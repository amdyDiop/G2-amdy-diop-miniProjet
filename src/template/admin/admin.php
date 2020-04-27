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
$error = "";
$errorFile = "";
if (isset($_POST['prenom'])) {
    if (existeLogin($_POST['login']) == 0) {
        $error = " login existe déja";
    } else {
        $error = "";
//1. strrchr renvoie l'extension avec le point (« . »).
        //2. substr(chaine,1) ignore le premier caractère de chaine.
        //3. strtolower met l'extension en minuscules.
        $extension = strtolower(substr(strrchr($_FILES['file']['name'], '.'), 1));
        $chemin = "../../../assets/Images/user/{$_POST['login']}.{$extension}";
        $resultat = move_uploaded_file($_FILES['file']['tmp_name'], $chemin);
        $objet = [
            "login" => $_POST['login'],
            "password" => $_POST['password'],
            "role" => 'admin',
            "nom" => $_POST['nom'],
            "prenom" => $_POST['prenom'],
            "photo" => $chemin,
        ];
        $files = '../../../assets/json/user.json';
        $db = file_get_contents($files);
        $db = json_decode($db, true);
        array_push($db, $objet);
        $db = json_encode($db);
        file_put_contents('../../../assets/json/user.json', $db);
        $objet = json_decode(json_encode($objet), false);
        $_SESSION['user'] = $objet;
        if ($resultat) {
            header('Location: admin.php');
        }

    }
}
$_SESSION['joueurs'] = getJoueur();
if (isset($_POST['question'])) {
    $reponses = [];
    $question = [];
    $champGenerer = count($_POST) - 3;
    $question['question'] = $_POST['question'];
    $question['type'] = $_POST['typeReponse'];
    $question['point'] = $_POST['point'];
    for ($i = 0; $i < $champGenerer - 1; $i++) {
        if ($_POST['typeReponse'] === "multiple") {
            if ( isset($_POST['reponse' . ($i + 1) . ''] ) && $_POST['reponse' . ($i + 1) . ''] != "" )  {
                if (isset($_POST["checkboxes" . ($i + 1) . ""])) {
                    $reponses[$i]['reponse'] = $_POST['reponse' . ($i + 1) . ''];
                    $reponses[$i]['etat'] = "true";;
                } else {
                    if (isset($_POST['reponse' . ($i + 1) . ''])) {
                        $reponses[$i]['reponse'] = $_POST['reponse' . ($i + 1) . ''];
                        $reponses[$i]['etat'] = "false";
                    }
                }
            }
        }
        if ($_POST['typeReponse'] === "simple") {
            if ($_POST['reponse' . ($i + 1) . ''] != "") {
                if (!empty($_POST['radio'] == "radio" . ($i + 1) . "")) {
                    $reponses[$i]['reponse'] = $_POST['reponse' . ($i + 1) . ''];
                    $reponses[$i]['etat'] = "true";;
                } else {
                    $reponses[$i]['reponse'] = $_POST['reponse' . ($i + 1) . ''];
                    $reponses[$i]['etat'] = "false";;
                }
            }
        }
    }
    if ($_POST['typeReponse'] === "texte") {
        $reponses[$i]['reponse'] = $_POST['texteReponse'];
        $reponses[$i]['etat'] = "true";;
    }
    $question['reponses'] = $reponses;
    $files = '../../../assets/json/question.json';
    $db = file_get_contents($files);
    $db = json_decode($db, true);
    array_push($db, $question);
    $db = json_encode($db);
    file_put_contents('../../../assets/json/question.json', $db);
}
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
