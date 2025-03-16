<?php
session_start();
require 'database.php';
// Vérifier si l'utilisateur est connecté
if (!isset($_SESSION['userIsLoggedIn']) || $_SESSION['userIsLoggedIn'] !== true) {
    header('Location: login.php'); // Rediriger vers la page de connexion si l'utilisateur n'est pas connecté
    exit();
}

// Traitement du formulaire de création de quiz
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['create_quiz'])) {
    $quiz_name = htmlspecialchars($_POST['quiz_name']);
    if (isset($_SESSION['userIsLoggedIn']) && $_SESSION['userIsLoggedIn'] === true) {
        $user_id = $_SESSION['id']; 
        }else {
            header('Location: login.php');
            exit();
        }
    $stmt = $pdo->prepare('INSERT INTO quizzes (name, user_id) VALUES (:name, :user_id)');
    $stmt->execute(['name' => $quiz_name, 'user_id' => $user_id]);
    $quiz_id = $pdo->lastInsertId();
    $_SESSION['quiz_id'] = $quiz_id;

    // Insérer les questions et les réponses
    for ($i = 1; isset($_POST["question_$i"]); $i++) {
        $question_text = htmlspecialchars($_POST["question_$i"]);
        $correct_answer = $_POST["correct_answer_$i"];

        // Insérer la question
        $stmt = $pdo->prepare('INSERT INTO questions (quiz_id, question_text) VALUES (:quiz_id, :question_text)');
        $stmt->execute(['quiz_id' => $quiz_id, 'question_text' => $question_text]);
        $question_id = $pdo->lastInsertId();

        // Insérer les réponses
        for ($j = 1; $j <= 4; $j++) {
            $answer_text = htmlspecialchars($_POST["answer_{$i}_{$j}"]);
            $is_correct = ($j == $correct_answer) ? 1 : 0;

            $stmt = $pdo->prepare("INSERT INTO answers (question_id, answer_text, is_correct) VALUES (:question_id, :answer_text, :is_correct)");
            $stmt->execute(['question_id' => $question_id, 'answer_text' => $answer_text, 'is_correct' => $is_correct]);
        }
    }

    // Rediriger vers la liste des quiz
    header('Location: list.php');
    exit();
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="assets/css/style.css">
    <link rel="stylesheet" href="assets/css/header.css">
    <link rel="stylesheet" href="assets/css/respoheader.css">
    <link rel="stylesheet" href="assets/css/new.css">
    <script src="assets/js/script" defer></script>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
    <title>GeekQuiz Create Quiz</title>
</head>
<body>
<?php require 'header.php';?>
<?php require 'respoheader.php';?>
<main>
    <form class="formula" action="new.php" method="POST">
            <h2>Create New Quiz</h2>
            <div class="quiz-name">
                <input type="text" class="form-control" id="quiz_name" placeholder="Nom du Quizz" name="quiz_name" required>
            </div>
            <div id="questions-container">
            </div>
            <div class="buttons">
                <button type="button" onclick="addQuestion()" class="btn btn-primary">Ajouter une question</button>
                <button type="submit" name="create_quiz" class="btn btn-primary">Créer le Quizz</button>
            </div>
        </form>
</main>
<?php require 'footer1.php';?>
<script src="assets/js/create.js"></script>
<script type="module" src="https://unpkg.com/ionicons@7.1.0/dist/ionicons/ionicons.esm.js"></script>
<script nomodule src="https://unpkg.com/ionicons@7.1.0/dist/ionicons/ionicons.js"></script>
</body>
</html>