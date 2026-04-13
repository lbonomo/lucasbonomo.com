#!/usr/bin/env bash
set -euo pipefail

if ! command -v lando >/dev/null 2>&1; then
	echo "Error: lando command not found. Install/start Lando first." >&2
	exit 1
fi

echo "Ensuring plugin is active and fixtures are loaded..."
lando wp --path=/app/wordpress plugin activate simple-service >/dev/null 2>&1 || true
lando wp --path=/app/wordpress eval-file /app/wordpress/wp-content/plugins/simple-service/tests/fixtures/setup-service-block-fixtures.php
