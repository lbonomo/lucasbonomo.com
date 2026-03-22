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


# Clean up Claudflare cache.
echo "🌐 Limpiando cache de Cloudflare..."
zone_id="889a84026fb83775ac107265294e2e92"
api_token="cfut_D7t1FitYA2rD3SLgzlvXJSWR2eO5aiRXEWrhpgif9fa392ba"
curl -X POST "https://api.cloudflare.com/client/v4/zones/$zone_id/purge_cache" \
     -H "Authorization: Bearer $api_token" \
     -H "Content-Type: application/json" \
     --data '{"purge_everything":true}'


     