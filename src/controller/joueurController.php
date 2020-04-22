<?php
function top5()
{
    $files = './assets/json/user.json';
    $db = file_get_contents($files);
    $db = json_decode($db, true);
    $joueurs = [];
    for ($i = 0; $i < count($db); $i++) {
        if (!strcmp($db[$i]['role'], "joueur")) {
            $joueurs[] = $db[$i];
        }
    }

    for ($i = 0; $i < count($joueurs) - 1; $i++) {

        for ($j = $i; $j < count($joueurs); $j++) {

            if ($joueurs[$i]['score'] < $joueurs[$j]['score']) {
                $temp = $joueurs[$i];
                $joueurs[$i] = $joueurs[$j];
                $joueurs[$j] = $temp;
            }

        }
        if ($i < 5) {
            $top[] = $joueurs[$i];
        } else
            break;
    }
    return $top;
}
//fonction qui recupére un joueur en fonction de sont mot de passse et de son login
function getJoueur()
{
    $files = '../../../assets/json/user.json';
    $db = file_get_contents($files);
    $db = json_decode($db, true);
    $joueurs = [];
    for ($i = 0; $i < count($db); $i++) {
        if (!strcmp($db[$i]['role'], "joueur")) {
            $joueurs[] = $db[$i];
        }
    }
    return $joueurs;
}

//fonction pagination des liste de joueur dans la page addminn
function pagination($tab, $nombreParPage, $page, $taille)
{
    $_SESSION['nombreTotal'] = $taille;
    $_SESSION['pageTotal'] = ceil($_SESSION['nombreTotal'] / $nombreParPage);
    if (isset($_GET[$page]) && $_GET[$page] > 0) // Si la variable $_GET['page'] existe... et ne contient que des chiffre
    {
        $_GET[$page] = $_SESSION['page'];
        $_SESSION['pageCourant'] = $_GET[$page];  // page courant prend la page actuelle
    } else {
        $_SESSION['pageCourant'] = $page;  // si non  elle prend 1ouvreloe bou  ma
    }
    $_SESSION['debut'] = ($_SESSION['pageCourant'] - 1) * $nombreParPage; // de but de l'achiffage par page

    for ($i = $_SESSION['debut']; ($i < $nombreParPage * $_SESSION['pageCourant'] &&$i< $taille); $i++ ){

            echo '<tr>';
            echo '<td class="upercase">' . $tab[$i]['nom'] . '</td>';
            echo '<td>' . $tab[$i]['prenom'] . '</td>';
            echo '<td>' .$tab[$i]['score'] . '</td>';
            echo '<tr>';
        }



}

// fonction pour créer des faux utilisatueur qui nous servirons de teste
function fosUser(){
   for ($i=0;$i<100;$i++){
       $objet = [
           "login" => 'user'.$i,
           "password" => 'user'.$i,
           "role" => 'joueur',
           "nom" => 'name'.$i,
           "prenom" =>'firstName'.$i,
           "photo" => '../../../assets/Images/logo-QuizzSA.png',
           "score" =>0
       ];
       $files = '../../../assets/json/user.json';
       $db = file_get_contents($files);
       $db = json_decode($db, true);
       array_push($db, $objet);
       $db = json_encode($db);
       file_put_contents('../../../assets/json/user.json', $db);
   }

}
?>

