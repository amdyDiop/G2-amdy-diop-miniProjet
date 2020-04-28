<?php
session_start();

if (empty($_SESSION['user'])) {
    header('Location: ../../../index.php');
}
if (!empty($_POST['deconnexion'])) {
    session_destroy();
    header('Location: ../../../index.php');
}
if (isset($_GET['page'])) {
    switch ($_GET['page']) {
        case 'listeQuestion':
            $_SESSION['url'] = "listeQuestion.php";
            break;
        case 'newAdmin':
            $_SESSION['url'] = "newAdmin.php";
            break;
        case 'listeJoueur':
            $_SESSION['url'] = "listeJoueur.php";
            break;
        case 'newQuestion':
            $_SESSION['url'] = "newQuestion.php";
            break;
    }
}
if (isset($_GET['liste'])) {
    include '../../controller/fonction.php';
}

include '../../controller/joueurController.php';
include '../../controller/adminController.php';
$_SESSION['joueurs'] = getJoueur();
$files = '../../../assets/json/question.json';
$db = file_get_contents($files);
$db = json_decode($db, true);
$_SESSION['question'] =$db;
//print_r( $_SESSION['question']);
?>
<!DOCTYPE html>
<html lang="fr">

<head>
    <title> Admin </title>
    <link rel="stylesheet" type="text/css" href="../../../assets/css/miniProjet.css">
    <link rel="stylesheet"  href="../../../assets/js/adminController.js">
    <meta http-equiv="content-type" content="text/html; charset=utf-8"/>

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
                <div class="texteAdmin">créer et paramétrer vos quizz
                    <form method="post">
                        <input class="deconnexion" type="submit" value="Déconnexion" name="deconnexion">

                    </form>
                </div>
            </div>
            <div class="menu">
                <div class="headerMenu">
                    <div class="divUI">
                        <?php echo '<img class="userImg" src="' . $_SESSION['user']->photo . '" alt="user">' ?>
                    </div>
                    <div class="nom"> <?= $_SESSION['user']->prenom ?></div>
                    <div class="prenom"><?= $_SESSION['user']->nom ?></div>
                </div>
                <div class="menuItem">
                    <ul>
                        <li class="navBar">
                            <a href="admin.php?page=listeQuestion"> Liste Question
                                <div class="iconListe"></div>
                            </a>
                        </li>
                        <li class="navBar">
                            <a href="admin.php?page=newAdmin"> Créer Admin
                                <div class="iconAdd"></div>
                            </a>
                        </li>
                        <li class="navBar">
                            <a href="admin.php?page=listeJoueur"> Liste joueur
                                <div class="iconListeActive"></div>
                            </a>
                        </li>
                        <li class="navBar">
                            <a href="admin.php?page=newQuestion"> Créer Questions
                                <div class="iconAdd"></div>
                            </a>
                        </li>
                    </ul>
                </div>
            </div>
            <?php
            if (!empty($_SESSION['url'])) {
                include $_SESSION['url'];
            }
            ?>
        </div>
    </div>
</body>
<script src="../../../assets/js/fonction.js"></script>
<script src="../../../assets/js/adminController.js"></script>

</html>
