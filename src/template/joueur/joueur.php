<?php
session_start();
if(empty($_SESSION['user']))
    header('Location: ../../../index.php');

if (!empty($_POST['deconnexion'])) {
    session_destroy();
    header('Location: ../../../index.php');

}
?>



<!DOCTYPE html>
<html lang="fr">

<head>
    <title> Admin </title>
    <meta http-equiv="content-type" content="text/html; charset=utf-8"/>
    <link rel="stylesheet" type="text/css" href="../../../assets/css/miniProjet.css">
</head>
<body>
<div class="global">
    <div class="header">
        <img class="logo" src="../../../assets/Images/logo-QuizzSA.png" alt="logo quiz">
        Le plaisir de jouer
    </div>
    <div class="content">
        <div class="globalAdmin">
            <div class="headerAdmin">
                <div class="contentHeader">
                    <div class="Imgdiv">
                        <img class="joueurImgheader" src="<?=$_SESSION['user']->photo?>">
                    </div>
                    <div class="usernameJoueur"><?= $_SESSION['user']->prenom.' '.$_SESSION['user']->nom ?></div>
                    <div class="texteheader1">
                        BIENVENUE SUR LA PLATEFORME DE JEU DE QUIZZ
                    </div>
                    <div class="texteheader2">
                        JOUER ET TESTER VOTRE NIVEAU DE CULTURE GÉNÉRALE
                    </div>
                    <form method="post">
                        <input class="deconnexionJoueur" type="submit" value="Déconnexion" name="deconnexion">
                    </form>
                </div>
            </div>
            <div class="contentjoueur">
            </div>
            <div class="score"></div>
        </div>
    </div>
</body>
</html>
