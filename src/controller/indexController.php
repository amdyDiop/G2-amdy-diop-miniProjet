<?php
$error = "";
include('src/controller/fonction.php');
include('src/controller/joueurController.php');
if (!empty($_POST['connexion'])) {
    if (isset($_POST['login']) && isset($_POST['password'])) {
        $login = $_POST['login'];
        $password = $_POST['password'];
        if (connex($login, $password) == 1) {
            if (strcmp(getRole($login, $password), "admin") == 0) {
                $_SESSION['admin'] = getUser($login, $password);
                $_SESSION['top5'] = top5('./assets/json/user.json');
                header('Location: ./src/template/admin/admin.php ');
            } elseif (strcmp(getRole($login, $password), "joueur") == 0) {
                $_SESSION['user'] = getUser($login, $password);
                $_SESSION['url'] = "listeJoueur.php";
                $_SESSION['jeux'] = "reponseQuestion.php";
                $_SESSION['page'] = 1;
                $_SESSION['score'] = 0;
                $_SESSION['addScore'] = 1;
//pour la pagination des liste de questions
                $_SESSION['Courantpage'] = 1;
// pour la pagintion des question dans le jeux
                $_SESSION['pageCourant'] = 1;
                $_SESSION['tabReponses'] = [];
                $_SESSION['question'] = questionRand($_SESSION['user'], 'assets/json/nombreDeQuestionParJeux.json', 'assets/json/question.json', 'Location: src/template/joueur/jeuxTerminer.php');
                for ($i = 0; $i < count($_SESSION['question']); $i++) {
                    $_SESSION['tabReponses'][$i]['question'] = $_SESSION['question'][$i]['question'];
                    $_SESSION['tabReponses'][$i]['point'] = $_SESSION['question'][$i]['point'];
                    $_SESSION['tabReponses'][$i]['type'] = $_SESSION['question'][$i]['type'];
                    $_SESSION['tabReponses'][$i]['reponses'] = $_SESSION['question'][$i]['reponses'];
                    $_SESSION['tabReponses'][$i]['clicked'] = [];
                }
                $_SESSION['top5'] = top5('./assets/json/user.json');
                header('Location: ./src/template/joueur/joueur.php ');
            }
        } else {
            $error = "login ou mot de passe incorrect";
        }

    }
}
?>
