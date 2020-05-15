<?php
session_start();
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
            "role" => 'joueur',
            "nom" => $_POST['nom'],
            "prenom" => $_POST['prenom'],
            "photo" => $chemin,
            "score"=>0,
            "repondue"=>[]
        ];
        $files = '../../../assets/json/user.json';
        $db = file_get_contents($files);
        $db = json_decode($db, true);
        array_push($db, $objet);
        $db = json_encode($db);
        file_put_contents('../../../assets/json/user.json', $db);
        $objet = json_decode(json_encode($objet), FALSE);
        header('Location: ../../../index.php');


    }
}

//creation de fosuser
//fosUser();
?>


<!DOCTYPE html>
<html lang="fr">
<head>
    <title> Inscription</title>
    <meta http-equiv="content-type" content="text/html; charset=utf-8"/>
    <link rel="stylesheet" type="text/css" href="../../../assets/css/miniProjet.css">
    <link rel="stylesheet" media="screen and (max-width: 1224px)"  href="../../../assets/css/miniProjetTablette.css"/>
    <link rel="stylesheet" media="screen and (max-width: 768px)"  href="../../../assets/css/miniProjetportable.css"/>
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
        <div class="contentNewJoueur">
            <div class="texteInscJoueur">
                S'inscrire
            </div>
            <div class="sousTextejoueur">
                Pour tester votre niveau de culture générale
            </div>
            <hr class="hr">
            <form name="myForm" class="adminAdd" method="POST" onsubmit=" return isEmpty();"
                  enctype="multipart/form-data">
                <label for="prenom">Prénom</label>
                <input class="inputJoueur" type="text" name="prenom" value="<?= @$_POST['prenom'] ?>">
                <span id="errorPrenom" class="error"></span>
                <label class="labelJoueur" for="nom">Nom</label>
                <input class="inputJoueur" type="text" id="nom" name="nom" pattern="[\w \s]{2,}"
                       value="<?= @$_POST['nom'] ?>">
                <span id="errorNom" class="error"></span>
                <label class="labelJoueur" for="login">Login</label> <span class="error"><?= $error ?></span>
                <input class="inputJoueur" type="text" id="login" name="login" value="<?= @$_POST['login'] ?>">
                <span id="errorlogin" class="error"></span>
                <label class="labelJoueur" for="password">Password</label>
                <span id="passwordMessage"></span>
                <span id="errorPassword" class="error"></span>
                <input class="inputJoueur" type="password" id="password" name="password"
                       value="<?= @$_POST['password'] ?>">
                <label class="labelJoueur" for="cpassword">Confirm password</label>
                <input class="inputJoueur" type="password" id="cpassword" name="cpassword"
                       value="<?= @$_POST['cpassword'] ?>">
                <span id="errorCpassword" class="error"></span>
                Avatar <input class="inputfile" type="file" id="file" name="file" onchange="previewFile()"
                              accept=".jpeg, .png">
                <span class="error"><?= $errorFile ?></span><br>
                <input onclick="return isEmpty()" type="submit" name="submit" class="buttonValider"
                       value="Créer compte">
            </form>
            <img class="joueurImg" src="../../../assets/Images/user.png" alt="user">
            <div class="texteAvatar">avatar du joueur</div>
        </div>
    </div>
</div>
<script src="../../../assets/js/fonction.js"></script>
<script>
    function previewFile() {
        const preview = document.querySelector('.joueurImg');
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

</body>

</html>
