#!/bin/sh
hostname -b phpbnl13-workshop.relaxnow.nl
ln -sf /usr/share/zoneinfo/Europe/Amsterdam /etc/localtime
echo "Setting sources from US to NL" &&
sed -i 's/us\./nl./' /etc/apt/sources.list &&
echo "Updating apt" &&
apt-get -qq update &&
echo "Installing dependencies" &&
apt-get -qq install -y apache2 php5 php5-curl php5-intl php5-mysql php5-sqlite php-apc git curl

echo "Configuring Apache" &&
a2enmod rewrite
sed -i "s/export APACHE_RUN_USER=www-data/export APACHE_RUN_USER=vagrant/" /etc/apache2/envvars
cp -f /vagrant/etc/apache2/sites-available/phpbnl13-workshop.relaxnow.nl.vhost /etc/apache2/sites-available &&
ln -sf /etc/apache2/sites-available/phpbnl13-workshop.relaxnow.nl.vhost /etc/apache2/sites-enabled/phpbnl13-workshop.relaxnow.nl.vhost

echo "Configuring PHP"
sed -i "s/;date.timezone =/date.timezone = Europe\/Amsterdam/" /etc/php5/apache2/php.ini
sed -i "s/;date.timezone =/date.timezone = Europe\/Amsterdam/" /etc/php5/cli/php.ini
sed -i "s/short_open_tag = On/short_open_tag = Off/" /etc/php5/apache2/php.ini
sed -i "s/short_open_tag = On/short_open_tag = Off/" /etc/php5/cli/php.ini

echo "Restarting Apache" &&
service apache2 restart

cd /vagrant &&
curl -s https://getcomposer.org/installer | php
./vendor/sensio/distribution-bundle/Sensio/Bundle/DistributionBundle/Resources/bin/build_bootstrap.php
chmod -R a+w app/cache app/logs