# Lucas Bonomo

## Local environment setup.

 - Install [Lando](https://docs.lando.dev/getting-started/installation.html).
 - Download `uploads` folder. 
   `rsync -avr vanguard.com.ar:/var/www/lucasbonomo.com/wordpress/wp-content/uploads/* ./uploads/`

 - Run `lando start` 
 - Run `lando wp --path=/app/wordpress core download`
 - Make `wp-config.php` file
   ```
   lando wp config create \
     --dbname=wordpress \
     --dbuser=wordpress \
     --dbpass=wordpress \
     --dbhost=database \
     --path=wordpress
   ```
 - Download the last database vers
   `rsync -av vanguard.com.ar:/media/backup/mysql/lucasbonomo.* ./tools`

 - Import database. We need the last version of database into the `tools` folder,
   ```bash
   gunzip /app/tools/lucasbonomo.[date].sql.gz
   wp db import /app/tools/lucasbonomo.[date].sql
   ```
 - Search and replace,
   ```bash
   wp --path=/app/wordpress --skip-plugins search-replace lucasbonomo.com lucasbonomo.lndo.site
   ```
 - Create admin use to developer.
  ```bash
    wp --path=/app/wordpress user update admin --user_pass=fauno
    wp plugin install --activate query-monitor
    wp plugin deactivate wp-mail-smtp
    wp config set WP_DEBUG true --raw
    wp config set WP_DEBUG_LOG true --raw
    wp config set WP_DEBUG_DISPLAY true --raw
    wp config set SCRIPT_DEBUG true --raw
  ```
## Test github action localy

- install [`act`](https://github.com/nektos/act#installation)
- run `act -W [work flow file]` Ex: `act -W .github/workflows/deploy-development.yml`
## Deploy
```
rsync -av themes/lb-2019/dst/* vanguard.com.ar:/var/www/lucasbonomo.com/wordpress/wp-content/themes/lb19/
```

## Working with theme
- `npm install`
- `npm run dev` -> to developer
- `npm run build` -> to build for production
