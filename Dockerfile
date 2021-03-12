FROM ubuntu:latest

LABEL maintainer="Humam Al Amin <humamalamin13@gmail.com>"

ARG DEBIAN_FRONTEND=noninteractive
ARG WORKDIR=/var/www/html

RUN apt update && apt upgrade -y && apt install -y software-properties-common && \
    add-apt-repository ppa:ondrej/php && apt install -y nginx \
    php7.4-fpm \
    php7.4-mbstring \
    php7.4-gd \
    php7.4-xml \
    php7.4-mysql \
    php7.4-xdebug \
    zip \
    unzip \
    nano \
    curl \
    git \
    make && \
    mkdir /root/.ssh/

# Copy nginx config
ADD ./docker/default.conf /etc/nginx/sites-available/default
# Copy SSH Key
ADD ./docker/id_rsa_docker /root/.ssh/id_rsa

# Set default working directory
WORKDIR ${WORKDIR}

RUN chmod 400 /root/.ssh/id_rsa && \
    touch /root/.ssh/known_hosts && \
    ssh-keyscan github.com/ >> /root/.ssh/known_hosts && \
    # Install composer
    curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/bin/ --filename=composer && \
    # Remove default index
    rm index.nginx-debian.html && \
    # Clone project from Github
    git clone --branch main git@github.com:humamalamin/test-brignote.git /var/www/html && \
    # Change workdir permission
    chown -R www-data.www-data ${WORKDIR} && \
    chmod -R 755 ${WORKDIR} && \
    chmod -R 777 ${WORKDIR}/storage && \
    # Install library using composer
    composer install && \
    # Copy environments
    cp ${WORKDIR}/.env.example ${WORKDIR}/.env

# Expose port 80
EXPOSE 80     

# Replace fpm sock with listening port 9000
CMD sed -i 's/\/run\/php\/php7.4-fpm.sock/127.0.0.1:9000/g' /etc/php/7.4/fpm/pool.d/www.conf && \
    # Start php7.3-FPM
    service php7.4-fpm start && \
    # Start Nginx
    nginx -g "daemon off;"
