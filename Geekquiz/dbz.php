<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="assets/css/style.css">
    <link rel="stylesheet" href="assets/css/quest.css?t=<?php echo time(); ?>">
    <link rel="stylesheet" href="assets/css/respoheader.css">
    <link rel="stylesheet" href="assets/css/header.css">
    <script src="assets/js/script" defer></script>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Alegreya+Sans:ital,wght@0,100;0,300;0,400;0,500;0,700;0,800;0,900;1,100;1,300;1,400;1,500;1,700;1,800;1,900&family=Crimson+Text:ital,wght@0,400;0,600;0,700;1,400;1,600;1,700&family=Lobster&family=Lora:ital,wght@0,400..700;1,400..700&family=Manrope:wght@200..800&family=Monsieur+La+Doulaise&family=Montserrat:ital,wght@0,100..900;1,100..900&family=Playwrite+IN:wght@100..400&family=Roboto+Slab:wght@100..900&family=Sour+Gummy:ital,wght@0,100..900;1,100..900&display=swap" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
    <title>Question Dragon Ball Z</title>
</head>
<body>
<?php require 'header.php'; ?>
<?php require 'respoheader.php';?>
<main>
    <aside>
        <div style="text-align: center;" class="answers">
            <?php
            if (session_status() !== PHP_SESSION_ACTIVE) {
                session_start();
            }
            if (isset($_SESSION['userIsLoggedIn']) && $_SESSION['userIsLoggedIn']) {
                echo '<h2>Menu</h2>
                <ul>
                <li><a href="index.php">Accueil</a></li>
                <li><a href="game.php">Tous les quiz</a></li>
                <li><a href="new.php">Créer un quiz</a></li>
                <li><a href="logout.php">Déconnexion</a></li>
                </ul>';
            } else {
                echo '<h2 class="rank">Rankings</h2>';
                echo '<p>Pour Enregistrer votre score au ranking mondiale veuillez vous conneter</p>';
                echo '<div class="btn-group" role="group">
                <button id="drop" type="button" class="btn btn-primary dropdown-toggle" data-bs-toggle="dropdown" aria-expanded="false">
                    Click here
                    </button>
                    <ul class="dropdown-menu">
                        <li><a class="dropdown-item" href="rankings.php">Voir Rankings</a></li>
                        <li><a class="dropdown-item" href="sign.php">Sign in</a></li>
                    </ul>
                </div>';
            };
            ?>                
        </div>
        <div style="margin-top: 1em; text-align: center;" class="rules">
            <h2>Règles du Quiz</h2>
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
            if (session_status() !== PHP_SESSION_ACTIVE) {
                session_start();
            };
            if (isset($_SESSION['userIsLoggedIn']) && $_SESSION['userIsLoggedIn']) {
                echo '<p style="font-weight: bold;text-transform: uppercase;text-align: center;">'. htmlspecialchars($_SESSION['username']) .'</p>';
            } else {
                echo '<p style="font-weight: bold;">GuestPlayer</p>';
            };
            ?>
            <p id="questCorrect" class="score-true" style="color: green; font-weight: bold;">Questions correctes : 0</p>
            <p id="questFailed" style="color: orange; font-weight: bold;">Question incorrectes : 0</p>
        </div>
        <div style="font-size: 1em; text-align: center;" class="commente">
        </div>
    </aside>
    <section>
        <div class="container">
            <h1>Quiz Dragon Ball Z</h1>
            <div>
                <img class="image-quizz" src="assets/images/dbz.webp" alt="Quizz Time!">
            </div>
            <div>
                <p class="quizz-text"></p>
                    <form id="answer-container" >
                    </form>
                <input id="next-button" type="submit" value="Suivant">
            </div>
            <div class="resetings none">
                <a href="game.php">
                    <button type="button" class="btn btn-outline-warning reset">Retour</button>
                </a>
                <button id="reset" class="btn btn-primary reset" style="margin-top: 1em;">Recommencer</button>
            </div>
        </div>
    </section>
</main>
<?php require 'footer1.php'; ?>
<script type="module" src="https://unpkg.com/ionicons@7.1.0/dist/ionicons/ionicons.esm.js"></script>
<script nomodule src="https://unpkg.com/ionicons@7.1.0/dist/ionicons/ionicons.js"></script>
<script src="assets/js/dbz.js"></script>
</body>
</html>