<?php
?>


<div class="contentaddAdmin">
    <div class="texteInsc">
        S'inscrire
    </div>
    <div class="sousTexte">
        Pour proposer des quizz
    </div>
    <hr>
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

      <img class="addminImg" src="./../../../assets/Images/user.png" alt="user">
    <div class="texteAvatar">avatar admin</div>


</div>
