var lesLiens= document.getElementsByClassName("like");
for(var i=0 ; i < lesLiens.length;i++){
    lesLiens[i].addEventListener("click", majLike)
}

function majLike(event) {
    event.preventDefault();
    let xhr=new XMLHttpRequest();
    let baliseA = event.target.parentNode;
    let url=baliseA.getAttribute("href");
    xhr.open("GET", url);
    xhr.responseType="json";
    xhr.send();

    xhr.onload=function() {
        if (xhr.status!=200) {
            alert("Erreur"+xhr.status+":"+xhr.statusText);
        }else {
            if(event.target==baliseA.firstElementChild){
                event.target.nextElementSibling.textContent=xhr.response.nbLike 
            } else {
                if (event.target==baliseA.lastElementChild) {
                    event.target.previousElementSibling.textContent=xhr.response.nbLike 
                } else {
                    event.target.textContent=xhr.response.nbLike 
                }
            }
        }
    };
    xhr.onerror=function(){
        alert("La requête a échoué");
    }
}