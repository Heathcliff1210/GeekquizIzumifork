<?php
/**
 * Script d'initialisation de la base de données
 * Ce script vérifie si l'environnement est PostgreSQL ou MySQL et initialise la base de données en conséquence
 */

// Vérifier si on est en environnement PostgreSQL (Railway, Render, Replit)
if (getenv('PGHOST') || getenv('DATABASE_URL')) {
    require_once 'database_postgres.php';
    
    // Créer les tables si elles n'existent pas
    if (!createPostgresTables($pdo)) {
        die("Erreur lors de la création des tables PostgreSQL.");
    }
    
    // Vérifier si des données existent déjà
    $stmt = $pdo->query("SELECT COUNT(*) FROM users");
    $userCount = $stmt->fetchColumn();
    
    if ($userCount > 0) {
        // Les données existent, pas besoin d'initialiser
        return;
    }
    
    // Importer les données MySQL vers PostgreSQL
    require_once 'import_mysql_data.php';
    
    // Si l'importation échoue, insérer des données minimales de secours
    if ($pdo->query("SELECT COUNT(*) FROM users")->fetchColumn() == 0) {
        try {
            // Créer un utilisateur de secours
            $password = password_hash('admin123', PASSWORD_DEFAULT);
            $stmt = $pdo->prepare("INSERT INTO users (username, email, password, role) VALUES (?, ?, ?, ?)");
            $stmt->execute(['admin', 'admin@geekquiz.com', $password, 'admin']);
            
            // Copier dans formulaire pour assurer la compatibilité
            $adminId = $pdo->lastInsertId();
            $stmt = $pdo->prepare("INSERT INTO formulaire (username, email, password) VALUES (?, ?, ?)");
            $stmt->execute(['admin', 'admin@geekquiz.com', $password]);
            
            echo "Données minimales créées avec succès.";
        } catch (PDOException $e) {
            die("Erreur lors de l'insertion des données minimales : " . $e->getMessage());
        }
    }
} else {
    // Environnement MySQL (développement local)
    require_once 'database.php';
}