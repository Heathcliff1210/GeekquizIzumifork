<?php
session_start();
require 'database.php';
// Récupérer tous les quizz avec le nom de l'utilisateur
$stmt = $pdo->prepare("SELECT quizzes.id, quizzes.name, formulaire.username, quizzes.user_id FROM quizzes JOIN formulaire ON quizzes.user_id = formulaire.id");
$stmt->execute();
$quizzes = $stmt->fetchAll(PDO::FETCH_ASSOC);
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="assets/css/style.css">
    <link rel="stylesheet" href="assets/css/header.css">
    <link rel="stylesheet" href="assets/css/list.css">
    <link rel="stylesheet" href="assets/css/respoheader.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
    <title>All Quizzes</title>
</head>
<body>
    <?php require 'header.php'; ?>
    <?php require 'respoheader.php';?>
    <main>
        <div class="myquiz">
        <?php
        // Vérifier si $quizzes est défini et est un tableau
        if (isset($quizzes) && is_array($quizzes)) {
            foreach ($quizzes as $quiz) {
                // Récupérer le nombre de questions pour ce quiz
                $quizId = $quiz['id'];
                $sql = "SELECT COUNT(*) AS nombre_questions FROM questions WHERE quiz_id = ?";
                $stmt = $pdo->prepare($sql);
                $stmt->execute([$quizId]);
                $resultat = $stmt->fetch(PDO::FETCH_ASSOC);

                if ($resultat) {
                    $nombreQuestions = $resultat['nombre_questions'];
                } else {
                    $nombreQuestions = 0;
                }
                echo "<div class='quiz-container'>";
                echo "<div class='image-create'>
                <img src='assets/images/geek.webp' alt='creator image' title='GeekQuiz'>
                </div>
                <div>
                <h3> Titre : " . htmlspecialchars($quiz['name']) . "</h3>
                <p>Créé par : <span style='text-transform : capitalize; font-weight: 600;'>" . htmlspecialchars($quiz['username']) . "</span></p>
                <p>" . $nombreQuestions . " questions.</p>";
                
                // On Ajoute les boutons Modifier et Supprimer uniquement si l'utilisateur connecté est le créateur du quiz
                if (isset($_SESSION['id']) && $_SESSION['id'] == $quiz['user_id']) {
                    echo "<div class='quiz-actions'>
                    <a href='made_quiz.php?id=" . $quiz['id'] . "' class='btn btn-primary'>Jouer</a>
                    <a href='modif.php?id=" . $quiz['id'] . "' class='btn btn-secondary'>Modifier</a>
                            <form method='POST' action='delete.php' style='display:inline;'>
                                <input type='hidden' name='quiz_id' value='" . $quiz['id'] . "'>
                                <button type='submit' class='btn btn-danger' onclick='return confirm(\"Êtes-vous sûr de vouloir supprimer ce quiz ?\");'>Supprimer</button>
                                </form>
                          </div>";
                        } else {
                    echo "<div class='quiz-actions'>
                            <a href='made_quiz.php?id=" . $quiz['id'] . "' class='btn btn-primary'>Jouer</a>
                            <a href='modif.php?id=" . $quiz['id'] . "' class='btn btn-secondary hide'>Modifier</a>
                            <form class='hide' method='POST' action='delete.php' style='display:inline;'>
                            <input type='hidden' name='quiz_id' value='" . $quiz['id'] . "'>
                                <button type='submit' class='btn btn-danger' onclick='return confirm(\"Êtes-vous sûr de vouloir supprimer ce quiz ?\");'>Supprimer</button>
                            </form>
                          </div>";
                }
                echo "</div>";
                echo "</div>";
            }
            if (empty($quizzes)) {
                echo "<p>Aucun quiz n'a été créé pour le moment.</p>";
            }
        } else {
            echo "<p>Erreur : Impossible de charger la liste des quiz.</p>"; // Message d'erreur si $quizzes n'est pas défini ou n'est pas un tableau
        }
        ?>
        </div>
    </main>
    <?php require 'footer1.php'; ?>
    <script src="assets/js/script.js"></script>
<script type="module" src="https://unpkg.com/ionicons@7.1.0/dist/ionicons/ionicons.esm.js"></script>
<script nomodule src="https://unpkg.com/ionicons@7.1.0/dist/ionicons/ionicons.js"></script>
</body>
</html>