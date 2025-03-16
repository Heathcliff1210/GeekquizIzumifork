<?php
if (session_status() !== PHP_SESSION_ACTIVE) {
    session_start();
};
// Connexion à la base de données
require 'database.php';
if (isset($_SESSION['id'])) {
    // Récupérer le classement personnel de l'utilisateur connecté
    $stmt = $pdo->prepare('
        SELECT q.id AS quiz_id,q.name AS quiz_name, s.score
        FROM scores s
        JOIN quizzes q ON s.quiz_id = q.id
        WHERE s.user_id = ?
        ORDER BY q.name
    ');
    $stmt->execute([$_SESSION['id']]);
    $personalRankings = $stmt->fetchAll();
}
// Recuperer le nom des createur de chaque quiz
$stmt = $pdo->prepare('
    SELECT q.id AS quiz_id, q.name AS quiz_name, f.username
    FROM quizzes q
    JOIN formulaire f ON q.user_id = f.id
');
$stmt->execute();
$creators = $stmt->fetchAll();

// Récupérer le classement général pour tous les quiz
$stmt = $pdo->prepare('
    SELECT q.id AS quiz_id, q.name AS quiz_name, f.username, s.score,
           ROW_NUMBER() OVER (PARTITION BY q.id ORDER BY s.score DESC) as rank
    FROM scores s
    JOIN quizzes q ON s.quiz_id = q.id
    JOIN formulaire f ON s.user_id = f.id
    ORDER BY q.name, s.score DESC
');
$stmt->execute();
$generalRankings = $stmt->fetchAll();

// Regrouper les résultats par quiz
function regroupeParQuiz($generalRankings) {
    // Initialisation du tableau qui contiendra les résultats regroupés par quiz
    $quizRankings = [];

    // Parcours de chaque classement dans le tableau général
    foreach ($generalRankings as $ranking) {
        // Extraction de l'identifiant et du nom du quiz
        $quizId = $ranking['quiz_id'];
        $quizName = $ranking['quiz_name'];

        // Vérifie si le quiz n'existe pas encore dans notre tableau de résultats
        if (!isset($quizRankings[$quizId])) {
            // Si non, on crée une entrée pour ce quiz avec son nom et un tableau vide pour les classements
            $quizRankings[$quizId] = [
                'name' => $quizName,
                'rankings' => []
            ];
        }

        // Ajout du classement courant dans la liste des classements du quiz
        // L'opérateur [] permet d'ajouter une nouvelle entrée en fin de tableau
        $quizRankings[$quizId]['rankings'][] = $ranking;
    }

    // Retourne le tableau regroupé par quiz
    return $quizRankings;
}
$quizRankings = regroupeParQuiz($generalRankings);
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="assets/css/style.css">
    <link rel="stylesheet" href="assets/css/header.css">
    <link rel="stylesheet" href="assets/css/rank.css">
    <link rel="stylesheet" href="assets/css/respoheader.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Alegreya+Sans:ital,wght@0,100;0,300;0,400;0,500;0,700;0,800;0,900;1,100;1,300;1,400;1,500;1,700;1,800;1,900&family=Lobster&family=Lora:ital,wght@0,400..700;1,400..700&family=Manrope:wght@200..800&family=Monsieur+La+Doulaise&family=Montserrat:ital,wght@0,100..900;1,100..900&family=Playwrite+IN:wght@100..400&family=Roboto+Slab:wght@100..900&family=Sour+Gummy:ital,wght@0,100..900;1,100..900&display=swap" rel="stylesheet">
    <title>Classements</title>
</head>
<body>
<?php require 'header.php'; ?>
<?php require 'respoheader.php';?>
    <main>
        <div>
            <h2 class="rankings-title">Votre classement personnel</h2>
            <table class="personal-table">
                <thead>
                    <tr>
                        <th>Quiz</th>
                        <th>Score</th>
                        <th>Createur du Quiz</th>
                    </tr>
                </thead>
                <tbody>
                    <!-- On verifie si l'utilisateur a deja jouer a un quizz crée -->
                    <?php if (!empty($personalRankings)):?>
                        <?php foreach ($personalRankings as $ranking): ?>
                        <tr>
                            <td><?= htmlspecialchars($ranking['quiz_name']) ?></td>
                            <td><?= $ranking['score'] ?></td>
                            <td>
                                <?php foreach ($creators as $creator):?>
                                    <?php if ($creator['quiz_id'] === $ranking['quiz_id']):?>
                                        <?= htmlspecialchars($creator['username'])?>
                                    <?php endif;?>
                                <?php endforeach;?>
                            </td>
                        </tr>
                        <?php endforeach; ?>
                    <?php endif; ?>
                    <?php if (empty($personalRankings)):?>
                        <tr>
                            <td colspan="2">Aucun score enregistré</td>
                        </tr>
                    <?php endif; ?>
                </tbody>
            </table>
        </div>
        <div>
        <h2 class="rankings-title">Classement général par quiz</h2>
        <?php if (!empty($quizRankings)):?>
            <?php foreach ($quizRankings as $quiz): ?>
                <h3><?= htmlspecialchars($quiz['name']) ?></h3>
                <table class="rankings-table">
                    <thead>
                        <tr>
                            <th>Rang</th>
                            <th>Utilisateur</th>
                            <th>Score</th>
                        </tr>
                    </thead>
                    <tbody>
            <!--En fonction de si oui l'utilisateur es connecter ou non on affiche le tableau generale --> 
                        <?php if (!isset($_SESSION['username'])):?>
                            <?php foreach ($quiz['rankings'] as $ranking): ?>
                                <tr>
                                    <td><?= $ranking['rank'] ?></td>
                                    <td><?= htmlspecialchars($ranking['username']) ?></td>
                                    <td><?= $ranking['score'] ?></td>
                                </tr>
                            <?php endforeach;?>
                            <?php else:?>
                                <?php foreach ($quiz['rankings'] as $ranking):?>
                                    <tr class="<?php echo $ranking['username'] === $_SESSION['username']?'current-user' : ''?>">
                                        <td><?= $ranking['rank']?></td>
                                        <td><?= htmlspecialchars($ranking['username'])?></td>
                                        <td><?= $ranking['score']?></td>
                                    </tr>
                                <?php endforeach;?>
                            <?php endif;?>
                    </tbody>
                </table>
            <?php endforeach; ?>
            <br>
        <?php else: ?>
            <h2>Aucun quiz disponible</h2>
        <?php endif;?>
        </div>
    </main>
<?php require 'footer1.php'; ?>
<script src="assets/js/script.js"></script>
<script type="module" src="https://unpkg.com/ionicons@7.1.0/dist/ionicons/ionicons.esm.js"></script>
<script nomodule src="https://unpkg.com/ionicons@7.1.0/dist/ionicons/ionicons.js"></script>
</body>
</html>
                        