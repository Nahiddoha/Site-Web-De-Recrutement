<?php
session_start();
include_once('config.php');
if(isset($_POST["suivant"])){
    print_r($_POST);
    
$langue=$_POST["langue"];
$niveau_langue=$_POST["niveau_langue"];
    $con = config::connect();
    $id_candidat = $_SESSION['id_candidat'];
    for($i=0;$i<count($langue);$i++){
       if(empty($langue[$i]) ===false && empty($langue[$i]===false)){
        insert($con,$langue[$i],$niveau_langue[$i],$id_candidat);
       }
    }
}
function insert($con,$langue,$niveau_langue,$id_candidat) {
    $query = $con->prepare("
        INSERT INTO langue (langue,niveau_langue,id_candidat)
        VALUES (:langue,:niveau_langue,:id_candidat)
    ");
    $query->bindParam(":langue", $langue);
    $query->bindParam(":niveau_langue", $niveau_langue);
    
    $query->bindParam(":id_candidat", $id_candidat);
    try {
        $query->execute();
        echo "hello";
        // if ($query->execute()) {
        //     return "Insertion de la requête réussie.";
        // } else {
        //     return "Échec de l'insertion de la requête.";
        // }
    } catch (PDOException $e) {
       echo "Erreur: " . $e->getMessage();
    }
}
?>