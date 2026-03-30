#! /bin/bash
set -e

# Configuración
ip=45.152.44.24
port=65002
user=u112496268
domain=lucasbonomo.com
public_dir=/home/$user/domains/$domain/public_html
db_name=u112496268_IgTgF
db_user=u112496268_WEq0k
db_password=KPdSyDg1N8
db_host=127.0.0.1
dump_file=/home/$user/$domain-dump.sql

# /home/u112496268/domains/lucasbonomo.com/public_html

# Create database dump from production server with mysqldump
echo "Creating database dump from production server..."
ssh -p $port $user@$ip "MYSQL_PWD='$db_password' mysqldump --host='$db_host' --user='$db_user' --add-drop-table '$db_name' > '$dump_file'"
# If there is an error, exit the script
if [ $? -ne 0 ]; then
	echo "Error creating database dump from production server. Exiting."
	exit 1
fi
sleep 15 # Wait for the database dump to be created

# Get wp-content/media and database dump from production server
echo "Syncing wp-content/uploads from production server..."
rsync -avz --progress -e "ssh -p $port" $user@$ip:$public_dir/wp-content/uploads/ ../uploads/
sleep 15 # Wait for the database dump to be created

# Get database dump from production server
echo "Syncing database dump from production server..."
rsync -avz --progress -e "ssh -p $port" $user@$ip:$dump_file ./
sleep 15 # Wait for the database dump to be created

# Use Lando to import the database dump
echo "Importing database dump into local environment..."
lando db-import $domain-dump.sql

lando wp search-replace 'lucasbonomo.com' 'lucasbonomo.lndo.site' --skip-columns=guid