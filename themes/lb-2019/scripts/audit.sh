#!/bin/bash
set -uo pipefail

# Generic post-publish web audit. Works for any site.
#
# Usage:
#   audit.sh <url> [--deep] [--out DIR] [--max-links N] [--strict]
#
#   <url>          Site or page to audit (e.g. https://example.com/post/)
#   --deep         Also run the Kiro "web-audit" agent (Core Web Vitals, a11y,
#                  full SEO review via chrome-devtools MCP). Needs kiro-cli.
#   --out DIR      Report directory (default: ./audit-reports)
#   --max-links N  Max internal links to spot-check (default: 25)
#   --strict       Exit 1 if any quick check fails (useful in CI / deploy)
#
# Env overrides: AUDIT_URL, AUDIT_OUT, AUDIT_MAX_LINKS
#
# Quick checks (curl only, no LLM): HTTP status, redirects/HTTPS, TTFB,
# compression, caching + security headers, SEO tags, robots.txt, sitemap.xml,
# internal link status spot-check.

URL="${AUDIT_URL:-}"
OUT="${AUDIT_OUT:-./audit-reports}"
MAX_LINKS="${AUDIT_MAX_LINKS:-25}"
DEEP=0
STRICT=0

while [ $# -gt 0 ]; do
    case "$1" in
        --deep) DEEP=1 ;;
        --strict) STRICT=1 ;;
        --out) OUT="${2:?--out needs a value}"; shift ;;
        --max-links) MAX_LINKS="${2:?--max-links needs a value}"; shift ;;
        -h|--help) sed -n '3,20p' "$0"; exit 0 ;;
        -*) echo "Unknown option: $1" >&2; exit 2 ;;
        *) URL="$1" ;;
    esac
    shift
done

if [ -z "$URL" ]; then
    echo "Usage: $0 <url> [--deep] [--out DIR] [--max-links N] [--strict]" >&2
    exit 2
fi
case "$URL" in
    http://*|https://*) ;;
    *) echo "❌ URL must start with http:// or https://" >&2; exit 2 ;;
esac

command -v curl >/dev/null || { echo "❌ curl is required" >&2; exit 2; }

ORIGIN=$(printf '%s' "$URL" | sed -E 's#^(https?://[^/]+).*#\1#')
HOST=$(printf '%s' "$ORIGIN" | sed -E 's#^https?://##')
STAMP=$(date +%Y%m%d-%H%M%S)
mkdir -p "$OUT"
REPORT="$OUT/audit-${HOST}-${STAMP}.md"
TMP=$(mktemp -d)
trap 'rm -rf "$TMP"' EXIT

FAILS=0
WARNS=0
pass() { echo "- ✅ $1" | tee -a "$REPORT"; }
warn() { echo "- ⚠️  $1" | tee -a "$REPORT"; WARNS=$((WARNS+1)); }
fail() { echo "- ❌ $1" | tee -a "$REPORT"; FAILS=$((FAILS+1)); }
section() { printf '\n## %s\n' "$1" | tee -a "$REPORT"; }

CURL=(curl -sS -L --max-time 30 -A "web-audit-script/1.0")

{
    echo "# Web audit: $URL"
    echo "Date: $(date -Is)"
} | tee "$REPORT"

# ---- Status, redirects, timing --------------------------------------------
section "HTTP status & timing"
METRICS=$("${CURL[@]}" -o "$TMP/body.html" -D "$TMP/headers.txt" \
    -w '%{http_code} %{url_effective} %{time_starttransfer} %{time_total} %{size_download} %{num_redirects}' "$URL" 2>"$TMP/err.txt") || {
    fail "Request failed: $(cat "$TMP/err.txt")"
    echo; echo "Report: $REPORT"; exit 1
}
read -r CODE FINAL TTFB TOTAL SIZE REDIRS <<<"$METRICS"

[ "$CODE" = "200" ] && pass "Status $CODE" || fail "Status $CODE (expected 200)"
[ "$REDIRS" -le 1 ] && pass "Redirects: $REDIRS" || warn "Redirect chain of $REDIRS hops"
case "$FINAL" in https://*) pass "Served over HTTPS ($FINAL)" ;; *) fail "Final URL is not HTTPS ($FINAL)" ;; esac
# TTFB threshold from web.dev: good < 0.8s, poor > 1.8s
awk -v t="$TTFB" 'BEGIN{exit !(t<0.8)}' && pass "TTFB ${TTFB}s (good < 0.8s)" || {
    awk -v t="$TTFB" 'BEGIN{exit !(t<=1.8)}' && warn "TTFB ${TTFB}s (needs improvement)" || fail "TTFB ${TTFB}s (poor > 1.8s)"; }
echo "- Total ${TOTAL}s, HTML ${SIZE} bytes" | tee -a "$REPORT"

# ---- Headers ---------------------------------------------------------------
section "Headers"
# Use the headers of the last response only
awk 'BEGIN{RS="\r\n\r\n"} {last=$0} END{print last}' "$TMP/headers.txt" | tr -d '\r' >"$TMP/last-headers.txt"
hdr() { grep -i "^$1:" "$TMP/last-headers.txt" | head -n1 | cut -d: -f2- | sed 's/^ *//'; }

[ -n "$(hdr content-encoding)" ] && pass "Compression: $(hdr content-encoding)" || {
    "${CURL[@]}" -o /dev/null -H 'Accept-Encoding: gzip, br' -D "$TMP/enc.txt" "$URL" 2>/dev/null
    grep -qi '^content-encoding:' "$TMP/enc.txt" && pass "Compression enabled" || warn "No gzip/br compression on HTML"; }
[ -n "$(hdr cache-control)" ] && pass "Cache-Control: $(hdr cache-control)" || warn "No Cache-Control header on HTML"
[ -n "$(hdr strict-transport-security)" ] && pass "HSTS present" || warn "Missing Strict-Transport-Security"
[ -n "$(hdr x-content-type-options)" ] && pass "X-Content-Type-Options present" || warn "Missing X-Content-Type-Options"
[ -n "$(hdr content-security-policy)" ] && pass "Content-Security-Policy present" || warn "Missing Content-Security-Policy"
[ -n "$(hdr referrer-policy)" ] && pass "Referrer-Policy present" || warn "Missing Referrer-Policy"

# ---- SEO / HTML ------------------------------------------------------------
section "SEO & HTML"
HTML="$TMP/body.html"
has() { grep -qiE "$1" "$HTML"; }

TITLE=$(grep -oiE '<title[^>]*>[^<]*' "$HTML" | head -n1 | sed -E 's/<title[^>]*>//I')
[ -n "$TITLE" ] && pass "Title: \"$TITLE\" (${#TITLE} chars)" || fail "Missing <title>"
[ -n "$TITLE" ] && [ "${#TITLE}" -gt 60 ] && warn "Title longer than ~60 chars"
has '<meta[^>]+name=["'\'']description["'\'']' && pass "Meta description present" || fail "Missing meta description"
has '<link[^>]+rel=["'\'']canonical["'\'']' && pass "Canonical link present" || warn "Missing canonical link"
has '<meta[^>]+name=["'\'']viewport["'\'']' && pass "Viewport meta present" || fail "Missing viewport meta"
has '<html[^>]+lang=' && pass "<html lang> present" || fail "Missing lang attribute on <html>"
has '<meta[^>]+property=["'\'']og:title["'\'']' && pass "Open Graph tags present" || warn "Missing Open Graph tags"
has '<meta[^>]+name=["'\'']twitter:card["'\'']' && pass "Twitter Card present" || warn "Missing Twitter Card"
has '<meta[^>]+name=["'\'']robots["''][^>]+noindex' && fail "Page is marked noindex"
H1=$(grep -oiE '<h1[ >]' "$HTML" | wc -l)
[ "$H1" -eq 1 ] && pass "Exactly one <h1>" || warn "Found $H1 <h1> elements (expected 1)"
NOALT=$(grep -oiE '<img(\s[^>]*)?>' "$HTML" | grep -viE '\salt=' | wc -l)
[ "$NOALT" -eq 0 ] && pass "All <img> have alt" || warn "$NOALT <img> without alt attribute"
has 'application/ld\+json' && pass "Structured data (JSON-LD) present" || warn "No JSON-LD structured data"

# ---- robots.txt & sitemap --------------------------------------------------
section "robots.txt & sitemap"
RC=$("${CURL[@]}" -o "$TMP/robots.txt" -w '%{http_code}' "$ORIGIN/robots.txt" 2>/dev/null || echo 000)
if [ "$RC" = "200" ]; then
    pass "robots.txt found"
    grep -qiE '^\s*Disallow:\s*/\s*$' "$TMP/robots.txt" && fail "robots.txt disallows the whole site"
else
    warn "robots.txt not found ($RC)"
fi
SITEMAP=$(grep -iE '^\s*Sitemap:' "$TMP/robots.txt" 2>/dev/null | head -n1 | sed -E 's/^[^:]+:\s*//' | tr -d '\r')
SITEMAP="${SITEMAP:-$ORIGIN/sitemap.xml}"
SC=$("${CURL[@]}" -o /dev/null -w '%{http_code}' "$SITEMAP" 2>/dev/null || echo 000)
[ "$SC" = "200" ] && pass "Sitemap reachable: $SITEMAP" || warn "Sitemap not reachable ($SC): $SITEMAP"

# ---- Internal links spot-check --------------------------------------------
section "Internal links (up to $MAX_LINKS)"
grep -oiE 'href=["'\''][^"'\'']+' "$HTML" | sed -E 's/^href=["'\'']//I' \
    | sed -E "s#^//#https://#; s#^/#${ORIGIN}/#" \
    | grep -E "^${ORIGIN}" | sed 's/#.*//' | sort -u | head -n "$MAX_LINKS" >"$TMP/links.txt"
BROKEN=0
while IFS= read -r link; do
    [ -z "$link" ] && continue
    lc=$("${CURL[@]}" -o /dev/null -I -w '%{http_code}' "$link" 2>/dev/null || echo 000)
    # Some servers reject HEAD; retry with GET
    case "$lc" in 405|403|000) lc=$("${CURL[@]}" -o /dev/null -w '%{http_code}' "$link" 2>/dev/null || echo 000) ;; esac
    case "$lc" in 2*|3*) ;; *) fail "$lc $link"; BROKEN=$((BROKEN+1)) ;; esac
done <"$TMP/links.txt"
[ "$BROKEN" -eq 0 ] && pass "No broken internal links among $(wc -l <"$TMP/links.txt") checked"

# ---- Deep audit with Kiro agent -------------------------------------------
if [ "$DEEP" -eq 1 ]; then
    section "Deep audit (Kiro web-audit agent)"
    if command -v kiro-cli >/dev/null; then
        DEEP_OUT="$OUT/audit-${HOST}-${STAMP}-deep.md"
        echo "Running agent; this can take a few minutes..."
        if kiro-cli chat --agent web-audit --no-interactive \
            "Audit $URL following your full scope (performance/Core Web Vitals, SEO, accessibility, links). Output the report in the required format." \
            >"$DEEP_OUT" 2>&1; then
            pass "Deep report saved: $DEEP_OUT"
        else
            warn "Deep audit failed; see $DEEP_OUT"
        fi
    else
        warn "kiro-cli not found; skipping deep audit"
    fi
fi

# ---- Summary ---------------------------------------------------------------
section "Summary"
echo "- Failures: $FAILS | Warnings: $WARNS" | tee -a "$REPORT"
echo; echo "📄 Report: $REPORT"

if [ "$STRICT" -eq 1 ] && [ "$FAILS" -gt 0 ]; then exit 1; fi
exit 0
