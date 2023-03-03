image = document.getElementById("serie_image");
erreur = document.getElementById("erreur");
button = document.getElementById("add");
image.addEventListener("change", function (e){
    if(e.target.value.search('\.(png|jpg)$') != -1){0
        erreur.innerHTML='';
        button.disabled = false
    } else {
        erreur.innerHTML='Votre saisie est invalide';
        button.disabled = true
    }
});