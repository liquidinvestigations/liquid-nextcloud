# liquid-nextcloud


### How to run

1. Start NextCloud and let it do its first-run initialization:


        docker run \
            -p 8080:80 \
            -e NEXTCLOUD_ADMIN_USER=admin \
            -e NEXTCLOUD_ADMIN_PASSWORD=admin \
            -e POSTGRES_DB=nextcloud \
            -e POSTGRES_USER=nextcloud \
            -e POSTGRES_PASSWORD=nextcloud \
            -e POSTGRES_HOST=host.docker.internal:5432 \
            -e NC_HOST=localhost:8080
            -e OC_PASS=my-secret-password \
            -v `pwd`/volumes/nextcloud:/var/www/html \
            liquidinvestigations/liquid-nextcloud:latest

2. Set up our theme and config

        docker run \
            -e OC_PASS=my-secret-password \
            -v `pwd`/volumes/nextcloud:/var/www/html \
            liquidinvestigations/liquid-nextcloud:latest \
            /setup.sh
