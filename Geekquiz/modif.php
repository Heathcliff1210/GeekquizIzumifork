<?php
session_start();
require 'database.php';
if (!isset($_SESSION['userIsLoggedIn']) || $_SESSION['userIsLoggedIn'] !== true) {
    header('Location: login.php');
    exit();
}

if (!isset($_GET['id'])) {
    header('Location: list.php');
    exit();
}

$quiz_id = $_GET['id'];
$stmt = $pdo->prepare("SELECT * FROM quizzes WHERE id = ? AND user_id = ?");
$stmt->execute([$quiz_id, $_SESSION['id']]);
$quiz = $stmt->fetch();

if (!$quiz) {
    header('Location: list.php');
    exit();
}

$message = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (isset($_POST['add_question'])) {
        $new_question_text = $_POST['new_question_text'];
        $new_answers = $_POST['new_answers'];
        $new_correct_answer = $_POST['new_correct_answer'];

        // Insérer la nouvelle question
        $stmt = $pdo->prepare("INSERT INTO questions (quiz_id, question_text) VALUES (?, ?)");
        $stmt->execute([$quiz_id, $new_question_text]);
        $new_question_id = $pdo->lastInsertId();

        // Insérer les nouvelles réponses
        $stmt = $pdo->prepare("INSERT INTO answers (question_id, answer_text, is_correct) VALUES (?, ?, ?)");
        foreach ($new_answers as $index => $answer_text) {
            $is_correct = ($index == $new_correct_answer) ? 1 : 0;
            $stmt->execute([$new_question_id, $answer_text, $is_correct]);
        }

        $message = "Nouvelle question ajoutée avec succès.";
        header('Location: modif.php?id='. $quiz_id);
        exit();
    }

    
    if (isset($_POST['update_quiz'])) {
        $stmt1 = $pdo->prepare("UPDATE quizzes SET name = ? WHERE id = ?");
        $stmt1->execute([$_POST['title'], $quiz_id]);
        $message = "Le titre du quiz a été mis à jour.";
    } elseif (isset($_POST['update_question'])) {
        $question_id = $_POST['question_id'];
        $question_text = $_POST['question_text'];
        $correct_answer = $_POST['correct_answer'];
        
        $stmt = $pdo->prepare("SELECT * FROM answers WHERE question_id = ?");
        $stmt->execute([$_POST['question_id']]);
        $existing_answers = $stmt->fetchAll();
        // Mettre à jour la question
        $stmt2 = $pdo->prepare("UPDATE questions SET question_text = ? WHERE id = ?");
        $stmt2->execute([$question_text, $question_id]);
    
        // Mettre à jour les réponses
        foreach ($existing_answers as $index => $existing_answer) {
            $new_answer_text = $_POST['reponses'][$index];
            $isCorrect = $index == $correct_answer ? 1 : 0;
            
            $stmt = $pdo->prepare("UPDATE answers SET answer_text = ?, is_correct = ? WHERE id = ?");
            $stmt->execute([$new_answer_text, $isCorrect, $existing_answer['id']]);
        }

        $message = "La question et ses réponses ont été mises à jour.";
    } elseif (isset($_POST['delete_question'])) {
        $question_id = $_POST['question_id'];

        // Supprimer les réponses associées à la question
        $stmt = $pdo->prepare("DELETE FROM answers WHERE question_id = ?");
        $stmt->execute([$question_id]);

        // Ensuite supprimer la question
        $stmt = $pdo->prepare("DELETE FROM questions WHERE id = ?");
        $stmt->execute([$question_id]);

        $message = "La question et ses réponses ont été supprimées.";
        header('Location: modif.php?id='. $quiz_id);
        exit();
    }
}
// Récupérer les questions du quiz
$stmt = $pdo->prepare("SELECT * FROM questions WHERE quiz_id = ?");
$stmt->execute([$quiz_id]);
$questions = $stmt->fetchAll();

// Récupérer les réponses pour chaque question
$reponses = array();
foreach ($questions as $question) {
    $stmt = $pdo->prepare("SELECT * FROM answers WHERE question_id = ?");
    $stmt->execute([$question['id']]);
    $reponses[$question['id']] = $stmt->fetchAll();
}

$current_question = isset($_GET['question']) ? intval($_GET['question']) : 0;
// Récupérer la réponse correcte
$correct_answer_text = '';
if (!empty($reponses)){
    if (isset($reponses[$questions[$current_question]['id']])) {
        foreach ($reponses[$questions[$current_question]['id']] as $answer) {
            if ($answer['is_correct'] == 1) {
                $correct_answer_text = $answer['answer_text'];
                break;
            }
        }
    }
}
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="assets/css/style.css">
    <link rel="stylesheet" href="assets/css/header.css">
    <link rel="stylesheet" href="assets/css/modif.css">
    <link rel="stylesheet" href="assets/css/respoheader.css">
    <script src="assets/js/modif.js"></script>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
    <title>Modifier le Quiz : <?php echo $quiz['name']; ?></title>
</head>
<body>
    <?php require 'header.php'; ?>
    <?php require 'respoheader.php';?>
    <main class=" ">
        <h1>Modifier le Quiz : <?php echo $quiz['name']; ?></h1>
        <?php if ($message): ?>
            <div class="alert alert-success"><?php echo $message; ?></div>
        <?php endif; ?>
        <form class="modify_question_form" action="modif.php?id=<?php echo $quiz_id; ?>" method="POST" class="mb-4">
            <div class="mb-3">
                <label for="title" class="form-label">Titre du Quiz :</label>
                <input type="text" class="form-control" id="title" name="title" value="<?php echo $quiz['name']; ?>" required>
            </div>
            <button type="submit" name="update_quiz" class="btn btn-primary">Mettre à jour le titre</button>
        </form>
            <?php if (!isset($questions[$current_question])): 
                echo "<div class='nothing'>Aucune question et reponse pour ce quiz</div>"; ?>
            <?php endif; ?>
            <?php if (isset($questions[$current_question])):
            $question_reponses = $reponses[$questions[$current_question]['id']] ?? [];
            ?>
                <form class="modify_question_form" action="modif.php?id=<?php echo $quiz_id; ?>&question=<?php echo $current_question; ?>" method="POST">
                    <input type="hidden" name="question_id" value="<?php echo $questions[$current_question]['id']; ?>">
                    <div class="mb-3">
                        <label for="question_text" class="form-label">Question <?php echo $current_question + 1; ?> :</label>
                        <input type="text" class="form-control" id="question_text" name="question_text" value="<?php echo ($questions[$current_question]['question_text'] ?? ''); ?>" required>
                    </div>
                    
                    <?php foreach ($question_reponses as $index => $reponse): ?>
                        <div class="mb-3">
                            <label for="reponse_<?php echo $index; ?>" class="form-label">Réponse <?php echo $index + 1; ?> :</label>
                            <input type="text" class="form-control" id="reponse_<?php echo $index; ?>" name="reponses[]" value="<?php echo ($reponse['answer_text'] ?? ''); ?>" required>
                        </div>
                    <?php endforeach; ?>
                    
                    <div class="mb-3">
                        <label for="correct_answer" class="form-label">Réponse correcte :</label>
                        <select class="form-control" id="correct_answer" name="correct_answer" required>
                            <?php foreach ($question_reponses as $index => $reponse): ?>
                                <? var_dump($question_reponses); ?>
                                <option value="<?php echo $index ?>" <?php if ($reponse['answer_text'] == $correct_answer_text) echo 'selected'; ?>>
                                    Reponse <?php echo $index +1; ?>
                                </option>
                            <?php endforeach; ?>
                        </select>
                    </div>
                    <button style="margin-bottom: 1em;" type="submit" name="update_question" class="btn btn-primary">Mettre à jour la question</button>
                </form>
                <?php endif; ?>
                </form>
                <?php if (isset($questions[$current_question])): 
                    echo "<form class='modify_question_form mt-3' action='modif.php?id=" . $quiz_id . "&question=" . $current_question . " ' method= 'POST'>
                        <input type='hidden' name='question_id' value=" . $questions[$current_question]['id'] .">
                        <button type='submit' name='delete_question' class='btn btn-danger del'>
                            Supprimer la question
                        </button>
                    </form>";?>
                <?php endif; ?>
                
                <form action="modif.php?id=<?php echo $quiz_id; ?>" method="POST" class="mt-4" id="new_question_form">
                    <h3>Ajouter une nouvelle question</h3>
                    <div class="mb-3 scroll">
                        <h2>Entrer le text de Votre Question</h2>
                        <textarea placeholder="Nouvelle question" name="new_question_text" required></textarea>
                    </div>
                    <?php for($i = 1; $i <= 4; $i++): ?>
                        <div class="mb-3">
                            <label for="new_answer_<?php echo $i; ?>" class="form-label">Réponse <?php echo $i; ?> :</label>
                            <input type="text" class="form-control" id="new_answer_<?php echo $i; ?>" name="new_answers[]" required>
                        </div>
                    <?php endfor; ?>
                    <div class="mb-3">
                        <label for="new_correct_answer" class="form-label">Réponse correcte :</label>
                        <select class="form-control" id="new_correct_answer" name="new_correct_answer" required>
                            <?php for($i = 1; $i <= 4; $i++): ?>
                                <option value="<?php echo $i-1; ?>">Réponse <?php echo $i; ?></option>
                            <?php endfor; ?>
                        </select>
                    </div>
                    <button type="submit" name="add_question" class="btn btn-success">Ajouter la question</button>
                </form>
            <div id="question_move" class="mt-3">
                <?php if ($current_question > 0): ?>
                    <a href="modif.php?id=<?php echo $quiz_id; ?>&question=<?php echo $current_question - 1; ?>" class="btn btn-secondary">Question précédente</a>
                <?php endif; ?>
                
                <?php if ($current_question < count($questions) - 1): ?>
                    <a href="modif.php?id=<?php echo $quiz_id; ?>&question=<?php echo $current_question + 1; ?>" class="btn btn-secondary">Question suivante</a>
                <?php endif; ?>
                <button id="add_question" type="button" class="btn btn-outline-warning">Ajouter une Question</button>
            </div>
            <div class="mt-3">
                <button id="modif_question" type="button" class="btn btn-secondary">Modifier les Questions</button>
            </div>
        <a href="list.php" class="btn btn-success mt-3">Terminer les modifications</a>
    </main>
    <?php require 'footer1.php'; ?>
<script src="assets/js/script.js"></script>
<script type="module" src="https://unpkg.com/ionicons@7.1.0/dist/ionicons/ionicons.esm.js"></script>
<script nomodule src="https://unpkg.com/ionicons@7.1.0/dist/ionicons/ionicons.js"></script>
</body>
</html>