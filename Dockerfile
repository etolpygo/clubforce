FROM php:8.0-apache
WORKDIR /var/www/html

COPY src/ /var/www/html
EXPOSE 8000

RUN apt-get update && apt-get install apt-file -y && apt-file update && apt-get install vim -y


COPY demo.apache.conf /etc/apache2/sites-available/000-default.conf

RUN a2enmod rewrite &&\
    a2dissite 000-default &&\
    echo "ServerName localhost" >> /etc/apache2/apache2.conf &&\
    echo "Include sites-available/000-default.conf" >> /etc/apache2/apache2.conf &&\
    service apache2 restart