<?php
// Vérification si l'utilisateur est connecté en tant que recruteur
session_start();
 
if (!isset($_SESSION['id_recruteur'])) {
    header('Location: connecter_R.php');
    exit();
}
else{
    $id_recruteur=$_SESSION['id_recruteur'];
  include_once('config.php');
  $con = config::connect();
  $query = $con->prepare("
 select * from recruteur where  id_recruteur='$id_recruteur'");
$query->execute();
$recruteur=$query->fetch(PDO::FETCH_ASSOC);
?>

<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Page d'accueil recruteur</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.3.0/css/all.min.css"
        integrity="sha512-SzlrxWUlpfuzQ+pcUCosxcglQRNAq/DZjVsC0lE40xsADsfeQoEypE+enwcOiGjk/bSuGGKHEyjSoQ1zVisanQ=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-GLhlTQ8iRABdZLl6O3oVMWSktQOp6b7In1Zl3/Jr59b6EGGoI1aFkw7cmDA6j6gD" crossorigin="anonymous">

    <style>
    @import url('https://fonts.googleapis.com/css2?family=Poppins:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap');

    * {
        font-family: 'Poppins', sans-serif;
        margin: auto;
        padding: auto;
        box-sizing: border-box;
        scroll-behavior: smooth;
    }

    header {
        background-color: rgba(0, 0, 0, 0.8);
        width: 100%;
        position: fixed;
        z-index: 999;
        display: flex;
        justify-content: space-between;
        align-items: center;
        padding: 10px 100px;
    }

    .logo {
        text-decoration: none;
        color: white;
        text-transform: uppercase;
        font-weight: 700;
        font-size: 1.8em;
    }

    .navigation a {
        color: white;
        text-decoration: none;
        font-size: 1.1em;
        font-weight: 500;
        padding: 30px;
    }

    .navigation a:hover {
        color: #daa520;
    }

    .container1 {
        width: 60%;
        background-color: white;
        padding-right: 650px;
        /* border :1px black solid; */
        box-shadow: rgba(0, 0, 0, 0.17) 0px -23px 25px 0px inset, rgba(0, 0, 0, 0.15) 0px -36px 30px 0px inset, rgba(0, 0, 0, 0.1) 0px -79px 40px 0px inset, rgba(0, 0, 0, 0.06) 0px 2px 1px, rgba(0, 0, 0, 0.09) 0px 4px 2px, rgba(0, 0, 0, 0.09) 0px 8px 4px, rgba(0, 0, 0, 0.09) 0px 16px 8px, rgba(0, 0, 0, 0.09) 0px 32px 16px;
    }

    img {
        float: right;

    }

    .tarik {
        border: 5px solid grey;

        bordeR-radius: 20px;

        width: 700px;
    }

    h3 {
        color: rgb(137, 137, 252);
    }
    button {
        background-color: #00f;
        color: #fff;
        border: none;
        border-radius: 5px;
        padding: 10px 20px;
        font-size: 16px;
        cursor: pointer;
    }
    button:hover {
        background-color: #666;
    }
    .section1 {
        margin-right: 85%;
        margin-top: 0px;
        position: fixed;
    }

    label {
        margin-top: 10px;
        font-size: 20px;
        font-weight: 500;
    }
    .butt {
        margin-top: 10px;
    }

    select {
        padding: 5px;
        border-radius: 10px;
        width: 90%;
        border: 2px solid black;
        background-color: whitesmoke;
        font-size: 15px;
        font-weight: 500;
    }
    </style>
</head>

<body>
    <header>
        <a href="#" class="logo">LSID<em class="e1">recrutement</em></a>
        <nav class="navigation">
            <a href="#">acceuil :cv</a>
            <a href="offre_emploi.php">Ajouter offre</a>
            <a href="#foot">Contact</a>
            <a href="mes_offres.php">mes offres</a>
            <a href="deconnexion.php">Deconnexion</a>
        </nav>
    </header>
    <br>
    <br>
    <br>
    <br>
   

    <section class="S">
    <marquee behavior="" direction="right">bienvenue <?php echo $recruteur['prenom'] .' '.$recruteur['nom']; ?></marquee>

        <div class="contain">
            <div class="section1">
                <form method="POST" action="">
                    <label for="domaine">Filtrer par domaine:</label><br>
                    <select id="domaine" name="domaine">
                        <option value="">Tous les domaines</option>
                        <option value="Informatique">informatique</option>
                        <option value="électronique">electronique</option>
                        <option value="commerce">commerce</option>
                        <option value="mécanique">mécanique</option>
                    </select><br>
                    <button type="submit" class="butt">Filtrer</button>
                </form>
            </div>
            <div class="container1">
                <div class="row">
                    <div class="col-md-6 offset-md-3 mt-5">

                        <?php
include_once('config.php');
$con = config::connect();



        
if(isset($_POST['domaine']) && !empty($_POST['domaine'])) {
    $domaine = $_POST['domaine'];
    $q=$con->prepare("select * from condidat where domaine='$domaine'");
    $q->execute();
    $j=$q->fetchAll(PDO::FETCH_ASSOC);
 foreach($j as $r){
    $id=$r['id_candidat'];
$query=$con->prepare("select  * from profil where id_candidat='$id'");
    $query->execute();

$rows=$query->fetchAll(PDO::FETCH_ASSOC);
$query7= $con->prepare("select * from scores where id_candidat='$id'");
$query7->execute();


foreach($rows as $row){
  
        $i=$row['id_candidat'];
        $query1 = $con->prepare("select  * from formation where id_candidat='$i'");
        
        $query1->execute();
        $query2 = $con->prepare("select * from experience where id_candidat='$i' ");
        
        $query2->execute();
        $query3 = $con->prepare("select * from langue where id_candidat='$i' ");
        
        $query3->execute();
        $query4 = $con->prepare("select  * from bureau where id_candidat='$i' ");
        
        $query4->execute();
        $query5 = $con->prepare("select   * from technique where id_candidat='$i'");
        
        $query5->execute();
        $query6 = $con->prepare("select * from loisir where id_candidat='$i'");
        $query6->execute();
       
    
      
?>
                        <section class="tarik">
                            <?php  if($qi=$query7->fetch(PDO::FETCH_ASSOC)){ ?>
                            <p style =color:red;><strong> Score:</strong> <?php echo $qi["score"] .'%' ;?></p>

                            <?php } ?>

                            <h3>Informations personnelles:</h3>
                            <div class="row">
                                <div class="col-md-6">
                                    <p><strong>Cin:</strong> <?php echo $row["cin"]; ?></p>
                                    <p><strong>Nom:</strong> <?php echo $row["nom"]; ?></p>
                                    <p><strong>Prénom:</strong> <?php echo $row["prenom"]; ?> </p>
                                    <p><strong>Date de naissance:</strong> <?php echo $row["date_naissance"]; ?></p>


                                    <p><strong>Téléphone:</strong> <?php echo $row["tel"]; ?></p>
                                  
                                    <p><strong>Email:</strong> </em> <a style=color:green; href="mailto:<?php echo $row["email"]; ?>"> <?php echo $row["email"]; ?></a></p>
                                    <p><strong>Adresse:</strong> <?php echo $row["adresse"]; ?></p>

                                </div>

                            </div>

                            <hr>
                            <h3>formation :</h3>
                            <?php
        while($rows1=$query1->fetch(PDO::FETCH_ASSOC)){
     ?>

                            <div class="row">
                                <div class="col-md-6">
                                    <p><strong><?php echo $rows1["type_diplome"]; ?>
                                            <?php echo $rows1["specialite"]; ?></strong></p>
                                    <p><strong>
                                            <?php echo $rows1["groupe_etablissement"]; ?><?php echo $rows1["etablissement"]; ?>
                                        </strong></p>
                                    <p><strong>Date:</strong> <?php echo $rows1["annee_obtinnation"]; ?></p>
                                </div>
                            </div><?php } ?>
                            <hr>
                            <h3>Expérience:</h3>
                            <?php
       while($rows2=$query2->fetch(PDO::FETCH_ASSOC)){
            ?>
                            <div class="row">
                                <div class="col-md-6">
                                    <p><strong>Entreprise <?php echo $rows2["entreprise"]; ?></strong></p>
                                    <p><strong>Poste:</strong> <?php echo $rows2["intitule_poste"]; ?> </p>
                                    <p><?php echo $rows2["description"]; ?> </p>
                                    <p><strong>Date:</strong> <?php echo $rows2["date_debut"]; ?> -
                                        <?php echo $rows2["date_fin"]; ?> </p>

                                </div>
                            </div>
                            <?php } ?>
                            <hr>
                            <h3>Langue :</h3>
                            <?php
        while($rows3=$query3->fetch(PDO::FETCH_ASSOC)){
     ?>
                            <div class="col-md-6">
                                <ul>
                                    <li><?php echo $rows3["langue"]; ?> <?php echo $rows3["niveau_langue"]; ?>%</li>
                                </ul>
                            </div>
                            <?php } ?>
                            <hr>
                            <h3>compétence bureautique :</h3>
                            <?php
        while($rows4=$query4->fetch(PDO::FETCH_ASSOC)){
    
            ?>
                            <div class="col-md-6">
                                <ul>
                                    <li> <?php echo $rows4["comp_bureau"]; ?></li>
                                </ul>
                            </div>
                            <?php }?>
                            <hr>
                            <h3>compétence technique </i>:</h3>
                            <?php
        while($rows5=$query5->fetch(PDO::FETCH_ASSOC)){
     ?>
                            <div class="col-md-6">
                                <ul>
                                    <li> <?php echo $rows5["comp_tec"]; ?></li>
                                </ul>
                            </div>
                            <?php } ?>
                            <hr>
                            <h3>loisir:</h3>
                            <?php
        while($rows6=$query6->fetch(PDO::FETCH_ASSOC)){
    
            ?>

                            <div class="col-md-6">
                                <ul>
                                    <li> <?php echo $rows6["loisir"]; ?></li>
                                </ul>

                            </div>

                            <?php }  ?>
                        </section>
                        <?php } ?><br><br> <?php } } ?>

                    </div>
                </div>
            </div>


</body>
<br>
<br>
<br>
<br>
<br>
</body>
<footer class="bg-dark text-white pt-5 pb-4" id="foot">
    <div class="container text-center text-md-left">
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
<?php } ?>