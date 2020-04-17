<?php
session_start();
if(empty( $_SESSION['user']))
    header('Location: ../../../index.php');

if (!empty($_POST['deconnexion'])) {
    session_destroy();
    header('Location: ../../../index.php');

}

if (isset($_POST['listeJoueur'])) {

    $_SESSION['url'] = "listeJoueur.php";

} elseif (isset($_POST['listeQuestion'])) {

    $_SESSION['url'] = "listeQuestion.php";

} elseif (isset($_POST['creeAdmin'])) {

    $_SESSION['url'] = "newAdmin.php";

}


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
                            <form method="post">
                                <a class="" href=""> Liste Questions
                                    <div class="iconListe"><input type="submit" value="" id="" name="listeQuestion"
                                                                  class="href_ButonON"/></div>
                                </a>

                            </form>
                        </li>
                        <li class="navBar">
                            <form method="post">
                                <a href=""> Créer Admin
                                    <input type="submit" name="creeAdmin" value="">
                                    <div class="iconAdd"></div>
                                </a>
                            </form>
                        </li>
                        <li class="navBar">
                            <form method="post">
                                <a href=""> Liste joueur

                                    <input type="submit" name="listeJoueur" value="">
                                    <div class="iconListeActive"></div>
                                </a>

                            </form>

                        </li>
                        <li class="navBar">
                            <form method="post">
                                <a href=""> Créer Questions

                                    <input type="submit" name="newQuestion" value="">
                                    <div class="iconAdd"></div>
                                </a>
                            </form>

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
    <script>
        function click(id) {
            var reponse = document.getElementById(id);
            var nbReponse = document.getElementById('nbInput').value;
            reponse.innerHTML += ndex + '" value="">  </div> </div>;


            /**  var x = document.createElement("INPUT");
             x.setAttribute("type", "text");
             x.setAttribute("value", "input gaye am fii ");
             x.setAttribute("name", "input gaye am fii");
             document.body.appendChild(x);
             compteur++;*/
        }
    </script>
</body>
</html>
