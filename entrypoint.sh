#!/bin/bash

# Chemin PHP adaptable pour fonctionner sur différentes plateformes
PHP=$(command -v php || echo "/nix/store/6abnc1cqyn1y6f7nh6v76aa6204mc79z-php-with-extensions-8.2.20/bin/php")

# Déterminer le répertoire de l'application
if [ -d "Geekquiz" ]; then
  GEEKQUIZ_DIR="Geekquiz"
elif [ -d "geekquiz" ]; then
  GEEKQUIZ_DIR="geekquiz"
else
  GEEKQUIZ_DIR="."
fi

# Initialiser silencieusement la base de données
if [ -f "$GEEKQUIZ_DIR/init_database.php" ]; then
  $PHP -f "$GEEKQUIZ_DIR/init_database.php" > /dev/null 2>&1
fi

# Utiliser le port fourni par l'environnement ou 5000 par défaut
PORT=${PORT:-5000}

# Changer vers le répertoire de l'application et démarrer le serveur
cd "$GEEKQUIZ_DIR" || { exit 1; }
$PHP -d display_errors=0 -d error_reporting=0 -S 0.0.0.0:$PORT