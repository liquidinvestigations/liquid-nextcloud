FROM nextcloud:28.0.3-apache

RUN apt-get update -y && apt-get install -y wget unzip sudo

RUN mkdir /apps-to-install

WORKDIR /apps-to-install

RUN wget -O sociallogin.zip https://github.com/liquidinvestigations/nextcloud-social-login/archive/refs/heads/master.zip 

RUN unzip /apps-to-install/sociallogin.zip -d /apps-to-install

WORKDIR /var/www/html
