
<?php
session_start();


if (isset($_POST['listeJoueur'])) {

    $_SESSION['url']="listeJoueur.php";

}
elseif (isset($_POST['listeQuestion'])) {

    $_SESSION['url']="listeQuestion.php";

}
elseif (isset($_POST['creeAdmin'])) {

    $_SESSION['url']="newAdmin.php";

}


?>

<!DOCTYPE html>
<html lang="fr">

<head>
    <title> mini projet php </title>
    <meta http-equiv="content-type" content="text/html; charset=utf-8"/>
    <link rel="stylesheet" type="text/css" href="../../assets/css/miniProjet.css">
    <link rel="stylesheet"
          href="https://fonts.googleapis.com/css?family=Tangerine">
</head>
<?php

?>
<body>
<div class="global">
    <div class="header">
        <img class="logo" src="../../assets/Images/logo-QuizzSA.png" alt="logo quiz">
        Le plaisir de jouer
    </div>
    <div class="content">
        <div class="globalAdmin">
            <div class="headerAdmin">
                <div class="texteAdmin">créer et paramétrer vos quizz</div>
                <input class="deconnexion" type="submit" value="Déconnexion" name="deconnexion">
            </div>

            <div class="menu">
                <div class="headerMenu">
                    <div class="divUI">
                        <img class="userImg" src="amdy.JPG" alt="user">
                    </div>
                    <div class="nom">mouhamadou</div>
                    <div class="prenom">ilimane var</div>

                </div>
                <div class="menuItem">
                    <ul>

                        <li class="navBar">
                            <form method="post">
                            <a href=""> Liste Questions

                                <input  type="submit" name="listeQuestion" value="">
                                <div class="iconListe"></div>
                            </a>
                            </form>
                        </li>
                        <li class="navBar">
                            <a href=""> Créer Admin
                                <form method="post">
                                    <input  type="submit" name="creeAdmin" value="">
                                </form>
                                <div class="iconAdd"></div>
                            </a>
                        </li>
                        <li class="navBar">
                            <a href=""> Liste joueur
                                <form method="post">
                                <input  type="submit" name="listeJoueur" value="">
                                </form>
                                <div class="iconListeActive"></div>
                            </a>

                        </li>
                        <li class="navBar">
                            <a href=""> Créer Questions
                                <form method="post">
                                    <input  type="submit" name="newQuestion" value="">
                                </form>
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
    <script>
        function click(id) {
            var reponse = document.getElementById(id);
            var nbReponse= document.getElementById('nbInput').value;
                reponse.innerHTML += ndex+'" value="">  </div> </div>;


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
