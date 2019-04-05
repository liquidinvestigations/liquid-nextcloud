FROM nextcloud:15

COPY ./config/custom.config.php /liquid/custom.config.php
COPY ./theme /liquid/theme

COPY ./setup.sh /setup.sh
RUN chmod 0775 /setup.sh
