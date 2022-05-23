function bulleDisparition(){
    if(window.innerWidth<=920 && document.getElementById("Checkbox").checked == true){
    document.getElementById('bulle').style.opacity = "0";
    document.getElementById('bulle').style.transition = "250ms";
}else {
    document.getElementById('bulle').style.opacity = "1";
    document.getElementById('menu').style.rotate = "90";
    document.getElementById('menu').style.transition = "250ms";
    document.getElementById('bulle').style.transition = "250ms";
}
}

function connexionDisparition(){
    if(window.innerWidth<=920 && document.getElementById("Checkbox").checked == true){
    document.getElementById('formulaire').style.opacity = "0";
    document.getElementById('formulaire').style.transition = "250ms";
}else {
    document.getElementById('formulaire').style.opacity = "1";
    document.getElementById('menu').style.rotate = "90";
    document.getElementById('menu').style.transition = "250ms";
    document.getElementById('formulaire').style.transition = "250ms";
}
}

const searchBar = document.getElementById('barreSearch');

searchBar.addEventListener('keyup', (e) => {
    const searchedLetters = e.target.value;
    const cards = document.querySelectorAll('.ensembleResto');
    filterElements(searchedLetters, cards);
})

    function filterElements(letters, elements){
        for(let i=0; i<elements.length; i++){
        if(elements[i].textContent.toLowerCase().includes(letters)) {
            elements[i].style.display = "block";
        } else {
            elements[i].style.display = "none";
        } 
    }
    }

//-------------------------------------//ICI AJAX--------------------
    
    function data(data) {
        let text = "";
        for (var key in data) {
          text += key + "=" + data[key] + "&";
        }
        return text.trim("&");
    }
    
    function fetch_post(url, dataArray) {
        let dataObject = data(dataArray);
        return fetch(url, {
                 method: "post",
                 headers: {
                       "Content-Type": "application/x-www-form-urlencoded",
                 },
                 body: dataObject,
            })
            .then((response) => response.text())
            .catch((error) => console.error("Error:", error));
    }

function openModal(e){    
    let idd=e.target.id;
    console.log(idd);
    const json_data = JSON.stringify({
    idd
    })
    console.log(json_data);

    let dataArray = {"idd": idd};
    fetch_post('produits.php', dataArray).then(function(response) {
        let restaurant = JSON.parse(response);
        document.getElementById('overlay').style.opacity = "1";
        document.getElementById('popup').style.opacity = "1";
        document.getElementById('overlay').style.zIndex = "102";
        document.getElementById('popup').style.zIndex = "110";
        document.getElementById('overlay').style.transition = "500ms";
        document.getElementById('popup').style.transition = "500ms"; 
    
        document.getElementById('popup').innerHTML ='';    
        document.getElementById('popup').innerHTML +=   `<span onclick="closeModal()" id="btnClose" class="btnClose" style="position: sticky;top: 10px;right:25px">&times;</span>
                                                        <button class="flecheDroite" onclick="flecheDroiteProduit()"><img src="img/flecheGauche.png" height="10px"></button>
                                                        <button class="flecheGauche" onclick="flecheGaucheProduit()"><img src="img/flecheGauche.png" height="10px"></button>
                                                        <div class="imageRestau1" id="imageRestau1" style="background: url(img/`+ restaurant[0]['Image1'] +`); background-size: cover;
                                                        background-repeat: no-repeat; background-position-y: center; background-position-x: center;">
                                                        </div>
                                                        <div class="imageRestau2" id="imageRestau2" style="background: url(img/`+ restaurant[0]['Image2'] +`); background-size: cover;
                                                        background-repeat: no-repeat; background-position-y: center; background-position-x: center;">
                                                        </div>
                                                        <div class="imageRestau3" id="imageRestau3" style="background: url(img/`+ restaurant[0]['Image3'] +`); background-size: cover;
                                                        background-repeat: no-repeat; background-position-y: center; background-position-x: center;">
                                                        </div>
                                                        <div class="imageRestau4">
                                                        </div>
                                                        <h2>`+ restaurant[0]['Nom'] +`<img src="img/projecteur.png" height="70px"></h2>
                                                        `
                                                        if(restaurant[0]["Etoiles"] == 5){
                                                        document.getElementById("popup").innerHTML += 
                                                            `<div class="etoiles">
                                                            <img class="stars" src="img/starr.png" height="30px">
                                                            <img class="stars"  src="img/starr.png" height="30px">
                                                            <img  class="stars" src="img/starr.png" height="30px">
                                                            <img class="stars"  src="img/starr.png" height="30px">
                                                            <img  class="stars" src="img/starr.png" height="30px">
                                                            </div>`
                                                        }
                                                        if(restaurant[0]["Etoiles"] == 4){
                                                        document.getElementById("popup").innerHTML += 
                                                            `<div class="etoiles">
                                                            <img class="stars" src="img/starr.png" height="30px">
                                                            <img class="stars"  src="img/starr.png" height="30px">
                                                            <img  class="stars" src="img/starr.png" height="30px">
                                                            <img class="stars"  src="img/starr.png" height="30px">
                                                            </div>`
                                                        }
                                                        if(restaurant[0]["Etoiles"] == 3){
                                                        document.getElementById("popup").innerHTML += 
                                                            `<div class="etoiles">
                                                            <img class="stars" src="img/starr.png" height="30px">
                                                            <img class="stars"  src="img/starr.png" height="30px">
                                                            <img  class="stars" src="img/starr.png" height="30px">
                                                            </div>`
                                                        }
                                                        if(restaurant[0]["Etoiles"] == 2){
                                                        document.getElementById("popup").innerHTML += 
                                                            `<div class="etoiles">
                                                            <img class="stars" src="img/starr.png" height="30px">
                                                            <img class="stars"  src="img/starr.png" height="30px">
                                                            </div>`
                                                        }
                                                        if(restaurant[0]["Etoiles"] == 1){
                                                        document.getElementById("popup").innerHTML += 
                                                            `<div class="etoiles">
                                                            <img class="stars" src="img/starr.png" height="30px">
                                                            </div>`
                                                        }
                                                            if(restaurant[0]["Etoiles"] == 0){

                                                        } 
                                                            document.getElementById("popup").innerHTML += `
                                                        <div class="information">
                                                        <h4><img src="img/pointAdresse1.png" height="15px"> `+ restaurant[0]['Adresse'] +`</h4>
                                                        <h4><img src="img/iconTel.png" height="15px"> `+ restaurant[0]['Telephone'] +`</h4>
                                                        </div>
                                                        <h3>Critique :</h3>
                                                        <p>`+ restaurant[0]['Critique'] +`</p>
                                                        <div class="note">
                                                            <p>Qualité du service : `+ restaurant[0]['NoteService'] +`/5</p>
                                                            <p>Maîtrise des cuissons et des saveurs : `+ restaurant[0]['NoteCuisson'] +`/5</p>
                                                            <p>Richesse de la carte : `+ restaurant[0]['NoteCarte'] +`/5</p>
                                                            <p>Rapport qualité/prix : `+ restaurant[0]['NotePrix'] +`/5</p>
                                                        </div>`
        console.log(restaurant);
    });
   

                                              // FIN AJAX   -------------------------------------------------------

}
                    // POP UP-----------------------------------------------
function closeModal(){
    document.getElementById('overlay').style.opacity = "0";
    document.getElementById('popup').style.opacity = "0";
    document.getElementById('overlay').style.zIndex = "-1";
    document.getElementById('popup').style.zIndex = "-2";
    document.getElementById('overlay').style.transition = "500ms";
    document.getElementById('popup').style.transition = "500ms";
}

function closeAvecOverlay(){
    document.getElementById('overlay').style.opacity = "0";
    document.getElementById('popup').style.opacity = "0";
    document.getElementById('overlay').style.zIndex = "-1";
    document.getElementById('popup').style.zIndex = "-2";
    document.getElementById('overlay').style.transition = "500ms";
    document.getElementById('popup').style.transition = "500ms";
}


                                 // carrousel ----------------------------------------------------
variante=1;

function flecheDroiteProduit(){
    if(variante == 1){
        document.getElementById('imageRestau1').style.transform = "translateX(-100%)";
        document.getElementById('imageRestau2').style.transform = "translateX(0%)";
        document.getElementById('imageRestau3').style.transform = "translateX(100%)";
        variante = 2;
    }else if (variante == 2){
        document.getElementById('imageRestau1').style.transform = "translateX(-200%)";
        document.getElementById('imageRestau2').style.transform = "translateX(-100%)";
        document.getElementById('imageRestau3').style.transform = "translateX(0%)";
        variante = 3;
    }else{
        document.getElementById('imageRestau1').style.transform = "translateX(0%)";
        document.getElementById('imageRestau2').style.transform = "translateX(100%)";
        document.getElementById('imageRestau3').style.transform = "translateX(200%)";
        variante = 1;
    }
}
function flecheGaucheProduit(){
    if(variante == 1){
        document.getElementById('imageRestau1').style.transform = "translateX(-200%)";
        document.getElementById('imageRestau2').style.transform = "translateX(-100%)";
        document.getElementById('imageRestau3').style.transform = "translateX(0%)";
        variante = 3;
    }else if (variante == 2){
        document.getElementById('imageRestau1').style.transform = "translateX(0%)";
        document.getElementById('imageRestau2').style.transform = "translateX(100%)";
        document.getElementById('imageRestau3').style.transform = "translateX(200%)";
        variante = 1;
    }else{
        document.getElementById('imageRestau1').style.transform = "translateX(-100%)";
        document.getElementById('imageRestau2').style.transform = "translateX(0%)";
        document.getElementById('imageRestau3').style.transform = "translateX(100%)";
        variante = 2;
    }
}