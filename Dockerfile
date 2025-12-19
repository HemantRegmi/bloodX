FROM php:8.1-apache

# Enable mysqli extension and Apache rewrite
RUN docker-php-ext-install mysqli && a2enmod rewrite

# Set Apache Default Page
RUN sed -i 's/DirectoryIndex index.html/DirectoryIndex home.php index.html/g' /etc/apache2/mods-available/dir.conf

# Set DocumentRoot to /var/www/html/app
RUN sed -i 's#DocumentRoot /var/www/html#DocumentRoot /var/www/html/app#g' /etc/apache2/sites-available/000-default.conf

# Allow overrides
RUN printf '\n<Directory /var/www/html/app>\n    Options Indexes FollowSymLinks\n    AllowOverride All\n    Require all granted\n</Directory>\n' >> /etc/apache2/sites-available/000-default.conf

# Copy application from CURRENT directory to /var/www/html/app
COPY . /var/www/html/app/

# Force DirectoryIndex via .htaccess (Strongest method)
RUN echo "DirectoryIndex home.php" > /var/www/html/app/.htaccess

RUN chown -R www-data:www-data /var/www/html

EXPOSE 80