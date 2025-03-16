#!/bin/bash

# Chemin PHP adaptable pour fonctionner sur différentes plateformes
PHP=$(command -v php || echo "/nix/store/6abnc1cqyn1y6f7nh6v76aa6204mc79z-php-with-extensions-8.2.20/bin/php")
echo "Utilisation de PHP: $PHP"

# Déterminer le répertoire de l'application
if [ -d "Geekquiz" ]; then
  GEEKQUIZ_DIR="Geekquiz"
elif [ -d "geekquiz" ]; then
  GEEKQUIZ_DIR="geekquiz"
else
  # Si aucun répertoire Geekquiz n'est trouvé, utiliser le répertoire courant
  GEEKQUIZ_DIR="."
fi

# Vérification et initialisation de la base de données PostgreSQL
echo "Initialisation de la base de données PostgreSQL..."
if [ -f "$GEEKQUIZ_DIR/init_database.php" ]; then
  $PHP -f "$GEEKQUIZ_DIR/init_database.php"
else
  echo "Fichier init_database.php non trouvé."
fi

# Utiliser le port fourni par l'environnement ou 5000 par défaut
PORT=${PORT:-5000}

# Démarrage du serveur PHP
echo "Démarrage du serveur PHP sur le port $PORT..."
cd "$GEEKQUIZ_DIR" || { echo "Erreur: Impossible d'accéder au répertoire $GEEKQUIZ_DIR"; exit 1; }
$PHP -d display_errors=0 -d error_reporting=0 -S 0.0.0.0:$PORT