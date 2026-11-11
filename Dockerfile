# Local development image mirroring WEDOS hosting (Apache + PHP 8.5)
FROM php:8.5-apache

# Run Apache as UID/GID 1000 so files written to the bind-mounted log/ and temp/ stay owned by the host user
RUN usermod -u 1000 www-data && groupmod -g 1000 www-data

RUN a2enmod rewrite \
	&& sed -ri 's#DocumentRoot /var/www/html#DocumentRoot /var/www/html/www#' /etc/apache2/sites-available/000-default.conf \
	&& printf '<Directory /var/www/html/www>\n\tAllowOverride All\n</Directory>\n' > /etc/apache2/conf-enabled/app.conf
