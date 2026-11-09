#!/bin/bash
set -euo pipefail

# Sync the acf-json folder between the remote server and the local theme.
#
# Usage:
#   ./sync-acf-json.sh pull [--dry-run]   # remote -> local (default)
#   ./sync-acf-json.sh push [--dry-run]   # local  -> remote
#
# --dry-run shows what would change without transferring anything.

# Run from the theme root (directory of this script)
cd "$(dirname "$0")"

# --- Connection settings (shared with deploy.sh) ---
ip=45.152.44.24
port=65002
user=u112496268
domain=lucasbonomo.com
theme_name="lb-2019"

remote_theme_path="/home/$user/domains/$domain/public_html/wp-content/themes/$theme_name"
remote_acf="$remote_theme_path/acf-json/"
local_acf="./acf-json/"

# --- Parse arguments ---
direction="${1:-pull}"
dry_run=""

for arg in "$@"; do
    case "$arg" in
        --dry-run) dry_run="--dry-run" ;;
    esac
done

# rsync options:
#   -a archive, -v verbose, -z compress, --delete keep dirs identical
#   -i itemized changes so you can see exactly what happens
rsync_opts=(-avz --delete --itemize-changes -e "ssh -p $port")
if [ -n "$dry_run" ]; then
    rsync_opts+=("$dry_run")
fi

ensure_local_dir() {
    mkdir -p "$local_acf"
}

case "$direction" in
    pull)
        echo "⬇️  Pulling acf-json: remote -> local"
        [ -n "$dry_run" ] && echo "   (dry-run: no changes will be made)"
        ensure_local_dir
        rsync "${rsync_opts[@]}" "$user@$ip:$remote_acf" "$local_acf"
        ;;
    push)
        echo "⬆️  Pushing acf-json: local -> remote"
        [ -n "$dry_run" ] && echo "   (dry-run: no changes will be made)"
        rsync "${rsync_opts[@]}" "$local_acf" "$user@$ip:$remote_acf"
        ;;
    *)
        echo "❌ Dirección desconocida: '$direction'"
        echo "Uso: $0 [pull|push] [--dry-run]"
        exit 1
        ;;
esac

if [ $? -eq 0 ]; then
    echo "✅ Sincronización de acf-json completada ($direction)."
else
    echo "❌ Error al sincronizar acf-json."
    exit 1
fi
