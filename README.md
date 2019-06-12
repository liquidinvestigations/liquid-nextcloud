# liquid-nextcloud


### How to run

1. Start NextCloud and let it do its first-run initialization:


        docker run --rm \
            -p 8080:80 \
            -e ADMIN_USER=admin \
            -e ADMIN_PASSWORD=admin \
            -e POSTGRES_DB=nextcloud \
            -e POSTGRES_USER=nextcloud \
            -e POSTGRES_PASSWORD=nextcloud \
            -e POSTGRES_HOST=host.docker.internal:5432 \
            -e HOSTNAME=localhost:8080 \
            -e OC_PASS=my-secret-password \
            -v `pwd`/volumes/nextcloud:/var/www/html \
            liquidinvestigations/liquid-nextcloud:latest

2. Set up our theme and config

        docker run --rm \
            -e ADMIN_USER=admin \
            -e ADMIN_PASSWORD=admin \
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
