# liquid-nextcloud


### How to run

    $ docker run \
        -p 8080:80 \
        -e NEXTCLOUD_ADMIN_USER=admin \
        -e NEXTCLOUD_ADMIN_PASSWORD=admin \
        -e POSTGRES_DB=nextcloud \
        -e POSTGRES_USER=nextcloud \
        -e POSTGRES_PASSWORD=nextcloud \
        -e POSTGRES_HOST=host.docker.internal:5432 \
        -e OC_PASS=secret \
        -v `pwd`/volumes/nextcloud:/var/www/html \
        liquidinvestigations/liquid-nextcloud:latest
