<div class="contentjoueur">
    <div class="reponse">
        <form method="post" name="reponses">
            <?php
            $teste = 0;
            $scoreM=0;
            $scoreS=0;
            $scoreT=0;
            $indiceTrouver =[];
            echo '<div class="questioncontent">';
            for ($i = 0; $i <count($_SESSION['tabReponses']) ; $i++) {
                echo '<div class="questioncontent">';
                echo '<div class="question">';
                echo $i + 1 . ' . ' . $_SESSION['tabReponses'][$i]['question'];
                echo '</div>';
                //pour compter le nombre de reponse true et checked
                $teste = 0;
               // echo count($_SESSION['tabReponses'][$i]['reponses']);
                for ($j = 0; $j < count($_SESSION['tabReponses'][$i]['reponses']); $j++) {
                    if ($_SESSION['tabReponses'][$i]['reponses'][$j]['etat'] == "true") {
                        $teste++;
                    }
                    if ($_SESSION['tabReponses'][$i]['type'] == "multiple") {
                      //  echo $_SESSION['tabReponses'][$i]['reponses'][$j]['etat'] .'   vs   '.$_SESSION['tabReponses'][$i]['clicked'][$j] ;
                        if ($_SESSION['tabReponses'][$i]['reponses'][$j]['etat'] == "true" && (isset($_SESSION['tabReponses'][$i]['clicked'][$j]) && $_SESSION['tabReponses'][$i]['clicked'][$j] === 1)) {
                            echo '<img class="valide" src="../../../assets/Images/Icones/valide.png" alt="">';
                            echo ' <input class="radio " type="checkbox" checked disabled="disabled" > ' . $_SESSION['tabReponses'][$i]['reponses'][$j]['reponse'] . '<br>';
                            //pour compter le nombre de reponse true et checked
                            $teste--;
                        } elseif ($_SESSION['tabReponses'][$i]['reponses'][$j]['etat'] == "false" && (isset($_SESSION['tabReponses'][$i]['clicked'][$j]) && $_SESSION['tabReponses'][$i]['clicked'][$j] === 1)) {
                            echo '<img class="valide" src="../../../assets/Images/Icones/invalide.png" alt="">';
                            echo ' <input class="radio " type="checkbox" checked disabled="disabled" > ' . $_SESSION['tabReponses'][$i]['reponses'][$j]['reponse'] . '<br>';
                        } elseif ($_SESSION['tabReponses'][$i]['reponses'][$j]['etat'] == "true") {
                            echo '<img class="valide" src="../../../assets/Images/Icones/valide.png" alt="">';
                            echo ' <input class="radio" type="checkbox"  disabled="disabled" > ' . $_SESSION['tabReponses'][$i]['reponses'][$j]['reponse'] . '<br>';
                        } else
                            echo '<input class="checkbox" type="checkbox" disabled="disabled" > ' . $_SESSION['tabReponses'][$i]['reponses'][$j]['reponse'] . '<br>';
                    }
                    if ($_SESSION['tabReponses'][$i]['type'] == "simple") {
                        //echo $_SESSION['tabReponses'][$i]['reponses'][$j]['etat'] .'   vs   '.@$_SESSION['tabReponses'][$i]['clicked'];
                        if (($_SESSION['tabReponses'][$i]['reponses'][$j]['etat'] == "true" && @$_SESSION['tabReponses'][$i]['clicked'] === $j)) {
                            echo '<img class="valide" src="../../../assets/Images/Icones/valide.png" alt="">';
                            echo ' <input class="radio" type="radio" disabled="disabled" name="radio" checked > ' . @$_SESSION['tabReponses'][$i]['reponses'][$j]['reponse'] . '<br>';
                            $scoreS +=$_SESSION['tabReponses'][$i]['point'];
                            $indiceTrouver[]= $i;
                        } else if ($_SESSION['tabReponses'][$i]['clicked'] == $j) {
                            echo '<img class="valide" src="../../../assets/Images/Icones/invalide.png" alt="">';
                            echo ' <input class="radio" type="radio" disabled="disabled" name="radio" checked> ' . @$_SESSION['tabReponses'][$i]['reponses'][$j]['reponse'] . '<br>';
                        } elseif ($_SESSION['tabReponses'][$i]['reponses'][$j]['etat'] == "true") {
                            echo '<img class="valide" src="../../../assets/Images/Icones/valide.png" alt="">';
                            echo ' <input class="radio" type="radio" disabled="disabled" name="radio" > ' . @$_SESSION['tabReponses'][$i]['reponses'][$j]['reponse'] . '<br>';
                        } else
                            echo '<input class="inputCheckbox" type="radio" disabled="disabled" name="radio"> ' . @$_SESSION['tabReponses'][$i]['reponses'][$j]['reponse'] . '<br>';
                    }
                    if ($j == count($_SESSION['tabReponses'][$i]['reponses']) - 1 && $teste == 0){
                        $scoreM+= $_SESSION['tabReponses'][$i]['point'];
                        $indiceTrouver[]= $i;
                    }

                }
                if ($_SESSION['tabReponses'][$i]['type'] == "texte") {
                    if ($_SESSION['tabReponses'][$i]['reponses'][0]['reponse'] === @$_SESSION['tabReponses'][$i]['clicked'][0]) {
                        echo '<img class="valide" src="../../../assets/Images/Icones/valide.png" alt="">';
                        echo '<input class="inputReponse" type="text" value="' . $_SESSION['tabReponses'][$i]['reponses'][0]['reponse'] . '" readonly><br>';
                        $scoreT +=$_SESSION['tabReponses'][$i]['point'];
                        $indiceTrouver[]= $i;
                    } else {
                        echo '<img class="valide" src="../../../assets/Images/Icones/valide.png" alt="">';
                        echo '<input class="inputReponse" type="text" value="' . $_SESSION['tabReponses'][$i]['reponses'][0]['reponse'] . '" readonly><br>';
                        echo '<img class="valide" src="../../../assets/Images/Icones/invalide.png" alt="">';
                        echo '<input class="inputReponse" type="text" value="' . @$_SESSION['tabReponses'][$i]['clicked'][0] . '" readonly><br>';
                    }
                }
                echo '</div>';
            }
            echo '</div>';

                echo '<input class="suivant" type="submit" name="reJouer" value="rejouer ">';


            //pour éliminer l'execution de cette code lors du chargement
            if($_SESSION['addScore']  ==1){
                $_SESSION['addScore'] ++;
                $_SESSION['score']= $scoreS + $scoreM + $scoreT;
                if($_SESSION['user']->score<$_SESSION['score']){
                    $_SESSION['user']->score=$_SESSION['score'];
                }
                $files = '../../../assets/json/user.json';
                $fileQuestion = '../../../assets/json/question.json';
                $question = file_get_contents($fileQuestion);
                $question = json_decode($question, true);
                // var_dump($question);
                $user = file_get_contents($files);
                $user = json_decode($user, true);
                for($i =0 ;$i < count($indiceTrouver);$i++){
                    for ($j=0 ; $j < count($question);$j++){
                        if ($question[$j]['question'] == $_SESSION['tabReponses'][$i]['question']){
                            $_SESSION['user']->repondue[]= $j;
                        }
                    }
                }
                for($i= 0 ; $i < count($user) ;$i++){
                    if ($user[$i]['login']===$_SESSION['user']->login){
                        $user[$i]=$_SESSION['user'];
                    }
                }

                $user = json_encode($user);
                file_put_contents('../../../assets/json/user.json', $user);
                //mettre à jour la liste des scores
                $_SESSION['top5'] = top5('../../../assets/json/user.json');
            }
            echo '<div class="resultat">votre score est :'. $_SESSION['score'].'   pts</div>';

            ?>
        </form>
    </div>
</div>

<?php
// pour ajouter le score une fois meme en rechargent la page

?>
