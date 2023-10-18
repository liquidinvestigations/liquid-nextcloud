FROM nextcloud:27-apache

RUN apt-get update -y && apt-get install -y wget unzip

RUN mkdir /apps-to-install

WORKDIR /apps-to-install

RUN wget -O sociallogin.zip https://github.com/liquidinvestigations/nextcloud-social-login/archive/refs/heads/master.zip 

WORKDIR /var/www/html
