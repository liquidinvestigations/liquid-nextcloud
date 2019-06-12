# liquid-nextcloud


### How to run

1. Start NextCloud and let it do its first-run initialization:


        docker run --rm \
            -p 8080:80 \
            -e NEXTCLOUD_ADMIN_USER=admin \
            -e NEXTCLOUD_ADMIN_PASSWORD=admin \
            -e POSTGRES_DB=nextcloud \
            -e POSTGRES_USER=nextcloud \
            -e POSTGRES_PASSWORD=nextcloud \
            -e POSTGRES_HOST=host.docker.internal:5432 \
            -e NEXTCLOUD_HOST=localhost:8080 \
            -e OC_PASS=my-secret-password \
            -v `pwd`/volumes/nextcloud:/var/www/html \
            liquidinvestigations/liquid-nextcloud:latest


Take note of where the service is hosted (in the following example: 10.66.60.1 port 27777).


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
            -e OC_PASS=my-secret-password \
            -v `pwd`/volumes/nextcloud:/var/www/html \
            liquidinvestigations/liquid-nextcloud:latest \
            /setup.sh


### Docker build

https://hub.docker.com/r/liquidinvestigations/liquid-nextcloud
