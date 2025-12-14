#!/bin/bash
ip=45.152.44.24
port=65002
user=u112496268
domain=lucasbonomo.com
path=/home/$user/domains/$domain/public_html/
theme_name="lb-2019"

# Build theme
./build.sh

# Get last theme build
last_build=$(find ./ -name "$theme_name.*.zip" | sort | tail -n 1)

# Copy last theme build
scp -P $port $last_build $user@$ip:/home/$user/


# Install and activate theme.
ssh -p $port $user@$ip "wp theme install $last_build --path=$path --force --activate"

if [ $? -eq 0 ]; then
    echo "✅ Tema desplegado exitosamente en el servidor."
else
    echo "❌ Error al desplegar el tema en el servidor."
fi