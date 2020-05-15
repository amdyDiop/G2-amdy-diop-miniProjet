<?php
$error = "";
$errorFile = "";
//inscription administrateur
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
//fin inscription administrateur

//add new question  administrateur
if (isset($_POST['question'])) {
    $reponses = [];
    $question = [];
    $champGenerer = count($_POST) - 3;
    $question['question'] = $_POST['question'];
    $question['type'] = $_POST['typeReponse'];
    $question['point'] = $_POST['point'];
    for ($i = 0; $i < $champGenerer - 1; $i++) {
        if ($_POST['typeReponse'] === "multiple") {
            if (isset($_POST['reponse' . ($i + 1) . '']) && $_POST['reponse' . ($i + 1) . ''] != "") {
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
//fin add  new question
$files = '../../../assets/json/nombreDeQuestionParJeux.json';
$nombreParJeux = file_get_contents($files);
if (!empty($_POST['valider']))
    {
        file_put_contents($files,$_POST['nbQuestion']);
        $nombreParJeux = file_get_contents($files);
    }
?>
