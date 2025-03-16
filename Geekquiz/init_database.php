<?php
/**
 * Script d'initialisation de la base de données
 * Ce script vérifie si l'environnement est PostgreSQL ou MySQL et initialise la base de données en conséquence
 */

// Vérifier si on est en environnement PostgreSQL (Railway)
if (getenv('PGHOST')) {
    require_once 'database_postgres.php';
    echo "Initialisation de la base de données PostgreSQL...<br>";
    
    // Créer les tables si elles n'existent pas
    if (createPostgresTables($pdo)) {
        echo "Tables PostgreSQL créées avec succès.<br>";
    } else {
        echo "Erreur lors de la création des tables PostgreSQL.<br>";
        exit();
    }
    
    // Vérifier si des données existent déjà
    $stmt = $pdo->query("SELECT COUNT(*) FROM users");
    $userCount = $stmt->fetchColumn();
    
    if ($userCount > 0) {
        echo "Des données existent déjà dans la base de données. Initialisation terminée.<br>";
        exit();
    }
    
    // Insérer des données de démonstration
    try {
        // Créer un utilisateur de démonstration
        $password = password_hash('password123', PASSWORD_DEFAULT);
        $stmt = $pdo->prepare("INSERT INTO users (username, email, password, role) VALUES (?, ?, ?, ?)");
        $stmt->execute(['admin', 'admin@geekquiz.com', $password, 'admin']);
        $adminId = $pdo->lastInsertId();
        
        // Créer un quiz de démonstration
        $stmt = $pdo->prepare("INSERT INTO quizzes (name, description, category, user_id) VALUES (?, ?, ?, ?)");
        $stmt->execute(['Quiz de démonstration', 'Un quiz pour tester l\'application', 'démo', $adminId]);
        $quizId = $pdo->lastInsertId();
        
        // Créer des questions et réponses
        $questions = [
            'Quelle est la capitale de la France?' => [
                ['Paris', true],
                ['Lyon', false],
                ['Marseille', false],
                ['Toulouse', false]
            ],
            'Qui a peint la Joconde?' => [
                ['Picasso', false],
                ['Van Gogh', false],
                ['Michel-Ange', false],
                ['Léonard de Vinci', true]
            ],
            'Combien font 2+2?' => [
                ['3', false],
                ['4', true],
                ['5', false],
                ['22', false]
            ]
        ];
        
        foreach ($questions as $questionText => $answers) {
            $stmt = $pdo->prepare("INSERT INTO questions (quiz_id, question_text) VALUES (?, ?)");
            $stmt->execute([$quizId, $questionText]);
            $questionId = $pdo->lastInsertId();
            
            foreach ($answers as $answer) {
                $stmt = $pdo->prepare("INSERT INTO answers (question_id, answer_text, is_correct) VALUES (?, ?, ?)");
                $stmt->execute([$questionId, $answer[0], $answer[1]]);
            }
        }
        
        echo "Données de démonstration insérées avec succès.<br>";
        
    } catch (PDOException $e) {
        echo "Erreur lors de l'insertion des données de démonstration : " . $e->getMessage() . "<br>";
    }
} else {
    // Environnement MySQL (développement local)
    require_once 'database.php';
    echo "Environnement MySQL détecté. Pas d'initialisation nécessaire.<br>";
}

echo "Initialisation de la base de données terminée.<br>";
echo "<a href='index.php'>Retour à l'accueil</a>";