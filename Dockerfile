FROM nextcloud:27-apache

RUN apt-get update -y && apt-get install -y wget unzip

RUN wget https://github.com/liquidinvestigations/nextcloud-social-login/archive/refs/heads/master.zip
RUN pwd
RUN ls .
RUN unzip master.zip
RUN mkdir -p /var/www/html/custom_apps/sociallogin
RUN mv nextcloud-social-login-master/* /var/www/html/custom_apps/sociallogin
RUN rm master.zip
RUN rm -r /var/www/html/nextcloud-social-login-master
