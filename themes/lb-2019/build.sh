#!/bin/bash
set -euo pipefail

# Run from the theme root (directory of this script)
cd "$(dirname "$0")"

THEME_SLUG="lb-2019"

# Get version from the source style.css (source of truth)
VERSION=$(grep -i "Version:" style.css | head -n1 | cut -d':' -f2 | tr -d ' \r')
if [ -z "$VERSION" ]; then
    echo "❌ Error: no se pudo leer la versión de style.css"
    exit 1
fi

echo "🚀 Empaquetando ${THEME_SLUG} v${VERSION}..."

# Clean dist/ so stale artifacts don't leak into the zip
rm -rf dist

# Build theme (vite build + sync of static files into dist/)
npm run build

if [ ! -d dist ]; then
    echo "❌ Error: el build no generó el directorio dist/"
    exit 1
fi

# Assemble the zip with the theme slug as the root directory
ZIP_NAME="${THEME_SLUG}.${VERSION}.zip"
OUT_ZIP="$PWD/${ZIP_NAME}"

# Remove a previous zip with the same version, if any
rm -f "$OUT_ZIP"

TMP_DIR="$(mktemp -d)"
trap 'rm -rf "$TMP_DIR"' EXIT

mkdir -p "$TMP_DIR/${THEME_SLUG}"
cp -a dist/. "$TMP_DIR/${THEME_SLUG}/"

# Defensive cleanup: drop any nested build artifacts that may exist in dist/
rm -rf "$TMP_DIR/${THEME_SLUG}/dist" \
       "$TMP_DIR/${THEME_SLUG}/lb19" \
       "$TMP_DIR/${THEME_SLUG}/${THEME_SLUG}."*
find "$TMP_DIR/${THEME_SLUG}" -name '*.zip' -delete

(
    cd "$TMP_DIR"
    zip -rq "$OUT_ZIP" "${THEME_SLUG}"
)

if [ ! -f "$OUT_ZIP" ]; then
    echo "❌ Error: no se pudo crear el archivo ZIP"
    exit 1
fi

SIZE=$(du -h "$OUT_ZIP" | cut -f1)
echo "✅ ZIP creado: ${ZIP_NAME} (${SIZE})"
