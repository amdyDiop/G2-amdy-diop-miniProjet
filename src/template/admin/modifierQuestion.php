<?php

@session_start();
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
        case 'modifier_question':
            $_SESSION['url'] = "modifierQuestion.php";
            break;
    }
}
if (isset($_GET['liste'])) {
    include '../../controller/fonction.php';
}

@include '../../controller/joueurController.php';
include '../../controller/adminController.php';
$_SESSION['joueurs'] = getJoueur();
$files = '../../../assets/json/question.json';
$db = file_get_contents($files);
$db = json_decode($db, true);
//var_dump($db);
$_SESSION['question'] = $db;
//print_r( $_SESSION['question']);
?>
<!DOCTYPE html>
<html lang="fr">

<head>
    <title> Admin </title>
    <link rel="stylesheet" type="text/css" href="../../../assets/css/miniProjet.css">
    <link rel="stylesheet" href="../../../assets/js/adminController.js">
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

            <div class="contentNewQuestion">
                <h2 class="titlenewQuestion">paramétrer votre question </h2>
                <div class="cadreInterne">
                    <form action="" method="post" name="newQuestion" onsubmit="return emptyQuestion();">
                        <div class="questionNew">
                            <div class="positionLabelQuestion"> Question</div>
                            <textarea name="question" id="question" cols="52"
                                      rows="4"><?= $db[$_SESSION['indice']]['question'] ?></textarea>
                        </div>
                        <div class="nbQuestionNew">
                            <label class="label" for="point">Nbre de Points</label>
                            <input class="nbPoint" type="number" name="point"
                                   value="<?= $db[$_SESSION['indice']]['point'] ?>">
                        </div>
                        <div class="nbQuestionNew">
                            <label class="label" for="typeReponse">Type de réponse</label>
                            <select id="select" name="typeReponse">
                                <?php
                                if ($db[$_SESSION['indice']]['type'] === "multiple") {
                                    echo '<option value="">Donnez le type de réponse</option>';
                                    echo '<option value = "multiple"  selected> Multiple</option >';
                                    echo '<option value = "simple" > Choix Simple </option >';
                                    echo '<option value = "texte" > Choix Texte </option >';
                                } elseif ($db[$_SESSION['indice']]['type'] === "simple") {
                                    echo '<option value="">Donnez le type de réponse</option>';
                                    echo '<option value = "multiple"  > Multiple</option >';
                                    echo '<option value = "simple" selected> Choix Simple </option >';
                                    echo '<option value = "texte" > Choix Texte </option >';
                                } else {
                                    echo '<option value="">Donnez le type de réponse</option>';
                                    echo '<option value = "multiple"  > Multiple</option >';
                                    echo '<option value = "simple" > Choix Simple </option >';
                                    echo '<option value = "texte" selected> Choix Texte </option >';
                                }
                                ?>
                            </select>
                            <?php
                            if ($db[$_SESSION['indice']]['type'] === "multiple") {
                                for ($i = 0; $i < count($db[$_SESSION['indice']]['reponses']); $i++) {
                                    echo '<div id="champ"'.($i+1).'"class="nbQuestionNew">';
                                    echo "<label class=\"label\" for=\"reponse".($i+1)."\">Réponse".($i+1)."</label>" ;
                                    echo "<input class=\"labelReponse\" type=\"text\" name=\"reponse".($i+1)."\" >" ;
                                   echo "<input type=\"checkbox\" name=\"checkboxes" .($i+1). "\" id=\"check" .($i+1). "\">" ;
                                   echo "<button class=\"delete\" onClick=\"suprimer('champ" .($i+1)."');\"></button> </div>";
                                }
                            }
                            ?>
                            <input class="addInpute" type="button" value="" onClick="addInput('newInput');">
                        </div>
                        <div id="newInput">
                        </div>
                        <input class="suivant" type="submit" value="modifier">
                    </form>
                </div>
            </div>
        </div>
    </div>
</body>
<script src="../../../assets/js/fonction.js"></script>
<script src="../../../assets/js/adminController.js"></script>

</html>
