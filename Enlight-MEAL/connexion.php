<!DOCTYPE html>
<html lang="fr">
<head>
    <link rel="icon" href="img/Projecteur.png">
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="CSS/produits.css"/>
    <link rel="stylesheet" href="CSS/form.css"/>
    <title>Enlight Meal/Connexion</title>
</head>
<body>
    <header>
        <input type="checkbox" id="Checkbox" onclick="connexionDisparition()"> 
        <img id="menu" class="menu" src="img/burger.svg" alt="menu" height="30px"></label>
        <a href="index.php"><h1>ENLIGHT <span class="meal">MEAL</span><img src="img/projecteur.png" height="70px"></h1></a>
        <nav>
            <a class="navCo" href="connexion.php"><p>Compte</p> <span><img class="compte" src="img/compte.png" height="30px"></span></a>
            <a href="index.php?id_Categorie=1#section_2">Dark Kitchen</a>
            <a href="index.php?id_Categorie=2#section_2">Restaurant à Thème</a>
            <a href="index.php?id_Categorie=3#section_2">Pizzeria</a>
            <a href="index.php?id_Categorie=4#section_2">À Volonté</a>
        </nav>
        <a href="connexion.php"><img class="connexion" src="img/connexion.png" height="40px"></a>
    </header>
    <section id="section_1">
        <div class="login-form" id="formulaire">
        <?php
session_start();
 $servname = "localhost";
 $user = "root";
 $pass = "";
 $dbname = "enlight_meal";

$conn = new PDO("mysql:host=$servname;dbname=$dbname;charset=utf8",$user, $pass);


if(isset($_POST['envoi'])){       
    if(!empty($_POST['administrateur']) && !empty($_POST['password']))
    {
        $pseudo = htmlspecialchars($_POST['administrateur']);
        $mdp = sha1($_POST['password']);    //sha1 cryptage = sécu

        $recupUser = $conn->prepare("SELECT * FROM utilisateurs WHERE pseudo = ? AND mdp = ?");          // mettre son prénom et si c bon renvoi à ma page sinon n 'existe pas!
        $recupUser -> execute(array($pseudo, $mdp));



        if($recupUser->rowCount() > 0){            // rowcount = nb de lignes ici pseudo+mdp ok
            $_SESSION['pseudo'] = $pseudo;
            $_SESSION['mdp'] = $mdp;
            $reussie = "connexion réussie";
            echo "<div id='reussie'>" .$reussie ."</div>";
            header("Location: backOffice/backAcceuil.php");
        }else{        
            $erreur = "*pseudo ou mot de passe incorrect...";
            echo "<div id='erreur'>" .$erreur ."</div>";
        }
        }else{
            $incomplet = "*Veuillez compléter tous les champs";
            echo "<div id='incomplet'>" .$incomplet ."</div>";
        }
        
    }
    ?>

<!---------------------------------  A REVOIR -----------------------
?php
    function ajoutAdmin(){
        /// nom utilisateur sans majuscule
        $prenomAdmin = 'léticia';
        ///  mot de passe
        $pass = 'test';
             
        /// Condition que utilisateur n'existe pas, on le créé
        if ( !username_exists( $prenomAdmin ) ) {
        $id = Léticia( $prenomAdmin, $pass);
        $prenomAdmin = léticia( $user_id );
        $prenomAdmin->set_role( 'administrator' );
        } 
      }
       
      add_action('ajoutAdmin');
?>
-------------------------------------------->







            <form action="" method="post">
                <h2 class="text-center">Connexion</h2>       
                <div class="form-group">
                    <input type="text" name="administrateur" class="form-control" placeholder="pseudo"  autocomplete="off" required>
                </div>
                <div class="form-group">
                    <input type="password" name="password" class="form-control" placeholder="Mot de passe"  autocomplete="off" required>
                </div>
                <div class="form-group">
                    <button type="submit" name="envoi" class="btn btn-primary btn-block">Connexion</button>
                </div>   
            </form>
        </div>
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
</body>
</html>
<script src="JavaScript/JavaScript.js"></script>