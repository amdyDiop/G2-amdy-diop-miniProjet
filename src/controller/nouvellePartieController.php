<?php $_SESSION['jeux'] = "reponseQuestion.php";
$_SESSION['page'] = 1;
$_SESSION['score'] = 0;
$_SESSION['addScore'] = 1;
//pour la pagination des liste de questions
$_SESSION['Courantpage'] = 1;
// pour la pagintion des question dans le jeux
$_SESSION['pageCourant'] = 1;
$_SESSION['tabReponses'] = [];
$cheminNbQuestion ='../../../assets/json/nombreDeQuestionParJeux.json';
$cheminQuestion='../../../assets/json/question.json';
$direction= 'Location: jeuxTerminer.php';
$_SESSION['question'] = questionRand($_SESSION['user'],$cheminNbQuestion,$cheminQuestion,$direction);
for ($i = 0; $i < count($_SESSION['question']); $i++) {
    $_SESSION['tabReponses'][$i]['question'] = $_SESSION['question'][$i]['question'];
    $_SESSION['tabReponses'][$i]['point'] = $_SESSION['question'][$i]['point'];
    $_SESSION['tabReponses'][$i]['type'] = $_SESSION['question'][$i]['type'];
    $_SESSION['tabReponses'][$i]['reponses'] = $_SESSION['question'][$i]['reponses'];
    $_SESSION['tabReponses'][$i]['clicked'] = [];
}
?>
