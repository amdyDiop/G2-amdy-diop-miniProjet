function connnexion() {
    var login = document.forms["connection"]["login"].value;
    var password = document.forms["connection"]["password"].value;

    if (login === "") {
        alert("le login ne doit pas etre vide");
        return false;
    }
    else if (password === "") {
        alert("le mot de passe ne doit pas etre vide ");
        return false;
    }
}
