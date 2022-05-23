<!DOCTYPE html>
<html lang="fr">
<head>
    <link rel="icon" href="img/Projecteur.png">
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="CSS/produits.css"/>
    <link rel="stylesheet" href="CSS/form.css"/>
    <title>Enlight Meal</title>
</head>
<body>
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
    <header>
        <input type="checkbox" id="Checkbox" onclick="bulleDisparition()"> 
        <img id="menu" class="menu" src="img/burger.svg" alt="menu" height="30px"></label>
        <a href="index.php"><h1>ENLIGHT<span class="meal"> MEAL</span><img src="img/projecteur.png" height="70px"></h1></a>
        <nav>
            <a class="navCo" href=<?php echo $page ?>><p>Compte</p> <span><img class="compte" src="img/compte.png" height="30px"></span></a>
            <a href="index.php?id_Categorie=1#section_2">Dark Kitchen</a>
            <a href="index.php?id_Categorie=2#section_2">Restaurant à Thème</a>
            <a href="index.php?id_Categorie=3#section_2">Pizzeria</a>
            <a href="index.php?id_Categorie=4#section_2">À Volonté</a>
        </nav>
        <a href=<?php echo $page ?>><img class="connexion" src="img/connexion.png" height="40px"></a>
    </header>
    <section id="section_1">
        <div class="bulle" id="bulle">
            <h2>Découvrez l'avis de nos nombreux critiques culinaires</h2>
        </div>
    </section>
    <section id="section_2">
        <form id="recherche">
            <input class="barre" type="text" name="text" id="barreSearch">
        </form>
        <!--<div class="filtre">
            <p>Filtres <span><img src="img/flecheBas.png" height="10px"></span></p>
        </div>-->
    </section>
    <section id="section_3">
        <?php
            foreach($restaurants as $restaurant){
                ?>
        <div class="ensembleResto" id="ensembleResto">
            <div class="resto" id="<?php echo $restaurant['Nom']?>" onclick="openModal(event)">
                <div id="<?php echo $restaurant['Nom'] ?>" class="foto" style="background: url(img/<?php echo $restaurant['Images'] ?>);
                                            background-size: cover;
                                            background-repeat: no-repeat;
                                            background-position-x: center;
                                            background-position-y: center"></div>
                <h2 id="<?php echo $restaurant['Nom'] ?>"><?php echo $restaurant['Nom'] ?></h2>
                <hr>
                <img id="<?php echo $restaurant['Nom'] ?>" class="lieu" src="img/pointAdresse.png" height="25px"><br>
               <p id="<?php echo $restaurant['Nom'] ?>"><?php echo $restaurant['Adresse'] ?></p><br>
               <img id="<?php echo $restaurant['Nom'] ?>" class="phone" src="img/iconTel.png" height="25px"><br>
               <p id="<?php echo $restaurant['Nom'] ?>" class="phonep"><?php echo $restaurant['Telephone'] ?></p> 
            </div>
            <div class="etoiles">
                <?php
                    if($restaurant['Etoiles'] == 5){?>
                        <img class="stars" src="img/starr.png" height="30px">
                        <img class="stars"  src="img/starr.png" height="30px">
                        <img  class="stars" src="img/starr.png" height="30px">
                        <img class="stars"  src="img/starr.png" height="30px">
                        <img  class="stars" src="img/starr.png" height="30px"><?php }?>
                <?php
                    if($restaurant['Etoiles'] == 4){?>
                        <img class="stars"  src="img/starr.png" height="30px">
                        <img  class="stars" src="img/starr.png" height="30px">
                        <img class="stars"  src="img/starr.png" height="30px">
                        <img  class="stars" src="img/starr.png" height="30px"><?php }?>
                <?php
                    if($restaurant['Etoiles'] == 3){?>
                        <img  class="stars" src="img/starr.png" height="30px">
                        <img class="stars"  src="img/starr.png" height="30px">
                        <img  class="stars" src="img/starr.png" height="30px"><?php }?>
                <?php
                    if($restaurant['Etoiles'] == 2){?>
                        <img class="stars"  src="img/starr.png" height="30px">
                        <img  class="stars" src="img/starr.png" height="30px"><?php }?>
                <?php
                    if($restaurant['Etoiles'] == 1){?>
                        <img  class="stars" src="img/starr.png" height="30px"><?php }?>
                <?php
                    if($restaurant['Etoiles'] == 0){}?>
            </div>
        </div>
        <?php }
        ?>
    </section>
    <footer>
        <div class="ligne">
            <div id="logofooter">
                <a href="#"><h1>ENLIGHT <span class="meal">MEAL</span><img src="img/projecteur.png" height="70px"></h1></a>
                <a href="#">Mentions légales – CGV</a>
            </div>
            <div id="reseaux">
                <h3>Rejoignez-nous</h3>
                <div class="ligne1">
                    <button><img src="img/Instagram.jpg" alt="Instagram"></button>
                    <button><img src="img/twitter.png" alt="Twitter"></button>
                </div>
            </div>
            <div id="contact">
                <h3>Contact</h3>
                <div>
                    <p>Adresse : 20 rue de la République,<br>58000 Nevers</p>
                    <p>Téléphone : 03.67.48.59.20</p>
                    <p>E-Mail : contact@enlight-meal.com</p>
                </div>
            </div>
        </div>
        <hr>
        <p style="padding-bottom: 5px; padding-top: 5px; border-bottom: none;">Tous droits réservés @Enlight Meal</p>
    </footer>
    <!--Popup-->
    <div id="overlay" class="overlay" onclick="closeAvecOverlay()">
    </div>
        <div id="popup">
        </div> 
</body>
</html>
<script src="JavaScript/JavaScript.js"></script>