<?php
session_start();

if(empty($_SESSION['user']))
    header('Location: ../../../index.php');

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
if (isset($_GET['liste']))
include('../../controller/fonction.php');
include('../../controller/joueurController.php');
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
            "photo" => $chemin
        ];
        $files = '../../../assets/json/user.json';
        $db = file_get_contents($files);
        $db = json_decode($db, true);
        array_push($db, $objet);
        $db = json_encode($db);
        file_put_contents('../../../assets/json/user.json', $db);
        $objet = json_decode(json_encode($objet), FALSE);
        $_SESSION['user'] = $objet;
        if ($resultat) {
            header('Location: admin.php');
        }

    }
}
$_SESSION['joueurs']= getJoueur();

?>

<!DOCTYPE html>
<html lang="fr">

<head>
    <title> Admin </title>
    <meta http-equiv="content-type" content="text/html; charset=utf-8"/>
    <link rel="stylesheet" type="text/css" href="../../../assets/css/miniProjet.css">
</head>
<?php

?>
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
                      <?php echo  '<img class="userImg" src="'. $_SESSION['user']->photo .'" alt="user">'?>
                    </div>
                    <div class="nom"> <?=$_SESSION['user']->prenom?></div>
                    <div class="prenom"><?=$_SESSION['user']->nom?></div>

                </div>
                <div class="menuItem">
                    <ul>

                        <li class="navBar">
                                <a href="admin.php?page=listeQuestion" > Liste Question
                                    <div  class="iconListe"></div>
                                </a>
                        </li>
                        <li class="navBar">
                                <a href="admin.php?page=newAdmin" > Créer Admin
                                    <div class="iconAdd"></div>
                                </a>
                        </li>
                        <li class="navBar">
                                <a href="admin.php?page=listeJoueur" > Liste joueur
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
                include($_SESSION['url']);
            }
            ?>
        </div>
    </div>

</body>
<script src="../../../assets/js/fonction.js"></script>
<script>
var i = 1; /* Set Global Variable i */
function increment(){
i += 1; /* Function for automatic increment of field's "Name" attribute. */
}
function addInput(divName) {
         var newdiv = document.createElement('div');
         var champ = "champ"+i;
          newdiv.innerHTML = "<div id=\"champ"+i+"\" class=\"nbQuestionNew\"><label class=\"label\" for=\"typeReponse\""+i+">Réponse"+i+"</label>  <input class=\"labelReponse\" type=\"text\" name=\"Reponse\""+i+" > <input type=\"checkbox\" name=\"repnseCheck\""+i+"><input  class=\"radio\" type=\"radio\" name= \"radio\""+i+"> <button class=\"delete\" onClick=\"suprimer('champ'+i');\"></button> </div>";
          document.getElementById(divName).appendChild(newdiv);
          increment()
}
function suprimer(elementId) {
    var element = document.getElementById(elementId);
    element.parentNode.removeChild(element);
}
    function previewFile() {
        const preview = document.querySelector('.addminImg');
        const file = document.querySelector('input[type=file]').files[0];
        const reader = new FileReader();

        reader.addEventListener("load", function () {
            // convert image file to base64 string
            preview.src = reader.result;
        }, false);

        if (file) {
            reader.readAsDataURL(file);
        }
    }
    function isEmpty() {
        // var errorPrenom = document.getElementById('errorPrenom');
        //var errorNom = document.getElementById('errorNom');
        //var errorLogin = document.getElementById('errorLogin');
        //var errorPassword = document.getElementById('errorPassword');
        //var errorCpassword = document.getElementById('errorCpassword');
        //var errorFile = document.getElementById('errorFile');
        var prenom = document.forms['myForm'].prenom.value;
        var nom = document.forms['myForm'].nom.value;
        var login = document.forms['myForm'].login.value;
        var password = document.forms['myForm'].password.value;
        var cpassword = document.forms['myForm'].cpassword.value;
        var file = document.forms['myForm'].file.value;
        if (!prenom.replace(/\s+/, '').length) {
            alert('Le champ Prenom ne peut être vide');
            return false;
        }
        if (!nom.replace(/\s+/, '').length) {

            alert('Le champ nom ne peut être vide');
            return false;
        }
        if (!login.replace(/\s+/, '').length) {
            alert('Le champ login ne peut être vide');
            return false;
        }
        if (!password.replace(/\s+/, '').length) {
            alert('Le champ password ne peut être vide');
            return false;
        }
        if (!cpassword.replace(/\s+/, '').length) {
            alert('Le champ confirmation ne peut être vide');
            return false;
        }
        if (cpassword !== password) {
            alert(' les deux mot de passe ne conrrespondent  pas');
            return false;
        }
        var fileName = document.forms['myForm'].file.value;
        regex = new RegExp("(.*?)\.(gpeg|png)$");
        if (fileName === "") {
            alert(' Le champ avatar ne peut être vide');
            return false;
        }
        /*if(regex!=="png"){
            alert("seul les formats  png  ou jpeg sont autorisé");
            return false;

        }*/


    }
</script>
</html>
