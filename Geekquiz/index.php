<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="assets/css/style.css">
    <link rel="stylesheet" href="assets/css/form.css">
    <link rel="stylesheet" href="assets/css/respoheader.css">
    <link rel="stylesheet" href="assets/css/header.css">
    <script src="assets/js/script" defer></script>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Alegreya+Sans:ital,wght@0,100;0,300;0,400;0,500;0,700;0,800;0,900;1,100;1,300;1,400;1,500;1,700;1,800;1,900&family=Lobster&family=Lora:ital,wght@0,400..700;1,400..700&family=Manrope:wght@200..800&family=Monsieur+La+Doulaise&family=Montserrat:ital,wght@0,100..900;1,100..900&family=Playwrite+IN:wght@100..400&family=Roboto+Slab:wght@100..900&family=Sour+Gummy:ital,wght@0,100..900;1,100..900&display=swap" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
    <title>GeekQuiz</title>
</head>
<body>
    <?php require 'header.php';?>
    <?php require 'respoheader.php';?>
    <main>
        <div class="container">
            <div class="row justify-content-center my">
                <div id="respo-title" style="color: white;" class="col-lg-8 text-center">
                    <h1 style="margin-bottom: 1em" class="display-4">Bienvenue sur GeekQuiz !</h1>
                    <p class="lead mb-4">Plongez dans l'univers passionnant de la connaissance et du divertissement avec GeekQuiz, votre nouvelle plateforme de quiz interactifs.</p>
                    <p class="mb-4">Que vous soyez un expert en histoire, un passionné de géographie, un fan de sport, un otaku invétéré, un mélomane averti, un scientifique en herbe ou simplement curieux de tout, GeekQuiz a le défi qu'il vous faut !</p>
                    <p class="mb-4">Choisissez parmi nos nombreuses catégories, testez vos connaissances, défiez vos amis et apprenez en vous amusant. Êtes-vous prêt à relever le défi et à devenir le maître incontesté du quiz ?</p>
                </div>
            </div>
            <div class="semi-container">
                <div class="option-container1">
                    <p class="headings">Commencer un Quizz</p>
                    <p>Choisissez une catégorie et plongez dans l'univers passionnant de GeekQuiz. Êtes-vous prêt à relever le défi ?</p>
                    <a style="text-decoration: none" class="start" href="game.php">
                        <span></span>
                        <span></span>
                        <span></span>
                        <span></span>
                        Commencer
                    </a>
                </div>
                <div class="option-container2">
                    <p class="headings">Rankings</p>
                    <p>Voyez les scores de tous les joueurs et déterminez si vous êtes au top 10 des meilleurs quizistes du monde. Vous pourrez également voir les scores des joueurs de votre catégorie préférée.</p>
                        <a href="rankings.php" style="text-decoration: none" class="startR">
                            <span></span>
                            <span></span>
                            <span></span>
                            <span></span>
                            Rankings
                        </a>
                </div>
                <div class="option-container3">
                    <p class="headings">Multijoueurs</p>
                    <p>Rejoignez une équipe de joueurs ou invité des amis a rejoindre votre équipe pour défier d'autres joueurs et amusez-vous en parcourant les questions et en répondant plus que vos adversaires.</p>
                    <a href="#" style="text-decoration: none" class="startM">
                            <span></span>
                            <span></span>
                            <span></span>
                            <span></span>
                            Multijoueurs
                        </a>
                </div>
                <div class="option-container4">
                    <p class="headings">Créer un Quizz</p>
                    <p>Créez votre propre quiz et partagez-le avec votre communauté pour vous amuser et vous entraîner.</p>
                    <a href="new.php" style="text-decoration: none" class="startC">
                        <span></span>
                        <span></span>
                        <span></span>
                        <span></span>
                        Créer un Quizz
                    </a>
                </div>
            </div>
        </div>
    <?php require_once 'formulaire.php';?>
    </main>
<?php require 'footer1.php';?>
    <script type="module" src="https://unpkg.com/ionicons@7.1.0/dist/ionicons/ionicons.esm.js"></script>
    <script nomodule src="https://unpkg.com/ionicons@7.1.0/dist/ionicons/ionicons.js"></script>
</body>
</html>