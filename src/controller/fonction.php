<?php
//fonction pour tester l'existence d'un user
function connex( $login, $password)
{
    $files = './assets/json/user.json';
    $db = file_get_contents($files);
    $db = json_decode($db);
    $teste = 0;
    for ($i = 0; $i < count($db); $i++) {
        if (strcmp($db[$i]->login, $login) == 0 && strcmp($db[$i]->password, $password) == 0) {
            $teste = 1;
            break;
        }
    }
    if ($teste == 1) {
        return 1;
    }
    return 0;
}

//fonction pour récupérer le joueur connecté
function getUser($login,$password){
    $files = './assets/json/user.json';
    $db = file_get_contents($files);
    $db = json_decode($db);
    for ($i = 0; $i < count($db); $i++) {
            if (strcmp($db[$i]->login, $login) == 0 && strcmp($db[$i]->password, $password) == 0) {
                return $db[$i];
              }
    }
    return null ;
}

function getRole($login,$password){
    $files = './assets/json/user.json';
    $db = file_get_contents($files);
    $db = json_decode($db);
    for ($i = 0; $i < count($db); $i++) {
        if (strcmp($db[$i]->login,$login) == 0 && strcmp($db[$i]->password, $password) == 0 && strcmp($db[$i]->role,"admin") == 0) {
            return "admin";
        }
        if (strcmp($db[$i]->login,$login) == 0 && strcmp($db[$i]->password, $password) == 0 && strcmp($db[$i]->role,"joueur") == 0) {
            return "joueur";
        }
    }
}

function existeLogin($login){
$files = '../../../assets/json/user.json';
$db = file_get_contents($files);
$db = json_decode($db, true);
$teste = 0;
for ($i = 0; $i < count($db); $i++) {
    if (strcmp($db[$i]['login'], $login) == 0) {
        $teste = 1;
        break;
    }
}
if ($teste == 0)
    return 1;
return 0;

}

?>
