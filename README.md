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
   `rsync -av vanguard.com.ar:/media/backup/mysql/lucasbonomo.1693803604.sql.gz ./tools`

 - Import database. We need the last version of database into the `tools` folder,
   ```
   lando wp --path=/app/wordpress db import /app/tools/mysql.sql
   ```
 - Search and replace,
   ```
   lando wp --path=/app/wordpress --skip-plugins search-replace lucasbonomo.com lucasbonomo.lndo.site
   ```
 - Create admin use to developer.
   ```
   lando wp --path=/app/wordpress user update admin --user_pass=fauno
   ```
## Test github action localy

- install [`act`](https://github.com/nektos/act#installation)
- run `act -W [work flow file]` Ex: `act -W .github/workflows/deploy-development.yml`

## Working with theme
- `npm install`
- `npm run dev` -> to developer
- `npm run build` -> to build for production
