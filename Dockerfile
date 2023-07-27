FROM nextcloud:27-apache

RUN apt-get update -y && apt-get install -y wget unzip

RUN mkdir /apps-to-install

WORKDIR /apps-to-install

RUN wget https://github.com/liquidinvestigations/nextcloud-social-login/archive/refs/tags/v5.4.3.zip

WORKDIR /var/www/html
