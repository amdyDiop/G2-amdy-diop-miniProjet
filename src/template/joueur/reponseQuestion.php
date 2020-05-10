<div class="contentjoueur">
    <div class="question">
        <span> queston <?= $_SESSION['pageCourant'] ?>/<?= count($_SESSION['tabReponses']) ?></span> <br>
        <?php
        for ($i = $_SESSION['debutQuestion']; ($i < $_SESSION['questionParPage'] * $_SESSION['pageCourant'] && $i < count($_SESSION['tabReponses']));  $i++) {
        echo '<span class="textequestion">' . $_SESSION['question'][$i]['question'] . '</span>'; ?>
    </div>
    <hr>
    <div class="nombreDePoint">
        <?= '<span class="textequestion">' . $_SESSION['question'][$i]['point'] . '</span>' ?> pts
    </div>
    <div class="reponse">
        <form method="post" name="reponses">
            <?php
            //var_dump($_SESSION['tabReponses']);

            echo '<div class="questioncontent">';
            for ($j = 0; $j < count($_SESSION['tabReponses'][$i]['reponses']); $j++) {
                if ($_SESSION['tabReponses'][$i]['type'] == "multiple") {
                    // var_dump($_SESSION['tabReponses'][$i]);
                    if (@$_SESSION['tabReponses'][$i]['clicked'][$j] === 1)
                        echo '<input class="inputCheckbox" type="checkbox" name="checbox' . $j . '"  checked > ' . $_SESSION['tabReponses'][$i]['reponses'][$j]['reponse'] . '<br>';
                    else
                        echo '<input class="inputCheckbox" type="checkbox"  name="checbox' . $j . '" > ' . $_SESSION['tabReponses'][$i]['reponses'][$j]['reponse'] . '<br>';
                }
                if ($_SESSION['tabReponses'][$i]['type'] == "simple") {
                    if ($_SESSION['tabReponses'][$i]['clicked'] === $j)
                        echo '<input class="inputCheckbox" type="radio" name="radio" value="radio' . $j . '" checked> ' . $_SESSION['tabReponses'][$i]['reponses'][$j]['reponse'] . '<br>';
                    else
                        echo '<input class="inputCheckbox" type="radio" name="radio" value="radio' . $j . '"> ' . $_SESSION['tabReponses'][$i]['reponses'][$j]['reponse'] . '<br>';
                }
            }
            if ($_SESSION['tabReponses'][$i]['type'] == "texte") {
                echo '<input class="inputReponse" type="text" value="' .@  $_SESSION['tabReponses'][$i]['clicked'][0] . '" name="texte" ><br>';
            }
            echo '</div>';
            }
            if ($_SESSION['pageCourant'] == 1 && count($_SESSION['tabReponses'])==1 ){
                echo '<input class="suivant" type="submit" name="terminer" value="Terminer">';
                echo '<input class="quitter" type="submit" name="terminer" value="Quitter">';
            }
            elseif ($_SESSION['pageCourant'] == 1){
                  echo '<input class="suivant" type="submit" name="suivant" value="Suivant">';
                echo '<input class="quitter" type="submit" name="terminer" value="Quitter">';
            }

            else if ($_SESSION['pageCourant'] == count($_SESSION['tabReponses']) ) {
                echo '<input class="suivant" type="submit" name="terminer" value="Terminer">';
                echo '<input class="precedent " type="submit" name="precedent" value="Précedent">';
            } else {
                echo '<input class="suivant" type="submit" name="suivant" value="Suivant">';
                echo '<input class="precedent " type="submit" name="precedent" value="Précedent">';
                echo '<input class="quitter" type="submit" name="terminer" value="Quitter">';

            }
            ?>
        </form>

    </div>
</div>
