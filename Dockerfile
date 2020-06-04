FROM nextcloud:18-apache

RUN apt-get update -y && apt-get install -y jq sudo

COPY ./theme /liquid/theme

COPY ./setup.sh /setup.sh
RUN chmod 0775 /setup.sh

RUN echo 'www-data ALL = (root) NOPASSWD: /bin/chown,/bin/mount' >> /etc/sudoers
