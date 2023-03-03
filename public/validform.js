image = document.getElementById("serie_image");
image.addEventListener("change", function (e){
    if(e.target.value.search('\.(png|jpg)$') != -1){
        console.log('valide');
    } else {
        console.log('pas valide');
    }
});