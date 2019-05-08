#!/bin/bash

set -ex

run_as() {
    if [ "$(id -u)" = 0 ]; then
        su -p www-data -s /bin/sh -c "$1"
    else
        sh -c "$1"
    fi
}

if [ -z "$NEXTCLOUD_POSTGRES_HOST" ]; then
    echo "Missing NEXTCLOUD_POSTGRES_HOST - please wait for the DB to spin up before running setup"
    exit
fi


run_as 'cp /liquid/custom.config.php /var/www/html/config/custom.config.php'
run_as 'cp -r /liquid/theme /var/www/html/themes/liquid'

run_as 'chown -R 33:33 /var/www/html/config/custom.config.php'
run_as 'chmod g+s /var/www/html/config/custom.config.php'

run_as 'chown -R 33:33 /var/www/html/themes/liquid'
run_as 'chmod g+s /var/www/html/themes/liquid'

initialized_state="/var/www/html/liquid-initialized"

if [ -f "$initialized_state" ]; then
    echo "Already initialized"
    exit
fi

run_as "php /var/www/html/occ maintenance:install --database pgsql --database-name $NEXTCLOUD_POSTGRES_DB --database-user $NEXTCLOUD_POSTGRES_USER --database-pass $NEXTCLOUD_POSTGRES_PASSWORD --database-host $NEXTCLOUD_POSTGRES_HOST --admin-user=$NEXTCLOUD_ADMIN_USER --admin-pass=$NEXTCLOUD_ADMIN_PASSWORD"
run_as 'php occ user:add --password-from-env --display-name="uploads" uploads'

run_as 'php occ app:disable theming'
run_as 'php occ app:disable accessibility'
run_as 'php occ app:disable activity'
run_as 'php occ app:disable comments'
run_as 'php occ app:disable federation'
run_as 'php occ app:disable files_pdfviewer'
run_as 'php occ app:disable files_versions'
run_as 'php occ app:disable files_videoplayer'
run_as 'php occ app:disable files_sharing'
run_as 'php occ app:disable firstrunwizard'
run_as 'php occ app:disable gallery'
run_as 'php occ app:disable nextcloud_announcements'
run_as 'php occ app:disable notifications'
run_as 'php occ app:disable password_policy'
run_as 'php occ app:disable sharebymail'
run_as 'php occ app:disable support'
run_as 'php occ app:disable survey_client'
run_as 'php occ app:disable systemtags'
run_as 'php occ app:disable updatenotification'

touch "$initialized_state"
