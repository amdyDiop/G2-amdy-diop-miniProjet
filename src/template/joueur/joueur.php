<?php
session_start();

if (empty($_SESSION['user']))
    header('Location: ../../../index.php');
echo 'prenom:' . $_SESSION['user']->prenom . '<br>';
echo 'nom:' . $_SESSION['user']->nom . '<br>';
echo 'role:' . $_SESSION['user']->role . '<br>';
echo '<img  class="logo" src=" ' . $_SESSION['user']->photo . '" >';
if (!empty($_POST['deconnexion'])) {
    session_destroy();
    header('Location: ../../../index.php');

}
?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <title>Joueur </title>
    <meta http-equiv="content-type" content="text/html; charset=utf-8"/>
    <link rel="stylesheet" type="text/css" href="../../../assets/css/miniProjet.css">
</head>
<?php
?>

<body>
<div class="content">
    <form action="" method="post">
        <input class="submit" type="submit" value="Décoonnexion" name="deconnexion">
    </form>

</div>
</body>

</html>
