<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>LE CV</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" 
    integrity="sha384-OgVRvuATP1z7JjHLkuOU7Xw704+h835Lr+6QL9UvYjZE3Ipu6Tp75j7Bh/kR0JKI" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.3.0/css/all.min.css"
        integrity="sha512-SzlrxWUlpfuzQ+pcUCosxcglQRNAq/DZjVsC0lE40xsADsfeQoEypE+enwcOiGjk/bSuGGKHEyjSoQ1zVisanQ=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-GLhlTQ8iRABdZLl6O3oVMWSktQOp6b7In1Zl3/Jr59b6EGGoI1aFkw7cmDA6j6gD" crossorigin="anonymous">
        <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
        <!-- <link href="sytle1.css" rel="stylesheet"> -->

  <style>
   @import url('https://fonts.googleapis.com/css2?family=Poppins:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap');

*{  font-family: 'Poppins', sans-serif;
    margin: 0;
    padding: 0;
    box-sizing: border-box;
    scroll-behavior: smooth;
}
header{
  background-color:  rgba(0, 0, 0, 0.8);
  width: 100%;
  position: fixed;
  z-index: 999;
  display: flex;
  justify-content: space-between;
  align-items: center;
  padding: 10px 100px;
}
.logo{
  text-decoration: none;
  color: white;
  text-transform: uppercase;
  font-weight: 700;
  font-size: 1.8em;
}

.navigation a{
  color: white;
  text-decoration: none;
  font-size: 1.1em;
  font-weight: 500;
  padding: 30px;
}

.navigation a:hover{
  color: #daa520;
}


.container1{
    width:60%;
    background-color :white ;
    /* border :1px black solid; */
    box-shadow: rgba(0, 0, 0, 0.17) 0px -23px 25px 0px inset, rgba(0, 0, 0, 0.15) 0px -36px 30px 0px inset, rgba(0, 0, 0, 0.1) 0px -79px 40px 0px inset, rgba(0, 0, 0, 0.06) 0px 2px 1px, rgba(0, 0, 0, 0.09) 0px 4px 2px, rgba(0, 0, 0, 0.09) 0px 8px 4px, rgba(0, 0, 0, 0.09) 0px 16px 8px, rgba(0, 0, 0, 0.09) 0px 32px 16px;
    margin-left: 20%;
} 
body{
    background-image: url("images/pawel-czerwinski-9lNoGFaNI2c-unsplash.jpg");
}
.ajouterCV{
    text-decoration-line: none;
  
    border :2px solid  green;
    border-radius :3px;
    background:green;
   
    border-bottom: none;
    color:white;
}



  </style>
</head>
<body>
<header>
        <a href="#" class="logo">LSID<em class="e1">recrutement</em></a>
        <nav class="navigation">
            <a href="acueil_condidat.php">offres d'emplois</a>
            <a href="profil.php">Ajouter CV</a>
            <a href="#foot">Contact</a>
            <a href="cv.php">MON CV</a>
            <a href="deconnexion_C.php">Deconnexion</a>
        </nav>
    </header>
<br>
<br>
<br>
<br>
<div class="container1">
        <div class="row">
            <div class="col-md-6 offset-md-3 mt-5">
               
<?php
session_start();
include_once('config.php');
if(isset($_SESSION['id_candidat'])){
    $id_candidat = $_SESSION['id_candidat'];


$con = config::connect();
$query = $con->prepare("select * from profil where id_candidat=:id_candidat");
$query->bindParam(":id_candidat",$id_candidat);
$query->execute();
$query1 = $con->prepare("select * from formation where id_candidat=:id_candidat");
$query1->bindParam(":id_candidat",$id_candidat);
$query1->execute();
$query2 = $con->prepare("select * from experience where id_candidat=:id_candidat");
$query2->bindParam(":id_candidat",$id_candidat);
$query2->execute();
$query3 = $con->prepare("select * from langue where id_candidat=:id_candidat");
$query3->bindParam(":id_candidat",$id_candidat);
$query3->execute();
$query4 = $con->prepare("select * from bureau where id_candidat=:id_candidat");
$query4->bindParam(":id_candidat",$id_candidat);
$query4->execute();
$query5 = $con->prepare("select * from technique where id_candidat=:id_candidat");
$query5->bindParam(":id_candidat",$id_candidat);
$query5->execute();
$query6 = $con->prepare("select * from loisir where id_candidat=:id_candidat");
$query6->bindParam(":id_candidat",$id_candidat);
$query6->execute();

if($rows=$query->fetch(PDO::FETCH_ASSOC)){
    $score=0;
    $score1=0;
    $score2=0;
    $score3=0;
    $score4=0;
?>
 <hr>
                <h3>Informations personnelles </h3>
                <div class="row">
                    <div class="col-md-6">

               
                    <p><strong>Cin:</strong> <?php echo $rows["cin"]; ?></p>
                        <p><strong>Nom:</strong> <?php echo $rows["nom"]; ?></p>
                        <p><strong>Prénom:</strong> <?php echo $rows["prenom"]; ?> </p>
                        <p><strong>Date de naissance:</strong> <?php echo $rows["date_naissance"]; ?></p>
                   
                   
                        <p><strong>Téléphone:</strong> <?php echo $rows["tel"]; ?></p>
                        <p><strong>Email:</strong> </em> <?php echo $rows["email"]; ?></p>
                        <p><strong>Adresse:</strong> <?php echo $rows["adresse"]; ?></p>

                        </div>

                </div>
               
          <hr>
      
         <h3>formation:</h3>   
        <?php
        $i=0;
       while($rows1=$query1->fetch(PDO::FETCH_ASSOC)){
        $i++;
     ?>
      
      <div class="row">
                    <div class="col-md-6">
                        <p><strong><?php echo $rows1["type_diplome"]; ?> <?php echo $rows1["specialite"]; ?></strong></p>
                        <p><strong> <?php echo $rows1["groupe_etablissement"]; ?><?php echo $rows1["etablissement"]; ?> </strong></p>
                        <p><strong>Date:</strong> <?php echo $rows1["annee_obtinnation"]; ?></p></div>
        </div><?php } 
        if($i>=6){
            $score4=100;
        }
        else{
            $score4=$i*100/6;

        }
    
   
         ?>
<hr>

        <h2>Expérience:</h2>  
        <?php
      while($rows2=$query2->fetch(PDO::FETCH_ASSOC)){
            ?>
      <div class="row">
                    <div class="col-md-6">
                        <p><strong>Entreprise <?php echo $rows2["entreprise"]; ?></strong></p>
                        <p><strong>Poste:</strong>  <?php echo $rows2["intitule_poste"]; ?>  </p>
                                     <p><?php echo $rows2["description"]; ?> </p>
                        <p><strong>Date:</strong> <?php echo $rows2["date_debut"]; ?> - <?php echo $rows2["date_fin"]; ?>  </p>
                        <?php 
                        $timestamp1 = strtotime($rows2["date_fin"]);
                        $timestamp2 = strtotime($rows2["date_debut"]);
                        $i=$timestamp1- $timestamp2;
                        $diff_days = round($i / (60 * 60 * 24));
                        $year=$diff_days/365;
                        if($year>=10){
                            $score1=100;
                        }
                        else{
                        $k=(100*$year)/10;
                        $score1 += $k;
                       }
                        ?>
                    
        </div>
        </div> 
        <?php } ?>
        <hr>
        <h2>Langue:</h2>  
     

        <?php
        $i=0;
        while($rows3=$query3->fetch(PDO::FETCH_ASSOC)){
            $i++;
     ?>
      <div class="col-md-6">
        <ul>
    <li><?php echo $rows3["langue"]; ?>  <?php echo $rows3["niveau_langue"]; ?>%</li>
    </ul>
    </div>
<?php } 
if($i>=6){
    $score2=100;
}
$score2= 100 * $i /6;

 ?>
        <hr>
        <h2>compétence bureautique:</h2>  
       
        <?php
        $i=0;
      while($rows4=$query4->fetch(PDO::FETCH_ASSOC)){
        $i++;
            ?>
            <div class="col-md-6" >
        <ul>
        <li>  <?php echo $rows4["comp_bureau"]; ?></li> 
        </ul>
        </div>
      <?php }
      $score3=100*$i/4;  
      ?>
      
      <hr>
     
        <h2>compétence technique::</h2>  
       
        <?php
        $i=0;
     while($rows5=$query5->fetch(PDO::FETCH_ASSOC)){
     ?>  
     <div class="col-md-6" >
        <ul>
        <li> <?php 
// Compétences requises pour le poste
$competences_requises = array("HTML", "PHP", "JAVA", "JavaScript", "C++","PYTHON","C","C#","RUBY","JULIA","SWIFT","Scala");

// Le CV à évaluer
$cv = $rows5["comp_tec"];

// Score initial


// Parcourir chaque compétence requise


foreach ($competences_requises as $competence) {
   
    // Vérifier si la compétence est présente dans le CV
   if ($cv===$competence) {
      
        // Ajouter des points pour chaque compétence trouvée
      $i++;
     
    }
  
}
echo $rows5["comp_tec"];

// Afficher le score final
   
        ?></li> 
        </ul>
        </div>
        <?php } 
    if(isset($competences_requises)){
        $score=$i*100/count($competences_requises);
    }
 
     ?>
<hr>

        <h2>loisir:</h2>
        <?php
       while($rows6=$query6->fetch(PDO::FETCH_ASSOC)){
    
            ?>
      
        <div class="col-md-6">
        <ul>
        <li> <?php echo $rows6["loisir"]; ?></li> 
        </ul>
    
        </div>
       
        <?php } ?>
         <br>
         <br>
         <?php 
        $sT=($score+$score1+$score2+$score3+$score4)/5;
     
        $query7 = $con->prepare("insert into  scores(score,id_candidat) values (:sT,:id_candidat)");
        $query7->bindParam(":sT",$sT);
       $query7->bindParam(":id_candidat",$id_candidat);
      $query7->execute();}
      else{ ?>
        <div class="row">
                          <div class="col-md-6">
                              <p><strong>vous n'avez pas un cv veuillez ajouter votre cv </strong></p>
                              <p ><strong><a class="ajouterCV" href="profil.php">ajouter un cv</a> </strong></p>
                              </div>
                              </div>

             <?php } } 
               else{ ?>
                <div class="row">
                                  <div class="col-md-6">
                                      <p><strong>vous n'avez pas un cv veuillez ajouter votre cv </strong></p>
                                      <p ><strong><a class="ajouterCV" href="profil.php">ajouter un cv</a> </strong></p>
               </div>    </div>
                     <?php }?>
       
    
      
       
    </div>
  </div>
</div>
              
</body>
<br>
<br>

    <footer class="bg-dark text-white pt-5 pb-4" >
    <div class="containe text-center text-md-left">
        <div class="row text-center text-md-left">
            <div class="col-md-3 col-xl-3 mx-auto mt-3">
                <h5 class="text-uppercase mb-4 font-weight-bold text-warning">LSIDrecrutement
                </h5>
                <p>avec nous vous trouverai le meilleure ofre</p>

            </div>
            <div class="col-md-2 col-lg-2 col-xl-2 mx-auto mt-3">
                <h5 class="text-uppercase mb-4 font-weight-bold text-warning"> Secteurs
                </h5>
                <p>
                    <a href="#" class="text-white" style="text-decoration :none;">informatique</a>


                    <a href="#" class="text-white" style="text-decoration :none;">mécanique</a>
                    <a href="#" class="text-white" style="text-decoration :none;">électronique</a>
                    <a href="#" class="text-white" style="text-decoration :none;">réseau</a>
                </p>
            </div>
            <div class="col-md-4 col-lg-3 col-xl-3 mx-auto mt-3">
                <h5 class="text-uppercase mb-4 font-weight-bold text-warning"> Contact</h5>
                <p>
                    <i class="fas fa-home mr-3"></i>Settat ,Casablanca-Settat ,Maroc
                </p>
                <p>
                    <i class="fas fa-envelope mr-3"></i>LSIDrecrutement2023@gmail.com
                </p>
                <p>
                    <i class="fas fa-phone mr-3"></i>+212 6123456988
                </p>
                <p>
                    <i class="fas fa-phone mr-3"></i>+212 5123456789
                </p>
            </div>
        </div>
        <hr class="mb-4">
        <div class="row alig-items-center">
            <div class="col-md-7 col-lg-8">
                <p>les droits de copies @2023 est réserver par :
                    <a href="#" style="text-decoration: none;">
                        <strong class="text-warning">Provideur</strong>
                    </a>

                </p>


            </div>
            <div class="col-md-5 col-lg-4">
                <div class="text-center text-md-right">
                    <ul class="list-unstyled list-inline">
                        <li class="list-inline-item">
                            <a href="#" class="btn-floating btn-sm text-white"><i class="fab fa-facebook"></i></a>
                        </li>
                        <li class="list-inline-item">
                            <a href="#" class="btn-floating btn-sm text-white"><i class="fab fa-twitter"></i></a>
                        </li>
                        <li class="list-inline-item">
                            <a href="#" class="btn-floating btn-sm text-white"><i class="fab fa-google-plus"></i></a>

                        </li>
                        <li class="list-inline-item">
                            <a href="#" class="btn-floating btn-sm text-white"><i class="fab fa-linkedin-in"></i></a>
                        </li>
                        <li class="list-inline-item">
                            <a href="#" class="btn-floating btn-sm text-white"><i class="fab fa-youtube"></i></a>
                        </li>
                </div>

            </div>
        </div>
    </div>
</footer>



</html>
