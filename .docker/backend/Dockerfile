FROM debian:bookworm-20240423

#install
RUN apt-get update && apt-get install -y nginx nmap vim nano curl supervisor

RUN apt install apt-transport-https -y && \
    curl -sSLo /usr/share/keyrings/deb.sury.org-php.gpg https://packages.sury.org/php/apt.gpg && \
    sh -c 'echo "deb [signed-by=/usr/share/keyrings/deb.sury.org-php.gpg] https://packages.sury.org/php/ bookworm main" > /etc/apt/sources.list.d/php.list'
RUN apt update && apt install php8.3-fpm -y
RUN apt install php8.3-mysql -y
RUN apt install php8.3-xml php8.3-curl php8.3-dom -y

RUN curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin --filename=composer

#configuration
RUN echo 'extension=mysqli' >> /etc/php/8.3/fpm/php.ini
RUN echo 'extension=mysql' >> /etc/php/8.3/fpm/php.ini
RUN ln -s /usr/sbin/php-fpm8.3 /usr/sbin/php-fpm
ADD ./etc /etc
RUN rm /etc/nginx/sites-enabled/default

WORKDIR /var/www/html
CMD /usr/bin/supervisord -c /etc/supervisord.conf