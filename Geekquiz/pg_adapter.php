<?php
/**
 * Adaptateur PostgreSQL pour le système GeekQuiz
 * Ce fichier contient des fonctions qui adaptent les requêtes SQL MySQL pour PostgreSQL
 */

/**
 * Fonction qui remplace la requête "ON DUPLICATE KEY UPDATE" de MySQL par une solution PostgreSQL
 * @param PDO $pdo Instance PDO
 * @param int $userId ID de l'utilisateur
 * @param int $quizId ID du quiz
 * @param float $score Score à insérer
 * @return bool Succès ou échec de l'opération
 */
function pgInsertScore($pdo, $userId, $quizId, $score) {
    try {
        // Vérifier si l'entrée existe déjà
        $stmt = $pdo->prepare('SELECT COUNT(*) FROM scores WHERE user_id = ? AND quiz_id = ?');
        $stmt->execute([$userId, $quizId]);
        $exists = (int)$stmt->fetchColumn() > 0;

        if ($exists) {
            // Mettre à jour l'entrée existante
            $stmt = $pdo->prepare('UPDATE scores SET score = ? WHERE user_id = ? AND quiz_id = ?');
            return $stmt->execute([$score, $userId, $quizId]);
        } else {
            // Insérer une nouvelle entrée
            $stmt = $pdo->prepare('INSERT INTO scores (user_id, quiz_id, score) VALUES (?, ?, ?)');
            return $stmt->execute([$userId, $quizId, $score]);
        }
    } catch (PDOException $e) {
        error_log('Erreur PostgreSQL : ' . $e->getMessage());
        return false;
    }
}

/**
 * Fonction qui convertit les requêtes MySQL en requêtes PostgreSQL
 * @param string $query Requête SQL MySQL
 * @return string Requête adaptée pour PostgreSQL
 */
function convertToPostgres($query) {
    // Remplacer les backticks par des guillemets doubles
    $query = preg_replace('/`([^`]+)`/', '"$1"', $query);
    
    // Remplacer AUTO_INCREMENT par SERIAL
    $query = str_replace('AUTO_INCREMENT', 'SERIAL', $query);
    
    // Remplacer les types de données
    $query = str_replace('INT(11)', 'INTEGER', $query);
    $query = str_replace('TINYINT(1)', 'BOOLEAN', $query);
    
    // Remplacer CURRENT_TIMESTAMP
    $query = str_replace('CURRENT_TIMESTAMP', 'CURRENT_TIMESTAMP', $query);
    
    // Remplacer le type d'index
    $query = str_replace('ENGINE=InnoDB', '', $query);
    $query = str_replace('DEFAULT CHARSET=utf8mb4', '', $query);
    $query = str_replace('COLLATE=utf8mb4_general_ci', '', $query);
    
    return $query;
}

/**
 * Fonction qui adapte une requête CREATE TABLE pour PostgreSQL
 * @param string $query Requête CREATE TABLE de MySQL
 * @return string Requête adaptée pour PostgreSQL
 */
function adaptCreateTable($query) {
    $query = convertToPostgres($query);
    
    // Gérer les clés primaires
    $query = preg_replace('/PRIMARY KEY\s+\(([^)]+)\)/', 'PRIMARY KEY ($1)', $query);
    
    // Gérer les contraintes de clé étrangère
    $query = preg_replace('/FOREIGN KEY\s+\(([^)]+)\) REFERENCES\s+([^(]+)\(([^)]+)\)/', 'FOREIGN KEY ($1) REFERENCES $2($3)', $query);
    
    return $query;
}

/**
 * Fonction pour créer les tables nécessaires dans PostgreSQL
 * @param PDO $pdo Instance PDO connectée à PostgreSQL
 * @return bool Succès ou échec de l'opération
 */
function createPostgresTables($pdo) {
    try {
        // Créer la table utilisateurs
        $pdo->exec("
            CREATE TABLE IF NOT EXISTS users (
                id SERIAL PRIMARY KEY,
                username VARCHAR(50) NOT NULL UNIQUE,
                email VARCHAR(100) NOT NULL UNIQUE,
                password VARCHAR(255) NOT NULL,
                created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
                role VARCHAR(20) DEFAULT 'user'
            );
        ");
        
        // Créer la table quizzes
        $pdo->exec("
            CREATE TABLE IF NOT EXISTS quizzes (
                id SERIAL PRIMARY KEY,
                name VARCHAR(100) NOT NULL,
                description TEXT,
                category VARCHAR(50) NOT NULL,
                user_id INTEGER REFERENCES users(id) ON DELETE CASCADE,
                created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
            );
        ");
        
        // Créer la table questions
        $pdo->exec("
            CREATE TABLE IF NOT EXISTS questions (
                id SERIAL PRIMARY KEY,
                quiz_id INTEGER REFERENCES quizzes(id) ON DELETE CASCADE,
                question_text TEXT NOT NULL,
                created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
            );
        ");
        
        // Créer la table réponses
        $pdo->exec("
            CREATE TABLE IF NOT EXISTS answers (
                id SERIAL PRIMARY KEY,
                question_id INTEGER REFERENCES questions(id) ON DELETE CASCADE,
                answer_text TEXT NOT NULL,
                is_correct BOOLEAN DEFAULT FALSE,
                created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
            );
        ");
        
        // Créer la table scores
        $pdo->exec("
            CREATE TABLE IF NOT EXISTS scores (
                id SERIAL PRIMARY KEY,
                user_id INTEGER REFERENCES users(id) ON DELETE CASCADE,
                quiz_id INTEGER REFERENCES quizzes(id) ON DELETE CASCADE,
                score DECIMAL(5,2) NOT NULL,
                created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
                UNIQUE(user_id, quiz_id)
            );
        ");
        
        // Créer la table formulaire
        $pdo->exec("
            CREATE TABLE IF NOT EXISTS formulaire (
                id SERIAL PRIMARY KEY,
                name VARCHAR(100) NOT NULL,
                email VARCHAR(100) NOT NULL,
                subject VARCHAR(100) NOT NULL,
                message TEXT NOT NULL,
                created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
            );
        ");
        
        return true;
    } catch (PDOException $e) {
        error_log('Erreur lors de la création des tables PostgreSQL : ' . $e->getMessage());
        return false;
    }
}