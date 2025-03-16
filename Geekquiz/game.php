<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="assets/css/style.css?t=<?php echo time(); ?>">
    <link rel="stylesheet" href="assets/css/game.css?t=<?php echo time(); ?>">
    <link rel="stylesheet" href="assets/css/header.css">
    <link rel="stylesheet" href="assets/css/respoheader.css">
    <script src="assets/js/script" defer></script>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Alegreya+Sans:ital,wght@0,100;0,300;0,400;0,500;0,700;0,800;0,900;1,100;1,300;1,400;1,500;1,700;1,800;1,900&family=Crimson+Text:ital,wght@0,400;0,600;0,700;1,400;1,600;1,700&family=Lobster&family=Lora:ital,wght@0,400..700;1,400..700&family=Manrope:wght@200..800&family=Monsieur+La+Doulaise&family=Montserrat:ital,wght@0,100..900;1,100..900&family=Playwrite+IN:wght@100..400&family=Roboto+Slab:wght@100..900&family=Sour+Gummy:ital,wght@0,100..900;1,100..900&display=swap" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
    <title>Quizz</title>
</head>
<body>
    <?php
    require 'header.php';
    ?>
    <?php require 'respoheader.php';?>
    <main>
        <div class="semi-bar">
            <button id="all" class="filter-button">All</button>
            <button id="histoire" class="filter-button">Histoire</button>
            <button id="sport" class="filter-button">Sport</button>
            <button id="anime" class="filter-button">Anime</button>
            <button id="science" class="filter-button">Science</button>
            <button id="divers" class="filter-button">Divers</button>
        </div>
        <div class="question-container">
            <div class="display">
                <div class="dispose anime">
                    <div class="box-image">
                        <a href="aot.php" class="lien-conteneur-photo">
                            <img class="icon" src="assets/images/aot.jpg" alt="Shingeki no kyojin" title="Attaque des titans">
                            <div class="photo-hover"></div>
                        </a>
                    </div>
                    <div>
                        <h5>Quiz Shingeki no Kyojin : Teste tes connaissances sur l'Attaque des Titans !</h5>
                        <p>Plonge dans l'univers brutal de L'Attaque des Titans avec ce quiz épique ! Teste tes connaissances sur Eren, Livaï, les Titans et les secrets des Murs.</p>
                    </div>
                    <div class="button">
                        <a href="aot.php" class="lien-conteneur-photo">
                            <button type="button" class="btn btn-warning">Jouer</button>
                        </a>
                    </div>
                </div>
                <div class="dispose anime" data>
                    <div class="box-image">
                        <a href="csm.php" class="lien-conteneur-photo">
                            <img class="icon" src="assets/images/csm.webp" alt="Chainesaw Man" title="Chainesaw man">
                            <div class="photo-hover"></div>
                        </a>
                    </div>
                    <div>
                        <h5>Quiz Chainsaw Man : Teste tes connaissances sur l'Homme-Tronçonneuse !</h5>
                        <p>Prends ta tronçonneuse, relève le défi et découvre-le maintenant !</p>
                    </div>
                    <div class="button">
                        <a href="csm.php" class="lien-conteneur-photo">
                            <button type="button" class="btn btn-warning">Jouer</button>
                        </a>
                    </div>
                </div>
                <div class="dispose divers">
                    <div class="box-image">
                        <a href="music.php" class="lien-conteneur-photo">
                            <img class="icon" src="assets/images/muse.avif" alt="Musique" title="Musique">
                            <div class="photo-hover"></div>
                        </a>
                    </div>
                    <div>
                        <h5>Quiz Musique : Es-tu prêt à faire vibrer les notes ?</h5>
                        <p>Teste tes connaissances sur les hits, les artistes légendaires et les genres qui font danser le monde.</p>
                    </div>
                    <div class="button">
                        <a href="music.php" class="lien-conteneur-photo">
                            <button type="button" class="btn btn-warning">Jouer</button>
                        </a>
                    </div>
                </div>
                <div class="dispose histoire">
                    <div class="box-image">
                        <a href="histoire.php" class="lien-conteneur-photo">
                            <img class="icon" src="assets/images/histoire1.jpg" alt="Histoire Romaine" title="Histoire Romaine">
                            <div class="photo-hover"></div>
                        </a>
                    </div>
                    <div>
                        <h5>Quiz Histoire Romaine : Es-tu prêt à conquérir l'Empire ?</h5>
                        <p>Teste tes connaissances sur les empereurs, les batailles légendaires et les secrets de la République. Es-tu un simple citoyen ou un véritable César de l'histoire ?</p>
                    </div>
                    <div class="button">
                        <a href="histoire.php" class="lien-conteneur-photo">
                            <button type="button" class="btn btn-warning">Jouer</button>
                        </a>
                    </div>
                </div>
                <div class="dispose science">
                    <div class="box-image">
                        <a href="geographie.php" class="lien-conteneur-photo">
                            <img class="icon" src="assets/images/globe.jpg" alt="Geographie globe terrestre" title="Globe">
                            <div class="photo-hover"></div>
                    </a>
                    </div>
                    <div>
                        <h5>Quiz Géographie : Es-tu prêt à explorer le monde ?</h5>
                        <p>Teste tes connaissances sur les continents, les capitales, les merveilles naturelles et les cultures du globe.</p>
                    </div>
                    <div class="button">
                        <a href="geographie.php" class="lien-conteneur-photo">
                            <button type="button" class="btn btn-warning">Jouer</button>
                        </a>
                    </div>
                </div>
                <div class="dispose sport">
                    <div class="box-image">
                        <a href="footb.php" class="lien-conteneur-photo">
                            <img class="icon" src="assets/images/foot.jpg" alt="Football" title="Quizz Football">
                            <div class="photo-hover"></div>
                        </a>
                    </div>
                    <div>
                        <h5>Quiz Football : Es-tu prêt à marquer l'histoire ?</h5>
                        <p>Plonge dans l'univers passionnant du football avec ce quiz enflammé ! Teste tes connaissances sur les légendes du ballon rond, les clubs mythiques, les coupes mémorables et les moments inoubliables</p>
                    </div>
                    <div class="button">
                        <a href="footb.php" class="lien-conteneur-photo">
                            <button type="button" class="btn btn-warning">Jouer</button>
                        </a>
                    </div>
                </div>
                <div class="dispose science">
                    <div class="box-image">
                        <a href="astro.php" class="lien-conteneur-photo">
                            <img class="icon" src="assets/images/astro.jpg" alt="Science Astronomie" title="Astronomie">
                            <div class="photo-hover"></div>
                        </a>
                    </div>
                    <div>
                        <h5>Quiz Astronomie : Es-tu prêt à explorer l'univers ?</h5>
                        <p>Teste tes connaissances sur les planètes, les étoiles, les galaxies et les secrets de l'espace. Es-tu un simple observateur ou un véritable astronome des étoiles ?</p>
                    </div>
                    <div class="button">
                        <a href="astro.php" class="lien-conteneur-photo">
                            <button type="button" class="btn btn-warning">Jouer</button>
                        </a>
                    </div>
                </div>
                <div class="dispose divers">
                    <div class="box-image">
                        <a href="jeu.php" class="lien-conteneur-photo">
                            <img class="icon" src="assets/images/jeu.jpg" alt="Jeu video" title="Jeu video">
                            <div class="photo-hover"></div>
                        </a>
                    </div>
                    <div>
                        <h5>Quiz Jeux Vidéo : Es-tu prêt à relever le défi virtuel ?</h5>
                        <p>Mets tes compétences à l'épreuve avec ce quiz ultime sur le monde des jeux vidéo !
                            Des classiques indémodables aux dernières sorties, en passant par les personnages emblématiques et les univers fantastiques, ce quiz te mettra au défi.</p>
                    </div>
                    <div class="button">
                        <a href="jeu.php" class="lien-conteneur-photo">
                            <button type="button" class="btn btn-warning">Jouer</button>
                        </a>
                    </div>
                  </div>
                <div class="dispose anime">
                    <div class="box-image">
                        <a href="jujutsu.php" class="lien-conteneur-photo">
                            <img class="icon" src="assets/images/jjk.jpg" alt="Anime Jujutsu kaisen">
                            <div class="photo-hover"></div>
                        </a>
                    </div>
                    <div>
                        <h5>Quiz Jujutsu Kaisen : Es-tu prêt à exorciser les fléaux ?</h5>
                        <p>Des combats épiques aux personnages attachants, en passant par les techniques de sorts uniques, ce quiz te plongera dans l'univers fascinant de Jujutsu Kaisen.</p>
                    </div>
                    <div class="button">
                        <a href="jujutsu.php" class="lien-conteneur-photo">
                            <button type="button" class="btn btn-warning">Jouer</button>
                        </a>
                    </div>
                </div>
                <div class="dispose anime">
                    <div class="box-image">
                        <a href="dbz.php" class="lien-conteneur-photo">
                            <img class="icon" src="assets/images/dbz.jpg" alt="Dragon Ball Z" title="Dragon Ball Z">
                            <div class="photo-hover"></div>
                        </a>
                    </div>
                    <div>
                        <h5>Quizz Dragon Ball : Niveau Facile à Intermédiaire</h5>
                        <p>Des combats épiques aux personnages attachants, en passant par les techniques de sorts uniques, ce quiz te plongera dans l'univers fascinant de Jujutsu Kaisen.</p>
                    </div>
                    <div class="button">
                        <a href="dbz.php" class="lien-conteneur-photo">
                            <button type="button" class="btn btn-warning">Jouer</button>
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </main>
    <?php
    require 'footer1.php';
    ?>
    <script type="module" src="https://unpkg.com/ionicons@7.1.0/dist/ionicons/ionicons.esm.js"></script>
    <script nomodule src="https://unpkg.com/ionicons@7.1.0/dist/ionicons/ionicons.js"></script>
</body>
</html>