<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>LES OFFRES</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-GLhlTQ8iRABdZLl6O3oVMWSktQOp6b7In1Zl3/Jr59b6EGGoI1aFkw7cmDA6j6gD" crossorigin="anonymous">
    <style>
        
    @import url('https://fonts.googleapis.com/css2?family=Poppins:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap');

    * {
        font-family: 'Poppins', sans-serif;
        margin: auto;
        padding: auto;
       
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

    .b1 {
        display: inline-block;
        padding: 10px;
        background-color: #555;
        color: #fff;
        text-decoration: none;
        margin: 20px 0;
    }

    .b1:hover {
        background-color: #333;
    }

    .S1 {
        background-color: rgba(0, 0, 0, 0.1);
        max-width: 600px;
        margin: 0 auto;
        padding: 20px;
       
        border-radius: 10px;
        padding-top: 50px;
    }

    
  
    </style>
</head>

<body>
    <header>
        <a href="#" class="logo">LSID<em class="e1">recrutement</em></a>
        <nav class="navigation">
            <a href="acueil_recruteur.php">acceuil:cv</a>
            <a href="offre_emploi.php">Ajouter offre</a>
            <a href="#foot">Contact</a>
            <a href="mes_offres.php">mes offres</a>
            <a href="deconnexion_R.php">Deconnexion</a>
        </nav>
    </header>
<br>
<br>
<br>
<br>
    <?php
  session_start();

  // Vérifier si l'utilisateur est connecté en tant que recruteur
  if (!isset($_SESSION['id_recruteur'])) {
    header('Location: connecteur_R.php');
    exit();
  } else {
    // Se connecter à la base de données
    $dsn = 'mysql:host=localhost;dbname=siterec';
    $username = 'root';
    $password = '';
    $options = array(
      PDO::MYSQL_ATTR_INIT_COMMAND => 'SET NAMES utf8',
    );

    $pdo = new PDO($dsn, $username, $password, $options);

    // Récupérer l'identifiant du recruteur connecté
    $id_recruteur = $_SESSION['id_recruteur'];
    $poste = $pdo->prepare("select *from offre_emp where id_recruteur='$id_recruteur'");
    $poste->execute();

    if($po = $poste->fetch(PDO::FETCH_ASSOC)){
        $_SESSION['id_emp'] = $po['id_emp'];
    }
    
    // Préparer et exécuter la requête SQL pour récupérer les offres d'emploi du recruteur
    $sql = "SELECT * FROM offre_emp WHERE id_recruteur ='$id_recruteur'";
    $stmt = $pdo->prepare($sql);
    $stmt->execute();
    while($row = $stmt->fetch(PDO::FETCH_ASSOC)){
  ?>

    <div class="S1">
        <p> <em>Nom de entreprise :</em> <?php echo $row["nom"]; ?></p> </br>
        <p> <em>Domaine :</em> <?php echo $row["domaine"]; ?></p> </br>
        <p><em>titre poste :</em> <?php echo $row["poste"]; ?></p> </br>
        <p><em>Description:</em> <?php echo $row["desc"]; ?> </p> </br>
        <p><em>Mission:</em> <?php echo $row["mission"]; ?></p> </br>
        <p><em>Pre-requis:</em> <?php echo $row["requis"]; ?></p> </br>
        <p><em>Email:</em> <?php echo $row["email"]; ?></p>

        <a class="b1" href="modifier_offre.php?id=<?= $row['id_recruteur'] ?>">Modifier</a>
        <a class="b1" href="supprimer_offre.php?id=<?= $row['id_recruteur'] ?>"
            onclick="return confirmerSuppression()">Supprimer</a>
    </div>
    <br>
    <br>
    <?php } ?>
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
<script>
function confirmerSuppression() {
    var confirmation = confirm("Êtes-vous sûr de vouloir supprimer cette offre ?");

    if (confirmation) {
        alert("L'offre a été supprimée avec succès.");
        return true;
    } else {
        return false;
    }
}
</script>
<?php } ?>