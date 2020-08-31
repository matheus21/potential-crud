FROM wyveo/nginx-php-fpm:latest
ENV HOME=/usr/share/nginx/
WORKDIR $HOME
RUN rm /etc/nginx/conf.d/default.conf
COPY conf/ /etc/nginx/conf.d/
RUN wget https://phar.phpunit.de/phpunit-9.3.8.phar
RUN chmod +x phpunit-9.3.8.phar
RUN mv phpunit-9.3.8.phar /usr/local/bin/phpunit