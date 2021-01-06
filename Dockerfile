FROM nextcloud:20-apache

RUN apt-get update -y && apt-get install -y jq sudo

COPY ./theme /liquid/theme
RUN echo 'www-data ALL = (root) NOPASSWD: /bin/chown' >> /etc/sudoers
