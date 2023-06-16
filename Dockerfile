FROM nextcloud:27-apache

WORKDIR /tmp
RUN apt-get update -y && apt-get install -y wget unzip

RUN wget https://github.com/liquidinvestigations/nextcloud-social-login/archive/refs/heads/master.zip
RUN unzip /tmp/master.zip
RUN mkdir -p /var/www/html/custom_apps/sociallogin/
RUN mv /tmp/nextcloud-social-login-master/* /var/www/html/custom_apps/sociallogin/
RUN rm /tmp/master.zip
RUN rm -r /tmp/nextcloud-social-login-master
