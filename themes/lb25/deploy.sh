#!/bin/bash
ip=45.152.44.24
port=65002
user=u112496268
domain=gabrielasolano.com.ar
path=/home/$user/domains/$domain/public_html/
VERSION=$(grep "Version:" style.css | cut -d':' -f2 | tr -d ' ')
theme_name="gs-tailwind"

# Build theme
echo "🔨 Building theme version $VERSION..."
./build.sh

# Get last theme build
last_build=$(find ./zips -name "$theme_name.*.zip" | sort -V | tail -n 1)
theme_file_name=$(basename "$last_build")

# Copy last theme build
scp -P $port $last_build $user@$ip:/home/$user/

# Install and activate theme.
ssh -p $port $user@$ip "wp theme install $theme_file_name --path=$path --force --activate"

if [ $? -eq 0 ]; then
    echo "✅ Tema desplegado exitosamente en el servidor."
else
    echo "❌ Error al desplegar el tema en el servidor."
fi
