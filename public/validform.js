image = document.getElementById("serie_image");
erreur = document.getElementById("erreur");
button = document.getElementById("add");
image.addEventListener("change", function (e){
    if(e.target.value.search('\.(png|jpg)$') != -1){
        erreur.innerHTML='';
        button.style.display = "";
    } else {
        erreur.innerHTML='Votre saisie est invalide';
        button.style.display = "none";
    }
});