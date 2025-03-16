<?php
/**
 * Utilitaire de conversion SQL pour faire fonctionner les requêtes MySQL sur PostgreSQL
 */

/**
 * Convertit une requête MySQL en requête PostgreSQL
 * @param string $query Requête SQL MySQL
 * @return string Requête SQL PostgreSQL
 */
function convertMySQLToPostgreSQL($query) {
    // Remplacement des backticks par des guillemets doubles pour les noms de colonnes et tables
    $query = preg_replace('/`([^`]+)`/', '"$1"', $query);
    
    // Transformation des LIMIT x,y en LIMIT y OFFSET x
    if (preg_match('/LIMIT\s+(\d+)\s*,\s*(\d+)/i', $query, $matches)) {
        $offset = $matches[1];
        $limit = $matches[2];
        $query = preg_replace('/LIMIT\s+\d+\s*,\s*\d+/i', "LIMIT $limit OFFSET $offset", $query);
    }
    
    // Remplacement des fonctions spécifiques MySQL
    $query = str_replace('IFNULL', 'COALESCE', $query);
    $query = str_replace('NOW()', 'CURRENT_TIMESTAMP', $query);
    
    // Remplacement de la concaténation
    $query = preg_replace('/CONCAT\(([^)]+)\)/', '$1', $query);
    $query = str_replace(' . ', ' || ', $query);
    
    // Conversion des requêtes ON DUPLICATE KEY UPDATE
    if (stripos($query, 'ON DUPLICATE KEY UPDATE') !== false) {
        // C'est une requête complexe qui nécessite l'utilisation de notre fonction pgInsertScore
        // Ce type de requête est traité séparément dans pg_adapter.php
        return $query; // Retourner la requête originale pour le moment
    }
    
    return $query;
}

/**
 * Fonction d'aide pour exécuter une requête adaptée en fonction de l'environnement
 * @param PDO $pdo Instance PDO
 * @param string $query Requête SQL (format MySQL)
 * @param array $params Paramètres pour la requête préparée
 * @return PDOStatement Résultat de l'exécution
 */
function executeAdaptedQuery($pdo, $query, $params = []) {
    // Vérifier si nous sommes en environnement PostgreSQL
    if (isPostgres()) {
        // Convertir la requête pour PostgreSQL
        $query = convertMySQLToPostgreSQL($query);
    }
    
    // Préparer et exécuter la requête
    $stmt = $pdo->prepare($query);
    $stmt->execute($params);
    
    return $stmt;
}