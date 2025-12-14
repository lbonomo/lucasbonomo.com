#!/bin/bash

# Build theme
npm run build

if [ $? -ne 0 ]; then
    echo "Error: Previous command failed."
    exit 1
fi

# Get version from style.css
VERSION=$(grep "Version:" lb19/style.css | cut -d':' -f2 | tr -d ' ')

# Create zip file
zip -r lb-2019.$VERSION.zip lb19
