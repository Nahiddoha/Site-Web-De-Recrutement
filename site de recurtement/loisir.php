<?php
session_start();
include_once('config.php');
if(isset($_POST["suivant"])){
    print_r($_POST);
    
$loisir=$_POST["loisir"];
$id_candidat = $_SESSION['id_candidat'];
    $con = config::connect();
    for($i=0;$i<count($loisir);$i++){
       if(empty($loisir[$i])===false){
        insert($con,$loisir[$i],$id_candidat);}
    }
}
function insert($con,$loisir,$id_candidat) {
    $query = $con->prepare("
        INSERT INTO  loisir(loisir,id_candidat)
        VALUES (:loisir,:id_candidat)
    ");
    $query->bindParam(":loisir", $loisir);
  
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