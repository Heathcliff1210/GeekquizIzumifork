<?php
session_start();
require 'database.php';
$quiz_id = $_POST['quiz_id'];
$user_id = $_SESSION['id'];

// Vérifier que l'utilisateur est bien le propriétaire du quiz
$stmt = $pdo->prepare("SELECT * FROM quizzes WHERE id = ? AND user_id = ?");
$stmt->execute([$quiz_id, $user_id]);
$quiz = $stmt->fetch();

if (!$quiz) {
    echo ("Vous n'avez pas l'autorisation de supprimer ce quiz.");
    header('Location: list.php');
    exit();
}
//Recuperer les questions du quiz
$stmt1 = $pdo->prepare('SELECT id FROM questions WHERE quiz_id = ?');
$stmt1->execute([$quiz_id]);
$questions = $stmt1->fetchAll();
if(!$questions){
    echo 'Quizz non trouver';
};

// Supprimer les reponses associées au quiz
foreach ($questions as $question_Id) {
    $stmt2 = $pdo->prepare('DELETE FROM answers WHERE question_id = ?');
    $stmt2->execute([$question_Id['id']]);
}

// Supprimer les questions associées au quiz
$stmt3 = $pdo->prepare("DELETE FROM questions WHERE quiz_id = ?");
$stmt3->execute([$quiz_id]);

// Supprimer le quiz
$stmt4 = $pdo->prepare("DELETE FROM quizzes WHERE id = ?");
$stmt4->execute([$quiz_id]);
header('Location: list.php');
exit();
?>