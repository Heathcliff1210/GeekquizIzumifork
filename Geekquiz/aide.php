<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="assets/css/style.css">
    <link rel="stylesheet" href="assets/css/form.css">
    <link rel="stylesheet" href="assets/css/header.css">
    <link rel="stylesheet" href="assets/css/help.css">
    <link rel="stylesheet" href="assets/css/respoheader.css">
    <link rel="stylesheet" href="assets/css/header.css">
    <script src="assets/js/script" defer></script>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
    <title>GeekQuiz Aide</title>
</head>
<body>
<?php require 'header.php';?>
<?php require 'respoheader.php';?>
<main>
    <h1 class="headers">Aide - GeekQuiz</h1>
    <p class="greet">Bienvenue sur la page d'aide de GeekQuiz! Vous trouverez ici des réponses aux questions fréquemment posées et des conseils pour utiliser notre plateforme de quiz.</p>
    <h2 class="headers">Fonctionnement général</h2>
    <p>Notre site vous permet de participer à des quiz sur différents thèmes, de créer vos propres quiz et de voir votre classements pour les quiz crée.</p>
     <h3 class="headers">Participation à un Quiz</h3>
    <ol>
        <li><strong>Sélectionner un quiz :</strong> Choisissez un quiz depuis la page d'accueil.</li>
        <li><strong>Répondre aux questions :</strong> Sélectionnez la réponse qui vous semble correcte. Vous ne pourrez pas revenir en arrière.</li>
        <li><strong>Voir son Classement :</strong> Une fois toutes les quiz terminer vous pouvez vous rendre dans la page "classement" pour voir vore classement mondiale!. <span class="important">N'oubliez pas de vous connecter ou vous inscire pour avoir acces a la page</span></li>
        <li><strong>Voir les résultats:</strong> Votre score et le nombres de bonnes/mauvaises réponses seront affichés.</li>
    </ol>
     <h3 class="headers">Création d'un quiz</h3>
        <p class="note">
            La création de quiz peut être réservée aux utilisateurs inscrits alors inscrivez vous pour avoir pleinement access au site
        </p>
    <ol>
        <li><strong>Accéder à l'outil de création :</strong> Cliquez sur l'onglet "Nouveau" pour créer un quiz" (souvent dans le menu secondaire lors des quiz).</li>
        <li><strong>Titre du Quiz :</strong> Donnez un titre clair à votre quiz.</li>
        <li><strong>Ajouter des questions :</strong>
            <ul>
                <li>Entrez le texte de la question.</li>
                <li>Ajoutez les options de réponse. <span class="important"> Indiquez clairement la bonne réponse</span>.</li>
                <li>Poser autant de questions que vous voulez pour chaque Quiz</li>
            </ul>
        </li>
         <li><strong>Publier et Enregistrer :</strong> Une fois terminé, publiez votre quiz pour le rendre accessible a Tous.</li>
    </ol>
    <h2 class="headers">Conseils et Astuces</h2>
    <ul>
        <li>Si vous rencontrez un bug, décrivez précisément le problème lorsque vous contactez le support.</li>
        <li>Vérifiez votre connexion internet si vous avez des problèmes de chargement.</li>
        <li>Lisez attentivement les questions et les options de réponse.</li>
    </ul>
    <h2 class="headers">FAQ (Foire Aux Questions)</h2>

    <div class="question">Q: Mon quiz ne s'affiche pas correctement. Que faire ?</div>
    <p>R:  Vérifiez que vous avez bien publié votre quiz.  Assurez-vous qu'il n'y a pas d'erreurs dans le code HTML si vous utilisez un éditeur avancé.  Contactez le support technique si le problème persiste.</p>

    <div class="question">Q : Puis-je modifier un quiz après l'avoir publié ?</div>
    <p>R : Oui, vous pouvez modifier un quiz publié.  Cependant, si des personnes ont déjà commencé à y répondre, leurs résultats pourraient être affectés.  Il est préférable de bien vérifier votre quiz avant de le publier.</p>

    <div class="question">Q: Comment supprimer un quiz que j'ai créé ?</div>
     <p>R: Accédez à la page de gestion des quiz crée.  Vous devriez y trouver une option pour supprimer (bouton "Supprimer", etc.).<span class="important"> La suppression est définitive</span>.</p>

    <h2 class="headers">Contact</h2>
    <p>Si vous n'avez pas trouvé la réponse à votre question, n'hésitez pas à nous contacter :</p>
    <ul>
        <li><strong>Par email :</strong> contact@geekquiz.com </li>
        <li><strong>Via le formulaire de contact :</strong> <a href="index.php#contact">Feedback</a></li>
    </ul>
</main>
<?php require 'footer1.php';?>
    <script type="module" src="https://unpkg.com/ionicons@7.1.0/dist/ionicons/ionicons.esm.js"></script>
    <script nomodule src="https://unpkg.com/ionicons@7.1.0/dist/ionicons/ionicons.js"></script>
</body>
</html>