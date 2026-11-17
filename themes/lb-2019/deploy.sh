#!/bin/bash

# Load secrets (Cloudflare) from .env
cd "$(dirname "$0")"
if [ -f .env ]; then
    set -a; . ./.env; set +a
fi
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
if [ -z "${CLOUDFLARE_API_TOKEN:-}" ] || [ -z "${CLOUDFLARE_ZONE_ID:-}" ]; then
    echo "⚠️  Falta CLOUDFLARE_API_TOKEN/CLOUDFLARE_ZONE_ID en .env, se omite la purga."
else
    curl -X POST "https://api.cloudflare.com/client/v4/zones/$CLOUDFLARE_ZONE_ID/purge_cache" \
         -H "Authorization: Bearer $CLOUDFLARE_API_TOKEN" \
         -H "Content-Type: application/json" \
         --data '{"purge_everything":true}'
    echo
fi

# Optional post-deploy audit (opt-in).
#   AUDIT=1 ./deploy.sh              -> quick checks
#   AUDIT=1 AUDIT_DEEP=1 ./deploy.sh -> quick checks + Kiro web-audit agent
if [ "${AUDIT:-0}" = "1" ]; then
    echo ""
    echo "🔎 Auditando https://$domain ..."
    # Give Cloudflare a moment after the cache purge.
    sleep 5
    deep_flag=""
    [ "${AUDIT_DEEP:-0}" = "1" ] && deep_flag="--deep"
    ./scripts/audit.sh "https://$domain" $deep_flag --out ./audit-reports
fi
