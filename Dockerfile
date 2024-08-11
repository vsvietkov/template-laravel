FROM php:8.3-fpm

ADD https://github.com/mlocati/docker-php-extension-installer/releases/latest/download/install-php-extensions /usr/local/bin/

RUN apt-get update && apt-get install -y git wget curl sudo build-essential gcc make libpng-dev nano python-is-python3 zip unzip cron iputils-ping

RUN chmod +x /usr/local/bin/install-php-extensions && sync && install-php-extensions gd zip soap pdo_mysql redis pcntl pcov http

COPY --from=composer:latest /usr/bin/composer /usr/bin/composer

RUN useradd -G www-data,root,sudo -u 1000 -d /home/deployer deployer
RUN echo "deployer:deployerpassword" | chpasswd
RUN mkdir -p /home/deployer/.composer && \
    chown -R deployer:deployer /home/deployer

ARG WORKDIR=/var/www/app
WORKDIR $WORKDIR

USER deployer

RUN echo '* * * * * cd $WORKDIR && /usr/local/bin/php artisan schedule:run >> /home/deployer/cron_result' > /home/deployer/cron
RUN crontab -u deployer /home/deployer/cron

CMD /usr/local/sbin/php-fpm
