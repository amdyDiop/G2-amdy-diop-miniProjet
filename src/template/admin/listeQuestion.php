<div class="contentListQuestion">
    <div class="textNbQuestion">
        <div class="line">
            <div class="texte">Nbre question/jeu</div>
            <input class="nbQuestion" type="number" value="" name="nbQuestion">
            <input class="ok" type="button" value="ok" name="oko">
        </div>
    </div>
    <div class="borderIn">
        <?php
        if (isset($_POST['suivant'])) {
            if ( $_SESSION['Courantpage']*5<= $_SESSION['nbQuestions'])
                $_SESSION['Courantpage']++;
        }
        if (isset($_POST['precedent'])) {
            if ( $_SESSION['Courantpage']>1)
                $_SESSION['Courantpage']--;
        }
        $_SESSION['nbQuestions']=count($_SESSION['question']);
        //echo $_SESSION['nbQuestions'];
        $_SESSION['questionParPage']=5;
        $_SESSION['debutQuestion'] = ($_SESSION['Courantpage'] -1) * $_SESSION['questionParPage'];

        for ($i = $_SESSION['debutQuestion']; ($i < $_SESSION['questionParPage'] * $_SESSION['Courantpage'] && $i < $_SESSION['nbQuestions']); $i++) {
            echo '<div class="questioncontent">';
            echo '<div class="question">';
            echo $i + 1 . ' . ' . $_SESSION['question'][$i]['question'] . '<br>';
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
