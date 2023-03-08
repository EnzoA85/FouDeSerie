/* lesLiens contient la liste des éléments <a>correspond au lien avec le pouce, le nombre de like et le j'aime */
var lesLiens= document.getElementsByClassName("like");
/* on parcourt les éléments que l'on vient de récupérer et pour chacun d'entre eux on écoute l'événement click et on appelle la fonction majLike lorsque l'événement se produit */
for(var i=0 ; i < lesLiens.length;i++){
    lesLiens.addEventListener("click", majLike)
}

function majLike(event) {
    /* On annule l'action par défaut correspondant à l'événement. Normalement quand on clique sur un lien , cela entraîne directement une nouvelle requête http. 
    Or dans notre cas, on ne veut pas que la requête s'exécute pour afficher une page contenant le json*/
    event.preventDefault()//On instancie un objet XMLHttpRequest 
    let xhr=new XMLHttpRequest();
    //On récupère la valeur de l'attribut href 
    let url=lesLiens[i].getAttribute("href");
    //On initialise notre requête avec open()
    xhr.open("GET", url);
    //On indique le format de la réponse
    xhr.responseType="json";
    //On envoie la requête
    xhr.send();

    //Dès que la réponse est reçue...
    xhr.onload=function() {
        //Si le statut HTTP n'est pas 200...
        if (xhr.status!=200) {
            //...On affiche le statut et le message correspondant 
            alert("Erreur"+xhr.status+":"+xhr.statusText);
            //Si le statut HTTP est 200 
        }else{
            event.target.textContent=xhr.response.likes
        }
    };
    //Si la requête n'a pas pu aboutir...
    xhr.onerror=function(){
        alert("La requête a échoué");
    }
}