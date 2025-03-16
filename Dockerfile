FROM php:8.1-apache

# Installer les dépendances et extensions PHP
RUN apt-get update && apt-get install -y \
    libpq-dev \
    postgresql-client \
    && docker-php-ext-install pdo pdo_pgsql

# Activer le module rewrite d'Apache
RUN a2enmod rewrite

# Copier les fichiers du projet dans le conteneur
COPY ./Geekquiz/ /var/www/html/

# Configuration des droits d'accès
RUN chown -R www-data:www-data /var/www/html

# Exposer le port 80
EXPOSE 80

# Créer un script d'initialisation pour la base de données
COPY init-db.sh /usr/local/bin/
RUN chmod +x /usr/local/bin/init-db.sh

# Script d'entrée pour démarrer Apache et initialiser la base de données
COPY entrypoint.sh /usr/local/bin/
RUN chmod +x /usr/local/bin/entrypoint.sh

ENTRYPOINT ["/usr/local/bin/entrypoint.sh"]
CMD ["apache2-foreground"]