#!/bin/bash
chown -R www-data:www-data /var/www/html/wordpress
chmod -R 755 /var/www/html/wordpress
service nginx restart
touch /root/success

