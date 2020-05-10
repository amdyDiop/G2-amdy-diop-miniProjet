<div class="contentListQuestion">
    <div class="textNbQuestion">

        <div class="line">
            <div class="texte">Nbre question/jeu</div>
            <form name="ok" method="post" onsubmit="return fixNbQuestion();">
                <input class="nbQuestion" type="number"  name="nbQuestion" value=<?=$nombreParJeux?>>
                <input class="ok" type="submit" value="ok" name="valider">
                <!--span class="error">le nombre de question doit etre >=5</span-->
            </form>
        </div>
    </div>
    <div class="borderIn">
        <?php
        if (isset($_POST['suivant'])) {
            if ($_SESSION['Courantpage'] * 5 <= $_SESSION['nbQuestions'])
                $_SESSION['Courantpage']++;
        }
        if (isset($_POST['precedent'])) {
            if ($_SESSION['Courantpage'] > 1)
                $_SESSION['Courantpage']--;
        }
        //echo count($_POST['modifier']);
        $_SESSION['nbQuestions'] = count($_SESSION['question']);
        //echo $_SESSION['nbQuestions'];
        $_SESSION['questionParPage'] = 5;
        $_SESSION['debutQuestion'] = ($_SESSION['Courantpage'] - 1) * $_SESSION['questionParPage'];

        for ($i = $_SESSION['debutQuestion']; ($i < $_SESSION['questionParPage'] * $_SESSION['Courantpage'] && $i < $_SESSION['nbQuestions']); $i++) {
            echo '<div class="questioncontent">';
            echo '<div class="question">';
            echo $i + 1 . ' . ' . $_SESSION['question'][$i]['question'];
            /**echo '<form method="POST">';
             * echo'<input type="submit" name="modifier'.$i.'"> <div class="iconListeActive"></div>';
             * echo'</form>';**/
            if (isset($_POST['modifier' . $i . ''])) {
                $_SESSION['url'] = "modifierQuestion.php";
                echo 'position' . $i;
                header('Location: modifierQuestion.php ');
                $_SESSION['indice'] = $i;
            }
            echo '</div>';
            for ($j = 0; $j < count($_SESSION['question'][$i]['reponses']); $j++) {
                if ($_SESSION['question'][$i]['type'] == "multiple") {
                    if ($_SESSION['question'][$i]['reponses'][$j]['etat'] == "true") {
                        echo '<input class="inputCheckbox" type="checkbox" checked disabled="disabled" > ' . $_SESSION['question'][$i]['reponses'][$j]['reponse'] . '<br>';
                    } else
                        echo '<input class="inputCheckbox" type="checkbox" disabled="disabled" > ' . $_SESSION['question'][$i]['reponses'][$j]['reponse'] . '<br>';
                }
                if ($_SESSION['question'][$i]['type'] == "simple") {
                    if ($_SESSION['question'][$i]['reponses'][$j]['etat'] == "true") {
                        echo '<input class="inputCheckbox" type="radio" disabled="disabled" name="radio" checked > ' . $_SESSION['question'][$i]['reponses'][$j]['reponse'] . '<br>';
                    } else
                        echo '<input class="inputCheckbox" type="radio" disabled="disabled" name="radio"> ' . $_SESSION['question'][$i]['reponses'][$j]['reponse'] . '<br>';
                }
            }
            if ($_SESSION['question'][$i]['type'] == "texte") {
                echo '<input class="inputReponse" type="text" value="' . $_SESSION['question'][$i]['reponses'][0]['reponse'] . '" readonly><br>';
            }
            echo '</div>';
        }
        ?>
    </div>
    <form method="post">
        <input class="suivant" type="submit" value="Suivant" name="suivant">
        <input class="precedent" type="submit" value="Précédent" name="precedent">
    </form>
</div>
<script>
    function fixNbQuestion(){
        //var errorNombre = document.getElementById('errorNobre');
        let valider = document.forms['ok'].nbQuestion.value;
        if (!valider.replace(/\s+/,'').length || valider<5) {
            alert('Le champ nombre  supérieur ou égal à 5');
            return false;
        }
    }
</script>
