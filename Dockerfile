FROM php:8.1-apache

# Enable mysqli extension and Apache rewrite
RUN docker-php-ext-install mysqli && a2enmod rewrite

# Set Apache DocumentRoot to the application folder and default page to home.php
RUN sed -i 's#DocumentRoot /var/www/html#DocumentRoot /var/www/html/app#g' /etc/apache2/sites-available/000-default.conf \
	&& echo '<IfModule mod_dir.c>\n    DirectoryIndex home.php\n</IfModule>' > /etc/apache2/conf-available/directoryindex.conf \
	&& a2enconf directoryindex

# Ensure Apache can serve from the new DocumentRoot
RUN printf '\n<Directory /var/www/html/app>\n    Options Indexes FollowSymLinks\n    AllowOverride All\n    Require all granted\n</Directory>\n' >> /etc/apache2/sites-available/000-default.conf

# Copy application (includes css/ and image/ inside app/)
COPY app/ /var/www/html/app/

RUN chown -R www-data:www-data /var/www/html

EXPOSE 80