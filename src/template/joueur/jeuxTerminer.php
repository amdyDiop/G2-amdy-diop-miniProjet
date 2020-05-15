<?php
session_start();
$_SESSION['url'] = "topScore.php";
if (empty($_SESSION['user']))
    header('Location: ../../../index.php');
if (isset($_POST['deconnexion'])) {
    unset($_SESSION['user']);
    header('Location: ../../../index.php');
}
include('../../controller/joueurController.php');
if (isset($_GET['page'])) {
    if ($_GET['page'] == "topScore") {
        $_SESSION['url'] = "topScore.php";
    } elseif ($_GET['page'] == "meilleur") {
        $_SESSION['url'] = "meilleur.php";
    }
}
?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <title> joueur </title>
    <meta http-equiv="content-type" content="text/html; charset=utf-8"/>
    <link rel="stylesheet" type="text/css" href="../../../assets/css/miniProjet.css">
    <link rel="stylesheet" media="screen and (max-width: 1224px)"  href="../../../assets/css/miniProjetTablette.css"/>
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
                        <img class="joueurImgheader" src="<?= $_SESSION['user']->photo ?>">
                    </div>
                    <div class="usernameJoueur"><?= $_SESSION['user']->prenom . ' ' . $_SESSION['user']->nom ?></div>
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
                <div class="felicitation feu">
                    Félicitation vous avez trouvé toutes les questions de ce jeu,
                    votre score est : <?=$_SESSION['user']->score ?> pts.
                    D'autres questions serons disponibles. Merci pour votre visite
                </div>

            </div>
            <div class="score">
                <ul>
                    <li><a href="joueur.php?page=topScore">Top score </a></li>
                    <li><a href="joueur.php?page=meilleur">Mon meilleur score </a></li>
                </ul>
                <?php include($_SESSION['url']) ?>
            </div>
        </div>
    </div>
</body>
</html>
