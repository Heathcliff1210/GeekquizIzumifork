#!/bin/bash
set -e

# Attendre que PostgreSQL soit prêt
echo "En attente de la base de données PostgreSQL..."
until PGPASSWORD=$PGPASSWORD psql -h "$PGHOST" -U "$PGUSER" -d "$PGDATABASE" -c '\q'; do
  echo "PostgreSQL n'est pas encore disponible - attente..."
  sleep 2
done

echo "PostgreSQL est prêt !"

# Se connecter à PostgreSQL et initialiser les tables
PGPASSWORD=$PGPASSWORD psql -h "$PGHOST" -U "$PGUSER" -d "$PGDATABASE" << EOF
-- Création des tables si elles n'existent pas
CREATE TABLE IF NOT EXISTS users (
    id SERIAL PRIMARY KEY,
    username VARCHAR(255) NOT NULL UNIQUE,
    password VARCHAR(255) NOT NULL,
    email VARCHAR(255) NOT NULL UNIQUE,
    score INT DEFAULT 0,
    role VARCHAR(50) DEFAULT 'user'
);

CREATE TABLE IF NOT EXISTS quizzes (
    id SERIAL PRIMARY KEY,
    title VARCHAR(255) NOT NULL,
    author_id INT,
    category VARCHAR(100),
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    FOREIGN KEY (author_id) REFERENCES users(id)
);

CREATE TABLE IF NOT EXISTS questions (
    id SERIAL PRIMARY KEY,
    quiz_id INT,
    question_text TEXT NOT NULL,
    FOREIGN KEY (quiz_id) REFERENCES quizzes(id) ON DELETE CASCADE
);

CREATE TABLE IF NOT EXISTS answers (
    id SERIAL PRIMARY KEY,
    question_id INT,
    answer_text TEXT NOT NULL,
    is_correct BOOLEAN DEFAULT FALSE,
    FOREIGN KEY (question_id) REFERENCES questions(id) ON DELETE CASCADE
);

CREATE TABLE IF NOT EXISTS scores (
    id SERIAL PRIMARY KEY,
    user_id INT,
    quiz_id INT,
    score INT DEFAULT 0,
    time_taken INT DEFAULT 0,
    date_taken TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    FOREIGN KEY (user_id) REFERENCES users(id),
    FOREIGN KEY (quiz_id) REFERENCES quizzes(id)
);

-- Insertion d'un utilisateur admin par défaut si la table est vide
INSERT INTO users (username, password, email, role)
SELECT 'admin', 'password123', 'admin@example.com', 'admin'
WHERE NOT EXISTS (SELECT 1 FROM users WHERE username = 'admin');
EOF

echo "Initialisation de la base de données terminée !"