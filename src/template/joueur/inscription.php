<!DOCTYPE html>
<html lang="fr">
<head>
    <title> Inscription</title>
    <meta http-equiv="content-type" content="text/html; charset=utf-8" />
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

        <div class="contentNewJoueur">
            <div class="texteInscJoueur">
                S'inscrire
            </div>
            <div class="sousTextejoueur">
                Pour tester votre niveau de culture générale
            </div>
            <hr class="hr">
            <form class="adminAdd" method="post">
                <label for="prenom">Prénom</label>
                <input class="inputJoueur" type="text" id="prenom">
                <label  class="labelJoueur" for="nom">Nom</label>
                <input class="inputJoueur" type="text" id="nom">
                <label  class="labelJoueur"  for="login">Login</label>
                <input class="inputJoueur" type="text" id="login">
                <label  class="labelJoueur"  for="password">Password</label>
                <input  class="inputJoueur" type="password" id="password">
                <label  class="labelJoueur"  for="cpassword">Confirm password</label>
                <input class="inputJoueur" type="password" id="cpassword">
                Avatar  <input class="inputfile" type="file" id="file" name="file">
                <input class="buttonValider" type="submit" id="submit" value="Créer compte">




            </form>
            <div class="joueurImg">
                <?php if (isset($_POST['[file]'])) echo '<img class="addminImg" src="" alt="user">'?>
            </div>
            <div class="texteAvatar">avatar du joueur </div>


        </div>


    </div>
</div>


</body>

</html>
