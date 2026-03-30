#!/bin/bash

# Build theme
npm run build

if [ $? -ne 0 ]; then
    echo "Error: Previous command failed."
    exit 1
fi

# Get version from style.css
VERSION=$(grep "Version:" dist/style.css | cut -d':' -f2 | tr -d ' ')

# Create zip file with lb19/ as root directory
TMP_DIR="$(mktemp -d)"
mkdir -p "$TMP_DIR/lb19"
cp -a dist/. "$TMP_DIR/lb19/"

(
    cd "$TMP_DIR" || exit 1
    zip -r "$OLDPWD/lb-2019.$VERSION.zip" lb19
)

rm -rf "$TMP_DIR"
