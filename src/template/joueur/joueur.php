<?php
session_start();
$_SESSION['url'] = "topScore.php";
$filenbQuestion = '../../../assets/json/nombreDeQuestionParJeux.json';
$_SESSION['nbQuestionsParJeux'] = file_get_contents($filenbQuestion);
//$_SESSION['question'] =$db;
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
//declaration question par page pour le jeux
$_SESSION['questionParPage'] = 1;
// traitement lors de la click sur le bouton suivant
if (isset($_POST['suivant'])) {
   traitementQuestion();
    if ($_SESSION['pageCourant'] * $_SESSION['questionParPage'] < count($_SESSION['tabReponses']))
        $_SESSION['pageCourant']++;
}
// traitement lors de la click sur le bouton précédent
if (isset($_POST['precedent'])) {
    traitementQuestion();
    if ($_SESSION['pageCourant'] > 1)
        $_SESSION['pageCourant']--;
}
if (isset($_POST['terminer'])) {
    traitementQuestion();
    $_SESSION['jeux'] = "resultat.php";
}
// traitement lors de la click sur le bouton suivant
if (isset($_POST['reJouer'])) {
    include('../../controller/nouvellePartieController.php');
}
//echo count($_POST['modifier']);
//echo $_SESSION['nbQuestions'];
$_SESSION['debutQuestion'] = ($_SESSION['pageCourant'] - 1) * $_SESSION['questionParPage'];
?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <title> joueur </title>
    <meta http-equiv="content-type" content="text/html; charset=utf-8"/>
    <link rel="stylesheet" type="text/css" href="../../../assets/css/miniProjet.css">
    <link rel="stylesheet" media="screen and (max-width: 1224px)"  href="../../../assets/css/miniProjetTablette.css"/>
    <link rel="stylesheet" media="screen and (max-width: 768px)"  href="../../../assets/css/miniProjetportable.css"/>
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
            <?php include($_SESSION['jeux']) ?>
            <div class="score">
                <ul>
                    <li><a href="joueur.php?page=topScore">Top score </a></li>
                    <li><a href="joueur.php?page=meilleur">Meilleur score </a></li>
                </ul>
                <?php include($_SESSION['url']) ?>
            </div>
        </div>
    </div>
</body>
</html>
