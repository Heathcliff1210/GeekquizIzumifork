<?php
/**
 * Fichier de configuration de la base de données PostgreSQL pour GeekQuiz
 */

// Inclure l'adaptateur PostgreSQL
require_once 'pg_adapter.php';

// Vérifier si DATABASE_URL est disponible (utilisé par Render et Replit)
if (getenv('DATABASE_URL')) {
    $database_url = getenv('DATABASE_URL');
    
    // Analyser l'URL de la base de données
    $url = parse_url($database_url);
    
    $host = $url['host'] ?? '';
    $port = $url['port'] ?? 5432;
    $user = $url['user'] ?? '';
    $password = $url['pass'] ?? '';
    $dbname = ltrim($url['path'] ?? '', '/');
} else {
    // Méthode traditionnelle Railway avec variables individuelles
    $host = getenv('PGHOST');
    $dbname = getenv('PGDATABASE');
    $user = getenv('PGUSER');
    $password = getenv('PGPASSWORD');
    $port = getenv('PGPORT');
}

// Connexion à la base de données PostgreSQL
try {
    $dsn = "pgsql:host=$host;port=$port;dbname=$dbname";
    $options = [
        PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
        PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
        PDO::ATTR_EMULATE_PREPARES => false,
    ];
    
    $pdo = new PDO($dsn, $user, $password, $options);
    
    // Vérifier si les tables existent, sinon les créer
    $result = $pdo->query("SELECT EXISTS (
        SELECT FROM information_schema.tables 
        WHERE table_name = 'users'
    )");
    
    if (!$result->fetchColumn()) {
        // Les tables n'existent pas, on les crée
        createPostgresTables($pdo);
    }
    
} catch (PDOException $e) {
    // En cas d'erreur, afficher le message et terminer le script
    die("Erreur de connexion à la base de données PostgreSQL: " . $e->getMessage());
}