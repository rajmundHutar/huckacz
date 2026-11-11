# Local development image mirroring WEDOS hosting (Apache + PHP 8.5)
FROM php:8.5-apache

RUN a2enmod rewrite \
	&& sed -ri 's#DocumentRoot /var/www/html#DocumentRoot /var/www/html/www#' /etc/apache2/sites-available/000-default.conf \
	&& printf '<Directory /var/www/html/www>\n\tAllowOverride All\n</Directory>\n' > /etc/apache2/conf-enabled/app.conf
