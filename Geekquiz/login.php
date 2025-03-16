<?php
session_start();
require 'database.php';
if (isset($_POST['send'])) {
    if (!empty($_POST["username"]) && !empty($_POST["password"])) {
        $username = htmlspecialchars($_POST["username"]);
        $pass = htmlspecialchars($_POST["password"]);
        $checkPass = 'SELECT id, username, password FROM formulaire WHERE username = ?';
        $prepareCheck = $pdo->prepare($checkPass);
        $prepareCheck->execute([$username]); 
        $row = $prepareCheck->fetch(); // Récupérez une seule ligne (si elle existe)
        if ($row && password_verify($pass, $row['password'])) {
            $_SESSION['username'] = $row['username']; 
            $_SESSION['userIsLoggedIn'] = true;
            $_SESSION['id'] = $row['id'];
            // Recuperer l'id du quizz associé a l'utilisateur
            $stmt3 = $pdo->prepare('SELECT id FROM quizzes WHERE user_id = ?');
            $stmt3->execute([$row['id']]);
            $quizzes = $stmt3->fetch();
            if ($quizzes) {
                $_SESSION['quiz_id'] = $quizzes['id'];
            };
            header('Location: list.php');
            exit();
        } else {
            echo "Identifiants incorrects."; 
        }
    } else {
        echo "Veuillez remplir tous les champs ci-dessus.";
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="assets/css/style.css?t=<?php echo time(); ?>">
    <link rel="stylesheet" href="assets/css/login.css?t=<?php echo time(); ?>">
    <link rel="stylesheet" href="assets/css/header.css">
    <link rel="stylesheet" href="assets/css/respoheader.css">
    <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
    <title>Login GeekQuiz</title>
</head>
<body>
<?php require 'header.php';?>
<?php require 'respoheader.php';?>
    <main class="box-sign">
        <div class="shade">
            <span class="box-animate"></span>
            <span class="box-animate2"></span>
            <div class="form-box login">
                <h2>Log in</h2>
                <form action="" method="post">
                    <div class="input-box">
                        <input type="text" name="username" id="username" autocomplete="off" required>
                        <label for="username">Username</label>
                        <i class='bx bxs-user'></i>
                    </div>
                    <div class="input-box">
                        <input type="password" name="password" id="password" autocomplete="off" required>
                        <label for="password">Password</label>
                        <i class='bx bxs-lock' ></i>
                    </div>
                    <button type="submit" name="send" class="btn">Login</button>
                    <div class="reg-links">
                        <p>Dont have an account? <a href="sign.php" class="register">Sign Up</a></p>
                    </div>
                </form>
                <div class="greetings">
                    <h2>Welcome To  GeekQuiz</h2>
                    <p>Hey Geek ! Bienvenue sur GeekQuizz, où science-fiction, comics et jeux vidéo se rencontrent pour des quizz épiques.</p>
                    <a href="game.php">
                        <button class="go">Play Quizz</button>
                    </a>
                    <a href="rankings.php">
                        <button class="go">View Rankings</button>
                    </a>
                    <a href="aide.php">
                        <button class="go">Help</button>
                    </a>
                </div>
            </div>
        </div>
    </main>
<?php require 'footer1.php';?>
    <script type="module" src="https://unpkg.com/ionicons@7.1.0/dist/ionicons/ionicons.esm.js"></script>
    <script nomodule src="https://unpkg.com/ionicons@7.1.0/dist/ionicons/ionicons.js"></script>
</body>
</html>