<?php
session_start();
include_once('config.php');
if(isset($_POST["suivant"])){
    
    print_r($_POST);
    
$competence=$_POST["competence"];
$id_candidat = $_SESSION['id_candidat'];
    $con = config::connect();
    for($i=0;$i<count($competence);$i++){
       if(empty($competence[$i])===false){
        insert($con,$competence[$i],$id_candidat);}
    }
}
function insert($con,$competence,$id_candidat) {
    $query = $con->prepare("
        INSERT INTO  technique(comp_tec,id_candidat)
        VALUES (:competence,:id_candidat)
    ");
    $query->bindParam(":competence", $competence);
  
    $query->bindParam(":id_candidat", $id_candidat);
    
    try {
      
    
         if ($query->execute()) {
           return "Insertion de la requête réussie.";
    } else {
       return "Échec de l'insertion de la requête.";
       }
    } catch (PDOException $e) {
       echo "Erreur: " . $e->getMessage();
    }
}
?>