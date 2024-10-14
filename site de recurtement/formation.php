<?php
session_start();
include_once('config.php');

if(isset($_POST["suivant"])){
    print_r($_POST);
    $type_diplomes=$_POST["type_diplome"];
    $specialites=$_POST["specialite"];
    $groupe_etablissements=$_POST["groupe_etablissement"];
    $etablissements=$_POST["etablissement"];
    $annee_obtinnations=$_POST["annee_obtention"];
    $id_candidat = $_SESSION['id_candidat'];
    $con = config::connect();
    
   
echo count($annee_obtinnations);
     for($i=0;$i<count($annee_obtinnations);$i++){
        if(empty($type_diplomes[$i])===false || empty($specialites[$i])===false ||empty($groupe_etablissements[$i])===false || empty($etablissements[$i])===false || empty($annee_obtinnations[$i])===false){
            insert($con,$type_diplomes[$i],$specialites[$i],$groupe_etablissements[$i],$etablissements[$i],$annee_obtinnations[$i],$id_candidat);}
        }
}

function insert($con,$type_diplome,$specialite,$groupe_etablissement,$etablissement,$annee_obtinnation,$id_candidat) {
   
    $query = $con->prepare("INSERT INTO formation (type_diplome, specialite, groupe_etablissement, etablissement, annee_obtinnation ,id_candidat)
     VALUES (:type_diplome, :specialite, :groupe_etablissement, :etablissement, :annee_obtinnation ,:id_candidat)");
    $query->bindParam(':type_diplome', $type_diplome);
    $query->bindParam(':specialite', $specialite);
    $query->bindParam(':groupe_etablissement', $groupe_etablissement);
    $query->bindParam(':etablissement', $etablissement);
    $query->bindParam(':annee_obtinnation', $annee_obtinnation);
    $query->bindParam(':id_candidat', $id_candidat);
    $query->execute();
   

}
?>