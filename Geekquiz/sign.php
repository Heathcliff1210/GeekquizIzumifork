<?php
session_start();
require 'database.php';
if (isset($_POST['send'])) {
    if(!empty($_POST["username"]) && !empty($_POST["email"]) && !empty($_POST["password"])) {
        $userName = htmlspecialchars($_POST["username"]);
        $email = htmlspecialchars($_POST["email"]);
        $password = password_hash($_POST["password"], PASSWORD_DEFAULT);
        //Verifier si le mail existe deja        
        $checkMailExistSql = 'SELECT id FROM formulaire WHERE email = :email';
        $stmtCheckEmail = $pdo->prepare($checkMailExistSql);
        $stmtCheckEmail->execute([':email' => $email]);
        $checkEmailExist = $stmtCheckEmail->fetch();

        if(!empty($checkEmailExist)) {
            $error = "L'email est déjà utilisée";
        } else {
            $sql = "INSERT INTO formulaire (username, email, password) VALUES (:username, :email, :password)";
            $stmt1 = $pdo->prepare($sql);
            $stmt1->execute([':username' => $userName, ':email' => $email, ':password' => $password]);
            $_SESSION['username'] = $userName;
            $_SESSION['userIsLoggedIn'] = true;
            // Recuperer l'id de session de l'utilisateur
            $stmt2 = $pdo->prepare('SELECT id FROM formulaire WHERE username = ?');
            $stmt2->execute([$userName]);
            $user = $stmt2->fetch();
            $_SESSION['id'] = $user['id'];
            // Recuperer l'id du quizz associé a l'utilisateur
            $stmt3 = $pdo->prepare('SELECT id FROM quizzes WHERE user_id = ?');
            $stmt3->execute([$user['id']]);
            $quizzes = $stmt3->fetch();
            if ($quizzes) {
            $_SESSION['quiz_id'] = $quizzes['id'];
            };
            header('Location: list.php');
            exit();
        }
    } else {
        $error = "Veuillez remplir tous les champs ci-dessus";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="assets/css/respoheader.css">
    <link rel="stylesheet" href="assets/css/style.css?t=<?php echo time(); ?>">
    <link rel="stylesheet" href="assets/css/sign.css?t=<?php echo time(); ?>">
    <link rel="stylesheet" href="assets/css/header.css">
    <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
    <title>Sign Up GeekQuiz</title>
</head>
<body>
<?php require 'header.php';?>
<?php require 'respoheader.php';?>
    <main class="box-sign">
        <div class="shade">
            <div class="form-box signup">
                <h2>Sign Up</h2>
                <?php if (!empty($error)): ?>
                    <div class="alert alert-success"><?php echo $error; ?></div>
                <?php endif; ?>
                <form action="" method="post">
                    <div class="input-box">
                        <input type="text" name="username" id="username" autocomplete="off" required>
                        <label for="username">Username</label>
                        <i class='bx bxs-user'></i>
                    </div>
                    <div class="input-box">
                        <input type="email" name="email" id="email" autocomplete="off" required>
                        <label for="email">Email</label>
                        <i class='bx bx-mail-send'></i>
                    </div>
                    <div class="input-box">
                        <input type="password" name="password" id="password" autocomplete="off" required>
                        <label for="password">Password</label>
                        <i class='bx bxs-lock' ></i>
                    </div>
                    <button type="submit" name="send" class="btn">Sign Up</button>
                    <div class="reg-links">
                        <p>Already have an account? <a href="login.php" class="register">Login</a></p>
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
