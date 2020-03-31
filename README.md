# liquid-nextcloud

[![Build Status](https://jenkins.liquiddemo.org/api/badges/liquidinvestigations/liquid-nextcloud/status.svg)](https://jenkins.liquiddemo.org/liquidinvestigations/liquid-nextcloud)

### How to run

1. Start NextCloud and let it do its first-run initialization:

        docker run --rm \
            -p 8080:80 \
            -v `pwd`/volumes/nextcloud:/var/www/html \
            liquidinvestigations/liquid-nextcloud:latest

As a strategy, polling /status.php until it returns 200 should be ok.

Take note of where the service is available internally (in the following example: 10.66.60.1 port 27777).


2. Set up our theme and config by running the setup script as www-data:

        docker run --rm \
            --user www-data:www-data \
            -e NEXTCLOUD_INTERNAL_STATUS_URL=http://10.66.60.1:27777/status.php \
            -e NEXTCLOUD_ADMIN_USER=admin \
            -e NEXTCLOUD_ADMIN_PASSWORD=admin \
            -e POSTGRES_DB=nextcloud \
            -e POSTGRES_USER=nextcloud \
            -e POSTGRES_PASSWORD=nextcloud \
            -e POSTGRES_HOST=host.docker.internal:5432 \
            -e NEXTCLOUD_HOST=external.example.com \
            -e OC_PASS=my-secret-password \
            -v `pwd`/volumes/nextcloud:/var/www/html \
            liquidinvestigations/liquid-nextcloud:latest \
            /setup.sh


This script will create two users:

- "admin", password: admin
- "uploads", password: my-secret-password


### Docker build

https://hub.docker.com/r/liquidinvestigations/liquid-nextcloud
