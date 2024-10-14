<?php
session_start();
include_once('config.php');
if(isset($_POST["suivant"])){
    print_r($_POST);
    
    $date_debut=$_POST["date_debut"];
    $date_fin=$_POST["date_fin"];
    $entreprise=$_POST["entreprise"];
    $intitule=$_POST["intitule_poste"];
    $descripition=$_POST["description"];
    $con = config::connect();
    $id_candidat = $_SESSION['id_candidat'];
    for($i=0;$i<count($date_debut);$i++){
     if(empty($date_debut[$i])===false || empty($date_fin[$i])===false || empty($entreprise[$i])===false || empty($intitule[$i])===false ||empty($descripition[$i])===false){
        insert($con,$date_debut[$i],$date_fin[$i],$entreprise[$i],$intitule[$i],$descripition[$i],$id_candidat);}
    }
}
function insert($con,$date_debut,$date_fin,$entreprise,$intitule,$descripition,$id_candidat) {
    $query = $con->prepare("
        INSERT INTO experience (date_debut,date_fin,entreprise,intitule_poste,description,id_candidat)
        VALUES (:date_debut,:date_fin,:entreprise, :intitule, :descripition,:id_candidat)
    ");
    $query->bindParam(":date_debut", $date_debut);
    $query->bindParam(":date_fin", $date_fin);
    $query->bindParam(":entreprise", $entreprise);
    $query->bindParam(":intitule", $intitule);
    $query->bindParam(":descripition", $descripition);
    $query->bindParam(":id_candidat", $id_candidat);
    echo "hello";
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