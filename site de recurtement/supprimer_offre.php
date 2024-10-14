<?php
session_start();
    $host = 'localhost';
    $username = 'root';
    $password = '';
    $database = 'siterec';
    $conn = new mysqli($host, $username, $password, $database);
    $sql=mysqli_query($conn,"select * from offre_emp");
    
if(isset($_SESSION["id_recruteur"]) ){
$id_emp=$_SESSION['id_emp'];
$id_recruteur=$_SESSION["id_recruteur"];
$req=mysqli_query($conn,"delete from offre_emp where id_recruteur ='$id_recruteur' and id_emp='$id_emp';");
if($req){
header("location: mes_offres.php");
}
else
echo "error suppression";
}

else{
echo "manque de connexion";}
?>