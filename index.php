<?php
session_start();
include('src/controller/indexController.php');
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
                <form name="connection" action="" method="POST">
                    <input class="inputLogin" type="text" name="login" placeholder=" Login">
                    <div class="errorLog"> <?= $error ?></div>
                    <input class="inputPassword" type="password" name="password" placeholder=" Password">
                    <div class="errorPassword"> <?= $error ?></div>
                    <input class="submit" type="submit" value="Connexion" name="connexion" onclick="connnexion()">
                    <a class="inscrir" href="src/template/joueur/inscription.php">S'inscrire pour jouer? </a>
                </form>
            </div>
        </div>
    </div>
</div>
<script src="assets/js/fonction.js"></script>
</body>
</html>
