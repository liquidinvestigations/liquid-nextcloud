FROM nextcloud:15

COPY ./config/custom.config.php /liquid/config/custom.config.php
COPY ./theme /liquid/themes/liquid

COPY ./setup.sh /setup.sh
RUN chmod 0775 /setup.sh
