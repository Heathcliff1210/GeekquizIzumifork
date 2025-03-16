<?php
// Vérification des variables d'environnement
echo "Vérification des variables d'environnement:\n";
echo "DATABASE_URL: " . (getenv('DATABASE_URL') ? "Défini" : "Non défini") . "\n";
echo "PGHOST: " . (getenv('PGHOST') ? "Défini" : "Non défini") . "\n";
echo "PGDATABASE: " . (getenv('PGDATABASE') ? "Défini" : "Non défini") . "\n";
echo "PGUSER: " . (getenv('PGUSER') ? "Défini" : "Non défini") . "\n";
echo "PGPORT: " . (getenv('PGPORT') ? "Défini" : "Non défini") . "\n";

if (getenv('DATABASE_URL')) {
    echo "\nInformations DATABASE_URL:\n";
    $url = parse_url(getenv('DATABASE_URL'));
    echo "Host: " . ($url['host'] ?? 'Non défini') . "\n";
    echo "Port: " . ($url['port'] ?? 'Non défini') . "\n";
    echo "User: " . ($url['user'] ?? 'Non défini') . "\n";
    echo "Path: " . ($url['path'] ?? 'Non défini') . "\n";
}