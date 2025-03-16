<?php
session_start();
require 'database.php';
// Vérifier si l'utilisateur est connecté
if (!isset($_SESSION['userIsLoggedIn']) || $_SESSION['userIsLoggedIn'] !== true) {
    header('Location: login.php');
    exit();
}

// Récupérer l'ID du quiz depuis l'URL
$idQuiz = isset($_GET['id']) ? intval($_GET['id']) : 0;

if ($idQuiz === 0) {
    exit("ID de quiz non valide.");
}

// Récupérer le quiz
$stmt = $pdo->prepare('SELECT * FROM quizzes WHERE id = ?');
$stmt->execute([$idQuiz]);
$quiz = $stmt->fetch();

if (!$quiz) {
    exit("Quiz non trouvé.");
}

// Récupérer les questions du quiz
$stmt = $pdo->prepare('SELECT * FROM questions WHERE quiz_id = ?');
$stmt->execute([$idQuiz]);
$questions = $stmt->fetchAll();

// Récupérer toutes les réponses pour toutes les questions
$allAnswers = [];
foreach ($questions as $question) {
    $stmt = $pdo->prepare('SELECT * FROM answers WHERE question_id = ?');
    $stmt->execute([$question['id']]);
    $answers = $stmt->fetchAll();
    $allAnswers[$question['id']] = $answers;
}

// Vérifier si le formulaire a été soumis
if (isset($_POST['submit'])) {
    $score = 0;
    $totalQuestions = count($questions);
    $bestScore = 0;
    $comment = "";
    // Parcourir chaque question pour vérifier les réponses soumises
    foreach ($questions as $question) {
        $questionId = $question['id'];

        if (isset($_POST['answer_' . $questionId])) {
            $selectedAnswerId = intval($_POST['answer_' . $questionId]);

            // Vérifier si cette réponse est correcte
            $stmt = $pdo->prepare('SELECT is_correct FROM answers WHERE id = ?');
            $stmt->execute([$selectedAnswerId]);
            $isCorrect = $stmt->fetchColumn();

            if ($isCorrect) {
                $score++;
            }
        }
    }
    // Définir le commentaire selon le score obtenu
    if ($score === 0) {
        $comment = "Vous n'avez répondu correctement à aucune question.";
    } elseif ($score < $totalQuestions / 2) {
        $comment = "Vous avez {$score} bonnes réponses sur {$totalQuestions}. Courage !";
    } elseif ($score === $totalQuestions) {
        $comment = "Félicitations ! Vous avez répondu correctement à toutes les questions.";
    } else {
        $comment = "Bien joué ! Vous avez {$score} bonnes réponses sur {$totalQuestions}.";
    }

    // Affichage du résultat via JavaScript
    echo '<script>
    document.addEventListener("DOMContentLoaded", function() {
        document.getElementById("questCorrect").textContent = "Questions correctes : ' . $score . '";
        document.getElementById("questFailed").textContent = "Questions incorrectes : ' . ($totalQuestions - $score) . '";
        document.getElementById("commente").textContent = "' . addslashes($comment) . '";
        document.getElementById("commente").style.color = "' . ($score === $totalQuestions ? 'green' : 'red') . '";
        document.getElementById("commente").style.fontWeight = "bold";
        document.getElementById("commente").style.textTransform = "uppercase";
        document.getElementById("commente").style.textAlign = "center";
        document.getElementById("commente").style.marginTop = "1em";
    });
    </script>';

    // Récupérer le meilleur score de l'utilisateur pour ce quiz
    $stmt = $pdo->prepare('SELECT score FROM scores WHERE user_id = ? AND quiz_id = ?');
    $stmt->execute([$_SESSION['id'], $idQuiz]);
    $currentBestScore = $stmt->fetchColumn();
    $score = $score * 100 / $totalQuestions;

    // Mettre à jour le meilleur score si le nouveau score est supérieur
    if ($currentBestScore === false || $score > $currentBestScore) {
        $stmt = $pdo->prepare('INSERT INTO scores (user_id, quiz_id, score) VALUES (?, ?, ?) ON DUPLICATE KEY UPDATE score = VALUES(score)');
        $stmt->execute([$_SESSION['id'], $idQuiz, $score]);
        $bestScore = $score;
    } else {
        $bestScore = $currentBestScore;
    }

}
?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Quiz : <?php echo ($quiz['name']); ?></title>
    <link rel="stylesheet" href="assets/css/style.css">
    <link rel="stylesheet" href="assets/css/header.css">
    <link rel="stylesheet" href="assets/css/made.css">
    <link rel="stylesheet" href="assets/css/respoheader.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Alegreya+Sans:ital,wght@0,100;0,300;0,400;0,500;0,700;0,800;0,900;1,100;1,300;1,400;1,500;1,700;1,800;1,900&family=Crimson+Text:ital,wght@0,400;0,600;0,700;1,400;1,600;1,700&family=Lobster&family=Lora:ital,wght@0,400..700;1,400..700&family=Manrope:wght@200..800&family=Monsieur+La+Doulaise&family=Montserrat:ital,wght@0,100..900;1,100..900&family=Playwrite+IN:wght@100..400&family=Roboto+Slab:wght@100..900&family=Sour+Gummy:ital,wght@0,100..900;1,100..900&display=swap" rel="stylesheet">
    <script src="assets/js/made.js" defer></script>
    <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
</head>
<body>
    <?php require 'header.php'; ?>
    <?php require 'respoheader.php';?>
    <main>
      <aside>
        <h2>Menu</h2>
        <ul>
          <li><a href="index.php">Accueil</a></li>
          <li><a href="list.php">Tous les quiz</a></li>
          <li><a href="new.php">Créer un quiz</a></li>
          <li><a href="logout.php">Déconnexion</a></li>
        </ul>
        <div style="margin-top: 1em; text-align: center;" class="rules">
            <h3>Règles du Quiz</h3>
            <ul style="list-style-type: disc; text-align: left; padding-left: 20px;">
                <li>Répondez à chaque question en cliquant sur la réponse qui vous semble correcte.</li>
                <li>Vous ne pouvez pas revenir à la question précédente.</li>
                <li>Le quiz se termine après la dernière question.</li>
                <li>Amusez-vous bien !</li>
            </ul>
        </div>
        <button class="rules-button">Règles</button>
        <div class="rules-popup">
            <span class="close-popup">&times;</span>
            <h2>Règles du Quiz</h2>
            <ul>
                <li>Répondez à chaque question en cliquant sur la réponse qui vous semble correcte.</li>
                <li>Vous ne pouvez pas revenir à la question précédente.</li>
                <li>Le quiz se termine après la dernière question.</li>
                <li>Amusez-vous bien !</li>
            </ul>
        </div>
        <div style="margin-top: 1em;" class="answer">
          <h2 class="board">Statistiques</h2>
          <?php
              echo '<p style="font-weight: bold; font-size: 1.5em; text-transform: uppercase; text-align: center;">' . htmlspecialchars($_SESSION['username']) . '</p>';
          ?>
          <p id="questCorrect" class="score-true" style="color: green; font-weight: bold;">Questions correctes : 0</p>
          <p id="questFailed" style="color: orange; font-weight: bold;">Questions incorrectes : 0</p>
          <p style="color: #ff2823; font-weight: bold;">Meilleurs Score : <?php
              $stmt = $pdo->prepare('SELECT score FROM scores WHERE user_id = ? AND quiz_id = ?');
              $stmt->execute([$_SESSION['id'], $idQuiz]);
              $maxScore = $stmt->fetchColumn();
              echo ($maxScore/10 ?? 0);

          ?></p>
          <div style="text-align: center;" id="commente"></div>
        </div>
      </aside>
      <section>
        <h1><?php echo ($quiz['name']); ?></h1>
        <img src="assets/images/quizg.webp" alt="Logo quizz Pro" title="GeekQuiz">
        <form id="quizForm" action="" method="post">
          <?php $questionIndex = 0; ?>
          <?php foreach ($questions as $question): ?>
              <div id="question-<?php echo $questionIndex ?>" class="question-container" style="display: <?php echo $questionIndex === 0 ? 'block' : 'none'; ?>;">
                  <h3><?php echo ($question['question_text']); ?></h3>
                  <div class="slider">
                    <?php foreach ($allAnswers[$question['id']] as $answer): ?>
                        <div class="slide">
                          <label class="click">
                            <input type="radio" name="answer_<?php echo $question['id']?>" value="<?php echo $answer['id'] ?>" data-correct="<?php echo ($answer['is_correct'] == 1) ? 'true' : 'false'; ?>">
                            <?php echo ($answer['answer_text']); ?>
                          </label>
                        </div>
                    <?php endforeach; ?>
                  </div>
              </div>
              <?php $questionIndex++; ?>
          <?php endforeach; ?>
          <button style="margin:auto;padding: 10px 20px;" type="button" id="nextButton">Suivant</button>
          <button style="padding: 10px 20px;" type="submit" id="submitButton" name="submit">Terminer</button>
        </form>
      </section>
    </main>
    <?php require 'footer1.php'; ?>
    <script type="module" src="https://unpkg.com/ionicons@7.1.0/dist/ionicons/ionicons.esm.js"></script>
    <script nomodule src="https://unpkg.com/ionicons@7.1.0/dist/ionicons/ionicons.js"></script>
</body>
</html>