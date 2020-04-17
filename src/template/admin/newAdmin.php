<div class="contentaddAdmin">
    <div class="texteInsc">
    S'inscrire
    </div>
    <div class="sousTexte">
        Pour proposer des quizz
    </div>
    <hr>
    <form class="adminAdd" method="post">
        <label for="prenom">Prénom</label>
        <input class="input" type="text" id="prenom">
        <label for="nom">Nom</label>
        <input class="input" type="text" id="nom">
        <label for="login">Login</label>
        <input class="input" type="text" id="login">
        <label for="password">Password</label>
        <input class="input" type="password" id="password">
        <label for="cpassword">Confirm password</label>
        <input class="input" type="password" id="cpassword">
        Avatar  <input class="inputfile" type="file" id="file" name="file">
        <input class="buttonValider" type="submit" id="submit" value="Créer compte">




    </form>
    <div class="addminImg">
       <?php if (isset($_POST['[file]'])) echo '<img class="addminImg" src="" alt="user">'?>
    </div>
    <div class="texteAvatar">avatar admin </div>


</div>
