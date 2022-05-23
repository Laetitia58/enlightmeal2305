<?php
session_start();
header("Content-Type: application.json");

http_response_code(200);

$servname = "localhost";
$user = "root";
$pass = "";
$dbname = "enlight_meal";
$conditionForm= $_COOKIE['nomResto'];


try{
    $conn = new PDO("mysql:host=$servname;dbname=$dbname;charset=utf8",$user, $pass);
    
}
catch (PDOException $e){
    echo "Erreur : " . $e->getMessage();
}
$conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    function valid_donnees($donnees){
        $donnees = trim($donnees);
        $donnees = stripslashes($donnees);
        $donnees = htmlspecialchars($donnees);
        return $donnees;
    }
    
    if(isset($_POST['envoi'])){
        echo $conditionForm;
        $nom_saisi = valid_donnees($_POST['Nom']);
        $adress_saisi = valid_donnees($_POST['Adresse']);
        $telephone_saisi = valid_donnees($_POST['Telephone']);
        $Etoiles_saisi = valid_donnees($_POST['Etoiles']);
        $id_Categorie_saisi = valid_donnees($_POST['id_Categorie']);
        $noteService_saisi = valid_donnees($_POST['noteService']);
        $noteCuisson_saisi = valid_donnees($_POST['noteCuisson']);
        $noteCarte_saisi = valid_donnees($_POST['noteCarte']);
        $notePrix_saisi = valid_donnees($_POST['notePrix']);
        $Critique_saisi = valid_donnees($_POST['Critique']);
        if(isset($_COOKIE['fileImage'])){
            $Images_saisi = valid_donnees($_POST['Imagesbis']);
        }else{
            $Images_saisi = valid_donnees($_POST['Images']);
        }
        if(isset($_COOKIE['fileImage1'])){
            $Image1_saisi = valid_donnees($_POST['Image1bis']);
        }else{
            $Image1_saisi = valid_donnees($_POST['Image1']);
        }
        if(isset($_COOKIE['fileImage2'])){
            $Image2_saisi = valid_donnees($_POST['Image2bis']);
        }else{
            $Image2_saisi = valid_donnees($_POST['Image2']);
        }
        if(isset($_COOKIE['fileImage3'])){
            $Image3_saisi = valid_donnees($_POST['Image3bis']);
        }else{
            $Image3_saisi = valid_donnees($_POST['Image3']);
        }
        
        $updateRestaurant = $conn->prepare('UPDATE restaurant SET Nom = ?, Adresse=?, Telephone=?, Etoiles=?, Images=?, id_Categorie=?, Image1=?, Image2=?, Image3=?, NoteService=?, NoteCuisson=?, NoteCarte=?, NotePrix=?, Critique=? WHERE Nom = ?');
        $updateRestaurant->execute(array($nom_saisi, $adress_saisi, $telephone_saisi, $Etoiles_saisi, $Images_saisi, $id_Categorie_saisi, $Image1_saisi, $Image2_saisi, $Image3_saisi, $noteService_saisi, $noteCuisson_saisi, $noteCarte_saisi, $notePrix_saisi, $Critique_saisi, $conditionForm));
        $_SESSION['modif'] = 1;
        header('location: backAcceuil.php');
    }