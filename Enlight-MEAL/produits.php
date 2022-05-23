<?php

header("Content-Type: application.json");

http_response_code(200);

$servname = "localhost";
$user = "root";
$pass = "";
$dbname = "enlight_meal";
$conditionProduits=' WHERE Nom = "'.$_POST['idd'].'";';

try{
    $conn = new PDO("mysql:host=$servname;dbname=$dbname;charset=utf8",$user, $pass);
}
catch(PDOException $e){
echo "Erreur : " . $e->getMessage();
}
$conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

$sth = $conn->prepare ("SELECT *
                       FROM `restaurant`
                       $conditionProduits");
$sth->execute();
$produits = $sth->fetchAll(PDO::FETCH_ASSOC);
echo json_encode($produits);



?>