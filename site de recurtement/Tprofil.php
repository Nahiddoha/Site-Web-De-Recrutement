<?php
session_start();
include_once('config.php');
echo "hello";
if(isset($_POST["suivant"])){
    $cin=$_POST["cin"];
    $nom=$_POST["nom"];
    $prenom=$_POST["prenom"];
    $dn=$_POST["dn"];
    $adress=$_POST["adress"];
    $email=$_POST["email"];
    $tel=$_POST["tel"];
    $con = config::connect();
    $id_candidat = $_SESSION['id_candidat'];
    echo $id_candidat;
   

    if(insert($con,$cin,$nom,$prenom,$adress,$dn,$email,$tel,$id_candidat)){
        
        header("Location: formation.html");
        exit();
    } else {
        echo "Échec de l'insertion de la requête.";
    }
}


function insert($con,$cin,$nom,$prenom,$adress,$dn,$email,$tel,$id_candidat) {
    if(empty($cin)===false && empty($nom)===false && empty($prenom)===false && empty($dn)===false && empty($tel)===false && empty($cin)===false && empty($email)===false){
        $query = $con->prepare("
            INSERT INTO profil (id_candidat,cin, nom, prenom, date_naissance, adresse, email, tel )
            VALUES (:id_candidat,:cin, :nom, :prenom, :dn, :adress, :email, :tel )
        ");
        $query->bindParam(":id_candidat",$id_candidat);
        $query->bindParam(":cin", $cin);
        $query->bindParam(":nom", $nom);
        $query->bindParam(":prenom", $prenom);
        $query->bindParam(":dn", $dn);
        $query->bindParam(":adress", $adress);
        $query->bindParam(":email", $email);
        $query->bindParam(":tel", $tel);
    
  
        try {
            if ($query->execute()) {
                return "Insertion de la requête réussie.";
            } else {
                return "Échec de l'insertion de la requête.";
            }
        } catch (PDOException $e) {
            return "Erreur: " . $e->getMessage();
        }
    } else {

        echo "Vous devez remplir la formulaire de les informations personnelles.";
        echo $id_candidat;
        header("Location: profil.php");
        exit();
    }
}
?>
