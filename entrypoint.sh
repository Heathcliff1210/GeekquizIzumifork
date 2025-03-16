#!/bin/bash

# Chemin PHP fixe
PHP="/nix/store/6abnc1cqyn1y6f7nh6v76aa6204mc79z-php-with-extensions-8.2.20/bin/php"
echo "Utilisation de PHP: $PHP"

# Vérification et initialisation de la base de données PostgreSQL
echo "Initialisation de la base de données PostgreSQL..."
$PHP -f Geekquiz/init_database.php

# Démarrage du serveur PHP
echo "Démarrage du serveur PHP sur le port 5000..."
cd Geekquiz
$PHP -S 0.0.0.0:5000