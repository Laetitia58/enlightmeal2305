<?php    // à la déconnexion suppr pseudo et non retour au bock office

    session_start();
    unset($_SESSION['pseudo']);
    header("Location: ../index.php");
?>