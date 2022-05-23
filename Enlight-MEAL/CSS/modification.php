<?php
session_start();

header("Content-Type: application.json");

http_response_code(200);

$servname = "localhost";

$servname = "localhost";  //clé usb

$user = "root";
$pass = "";
$dbname = "enlight_meal";
if(isset($_POST['nom'])){
    $conditionProduits=' WHERE Nom = "'.$_POST['nom'].'";';
}


/*function valid_donnees($donnees){
//pour éviter écrire les espaces, balises, sécu... en visuel
function valid_donnees($donnees){
    $donnees = trim($donnees);
    $donnees = stripslashes($donnees);
    $donnees = htmlspecialchars($donnees);
    return $donnees;
}*/


try{

    $conn = new PDO("mysql:host=$servname;dbname=$dbname;charset=utf8",$user, $pass);
}
catch (PDOException $e){
    echo "Erreur : " . $e->getMessage();
}

/*if(isset($_SESSION['pseudo'])){  
$conn = new PDO("mysql:host=$servname;dbname=$dbname;charset=utf8",$user, $pass);
$conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);  // si erreur, ce message en visu
if(isset($_SESSION['pseudo'])){    // isset= si existe affiche page normale (au moment connexion)
}else{
    header ('location: ../index.php');   // sinon renvoi ici
}
//if(isset($_GET['Nom']) AND !empty($_GET['Nom'])){
$getNom = $_GET['Nom'];*/
$conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

if(isset($_POST['nom'])){
$sth = $conn ->prepare("SELECT * 
                        FROM `restaurant` 
                        $conditionProduits");
$sth->execute();
$produits = $sth->fetchAll(PDO::FETCH_ASSOC);

echo json_encode($produits);
}

/*$carteRestaurant->execute(array($getNom));
if($carteRestaurant->rowCount() > 0){
    $carteInfos = $carteRestaurant->fetch();
    $Nom = $carteInfos['Nom'];
    $Adresse = $carteInfos['Adresse'];
    $Telephone = $carteInfos['Telephone'];
    $Etoiles = $carteInfos['Etoiles'];
    $Images = $carteInfos['Images'];
    $id_Categorie = $carteInfos['id_Categorie'];
    $Image1 = $carteInfos['Image1'];
    $Image2 = $carteInfos['Image2'];
    $Image3 = $carteInfos['Image3'];
    $noteService = $carteInfos['NoteService'];
    $noteCuisson = $carteInfos['NoteCuisson'];
    $noteCarte = $carteInfos['NoteCarte'];
    $notePrix = $carteInfos['NotePrix'];
    $Critique = $carteInfos['Critique'];*/
    
    /*if(isset($_POST['envoi'])){
        $nom_saisi = valid_donnees($_POST['Nom']);
        $adress_saisi = valid_donnees($_POST['Adresse']);
        $telephone_saisi = valid_donnees($_POST['Telephone']);
        $Etoiles_saisi = valid_donnees($_POST['Etoiles']);
        $Images_saisi = "";
        $id_Categorie_saisi = valid_donnees($_POST['id_Categorie']);
        $Image1_saisi = valid_donnees($_POST['Image1']);
        $Image2_saisi = valid_donnees($_POST['Image2']);
        $Image3_saisi = valid_donnees($_POST['Image3']);
        $noteService_saisi = valid_donnees($_POST['noteService']);
        $noteCuisson_saisi = valid_donnees($_POST['noteCuisson']);
        $noteCarte_saisi = valid_donnees($_POST['noteCarte']);
        $notePrix_saisi = valid_donnees($_POST['notePrix']);
        $Critique_saisi = valid_donnees($_POST['Critique']);
        if($_POST['Images'] == ""){
            $Images_saisi = $Images;
        }else
        {
            $Images_saisi = valid_donnees($_POST['Images']);
        }
        if($_POST['Image1'] == ""){
            $Image1_saisi = $Image1;
        }else
        {
            $Image1_saisi = valid_donnees($_POST['Image1']);
        }
        if($_POST['Image2'] == ""){
            $Image2_saisi = $Image2;
        }else
        {
            $Image2_saisi = valid_donnees($_POST['Image2']);
        }
        if($_POST['Image3'] == ""){
            $Image3_saisi = $Image3;
        }else
        {
            $Image3_saisi = valid_donnees($_POST['Image3']);
        }
        $updateRestaurant = $conn->prepare('UPDATE restaurant SET Nom = ?, Adresse=?, Telephone=?, Etoiles=?, Images=?, id_Categorie=?, Image1=?, Image2=?, Image3=?, NoteService=?, NoteCuisson=?, NoteCarte=?, NotePrix=?, Critique=?  WHERE Nom = ?');
        $updateRestaurant->execute(array($nom_saisi, $adress_saisi, $telephone_saisi, $Etoiles_saisi, $Images_saisi, $id_Categorie_saisi, $Image1_saisi, $Image2_saisi, $Image3_saisi, $noteService_saisi, $noteCuisson_saisi, $noteCarte_saisi, $notePrix_saisi, $Critique_saisi, $getNom));
        $_SESSION['modif'] = 1;
        header('location: backAcceuil.php');
    }
else{
    echo "Aucun article trouvé";
}
else{
    echo "Aucun identifiant trouvé";
}}
*//*
?>*/
?>