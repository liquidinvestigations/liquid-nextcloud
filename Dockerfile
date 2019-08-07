FROM nextcloud:16.0.3

RUN apt-get update -y && apt-get install -y jq sudo

COPY ./theme /liquid/theme

COPY ./setup.sh /setup.sh
RUN chmod 0775 /setup.sh
