#!/bin/bash

run_as() {
    if [ "$(id -u)" = 0 ]; then
        su -p www-data -s /bin/sh -c "$1"
    else
        sh -c "$1"
    fi
}

run_as 'cp /liquid/config/custom.config.php /var/www/html/config/custom.config.php'
run_as 'cp -r /liquid/themes/liquid /var/www/html/themes/liquid'

run_as 'chown -R 33:33 /var/www/html/config/custom.config.php'
run_as 'chmod g+s /var/www/html/config/custom.config.php'

run_as 'chown -R 33:33 /var/www/html/themes/liquid'
run_as 'chmod g+s /var/www/html/themes/liquid'

run_as 'php occ app:disable theming'
run_as 'php occ user:add --password-from-env --display-name="ncsync" ncsync'

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


