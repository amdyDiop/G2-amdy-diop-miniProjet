<table>
    <?php
    for ($i = 0; $i < count($_SESSION['top5']); $i++) {
        echo '<tr>';
        echo '<th>' . $_SESSION['top5'][$i]['prenom'] . ' ' . $_SESSION['top5'][$i]['nom'] . '</th>';
        echo '<th>' . $_SESSION['top5'][$i]['score'] . ' pts</th>';
        echo '<tr>';
    }

    ?>
</table>
