#! /bin/bash

rsync -av --delete-after -e ssh themes/lb-2019/dst/ vanguard.com.ar:/var/www/lucasbonomo.com/wordpress/wp-content/themes/lb19/
