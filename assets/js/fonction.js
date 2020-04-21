function connnexion() {
    var login = document.forms["connection"]["login"].value;
    var password = document.forms["connection"]["password"].value;
    if (login === "") {
        alert("le login ne doit pas etre vide");
        return false;
    } else if (password === "") {
        alert("le mot de passe ne doit pas etre vide ");
        return false;
    }
}

document.getElementById("password").addEventListener("input", function (e) {
    var mdp = e.target.value; // Valeur saisie dans le champ password
    var aideMdpElt = document.getElementById("passwordMessage");
    var longueurMdp = "";
    var couleurMsg = ""; // Longueur faible => couleur rouge
    if (mdp.length > 0 && mdp.length < 4) {
        longueurMdp = "Faible";
        couleurMsg = "red"; // Longueur faible => couleur rouge
        aideMdpElt.textContent = "Longueur : " + longueurMdp; // Texte de l'aide
        aideMdpElt.style.color = couleurMsg; // Couleur du texte de l'aide
    } else if (mdp.length >= 4 && mdp.length < 8) {
        longueurMdp = "moyenne";
        couleurMsg = "orange"; // Longueur moyenne => couleur orange
        aideMdpElt.textContent = "Longueur : " + longueurMdp; // Texte de l'aide
        aideMdpElt.style.color = couleurMsg; // Couleur du texte de l'aide
    } else if (mdp.length >= 8) {
        longueurMdp = "suffisante";
        couleurMsg = "green"; // Longueur suffisante => couleur verte
        aideMdpElt.textContent = "Longueur : " + longueurMdp; // Texte de l'aide
        aideMdpElt.style.color = couleurMsg; // Couleur du texte de l'aide
    } else {
        aideMdpElt.textContent = "";
    }
});
