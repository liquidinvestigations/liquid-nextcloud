FROM nextcloud:19-apache

RUN apt-get update -y && apt-get install -y jq sudo wget

COPY ./theme /liquid/theme

RUN echo 'www-data ALL = (root) NOPASSWD: /bin/chown' >> /etc/sudoers
