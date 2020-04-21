<?php
function top5(){
    $files = './assets/json/user.json';
    $db = file_get_contents($files);
    $db = json_decode($db ,true);
    $joueurs =[];
    for ($i = 0; $i < count($db); $i++) {
        if (!strcmp($db[$i]['role'], "joueur")) {
            $joueurs[]=$db[$i];
        }
    }

    for ($i=0 ; $i<count($joueurs )-1;$i++)
    {

        for ($j=$i ; $j <count($joueurs );$j++)
        {

            if ($joueurs[$i]['score']<$joueurs[$j]['score'] ){
                $temp = $joueurs[$i];
                $joueurs[$i]= $joueurs[$j];
                $joueurs[$j]= $temp;
            }

        }
        if ($i<5){
            $top[]= $joueurs[$i];
        }
        else
            break;
    }
    return  $top;
}
/**$tab =[2,3,4,6,7,8,9];
for ($i=0 ; $i<count($tab )-1;$i++)
{

    for ($j=$i ; $j <count($tab );$j++)
    {
        if ($tab[$i]<$tab [$j]){

            $temp = $tab [$i];
            $tab [$i]= $tab [$j];
            $tab [$j]= $temp;
        }

    }
}
var_dump($tab);*/
?>

