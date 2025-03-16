<?php
/**
 * Utilitaire pour gérer les scores et leur mise à jour
 * Compatible avec MySQL et PostgreSQL
 */

require_once 'pg_adapter.php';
require_once 'sqlconverter.php';

/**
 * Met à jour le score d'un utilisateur pour un quiz donné
 * @param PDO $pdo Instance PDO
 * @param int $userId ID de l'utilisateur
 * @param int $quizId ID du quiz
 * @param float $score Score à enregistrer
 * @return bool Succès ou échec de l'opération
 */
function updateScore($pdo, $userId, $quizId, $score) {
    // Vérifier si on est en environnement PostgreSQL
    if (function_exists('isPostgres') && isPostgres()) {
        return pgInsertScore($pdo, $userId, $quizId, $score);
    } else {
        // Version MySQL avec ON DUPLICATE KEY UPDATE
        try {
            $stmt = $pdo->prepare('INSERT INTO scores (user_id, quiz_id, score) VALUES (?, ?, ?) ON DUPLICATE KEY UPDATE score = VALUES(score)');
            return $stmt->execute([$userId, $quizId, $score]);
        } catch (PDOException $e) {
            error_log('Erreur lors de la mise à jour du score : ' . $e->getMessage());
            return false;
        }
    }
}

/**
 * Récupère le meilleur score d'un utilisateur pour un quiz donné
 * @param PDO $pdo Instance PDO
 * @param int $userId ID de l'utilisateur
 * @param int $quizId ID du quiz
 * @return float|false Le score ou false si aucun score n'existe
 */
function getBestScore($pdo, $userId, $quizId) {
    try {
        $stmt = $pdo->prepare('SELECT score FROM scores WHERE user_id = ? AND quiz_id = ?');
        $stmt->execute([$userId, $quizId]);
        return $stmt->fetchColumn();
    } catch (PDOException $e) {
        error_log('Erreur lors de la récupération du score : ' . $e->getMessage());
        return false;
    }
}