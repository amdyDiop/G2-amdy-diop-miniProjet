<div class="rightContent">
    <div class="textListJoueur">
        Liste des joueurs par score
    </div>
    <div class="tabList">
        <table>
            <th> Nom</th>
            <th>Prenom</th>
            <th> score</th>
            <?php
            $taille = count($_SESSION['joueurs']);
if (isset($_GET['liste'])){

    if (  $_SESSION['page']<=ceil( $taille /14)-1)
        $_SESSION['page']++;
}

            if (isset($_GET['listeprecedent'])){

                if (  $_SESSION['page']>1)
                    $_SESSION['page']--;
            }

            pagination($_SESSION['joueurs'],13,$_SESSION['page'],$taille);
            ?>
        </table>
    </div>
     <a   class="suivant" href="admin.php?liste=<?=$_SESSION['page']?>">suivant</a>
    <a   class="precedent" href="admin.php?listeprecedent=<?=$_SESSION['page']?>">précedant</a>

</div>
