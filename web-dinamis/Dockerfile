FROM php:8.2-apache

# Install ekstensi mysqli
RUN docker-php-ext-install mysqli

# Aktifkan mod_rewrite
RUN a2enmod rewrite

# Copy semua file ke dalam container
COPY . /var/www/html/

# Buat folder uploads kalau belum ada, lalu set permission
RUN mkdir -p /var/www/html/assets/uploads/produk \
    && chmod -R 755 /var/www/html/assets/uploads/

# Konfigurasi Apache AllowOverride
RUN echo '<Directory /var/www/html>\n\
    Options Indexes FollowSymLinks\n\
    AllowOverride All\n\
    Require all granted\n\
</Directory>' > /etc/apache2/conf-available/app.conf \
    && a2enconf app

EXPOSE 80