const searchBar = document.getElementById('barreSearch');                 // barre de recherche avec loupe

searchBar.addEventListener('keyup', (e) => {
    const searchedLetters = e.target.value;
    const cards = document.querySelectorAll('.card');
    filterElements(searchedLetters, cards);   // rech par ordre alph
})

    function filterElements(letters, elements){    // elements = cards
        for(let i=0; i<elements.length; i++){
        if(elements[i].textContent.toLowerCase().includes(letters)) {   // rendre en minuscule mm si ecrit en majuscule
            elements[i].style.display = "block";                        // [i] = rang de la card 
        } else {
            elements[i].style.display = "none";              // fait disparaitre tout ce qui ne convient pas à notre sélection
        } 
    }
    }

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

    function formulaire(e){
        let rest=e.target.id;
        //console.log(rest);
        /*const json_data = JSON.stringify({
            rest})
            console.log(json_data);
            let dataArray = {"rest": rest};
            fetch_post('envoiModif.php', dataArray).then(function(response) {
                let restNom = JSON.parse(response);
            })*/
            createCookie("nomResto", rest, 10);
    }
    function createCookie(name,value, days){
        var expires;
      
        if (days) {
            var date = new Date();
            date.setTime(date.getTime() + (days * 24 * 60 * 60 * 1000));
            expires = "; expires=" + date.toGMTString();
        }
        else {
            expires = "";
        }
          
        document.cookie = escape(name) + "=" + 
            escape(value) + expires + "; path=/";
    }
    function openModal1(e){    
        createCookie("fileImage", "image", -1);
        createCookie("fileImage1", "image1", -1);
        createCookie("fileImage2", "image2", -1);
        createCookie("fileImage3", "image3", -1);
         let nom=e.target.id;
        //console.log(nom);
        const json_data = JSON.stringify({
        nom
        })
        //console.log(json_data);
     
        let dataArray = {"nom": nom};
         fetch_post('modification.php', dataArray).then(function(response) {
             let restaurant = JSON.parse(response);
             document.getElementById('overlay1').style.opacity = "1";
             document.getElementById('popup1').style.opacity = "1";
             document.getElementById('overlay1').style.zIndex = "102";
             document.getElementById('popup1').style.zIndex = "110";
             document.getElementById('overlay1').style.transition = "500ms";
             document.getElementById('popup1').style.transition = "500ms";
            
             document.getElementById('popup1').innerHTML ='';    
             document.getElementById('popup1').innerHTML += `<form action="envoiModif.php" method="POST">
                                                            <span onclick="closeModal1()" id="btnClose" class="btnClose">&times;</span>
                                                            <h2 class="text-center" style="color:whitesmoke;margin-top:20px">Modifier un restaurant</h2>       
                                                            <div class="form-group">
                                                                <input type="text" name="Nom" class="form-control" placeholder="Nom"  autocomplete="off" value="`+ restaurant[0]['Nom'] +`">
                                                            </div>
                                                            <div class="form-group">
                                                                <input type="text" name="Adresse" class="form-control" placeholder="Adresse: 1 Jean Moulin, 58300 Nevers" autocomplete="off" value="`+ restaurant[0]['Adresse'] +`">
                                                            </div>
                                                            <div class="form-group">
                                                                <input type="text" name="Telephone" class="form-control" placeholder="Tel: ** ** ** ** **"  autocomplete="off" value="`+ restaurant[0]['Telephone'] +`">
                                                            </div>
                                                            <div class="form-group">
                                                                <input type="number" name="Etoiles" class="form-control" min="0" max="5" placeholder="Nombre d'Étoiles/5"  autocomplete="off" value="`+ restaurant[0]['Etoiles'] +`">
                                                            </div>
                                                            <div class="form-group">
                                                                <input id="ImagesLiens" type="text" name="Images" class="form-control" placeholder="nomImage.jpg"  autocomplete="off" value="`+ restaurant[0]['Images'] +`">
                                                                <input style="display:none" id="ImagesChargement" type="file" name="Imagesbis" class="form-control" placeholder="nomImage.jpg"  autocomplete="off" value="`+ restaurant[0]['Images'] +`">
                                                                <div onclick="chargementImage()" id="FileIm" class="file">File</div>
                                                                <div style="display:none" onclick="chargementLiens()" class="file" id="FileLi">Liens</div>
                                                            </div>
                                                            <div class="form-group">
                                                                <input type="number" name="id_Categorie" class="form-control" placeholder="id_Categorie : 1,2,3 ou 4"  autocomplete="off" value="`+ restaurant[0]['id_Categorie'] +`">
                                                            </div>
                                                            <h2 class="text-center" style="color:whitesmoke;margin-top:20px">Modifier un popup</h2>  
                                                            <div class="form-group">
                                                            <input id="ImagesLiens1" type="text" name="Image1" class="form-control" placeholder="nomImage.jpg"  autocomplete="off" value="`+ restaurant[0]['Image1'] +`">
                                                            <input style="display:none" id="ImagesChargement1" type="file" name="Image1bis" class="form-control" placeholder="nomImage1.jpg"  autocomplete="off" value="`+ restaurant[0]['Image1'] +`">
                                                            <div onclick="chargementImage1()" id="FileIm1" class="file">File</div>
                                                            <div style="display:none" onclick="chargementLiens1()" class="file" id="FileLi1">Liens</div>
                                                            </div>
                                                            <div class="form-group">
                                                            <input id="ImagesLiens2" type="text" name="Image2" class="form-control" placeholder="nomImage.jpg"  autocomplete="off" value="`+ restaurant[0]['Image2'] +`">
                                                            <input style="display:none" id="ImagesChargement2" type="file" name="Image2bis" class="form-control" placeholder="nomImage2.jpg"  autocomplete="off" value="`+ restaurant[0]['Image2'] +`">
                                                            <div onclick="chargementImage2()" id="FileIm2" class="file">File</div>
                                                            <div style="display:none" onclick="chargementLiens2()" class="file" id="FileLi2">Liens</div>
                                                            </div>
                                                            <div class="form-group">
                                                            <input id="ImagesLiens3" type="text" name="Image3" class="form-control" placeholder="nomImage.jpg"  autocomplete="off" value="`+ restaurant[0]['Image3'] +`">
                                                            <input style="display:none" id="ImagesChargement3" type="file" name="Image3bis" class="form-control" placeholder="nomImage3.jpg"  autocomplete="off" value="`+ restaurant[0]['Image3'] +`">
                                                            <div onclick="chargementImage3()" id="FileIm3" class="file">File</div>
                                                            <div style="display:none" onclick="chargementLiens3()" class="file" id="FileLi3">Liens</div>
                                                            </div>     
                                                            <div class="form-group">
                                                                <input type="number" name="noteService" class="form-control" min="0" max="5" placeholder="NoteService/5"  autocomplete="off" value="`+ restaurant[0]['NoteService'] +`">
                                                            </div>
                                                            <div class="form-group">
                                                                <input type="number" name="noteCuisson" class="form-control" min="0" max="5" placeholder="NoteCuisson/5"  autocomplete="off" value="`+ restaurant[0]['NoteCuisson'] +`">
                                                            </div>
                                                            <div class="form-group">
                                                                <input type="number" name="noteCarte" class="form-control" min="0" max="5" placeholder="NoteCarte/5"  autocomplete="off" value="`+ restaurant[0]['NoteCarte'] +`">
                                                            </div>
                                                            <div class="form-group">
                                                                <input type="number" name="notePrix" class="form-control" min="0" max="5" placeholder="NotePrix/5"  autocomplete="off" value="`+ restaurant[0]['NotePrix'] +`">
                                                            </div>
                                                            <div class="form-group">
                                                                <textarea style="resize:vertical" cols="33" rows="15" name="Critique" class="form-control" maxlength="1000" placeholder="Critique"  autocomplete="off"> `+ restaurant[0]['Critique'] +`</textarea>
                                                            </div>  
                                                            <div class="form-group" onclick="formulaire(event)">
                                                            <button id="`+ restaurant[0]['Nom'] +`" type="submit" name="envoi" class="btn btn-primary btn-block">Validez</button>
                                                        </div> 
                                                            </form>   `
                                                         })}
                                                         ;
     
function openModal(e){    
   /*let idd=e.target.id;
    console.log(idd);
    const json_data = JSON.stringify({
    idd
    })
    console.log(json_data);
    let dataArray = {"idd": idd};
    fetch_post('produits.php', dataArray).then(function(response) {
        let restaurant = JSON.parse(response);*/
        document.getElementById('overlay').style.opacity = "1";
        document.getElementById('popup').style.opacity = "1";
        document.getElementById('overlay').style.zIndex = "102";
        document.getElementById('popup').style.zIndex = "110";
        document.getElementById('overlay').style.transition = "500ms";
        document.getElementById('popup').style.transition = "500ms"; 
    
        /*document.getElementById('popup').innerHTML ='';    
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
                                                    //});*/}

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
    function closeModal1(){
        document.getElementById('overlay1').style.opacity = "0";
        document.getElementById('popup1').style.opacity = "0";
        document.getElementById('overlay1').style.zIndex = "-1";
        document.getElementById('popup1').style.zIndex = "-2";
        document.getElementById('overlay1').style.transition = "500ms";
        document.getElementById('popup1').style.transition = "500ms";
    }
    
    function closeAvecOverlay1(){
        document.getElementById('overlay1').style.opacity = "0";
        document.getElementById('popup1').style.opacity = "0";
        document.getElementById('overlay1').style.zIndex = "-1";
        document.getElementById('popup1').style.zIndex = "-2";
        document.getElementById('overlay1').style.transition = "500ms";
        document.getElementById('popup1').style.transition = "500ms";
    }




    function chargementImage(){
        createCookie("fileImage", "image", 10);
        document.getElementById('ImagesLiens').style.display = "none";
        document.getElementById('ImagesChargement').style.display = "block";
        document.getElementById('FileIm').style.display = "none";
        document.getElementById('FileLi').style.display = "block";
    }
    function chargementImage1(){
        createCookie("fileImage1", "image1", 10);
        document.getElementById('ImagesLiens1').style.display = "none";
        document.getElementById('ImagesChargement1').style.display = "block";
        document.getElementById('FileIm1').style.display = "none";
        document.getElementById('FileLi1').style.display = "block";
    }
    function chargementImage2(){
        createCookie("fileImage2", "image2", 10);
        document.getElementById('ImagesLiens2').style.display = "none";
        document.getElementById('ImagesChargement2').style.display = "block";
        document.getElementById('FileIm2').style.display = "none";
        document.getElementById('FileLi2').style.display = "block";
    }
    function chargementImage3(){
        createCookie("fileImage3", "image3", 10);
        document.getElementById('ImagesLiens3').style.display = "none";
        document.getElementById('ImagesChargement3').style.display = "block";
        document.getElementById('FileIm3').style.display = "none";
        document.getElementById('FileLi3').style.display = "block";
    }

    
    function chargementLiens(){
        createCookie("fileImage", "image", -1);
        document.getElementById('ImagesLiens').style.display = "block";
        document.getElementById('ImagesChargement').style.display = "none";
        document.getElementById('FileLi').style.display = "none";
        document.getElementById('FileIm').style.display = "block";
    }
    function chargementLiens1(){
        createCookie("fileImage1", "image1", -1);
        document.getElementById('ImagesLiens1').style.display = "block";
        document.getElementById('ImagesChargement1').style.display = "none";
        document.getElementById('FileLi1').style.display = "none";
        document.getElementById('FileIm1').style.display = "block";
    }
    function chargementLiens2(){
        createCookie("fileImage2", "image2", -1);
        document.getElementById('ImagesLiens2').style.display = "block";
        document.getElementById('ImagesChargement2').style.display = "none";
        document.getElementById('FileLi2').style.display = "none";
        document.getElementById('FileIm2').style.display = "block";
    }
    function chargementLiens3(){
        createCookie("fileImage3", "image3", -1);
        document.getElementById('ImagesLiens3').style.display = "block";
        document.getElementById('ImagesChargement3').style.display = "none";
        document.getElementById('FileLi3').style.display = "none";
        document.getElementById('FileIm3').style.display = "block";
    }

    
window.onscroll = function() {scrollFunction()};

function scrollFunction() {
  if (document.body.scrollTop > 500 || document.documentElement.scrollTop > 500) {
    document.getElementById("scroll_to_top").style.opacity = "1";
    document.getElementById("scroll_to_top").style.zIndex = "50";
    document.getElementById("scroll_to_top").style.transform = "500ms";
  } else {
    document.getElementById("scroll_to_top").style.opacity = "0";
    document.getElementById("scroll_to_top").style.zIndex = "-50";
    document.getElementById("scroll_to_top").style.transform = "500ms";
  }
}