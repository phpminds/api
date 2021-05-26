FROM pavlakis/xdebug:3.0.3 AS xdebug
FROM pavlakis/php-apache-common:8.0.3

COPY xdebug.ini /usr/local/etc/php/conf.d/xdebug.ini
COPY apache.conf /etc/apache2/sites-available/000-default.conf

COPY --from=xdebug /usr/local/lib/php/extensions/no-debug-non-zts-20200930/xdebug.so /usr/local/lib/php/extensions/no-debug-non-zts-20200930/xdebug.so