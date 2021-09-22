FROM php:8.0-apache
WORKDIR /var/www/html

COPY src/ /var/www/html
EXPOSE 8000

RUN apt-get update && apt-get install apt-file -y && apt-file update && apt-get install vim -y && apt install -y git

#COMPOSER 
RUN php -r "copy('https://getcomposer.org/installer', 'composer-setup.php');" &&\
    php -r "if (hash_file('sha384', 'composer-setup.php') === '756890a4488ce9024fc62c56153228907f1545c228516cbf63f885e036d37e9a59d27d63f46af1d4d07ee0f76181c7d3') { echo 'Installer verified'; } else { echo 'Installer corrupt'; unlink('composer-setup.php'); } echo PHP_EOL;" &&\
    php composer-setup.php &&\
    php -r "unlink('composer-setup.php');"
RUN mv composer.phar /usr/local/bin/composer

#PHPUNIT install from composer.json
RUN composer install

#PCOV
RUN pecl install pcov
COPY php.ini /usr/local/etc/php/php.ini

#APACHE CONFIG
COPY demo.apache.conf /etc/apache2/sites-available/000-default.conf
RUN a2enmod rewrite &&\
    a2dissite 000-default &&\
    echo "ServerName localhost" >> /etc/apache2/apache2.conf &&\
    echo "Include sites-available/000-default.conf" >> /etc/apache2/apache2.conf &&\
    service apache2 restart