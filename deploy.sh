#!/bin/bash

npm run build
rsync -av themes/lb-2019/dst/* vanguard.com.ar:/var/www/lucasbonomo.com/wordpress/wp-content/themes/lb19/
