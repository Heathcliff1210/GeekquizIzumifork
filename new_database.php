<?php
// Détection automatique de l'environnement (PostgreSQL en production, MySQL en développement)
if (getenv('PGHOST')) {
    // Environnement de production (Railway) - Utiliser PostgreSQL
    include 'database_postgres.php';
} else {
    // Environnement de développement local - Utiliser MySQL
    $host = 'localhost';
    $username = 'root';
    $password = '';
    $database = 'quizz';
    $charset = 'utf8mb4';
    $options = [
        PDO::ATTR_ERRMODE            => PDO::ERRMODE_EXCEPTION,
        PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
        PDO::ATTR_EMULATE_PREPARES   => false,
    ];
    $dsn = "mysql:host=$host;dbname=$database;charset=$charset;port=3307";
    try {
        $pdo = new PDO($dsn, $username, $password, $options);
    } catch (\PDOException $e) {
        throw new \PDOException($e->getMessage(), (int)$e->getCode());
    }
}
?>