<?php
if (session_status() !== PHP_SESSION_ACTIVE) {
    session_start();
};
?>
<header >
    <div class="navigation">
        <a style="text-decoration: none" href="index.php">
            <h1 class="nav-title">GeekQuiz</h1>
        </a>
        <ul>
            <li class="list act">
                <a class="navLinks" href="index.php">
                    <span class="icons">
                        <ion-icon name="home-outline"></ion-icon>
                    </span>
                    <span class="title">Accueil</span>
                </a>
            </li>
            <li class="list">
                <a class="navLinks" href="game.php">
                    <span class="icons">
                        <ion-icon name="game-controller-outline"></ion-icon>
                    </span>
                    <span class="title">Quizz</span>
                </a>
            </li>
            <li class="list">
                <a class="navLinks" href="rankings.php">
                    <span class="icons">
                        <ion-icon name="podium-outline"></ion-icon>
                    </span>
                    <span class="title">Classement</span>
                </a>
            </li>
            <li class="list">
                <a class="navLinks" href="new.php">
                    <span class="icons">
                        <ion-icon name="folder-open-outline"></ion-icon>
                    </span>
                    <span class="title">Nouveau</span>
                </a>
            </li>
            <?php if (isset($_SESSION['userIsLoggedIn']) && $_SESSION['userIsLoggedIn']): ?>
            <li class="list">
                <a class="navLinks" href="list.php">
                    <span class="icons">
                        <ion-icon name="list-outline"></ion-icon>
                    </span>
                    <span class="title">List</span>
                </a>
            </li>
            <?php endif; ?>
            <li class="list">
                <a class="navLinks" href="aide.php">
                    <span class="icons">
                        <ion-icon name="help-circle-outline"></ion-icon>
                    </span>
                    <span class="title">Aide</span>
                </a>
            </li>
        </ul>
        <div class="auth-buttons">
        <?php
        // Verifie si l'utilisateur est connecter et actualisé le header en fonction
        if (isset($_SESSION['userIsLoggedIn']) && $_SESSION['userIsLoggedIn']) {
            echo '<span class="user"><ion-icon class="profile" name="person-circle-outline"></ion-icon>' . htmlspecialchars($_SESSION['username']) .'</span>';
            echo '<a href="logout.php"><button class="sign-out">Se déconnecter</button></a>';
        } else {
            echo '<a href="login.php"><button class="sign-in">Sign In</button></a>';
            echo '<a href="sign.php"><button class="sign-up">Sign Up</button></a>';
        }
        ?>
        </div>
    </div>
</header>