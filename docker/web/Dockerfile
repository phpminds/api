FROM pavlakis/xdebug:2.9.8 AS xdebug
FROM pavlakis/php-apache-common:7.4.10

COPY xdebug.ini /usr/local/etc/php/conf.d/xdebug.ini
ADD apache.conf /etc/apache2/sites-available/000-default.conf

COPY --from=xdebug /usr/local/lib/php/extensions/no-debug-non-zts-20190902/xdebug.so /usr/local/lib/php/extensions/no-debug-non-zts-20190902/xdebug.so
