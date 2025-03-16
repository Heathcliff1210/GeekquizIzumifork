<?php
/**
 * Fichier de configuration de la base de données pour GeekQuiz
 * Ce fichier détecte automatiquement s'il faut utiliser PostgreSQL ou MySQL
 */

// Vérifier si nous sommes en environnement PostgreSQL (Railway, Render, Replit)
if (getenv('PGHOST') || getenv('DATABASE_URL')) {
    // Utiliser la connexion PostgreSQL
    require_once 'database_postgres.php';
} else {
    // Configuration MySQL (environnement local)
    $host = 'localhost';
    $db = 'geekquiz';
    $user = 'root';
    $pass = '';
    $charset = 'utf8mb4';

    $dsn = "mysql:host=$host;dbname=$db;charset=$charset";
    $options = [
        PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
        PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
        PDO::ATTR_EMULATE_PREPARES => false,
    ];

    try {
        $pdo = new PDO($dsn, $user, $pass, $options);
    } catch (PDOException $e) {
        die("Erreur de connexion à la base de données MySQL: " . $e->getMessage());
    }
}

// Fonction pour vérifier si on doit utiliser pgInsertScore
function isPostgres() {
    return getenv('PGHOST') !== false || getenv('DATABASE_URL') !== false;
}