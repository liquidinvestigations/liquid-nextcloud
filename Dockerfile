FROM nextcloud:stable-apache

RUN apt-get update -y && apt-get install -y jq sudo postgresql-client wget
RUN wget https://dl.min.io/client/mc/release/linux-amd64/mc -nv -O /bin/mc \
 && chmod +x /bin/mc \
 && /bin/mc --version \
 && psql --version

COPY ./theme /liquid/theme
RUN echo 'www-data ALL = (root) NOPASSWD: /bin/chown' >> /etc/sudoers
