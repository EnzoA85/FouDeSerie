var lesLiens= document.getElementsByClassName("like");
for(var i=0 ; i < lesLiens.length;i++){
    console.log("hbbdcbbhd")
    lesLiens[i].addEventListener("click", majLike)
}

function majLike(event) {
    event.preventDefault();
    let xhr=new XMLHttpRequest();
    let url=this.getAttribute("href");
    xhr.open("GET", url);
    xhr.responseType="json";
    xhr.send();

    xhr.onload=function() {
        if (xhr.status!=200) {
            alert("Erreur"+xhr.status+":"+xhr.statusText);
        }else{
            if (event.target==this.firstElementChild) {
                event.target.nextElementSibling.textContent=xhr.response.likes
            } else {
                event.target.textContent=xhr.response.likes
            }
        }
    };
    xhr.onerror=function(){
        alert("La requête a échoué");
    }
}