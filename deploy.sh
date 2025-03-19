#!/bin/bash

npm run build
rsync -av themes/lb-2019/dst/* root@vanguard.com.ar:/var/www/lucasbonomo.com/wordpress/wp-content/themes/lb19/
# rsync -av mu-plugins/* vanguard.com.ar:/var/www/lucasbonomo.com/wordpress/wp-content/mu-plugins/