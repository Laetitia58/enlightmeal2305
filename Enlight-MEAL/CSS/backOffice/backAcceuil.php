<?php
    session_start();
    $servname = "localhost";
    $user = "root";
    $pass = "";
    $dbname = "enlight_meal";
    $condition= '';
    $page = '';
    try{
        if(isset($_GET['id_Categorie'])){
            if($_GET['id_Categorie'] == 1){
                $condition=' WHERE id_Categorie = 1';
            } else if($_GET['id_Categorie'] == 2){
                $condition=' WHERE id_Categorie = 2';
            } else if($_GET['id_Categorie'] == 3){
                $condition=' WHERE id_Categorie = 3';
            } else if($_GET['id_Categorie'] == 4){
                $condition=' WHERE id_Categorie = 4';
            }
        }
        
        if(isset($_SESSION['pseudo'])){
            $page = '"backOffice/backAcceuil.php"';
        }else{
            $page = '"connexion.php"';
        }
    }
    catch(PDOException $e){
    
    }
    try {
    $conn = new PDO("mysql:host=$servname;dbname=$dbname;charset=utf8",$user, $pass);

    if(isset($_SESSION['pseudo'])){  
    }else{
        header ('location: ../index.php');
    }

    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    $sth = $conn->prepare ("SELECT *
                            FROM `restaurant`
                            $condition");
    $sth->execute();

    $restaurants = $sth->fetchAll(PDO::FETCH_ASSOC);
}
catch (PDOException $e){
    echo "Erreur : " . $e->getMessage();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.3.1/dist/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.14.7/dist/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.3.1/dist/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="formBack.css"/>
    <title>EnlightMeal/BackOffice</title>
</head>
<body style="background-color:black;">
<?php

try {  
    $conn = new PDO("mysql:host=$servname;dbname=$dbname;charset=utf8",$user, $pass);


    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);  // pour connexion a BDD  (rajouter variable $condition1 au tout debut code ligne 8)

    $sth = $conn->prepare ('SELECT *
                            FROM `utilisateurs`
                            WHERE pseudo = "'.$_SESSION['pseudo'].'"');   //ici concatener 2 fois pour contenir pseudo , fermer la derniere apostrophe liée à SELECT.

    $sth->execute();

    $administrateur = $sth->fetchAll(PDO::FETCH_ASSOC);
}  
catch (PDOException $e){
echo "Erreur : " . $e->getMessage();
}

?>     

<?php foreach($administrateur as $administrateurs){ ?>

<div class="container-fluid">
    <nav class="navbar navbar-expand-md navbar-black bg-black"> <!--à quelle taille la navbar doit se déployer avant de passer en design responsive-->   
        <a class="navbar-brand text-white" href="../index.php"><h1 style="font-size:25px"><?php echo $administrateurs['prenomAdmin'] ?></h1>  <!--navbar-brand = intitulé de la navbar-->
            <span style="color: black;
                  text-shadow: 1px 1px 0 #ffffff, 1px -1px 0 #ffffff, -1px 1px 0 #ffffff, -1px -1px 0 #ffffff, 1px -1px 0 #ffffff, -1px 1px 0 #ffffff, 
                  -1px -1px 0 #ffffff, -1px -1px 0 #ffffff;"><h1 class="h1" style="font-size:25px"><?php echo $administrateurs['nomAdmin'] ?> 
            </span>
            <img class="align-baseline" src="../img/projecteur.png" height="60px" style="margin-top:-35px;">  <!---aligner l'image à admin -->
        </h1>
        </a>
    <?php 
    } 
    ?>
<!-------------------------- intégrer 2 administrateurs en php---------------------//FIN------------------->


     <!--------------------ici menu burger qui apparait en responsive---------------->   
        <!---collapse: créer un élément qui va pouvoir être caché / affiché lors d’un clic sur un autre élément--->
             <!------navbar-toggler = afficher icone burger, possible remplacer par autre chose--->
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" 
                aria-expanded="false" aria-label="Toggle navigation" style="background:url(../img/burger.svg); background-repeat: no-repeat;
                background-size: contain;background-position-y: center;background-position-x: center; width:30px;height:30px">
        </button>

        <div class="collapse navbar-collapse" id="navbarSupportedContent">
          <ul class="flex-fill navbar-nav mr-auto">
<!------ "nav-item" englobe le dropdown  et l'élément suivant aura class dropdown-toggle ET nav-link Et attribut data-bs-toggle="dropdown"-->       
            <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle text-white" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" role="button" style="cursor:pointer;">
                       Catégories
                    </a>
<!-------------- au mm niveau que nav-link ---:  une balise "ul" avec la classe "dropdown-menu", contenant des "dropdown-item"--->                   
                    <div class="dropdown-menu">
                         <a href="backAcceuil.php"><button class="dropdown-item" type="button">Aucune</button></a>
                         <!-- ici:   "?"    signifie get et choisir une seule cat: ici (ci-dessous) cat1 -->
                         <a href="backAcceuil.php?id_Categorie=1"><button class="dropdown-item" type="button">Dark Kitchen</button></a>  
                         <a href="backAcceuil.php?id_Categorie=2"><button class="dropdown-item" type="button">Restaurant à Thème</button></a>
                         <a href="backAcceuil.php?id_Categorie=3"><button class="dropdown-item" type="button">Pizzeria</button></a>
                         <a href="backAcceuil.php?id_Categorie=4"><button class="dropdown-item" type="button">A volonté</button></a>
                    </div>
            </li>
            <li class="flex-fill nav-item">
                <a class="nav-link text-white" onclick="openModal()" style="cursor:pointer;">
                    Ajouter un restaurant
                </a>
            </li>
                <form action="logout.php" method="post">
                    <input type="submit" name="logout" value="Déconnexion" />
                </form>           
          </ul>
        </div>

    </nav>
        </div>
        <?php
             $servname = "localhost";
             $user = "root";
             $pass = "";
             $dbname = "enlight_meal";
            
            try{
                if(isset($_SESSION['ajout'])){
                    $ajout = "*Nouveau restaurant bien créé";
                    echo "<div id='ajout' style='color: #2a7a1f;
                    text-align: center;
                    margin-bottom: 2px;
                    font-family: 'Inter-Bold';'>" .$ajout ."</div>";
                    unset($_SESSION['ajout']);
                }
                
                if(isset($_SESSION['suppression'])){
                    $suppression = "*Restaurant bien supprimé";
                    echo "<div id='suppression' style='color: rgb(255, 88, 88);
                    text-align: center;
                    margin-bottom: 2px;
                    font-family: 'Inter-Bold';'>" .$suppression ."</div>";
                    unset($_SESSION['suppression']);
                }

                if(isset($_SESSION['modif'])){
                    $modif = "*Modification bien prise en compte";
                    echo "<div id='modif' style='color: rgb(255, 173, 80);
                    text-align: center;
                    margin-bottom: 2px;
                    font-family: 'Inter-Bold';'>" .$modif ."</div>";
                    unset($_SESSION['modif']);
                }
            } 
            catch (PDOException $e){
                echo "Erreur : " . $e->getMessage();
            }
            ?>
<form id="recherche">
            <input class="barre" type="text" name="text" id="barreSearch">
        </form>
<section class="d-flex flex-wrap justify-content-center" id="section_1">
    <?php
        foreach($restaurants as $restaurant){
    ?>
<div class="card-group mb-5 mt-5 flex-fill p-2" style="width: 20rem; max-width: 20rem;">
<div class="card" style="background-color:black; border-color:whitesmoke;">
<div class="card-header" style="background-color:black">
    <a class="modif" style="float:left;" onclick="openModal1(event)">
        <button id="<?php echo $restaurant['Nom']?>" style="color:whitesmoke; background-color:transparent; border-color:whitesmoke">Modifier</button>
    </a>
    <a onclick="return confirm('Voulez-vous vraiment supprimer ce restaurant ?');" class="croix" style="float:right" href="supprimer.php?Nom=<?php echo $restaurant['Nom']; ?>">
        <button style="color:whitesmoke; background-color:transparent; border-color:whitesmoke">&times;</button>
    </a>
</div>
<div class="card-body" style="background-color:black; color:whitesmoke; text-align:center;">
        <div class="ensembleResto" id="ensembleResto">
            <div class="resto" id="<?php echo $restaurant['Nom']?>">
                <div id="<?php echo $restaurant['Nom'] ?>" class="foto" style="background: url(../img/<?php echo $restaurant['Images'] ?>);
                                            background-size: cover;
                                            background-repeat: no-repeat;
                                            background-position-x: center;
                                            background-position-y: center;
                                            height: 100px"></div>
                <h2 id="<?php echo $restaurant['Nom'] ?>"><?php echo $restaurant['Nom'] ?></h2>
                <hr>
                <img id="<?php echo $restaurant['Nom'] ?>" class="lieu" src="../img/pointAdresse.png" height="25px"><br>
               <p id="<?php echo $restaurant['Nom'] ?>"><?php echo $restaurant['Adresse'] ?></p><br>
               <img id="<?php echo $restaurant['Nom'] ?>" class="phone" src="../img/iconTel.png" height="25px"><br>
               <p id="<?php echo $restaurant['Nom'] ?>" class="phonep"><?php echo $restaurant['Telephone'] ?></p> 
            </div>
            <div class="etoiles">
                <?php
                    if($restaurant['Etoiles'] == 5){?>
                        <img class="stars" src="../img/starr.png" height="30px">
                        <img class="stars"  src="../img/starr.png" height="30px">
                        <img  class="stars" src="../img/starr.png" height="30px">
                        <img class="stars"  src="../img/starr.png" height="30px">
                        <img  class="stars" src="../img/starr.png" height="30px"><?php }?>
                <?php
                    if($restaurant['Etoiles'] == 4){?>
                        <img class="stars"  src="../img/starr.png" height="30px">
                        <img  class="stars" src="../img/starr.png" height="30px">
                        <img class="stars"  src="../img/starr.png" height="30px">
                        <img  class="stars" src="../img/starr.png" height="30px"><?php }?>
                <?php
                    if($restaurant['Etoiles'] == 3){?>
                        <img  class="stars" src="../img/starr.png" height="30px">
                        <img class="stars"  src="../img/starr.png" height="30px">
                        <img  class="stars" src="../img/starr.png" height="30px"><?php }?>
                <?php
                    if($restaurant['Etoiles'] == 2){?>
                        <img class="stars"  src="../img/starr.png" height="30px">
                        <img  class="stars" src="../img/starr.png" height="30px"><?php }?>
                <?php
                    if($restaurant['Etoiles'] == 1){?>
                        <img  class="stars" src="../img/starr.png" height="30px"><?php }?>
                <?php
                    if($restaurant['Etoiles'] == 0){}?>
            </div>
</div>
</div>
</div>
</div>
        <?php }
        ?>
    </section>
    <section class="d-flex flex-wrap justify-content-center" id="section_2">
        <?php
            foreach($restaurants as $restaurant){
        ?>
        <div class="card-group mb-5 mt-5 flex-fill p-2" style="width: 30rem; max-width: 30rem;">
        <div class="card" style="background-color:black; border-color:whitesmoke;">
        <div class="card-body" style="background-color:black; color:whitesmoke; text-align:center;">
        <div class="imageRestau1" id="imageRestau1" style="background: url(../img/<?php echo $restaurant['Image1'] ?>); background-size: cover;
        background-repeat: no-repeat; background-position-y: center; background-position-x: center;height: 100px;">
        </div>
        <div class="imageRestau2" id="imageRestau2" style="background: url(../img/<?php echo $restaurant['Image2'] ?>); background-size: cover;
        background-repeat: no-repeat; background-position-y: center; background-position-x: center;height: 100px;">
        </div>
        <div class="imageRestau3" id="imageRestau3" style="background: url(../img/<?php echo $restaurant['Image3'] ?>); background-size: cover;
        background-repeat: no-repeat; background-position-y: center; background-position-x: center;height: 100px;">
        </div>
        <div class="imageRestau4">
        </div>
        <h2><?php echo $restaurant['Nom'] ?><img src="../img/projecteur.png" height="70px"></h2>
        <div class="etoiles">
        <?php
        if($restaurant['Etoiles'] == 5){?>
            <img class="stars" src="../img/starr.png" height="30px">
            <img class="stars"  src="../img/starr.png" height="30px">
            <img  class="stars" src="../img/starr.png" height="30px">
            <img class="stars"  src="../img/starr.png" height="30px">
            <img  class="stars" src="../img/starr.png" height="30px"><?php }?>
        <?php
            if($restaurant['Etoiles'] == 4){?>
                <img class="stars"  src="../img/starr.png" height="30px">
                <img  class="stars" src="../img/starr.png" height="30px">
                <img class="stars"  src="../img/starr.png" height="30px">
                <img  class="stars" ksrc="../img/starr.png" height="30px"><?php }?>
        <?php
            if($restaurant['Etoiles'] == 3){?>
                <img  class="stars" src="../img/starr.png" height="30px">
                <img class="stars"  src="../img/starr.png" height="30px">
                <img  class="stars" src="../img/starr.png" height="30px"><?php }?>
        <?php
            if($restaurant['Etoiles'] == 2){?>
                 <img class="stars"  src="../img/starr.png" height="30px">
                  <img  class="stars" src="../img/starr.png" height="30px"><?php }?>
        <?php
            if($restaurant['Etoiles'] == 1){?>
                <img  class="stars" src="../img/starr.png" height="30px"><?php }?>
        <?php
            if($restaurant['Etoiles'] == 0){}?>
        </div>
        <div class="information">
            <h4><img src="../img/pointAdresse1.png" height="15px" style="margin-top:-5px"><?php echo $restaurant['Adresse'] ?></h4>
            <h4><img src="../img/iconTel.png" height="15px" style="margin-top:-5px"><?php echo $restaurant['Telephone'] ?></h4>
        </div>
        <h3>Critique :</h3>
        <p><?php echo $restaurant['Critique'] ?></p>
        <div class="note">
        <p>Qualité du service : <?php echo $restaurant['NoteService'] ?>/5</p>
        <p>Maîtrise des cuissons et des saveurs : <?php echo $restaurant['NoteCuisson'] ?>/5</p>
        <p>Richesse de la carte : <?php echo $restaurant['NoteCarte'] ?>/5</p>
        <p>Rapport qualité/prix : <?php echo $restaurant['NotePrix'] ?>/5</p>
        </div>
</div>
</div>
</div>
        <?php }
        ?>
    </section>
     <div id="overlay" class="overlay" onclick="closeAvecOverlay()">
    </div>
    <div id="overlay1" class="overlay1" onclick="closeAvecOverlay1()">
    </div>
<div id="popup">
                <form action="nouveauRestaurant.php" method="post">
                    <span onclick="closeModal()" id="btnClose" class="btnClose">&times;</span>
                    <h2 class="text-center" style="color:whitesmoke;margin-top:20px">Ajouter un restaurant</h2>       
                    <div class="form-group">
                        <input type="text" name="Nom" class="form-control" placeholder="Nom"  autocomplete="off" required>
                    </div>
                    <div class="form-group">
                        <input type="text" name="Adresse" class="form-control" placeholder="Adresse: 1 Jean Moulin, 58300 Nevers"  autocomplete="off" required>
                    </div>
                    <div class="form-group">
                        <input type="text" name="Telephone" class="form-control" placeholder="Tel: ** ** ** ** **"  autocomplete="off" required>
                    </div>
                    <div class="form-group">
                        <input type="number" name="Etoiles" class="form-control" min="0" max="5" placeholder="Nombre d'Étoiles/5"  autocomplete="off" required>
                    </div>
                    <div class="form-group">
                        <input type="file" name="Images" class="form-control" placeholder="nomImage.jpg"  autocomplete="off" required>
                    </div>
                    <div class="form-group">
                        <input type="number" name="id_Categorie" class="form-control" min="1" max="4" placeholder="id_Categorie : 1,2,3 ou 4"  autocomplete="off" required>
                    </div>
                    <h2 class="text-center" style="color:whitesmoke;margin-top:20px">Ajouter un popup</h2>  
                    <div class="form-group">
                        <input type="file" name="Image1" class="form-control" placeholder="nomImage1.jpg"  autocomplete="off" required>
                    </div>
                    <div class="form-group">
                        <input type="file" name="Image2" class="form-control" placeholder="nomImage2.jpg"  autocomplete="off" required>
                    </div>
                    <div class="form-group">
                        <input type="file" name="Image3" class="form-control" placeholder="nomImage3.jpg"  autocomplete="off" required>
                    </div>     
                    <div class="form-group">
                        <input type="number" name="noteService" class="form-control" min="0" max="5" placeholder="NoteService/5"  autocomplete="off" required>
                    </div>
                    <div class="form-group">
                        <input type="number" name="noteCuisson" class="form-control" min="0" max="5" placeholder="NoteCuisson/5"  autocomplete="off" required>
                    </div>
                    <div class="form-group">
                        <input type="number" name="noteCarte" class="form-control" min="0" max="5" placeholder="NoteCarte/5"  autocomplete="off" required>
                    </div>
                    <div class="form-group">
                        <input type="number" name="notePrix" class="form-control" min="0" max="5" placeholder="NotePrix/5"  autocomplete="off" required>
                    </div>
                    <div class="form-group">
                        <textarea cols="33" rows="15" name="Critique" class="form-control" maxlength="1000" placeholder="Critique"  autocomplete="off" required></textarea>
                    </div>
                    <div class="form-group">
                    <button type="submit" name="envoi" class="btn btn-primary btn-block">Validez</button>
                    </div>   
                </form>               
</div> 
<div id="popup1">
</div>  
<div id="scroll_to_top">
    <a href="#top"><img src="../img/scrollTop.png" alt="Retourner en haut" height="50px"/></a>
</div>
</body>
</html>
<script src="recherche.js"></script>