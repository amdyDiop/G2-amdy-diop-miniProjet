function emptyQuestion() {
    var question = document.forms['newQuestion']['question'].value;

    var champGenerer = document.getElementsByTagName('input').length - 4;
    var texTAreaGenerer = document.getElementsByTagName('textarea').length;
    var point = document.forms['newQuestion']['point'].value;
    var select = document.forms['newQuestion']['select'].value;
    if (question === "") {
        alert('champs question  obligatoire');
        return false;
    }
    if (point < 1 || point === "") {
        alert('champs  point obligatoir et supérieur ou égal à 1');
        return false;
    }
    if (select === "") {
        alert('champs type de réponse obligatoire');
        return false;
    }
    if (select === "multiple") {
        if ((champGenerer / 2) < 2) {
            alert('ajouter au moins deux  reponses ');
            return false;
        } else {
            var taille = document.getElementsByTagName('input').length;
            vide = 0;
            var j = 1;
            var clicked = 0;
            for (var compteur = 3; compteur < taille - 1; compteur += 2) {
                if (document.getElementsByTagName('input')[compteur].value !== "") {
                    vide++;
                    if (document.getElementById('check' + j + '').checked) {
                        clicked++;
                        j++
                    }
                }
            }
            if (vide < 2) {
                alert('remplir au moins deux reponses');
                return false;
            }
            if (clicked === 0) {
                alert('choisir  les  bonnes  réponses');
                return false;
            }
        }
    }
    if (select === "simple") {
        if ((champGenerer / 2) < 2) {
            alert('ajouter au moins deux  reponses ');
            return false;
        } else {
            var tailler = document.getElementsByTagName('input').length;
            var vider = 0;
            var jr = 1;
            var clickedr = 0;
            for (var compteurr = 3; compteurr < tailler - 1; compteurr += 2) {
                if (document.getElementsByTagName('input')[compteurr].value !== "") {
                    vider++;
                    if (document.getElementById('radio' + jr + '').checked) {
                        // alert('beus na ko nag');
                        clickedr++;
                    }
                    jr++;
                }
            }
            if (vider < 2) {
                alert('remplir au moins deux reponse');
                return false;
            }
            if (clickedr === 0) {
                alert('choisir au moins la bonne  réponse');
                return false;
            }
        }
    }
    if (select === "texte") {
        if (texTAreaGenerer === 1) {
            alert('ajouter une  reponse');
            return false;
        } else {
            if (document.getElementsByTagName('textarea')[1].value === "") {
                alert('ajouter une  reponse');
                return false;
            }
        }
    }
}

var i = 1; /* Set Global Variable i */
function increment() {
    i += 1;
}

function decreement() {
    i -= 1;
}

function addInput(divName) {
    // var champ = "champ" + i;
    var newdiv = document.createElement('div');
    var valeur = document.getElementById('select').value;
    if (valeur === "multiple") {
        newdiv.innerHTML = "<div id=\"champ" + i + "\" class=\"nbQuestionNew\">" +
            "<label class=\"label\" for=\"reponse" + i + "\">Réponse" + i + "</label>" +
            "<input class=\"labelReponse\" type=\"text\" name=\"reponse" + i + "\" >" +
            " <input type=\"checkbox\" name=\"checkboxes" + i + "\" id=\"check" + i + "\">" +
            " <button class=\"delete\" onClick=\"suprimer('champ" + i + "');\"></button> </div>";
        document.getElementById(divName).appendChild(newdiv);
        increment()
    } else if (valeur === "simple") {
        newdiv.innerHTML = "<div id=\"champ" + i + "\" class=\"nbQuestionNew\">" +
            "<label class=\"label\" for=\"reponse" + i + "\">Réponse" + i + "</label>" +
            "<input class=\"labelReponse\" type=\"text\" name=\"reponse" + i + "\"  >" +
            "<input  class=\"radio\" type=\"radio\" name=\"radio\" id=\"radio" + i + "\"  value=\"radio" + i + "\">" +
            " <button class=\"delete\" onClick=\"suprimer('champ" + i + "');\"></button> </div>";
        document.getElementById(divName).appendChild(newdiv);
        increment()
    } else if (valeur === "texte") {
        if (i <= 1) {
            newdiv.innerHTML = "<div id=\"champ" + i + "\" class=\"nbQuestionNew\">" +
                "<label class=\"label\" for=\"reponse \">Réponse</label>" +
                "<textarea  class=\"area\" name=\"texteReponse\"></textarea>" +
                " <button class=\"delete\" onClick=\"suprimer('champ" + i + "');\"></button> </div>";
            document.getElementById(divName).appendChild(newdiv);
            increment()
        }
    } else {
        alert('le type de réponse est obligatoire  ');
    }
}

function suprimer(elementId) {
    var element = document.getElementById(elementId);
    element.parentNode.removeChild(element);
}

function previewFile() {
    const preview = document.querySelector('.addminImg');
    const file = document.querySelector('input[type=file]').files[0];
    const reader = new FileReader();
    reader.addEventListener("load", function () {
        // convert image file to base64 string
        preview.src = reader.result;
    }, false);
    if (file) {
        reader.readAsDataURL(file);
    }
}

function isEmpty() {
    // var errorPrenom = document.getElementById('errorPrenom');
    //var errorNom = document.getElementById('errorNom');
    //var errorLogin = document.getElementById('errorLogin');
    //var errorPassword = document.getElementById('errorPassword');
    //var errorCpassword = document.getElementById('errorCpassword');
    //var errorFile = document.getElementById('errorFile');
    var prenom = document.forms['myForm'].prenom.value;
    var nom = document.forms['myForm'].nom.value;
    var login = document.forms['myForm'].login.value;
    var password = document.forms['myForm'].password.value;
    var cpassword = document.forms['myForm'].cpassword.value;
    var file = document.forms['myForm'].file.value;
    if (!prenom.replace(/\s+/, '').length) {
        alert('Le champ Prenom ne peut être vide');
        return false;
    }
    if (!nom.replace(/\s+/, '').length) {

        alert('Le champ nom ne peut être vide');
        return false;
    }
    if (!login.replace(/\s+/, '').length) {
        alert('Le champ login ne peut être vide');
        return false;
    }
    if (!password.replace(/\s+/, '').length) {
        alert('Le champ password ne peut être vide');
        return false;
    }
    if (!cpassword.replace(/\s+/, '').length) {
        alert('Le champ confirmation ne peut être vide');
        return false;
    }
    if (cpassword !== password) {
        alert(' les deux mot de passe ne conrrespondent  pas');
        return false;
    }
    var fileName = document.forms['myForm'].file.value;
    regex = new RegExp("(.*?)\.(gpeg|png)$");
    if (fileName === "") {
        alert(' Le champ avatar ne peut être vide');
        return false;
    }
    /*if(regex!=="png"){
        alert("seul les formats  png  ou jpeg sont autorisé");
        return false;

    }*/


}
