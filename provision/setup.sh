#!/bin/bash
#
# LKS SMK Environment
#
# Including Software:
# - LEMP (PHP-FPM + NGINX + MARIADB)
# - Mail Server (Postfix + Dovecot)
# - Composer
# - Laravel 5.0.x
#
# Used for Ubuntu Server 14.04
#
# @author   Iqbal Maulana  <iq.bluejack@gmail.com>
# @created  March, 16 2015
#

# Source function library
. /lib/lsb/init-functions

echo "Provisioning virtual machine..."

export DEBIAN_FRONTEND=noninteractive

# Updating repository
log_daemon_msg "Updating repository..."
apt-get update > /dev/null
log_end_msg 0

apt-get install unzip -y > /dev/null
apt-get install makepasswd -y > /dev/null
USER_NAME=sa
DB_NAME=app
USER_PASS=opensource

# Configuring locale
log_daemon_msg "Setting up locale..."
export LANGUAGE=en_US.UTF-8
export LANG=en_US.UTF-8
export LC_ALL=en_US.UTF-8

locale-gen en_US.UTF-8 > /dev/null
dpkg-reconfigure locales > /dev/null

log_end_msg 0

# Installing Git for repository update
log_daemon_msg "Installing Git..."
apt-get install git -y > /dev/null
log_end_msg 0

# Installing Nginx (HTTP Server)
log_daemon_msg "Installing Nginx..."
apt-get install nginx -y > /dev/null

# Configuring Nginx
log_action_msg "Configuring Nginx..."
cp /var/www/provision/config/app_vhost /etc/nginx/sites-available/app_vhost > /dev/null
ln -s /etc/nginx/sites-available/app_vhost /etc/nginx/sites-enabled/
rm -rf /etc/nginx/sites-enabled/default
log_end_msg 0

# Installing MariaDB
log_daemon_msg "Installing MariaDB..."

log_action_msg "Preparing MariaDB..."
IP_CLASS_C=$(ifconfig eth0 | grep 'inet addr:' | cut -d: -f2 | awk '{ print $1}' | tr -s '.' ' ' | awk '{ print $1"."$2"."$3 }')

#apt-get install debconf-utils -y > /dev/null
#debconf-set-selections <<< "mariadb-server mysql-server/root_password password $MYSQL_PASS"
#debconf-set-selections <<< "mariadb-server mysql-server/root_password_again password $MYSQL_PASS"

log_action_msg "Installing package..."
apt-get install mariadb-server mariadb-client -y --allow-unauthenticated > /dev/null

log_action_msg "Configuring MariaDB..."

mysql -u root -e "GRANT ALL PRIVILEGES ON *.* TO '$USER_NAME'@'%' IDENTIFIED BY '$USER_PASS'"
sed -i "s/bind-address.*/bind-address = 0.0.0.0/" /etc/mysql/my.cnf
log_end_msg 0

# Installing PHP
log_daemon_msg "Installing PHP..."

#log_action_msg "Updating repository..."
#apt-get install software-properties-common python-software-properties build-essential -y > /dev/null
#add-apt-repository ppa:ondrej/php5 -y > /dev/null
#apt-get update > /dev/null

apt-get install php5 php5-fpm -y > /dev/null

log_action_msg "Installing PHP extensions..."
apt-get install curl php5-curl php5-gd php5-mcrypt php5-mysql php5 php-pear php5-imagick php5-imap -y > /dev/null

php5enmod mcrypt

log_end_msg 0

# Installing Mail Server
log_daemon_msg "Installing Mail Server..."

log_action_msg "Installing Postfix..."
apt-get install -y postfix > /dev/null

sed -i "s/mynetworks =.*/mynetworks = 127.0.0.0\/8 0.0.0.0\/0 /" /etc/postfix/main.cf

log_action_msg "Installing Dovecot..."
apt-get install -y dovecot-common dovecot-imapd dovecot-pop3d > /dev/null

log_action_msg "Configuring Dovecot..."
cp /var/www/provision/config/dovecot_master /etc/dovecot/conf.d/10-master.conf  > /dev/null
sed -i "s/#disable_plaintext_auth.*/disable_plaintext_auth=no/" /etc/dovecot/conf.d/10-auth.conf
sed -i "s/#ssl.*/ssl=no/" /etc/dovecot/conf.d/10-ssl.conf
sed -i "s/#mail_privileged_group.*/mail_privileged_group=mail/" /etc/dovecot/conf.d/10-mail.conf
log_end_msg 0

log_daemon_msg "Creating User..."
useradd $USER_NAME -m -s /bin/bash

if [ -f /var/www/.vagrant/.user-passes ]
  then
    rm -f /var/www/.vagrant/.user-passes
fi

echo "${USER_NAME}:${USER_PASS}"|sudo chpasswd
echo "${USER_NAME}:${USER_PASS}" > /var/www/.vagrant/.user-pass
log_end_msg 0

if [ -f /var/www/.env ]
    then

        log_daemon_msg "Configuring Laravel..."

        mysql -u root -e "DROP DATABASE IF EXISTS $DB_NAME"
        mysql -u root -e "CREATE DATABASE $DB_NAME"
        mysql -u root -e "GRANT ALL PRIVILEGES ON ${DB_NAME}.* TO '$USER_NAME'@'%' IDENTIFIED BY '$USER_PASS'"

        sed -i "s/DB_HOST.*/DB_HOST=127.0.0.1/" /var/www/.env
        sed -i "s/DB_DATABASE.*/DB_DATABASE=${DB_NAME}/" /var/www/.env
        sed -i "s/DB_USERNAME.*/DB_USERNAME=${USER_NAME}/" /var/www/.env
        sed -i "s/DB_PASSWORD.*/DB_PASSWORD=${USER_PASS}/" /var/www/.env

        sed -i "s/MAIL_HOST.*/MAIL_HOST=localhost/" /var/www/.env
        sed -i "s/MAIL_PORT.*/MAIL_PORT=25/" /var/www/.env

        cd /var/www

        # Update dependency
        php composer.phar update > /dev/null
        php artisan optimize > /dev/null
        php artisan migrate > /dev/null
        php artisan db:seed > /dev/null

        log_end_msg 0
fi

# Restarting Services
log_daemon_msg "Restarting services.."

service php5-fpm restart > /dev/null
service nginx restart > /dev/null
service mysql restart > /dev/null
service postfix restart > /dev/null
service dovecot restart > /dev/null

log_end_msg 0


