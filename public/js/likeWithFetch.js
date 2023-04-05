// /* lesLiens contient la liste des éléments <a> correspondant au lien avec le pouce, le nombre de like et le j'aime pour l'ensemble des séries*/
// let lesLiens=document.getElementsByClassName('js-a-likes');

// /* on parcourt les éléments que l'on vient de récupérer et pour chacun d'entre eux on écoute l'événement click et on appelle la fonction majLike lorsque l'événement se produit */
// for (var i = 0; i < lesLiens.length; i++) {
//     lesLiens[i].addEventListener('click',majLike)
//   }

// function majLike(event) {
//     event.preventDefault()
//     // On récupère l'URL du lien
//     let baliseA = event.target.parentNode
//     let url = baliseA.getAttribute('href');
//     //const test=fetch(url);
//     //console.log(test); 
//     // dans la console on voit que test est un Promise et <state>: "fulfilled" ce qui indique qu'elle est remplie
//     fetch(url)
//         .then(function (response) {
//             console.log(response);
//             return response.json(); 
//             // renvoie une promesse donc on peut enchaîner avec un then si cette promesse est résolue
//             // le then suivant va utiliser le résultat de cette 1ère promesse cad ici le json.
//         })
//         .then(function (data) {
//             if (event.target == baliseA.firstElementChild)
//                 event.target.nextElementSibling.textContent = data.likes;
//             else
//                 if (event.target == baliseA.lastElementChild)
//                     event.target.previousElementSibling.textContent = data.likes;
//                 else
//                     event.target.textContent = data.likes;
//         })
//         //si une des promesses n'est pas résolue on entre dans le catch
//         .catch(()=>alert("erreur"))
//     }

//     function majLikeV2(event) {
//         console.log(event)
//         event.preventDefault()
//         // On récupère l'URL du lien
//         let baliseA = event.target.parentNode
//         let url = baliseA.getAttribute('href');
//         getLike(url, event, baliseA)
//     }
    
//     async function getLike(url,event, baliseA){
//        try {
//         let response = await fetch(url) //attente que la promesse se résolve et renvoie du résultat
//         let data= await response.json() //attente que la promesse se résolve et renvoie du résultat
//         if (event.target == baliseA.firstElementChild)
//             event.target.nextElementSibling.textContent = data.likes;
//         else
//             if (event.target == baliseA.lastElementChild)
//                 event.target.previousElementSibling.textContent = data.likes;
//             else
//                 event.target.textContent = data.likes;
//         } catch(e){
//             //si une des promesses n'est pas résolue on entre dans le catch
//             alert('retour serveur : ')}
        
//     }

