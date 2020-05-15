<?php


function top5($chemin)
{
    $db = file_get_contents($chemin);
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
    for ($i = 0; $i < count($joueurs) - 1; $i++) {

        for ($j = $i; $j < count($joueurs); $j++) {

            if ($joueurs[$i]['score'] < $joueurs[$j]['score']) {
                $temp = $joueurs[$i];
                $joueurs[$i] = $joueurs[$j];
                $joueurs[$j] = $temp;
            }
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
    for ($i = $_SESSION['debut']; ($i < $nombreParPage * $_SESSION['pageCourant'] && $i < $taille); $i++) {
        echo '<tr>';
        echo '<td class="upercase">' . $tab[$i]['nom'] . '</td>';
        echo '<td>' . $tab[$i]['prenom'] . '</td>';
        echo '<td>' . $tab[$i]['score'] . ' pts</td>';
        echo '<tr>';
    }
}
// fonction pour créer des faux utilisatueur qui nous servirons de teste
function fosUser()
{
    for ($i = 0; $i < 100; $i++) {
        $objet = [
            "login" => 'user' . $i,
            "password" => 'user' . $i,
            "role" => 'joueur',
            "nom" => 'name' . $i,
            "prenom" => 'fName' . $i,
            "photo" => '../../../assets/Images/logo-QuizzSA.png',
            "score" => $i + 100,
            "repondue"=>[]
        ];
        $files = 'assets/json/user.json';
        $db = file_get_contents($files);
        $db = json_decode($db, true);
        array_push($db, $objet);
        $db = json_encode($db);
        file_put_contents('assets/json/user.json', $db);
    }
}
//fonction selection des question aleatoirement
function questionRand($user,$cheminNbQuestion,$cheminQuestions,$redirection)
{
    $nonrepondue = [];
    $nbquestion = file_get_contents($cheminNbQuestion);
    $questions = file_get_contents($cheminQuestions);
    $questions = json_decode($questions, true);
    // var_dump($questions);
    for ($j = 0; $j < count($questions); $j++) {
            if (in_array($j,$user->repondue)) {
                //echo 'magui si if bi';
            } else{
                //echo 'maagui si else bi';
                $nonrepondue[] = $questions[$j];
               //break;
            }
    }
   //var_dump($nonrepondue);
    $i=0;
    $return=[];
if (count($nonrepondue)==0){
  header($redirection);
}
   while ($i<$nbquestion) {
       $teste=0;
        $valeur = random_int(0, count($nonrepondue)-1);
        for ($j = 0; $j < count($return); $j++) {
            if (($nonrepondue[$valeur]['question']===$return[$j]['question'])){
               $teste=1;
               break;
            }
        }
        if ($teste ==0){
            $return[] = $nonrepondue[$valeur];
            $i++;
        }
        if ($i==count($nonrepondue)){
            break;
        }
    }
   // var_dump($return);
    return $return;
}


function traitementQuestion(){
    $position = $_SESSION['pageCourant'] - 1;
    //traitetement pour sauvegarder les reponses precédents
    if ($_SESSION['tabReponses'][$position]['type'] === "multiple") {
        for ($i = 0; $i < count($_SESSION['tabReponses'][$position]['reponses']); $i++) {
            if (isset($_POST['checbox' . $i . ''])) {
                $_SESSION['tabReponses'][$position]['clicked'][$i] = 1;
            } else
                $_SESSION['tabReponses'][$position]['clicked'][$i] = 0;
        }
    }
    if ($_SESSION['tabReponses'][$position]['type'] === "simple") {
        //   echo $_POST['radio'];
        for ($i = 0; $i < count($_SESSION['tabReponses'][$position]['reponses']); $i++) {
            if (isset($_POST['radio']) && $_POST['radio'] == "radio" . $i . "") {
                $_SESSION['tabReponses'][$position]['clicked'] = $i;
            }
        }
    }
    if ($_SESSION['tabReponses'][$position]['type'] === "texte") {
        $_SESSION['tabReponses'][$position]['clicked'][0]  = $_POST['texte'];
    }

    //var_dump($_SESSION['tabReponses'][$position]);
    //echo $_SESSION['tabReponses'][$position]['clecked'];
}
?>
