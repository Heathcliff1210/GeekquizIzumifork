<?php
session_start();
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['score'])) {
    $score = intval($_POST['score']);
    $_SESSION['last_score'] = $score;
    if (!isset($_SESSION['best_score']) || $score > $_SESSION['best_score']) {
        $_SESSION['best_score'] = $score;
    }
    
    echo "Score sauvegardé avec succès";
} else {
    echo "Erreur: Aucun score reçu";
}