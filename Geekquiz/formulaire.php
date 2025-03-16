<?php
require 'database.php';
if (isset($_POST['envoie'])) {
    if (!empty($_POST["nom"]) && !empty($_POST["email"]) && !empty($_POST["message"])) {
        $nom = htmlspecialchars($_POST["nom"]);
        $email = htmlspecialchars($_POST["email"]);
        $texte = htmlspecialchars($_POST ["message"]);
        // inserer email , le nom et le commentaire de l'utilisateur
        $sql = "INSERT INTO commentaire (name,email,message) VALUES (:name,:email,:texte)";
        $stmt1 = $pdo->prepare($sql);
        $stmt1->execute(['name' => $nom,'email' => $email,'texte' => $texte]);
    };
};
?>
<section id="contact" class="section-contact">
    <h2>Feedback</h2>
    <form method="post" action="">
        <div class="form-nom-email">
            <div class="form-column">
                <label for="nom">Nom</label>
                <input type="text" name="nom" id="nom" >
            </div>
            <div class="form-column">
                <label for="email">Email</label>
                <input type="email" name="email" id="email" >
            </div>
        </div>
        <textarea placeholder="Commentaire" name="message" id="message" rows="10"></textarea>
        <input type="submit" name="envoie" value="ENVOYER" class="cta" >
    </form>
</section>