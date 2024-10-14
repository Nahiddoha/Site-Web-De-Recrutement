<?php
session_start();
include_once('config.php');
if(isset($_POST["suivant"])){
    // Récupération des données du formulaire
    $allCheck= isset($_POST['bureau']) ? $_POST['bureau'] : [];    
    $con = config::connect();
    $id_candidat = $_SESSION['id_candidat'];
    for($i=0;$i<count($allCheck);$i++){
       insert($con,$allCheck[$i],$id_candidat);    
    }
    header("Location:technique.html");
    exit();
}
function insert($con,$allCheck,$id_candidat) {
    $query = $con->prepare("
        INSERT INTO bureau (comp_bureau,id_candidat) VALUES (:allCheck,:id_candidat)");
        $query->bindParam(":allCheck", $allCheck);
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
