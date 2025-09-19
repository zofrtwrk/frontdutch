# Use lightweight PHP + Apache image (serves HTML & PHP)
FROM php:8.2-apache

# Copy site files into Apache web root
COPY . /var/www/html

# Enable .htaccess + headers (for CORS) + rewrites
RUN a2enmod rewrite headers

# Allow .htaccess to work + prefer index.html first
RUN printf "ServerName localhost\n" > /etc/apache2/conf-available/servername.conf \
 && a2enconf servername \
 && printf "DirectoryIndex index.html index.php\n" > /etc/apache2/conf-available/dirindex.conf \
 && a2enconf dirindex \
 && printf "<Directory /var/www/html>\n  AllowOverride All\n  Require all granted\n</Directory>\n" \
      > /etc/apache2/conf-available/override.conf \
 && a2enconf override

# (Optional) simple health endpoint for platforms
RUN printf '%s\n' "<?php header('Content-Type: text/plain'); echo 'OK';" > /var/www/html/healthz.php

# Tighten permissions
RUN chown -R www-data:www-data /var/www/html

EXPOSE 80
CMD ["apache2-foreground"]
