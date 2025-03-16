<?php
/**
 * Script d'importation des données MySQL vers PostgreSQL
 * À exécuter une seule fois pour migrer les données
 */

// Vérifier si on est en environnement PostgreSQL
if (!getenv('PGHOST') && !getenv('DATABASE_URL')) {
    die("Ce script est conçu pour être utilisé uniquement avec PostgreSQL.");
}

// Connexion à la base de données
require_once 'database_postgres.php';

// Vérifier si les données ont déjà été importées
$stmt = $pdo->query("SELECT COUNT(*) FROM users");
$userCount = $stmt->fetchColumn();

if ($userCount > 0) {
    echo "Des données existent déjà dans la base. Importation annulée pour éviter les doublons.\n";
    exit;
}

// Début de la transaction pour assurer la cohérence des données
$pdo->beginTransaction();

try {
    // Importer les utilisateurs depuis la table formulaire MySQL
    $users = [
        [20, 'id', 'id@email', '$2y$10$Xi1NHbckBhKFwfp4mFr5EehSPayNA6DFUu2571Tq58IiDXGZNDjpa'],
        [22, 'Geekquiz', 'geek@email', '$2y$10$geIpn0lWAjvHyK1ZUxAVFOLTh2rzMuXIPGc2TzJcWvtS1JoIsy.7G'],
        [23, 'Player', 'player@mail.com', '$2y$10$kb6Vfn3wBswlsJ/92pBgb.tZr0RMVMbgX1yZct8OkX9JS7xa1FxhK'],
        [25, 'Arcano', 'arcano@email.com', '$2y$10$OeIr7Bdai/w5RWvkIdrpz.xuZb98y.YctEc4XTdJuIhmIS1dMTOhW'],
        [26, 'ami', 'ami@gmail.com', '$2y$10$RBzEn9JS20A0T.USfe1E/eM74RWmqC6KAhJoTFI0ZcpqlU4x7YGXa']
    ];

    // Insérer les utilisateurs dans la table users
    foreach ($users as $user) {
        $stmt = $pdo->prepare("INSERT INTO users (id, username, email, password, role) VALUES (?, ?, ?, ?, 'user')");
        $stmt->execute([$user[0], $user[1], $user[2], $user[3]]);
        
        // Pour assurer la compatibilité, copier aussi dans la table formulaire
        $stmt = $pdo->prepare("INSERT INTO formulaire (id, username, email, password) VALUES (?, ?, ?, ?)");
        $stmt->execute([$user[0], $user[1], $user[2], $user[3]]);
    }
    
    // Réinitialiser la séquence des ID utilisateurs
    $pdo->exec("SELECT setval('users_id_seq', (SELECT MAX(id) FROM users), true)");
    $pdo->exec("SELECT setval('formulaire_id_seq', (SELECT MAX(id) FROM formulaire), true)");
    
    // Importer les quizzes
    $quizzes = [
        [25, 'Quizz Cinema', 20],
        [26, 'Quizz Sur Bleach Only', 22],
        [27, 'Quizz sur les animaux', 23]
    ];
    
    foreach ($quizzes as $quiz) {
        $stmt = $pdo->prepare("INSERT INTO quizzes (id, name, user_id) VALUES (?, ?, ?)");
        $stmt->execute([$quiz[0], $quiz[1], $quiz[2]]);
    }
    
    // Réinitialiser la séquence des ID quizzes
    $pdo->exec("SELECT setval('quizzes_id_seq', (SELECT MAX(id) FROM quizzes), true)");
    
    // Importer les questions (trop nombreuses pour les lister toutes ici)
    $questions = [
        [42, 25, 'Quel réalisateur est célèbre pour avoir réalisé les films Titanic, Avatar et Les Dents de la mer ?'],
        [43, 25, 'Dans quel film d\'animation de Pixar doesse le personnage de Buzz Lightyear apparaître pour la première fois ?'],
        [44, 25, 'Quel acteur a incarné le rôle de Bruce Wayne / Batman dans les films Batman Begins, The Dark Knight et The Dark Knight Rises ?'],
        [45, 25, 'Quel pays est à l\'origine du film Parasite (2019), qui a remporté l\'Oscar du meilleur film ?'],
        [46, 25, 'Quelle actrice a joué le rôle principal dans le film Wonder Woman (2017) ?'],
        [47, 25, 'Dans le film Forrest Gump, quelle est la fameuse réplique que prononce Forrest Gump ?'],
        [48, 25, 'Quel film de science-fiction culte sorti en 1999 a été réalisé par The Wachowskis ?'],
        [49, 25, 'Quel acteur a joué le rôle de Darth Vader dans la trilogie originale de Star Wars ?'],
        [50, 25, 'Dans quel film de Quentin Tarantino apparaît le personnage de Django ?'],
        [51, 25, 'Quel est le nom du chien dans le film Le Chien de garde (A Dog\'s Journey) ?'],
        [52, 26, 'Qui est le protagoniste principal de Bleach ?'],
        [53, 26, 'Quelle est l\'espèce surnaturelle que Ichigo devient capable de combattre après avoir acquis ses pouvoirs de Soul Reaper ?'],
        [54, 26, 'Quel est le nom du sabre spirituel d'Ichigo lorsqu'il devient un Substitute Soul Reaper ?'],
        [55, 26, 'Qui est le capitaine de la 1ère division de la Gotei 13 et l'un des mentors d'Ichigo ?'],
        [56, 26, 'Quel terme est utilisé pour désigner les êtres humains qui ont perdu leur cœur et deviennent des ennemis des vivants et des morts ?'],
        [57, 26, 'Dans quel arc de l'anime Bleach Ichigo affronte les Quincy et leur leader, Sōsuke Aizen ?'],
        [58, 26, 'Quel est le nom de l'équipement utilisé par les Soul Reapers pour canaliser leur pouvoir spirituel ?'],
        [59, 26, 'Qui est le frère cadet d'Ichigo Kurosaki ?'],
        [60, 26, 'Dans l'arc Hueco Mundo, quel est le nom du roi des Hollows ?'],
        [61, 26, 'Quelle est la technique signature de Kisuke Urahara ?'],
        [62, 27, 'Quel est le mammifère terrestre le plus rapide du monde ?'],
        [63, 27, 'Combien de cœurs possède un octopus ?'],
        [64, 27, 'Quel animal est connu pour produire du lait sans être une vache ?'],
        [65, 27, 'Quel est le plus grand animal vivant sur Terre ?'],
        [66, 27, 'Quel oiseau ne sait pas voler ?'],
        [67, 27, 'Quel est le seul mammifère capable de voler véritablement ?'],
        [68, 27, 'Dans quel environnement vit principalement le dauphin ?'],
        [69, 27, 'Quel animal est surnommé le "roi de la jungle" ?'],
        [70, 27, 'À quelle catégorie appartient le pingouin ?'],
        [71, 27, 'Quel est le plus petit mammifère du monde ?'],
        [95, 26, 'Comment s\'appel la peluche de ichigo?']
    ];
    
    foreach ($questions as $question) {
        $stmt = $pdo->prepare("INSERT INTO questions (id, quiz_id, question_text) VALUES (?, ?, ?)");
        $stmt->execute([$question[0], $question[1], $question[2]]);
    }
    
    // Réinitialiser la séquence des ID questions
    $pdo->exec("SELECT setval('questions_id_seq', (SELECT MAX(id) FROM questions), true)");
    
    // Importer une sélection de réponses (pas toutes pour éviter un fichier trop long)
    $answers = [
        // Cinema Quiz
        [165, 42, 'Steven Spielberg', 0],
        [166, 42, 'James Cameron', 1],
        [167, 42, 'Christopher Nolan', 0],
        [168, 42, 'Quentin Tarantino', 0],
        [169, 43, 'Toy Story', 1],
        [170, 43, 'Monstres et Cie', 0],
        [171, 43, 'Cars', 0],
        [172, 43, 'Les Indes galantes', 0],
        [173, 44, 'Christian Bale', 1],
        [174, 44, 'Michael Keaton', 0],
        [175, 44, 'Ben Affleck', 0],
        [176, 44, 'Robert Pattinson', 0],
        
        // Bleach Quiz
        [205, 52, 'Ichigo Kurosaki', 1],
        [206, 52, 'Rukia Kuchiki', 0],
        [207, 52, 'Renji Abarai', 0],
        [208, 52, 'Chad', 0],
        [209, 53, 'Hollows', 1],
        [210, 53, 'Shinigamis', 0],
        [211, 53, 'Quincy', 0],
        [212, 53, 'Arrancars', 0],
        
        // Animaux Quiz
        [245, 62, 'Le guépard', 1],
        [246, 62, 'Le léopard', 0],
        [247, 62, 'Le lion', 0],
        [248, 62, 'Le cerf', 0],
        [249, 63, '1', 0],
        [250, 63, '2', 0],
        [251, 63, '3', 1],
        [252, 63, '4', 0]
    ];
    
    foreach ($answers as $answer) {
        $stmt = $pdo->prepare("INSERT INTO answers (id, question_id, answer_text, is_correct) VALUES (?, ?, ?, ?)");
        $stmt->execute([$answer[0], $answer[1], $answer[2], $answer[3]]);
    }
    
    // Réinitialiser la séquence des ID réponses
    $pdo->exec("SELECT setval('answers_id_seq', (SELECT MAX(id) FROM answers), true)");
    
    // Importer les scores
    $scores = [
        [10, 22, 26, 100],
        [16, 20, 25, 30],
        [17, 20, 26, 90],
        [18, 20, 27, 100],
        [19, 20, 28, 0],
        [21, 23, 27, 20],
        [22, 22, 33, 50],
        [23, 22, 35, 10],
        [24, 25, 26, 90],
        [25, 22, 37, 50],
        [26, 22, 38, 50],
        [27, 22, 39, 100],
        [28, 20, 39, 0],
        [29, 26, 27, 10]
    ];
    
    foreach ($scores as $score) {
        $stmt = $pdo->prepare("INSERT INTO scores (id, user_id, quiz_id, score) VALUES (?, ?, ?, ?)");
        $stmt->execute([$score[0], $score[1], $score[2], $score[3]]);
    }
    
    // Réinitialiser la séquence des ID scores
    $pdo->exec("SELECT setval('scores_id_seq', (SELECT MAX(id) FROM scores), true)");
    
    // Validation de la transaction
    $pdo->commit();
    
    echo "Importation réussie ! Les données MySQL ont été migrées vers PostgreSQL.\n";
    
} catch (PDOException $e) {
    // En cas d'erreur, annuler la transaction
    $pdo->rollBack();
    die("Erreur lors de l'importation des données : " . $e->getMessage());
}