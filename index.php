<?php


session_start();
$error = "";
$_SESSION['user'] = [];
include ('src/controller/fonction.php');
$_SESSION['nom'] = "amdy";
if (!empty($_POST['connexion'])) {
    if (isset($_POST['login']) && isset($_POST['password'])) {
        $login = $_POST['login'];
        $password = $_POST['password'];
        if (connex($login, $password) == 1) {
            if (strcmp(getRole($login, $password), "admin") == 0) {
                $_SESSION['user'] = getUser($login, $password);
                header('Location: ./src/template/admin/admin.php ');
            } elseif (strcmp(getRole($login, $password), "joueur") == 0) {
                $_SESSION['user'] = getUser($login, $password);
                header('Location: ./src/template/joueur/joueur.php ');
            }
        } else {
            $error = "login ou mot de passe incorrect";
        }

    }
}
?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <title>Login </title>
    <meta http-equiv="content-type" content="text/html; charset=utf-8"/>
    <link rel="stylesheet" type="text/css" href="./assets/css/miniProjet.css">
    <link rel="stylesheet"
          href="https://fonts.googleapis.com/css?family=Tangerine">
</head>
<?php
?>
<body>
<div class="global">
    <div class="header">
        <img class="logo" src="./assets/Images/logo-QuizzSA.png" alt="logo quiz">
        Le plaisir de jouer
    </div>
    <div class="content">
        <div class="login">
            <div class="loginHeader">Login Form</div>
            <div class="loginContent">
                <form action="" method="POST">

                    <input class="inputLogin" type="text" name="login" placeholder=" Login">
                    <div class="errorLog"> <?= $error ?></div>
                    <input class="inputPassword" type="password" name="password" placeholder=" Password">
                    <div class="errorPassword"> <?= $error ?></div>
                    <input class="submit" type="submit" value="Connexion" name="connexion">
                    <a class="inscrir" href="src/template/joueur/inscription.php">S'inscrire pour jouer? </a>
                </form>

            </div>
        </div>
    </div>
</div>
</body>

</html>
