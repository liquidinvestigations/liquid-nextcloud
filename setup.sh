#!/bin/bash

set -ex

if [ -z "$NEXTCLOUD_INTERNAL_STATUS_URL" ]; then
    echo "Missing NEXTCLOUD_INTERNAL_STATUS_URL - please wait for apache to boot up"
    exit 1
fi

if [ -z "$POSTGRES_HOST" ]; then
    echo "Missing POSTGRES_HOST - please wait for the DB to spin up before running setup"
    exit 1
fi

INSTALLED=$(curl --silent --header "Host: $NEXTCLOUD_HOST" $NEXTCLOUD_INTERNAL_STATUS_URL | jq .installed)
if [ "$INSTALLED" == "true" ]; then
    echo "Nextcloud already installed"
    exit 0
elif [ "$INSTALLED" == "null" ]; then
    echo "Apache probably not accepting host header"
    exit 1
fi

cp /liquid/custom.config.php /var/www/html/config/custom.config.php
cp -r /liquid/theme /var/www/html/themes/liquid

chown -R www-data:www-data /var/www/html/config/custom.config.php
chmod g+s /var/www/html/config/custom.config.php

chown -R www-data:www-data /var/www/html/themes/liquid
chmod g+s /var/www/html/themes/liquid

php /var/www/html/occ \
        maintenance:install \
        --database pgsql \
        --database-name $POSTGRES_DB \
        --database-user $POSTGRES_USER \
        --database-pass $POSTGRES_PASSWORD \
        --database-host $POSTGRES_HOST \
        --admin-user=$NEXTCLOUD_ADMIN_USER \
        --admin-pass=$NEXTCLOUD_ADMIN_PASSWORD

php occ user:add --password-from-env --display-name="uploads" uploads

php occ app:disable theming
php occ app:disable accessibility
php occ app:disable activity
php occ app:disable comments
php occ app:disable federation
php occ app:disable files_pdfviewer
php occ app:disable files_versions
php occ app:disable files_videoplayer
php occ app:disable files_sharing
php occ app:disable firstrunwizard
php occ app:disable gallery
php occ app:disable nextcloud_announcements
php occ app:disable notifications
php occ app:disable password_policy
php occ app:disable sharebymail
php occ app:disable support
php occ app:disable survey_client
php occ app:disable systemtags
php occ app:disable updatenotification
