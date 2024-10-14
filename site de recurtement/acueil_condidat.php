<?php
session_start();

// Vérifier si l'utilisateur est connecté en tant que recruteur
if (!isset($_SESSION['id_candidat'])) {
    header('Location: connecter_C.php');
    exit();
}else{
  $id_candidat=$_SESSION['id_candidat'];
  include_once('config.php');
  $con = config::connect();
  $query = $con->prepare("
 select * from condidat where  id_candidat='$id_candidat'
");
$query->execute();
$candidat=$query->fetch(PDO::FETCH_ASSOC);
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Page d'accueil candidat</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-GLhlTQ8iRABdZLl6O3oVMWSktQOp6b7In1Zl3/Jr59b6EGGoI1aFkw7cmDA6j6gD" crossorigin="anonymous">
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css" />

    <style>
    @import url('https://fonts.googleapis.com/css2?family=Poppins:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap');

    * {
        font-family: 'Poppins', sans-serif;
        margin: 0;
        padding: 0;
        box-sizing: border-box;
        scroll-behavior: smooth;
    }

    header {
        background-color: rgba(0, 0, 0, 0.8);
        width: 100%;
      
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

    /* styles pour la section avec les offres d'emploi */
    .container1 {
        background-color: rgba(0, 0, 0, 0.3);
        width: 60%;
        margin: 0 auto;
        padding: 20px;
        margin-bottom: 100px;
    }

    .S1 {
        background-color: white;
        border: 1px solid #ddd;
        border-radius: 5px;
        padding: 20px;
        margin-bottom: 20px;
        margin-top: 50px;
    }

    .S1 p {
        margin: 0;
        font-size: 16px;
        color: #333;
    }

    .S1 em {
        font-weight: bold;
        color: #666;
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

    .S1 {
        max-width: 100%;
        word-wrap: break-word;
    }

    .e1 {
        text-transform: lowercase;
        font-family: Arial, Helvetica, sans-serif;
    }

    .S {
        background-image: url(images/B1.jpg);
        background-size:cover;
       
        background-attachment: fixed;
    }

    .contain {
        display: flex;
        justify-content: center;
        flex-direction: row;
        flex-wrap: wrap;
    }

    .section1 {
        margin-right: 85%;
        margin-top: 80px;
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
            <a href="acueil_condidat.php">offres d'emplois</a>
            <a href="profil.php">Ajouter CV</a>
            <a href="#foot">Contact</a>
            <a href="cv.php">MON CV</a>
            <a href="deconnexion_C.php">Deconnexion</a>
        </nav>
    </header>

    <section class="S">
    <marquee behavior="" direction="right">bienvenue <?php echo $candidat['prenom'] .' '.$candidat['nom']; ?></marquee>

        <div class="contain">
            <div class="section1">
                <form method="POST" action="">
                    <label for="domaine">Filtrer par domaine:</label><br>
                    <select id="domaine" name="domaine">
                        <option value="">Tous les domaines</option>
                        <option value="Informatique">informatique</option>
                        <option value="electronique">electronique</option>
                        <option value="commerce">commerce</option>
                    </select><br>
                    <button type="submit" class="butt">Filtrer</button>
                </form>
            </div>

            <div class="container1">
                <?php 
        $servername = "localhost";
        $username = "root";
        $password = "";
        $dbname = "siterec";
        $conn = mysqli_connect($servername, $username, $password, $dbname);
        // Vérification de la connexion1
        if (!$conn) {
            die("Connection failed: " . mysqli_connect_error());
        }
        
        $sql = "SELECT * FROM offre_emp";
        
        if(isset($_POST['domaine']) && !empty($_POST['domaine'])) {
            $domaine = $_POST['domaine'];
            $sql .= " WHERE domaine='$domaine'";
        }
        
        $req=mysqli_query($conn, $sql);
        while($res=mysqli_fetch_array($req)){
        ?>

                <!--pour mettre chaque element dans un div separer-->
                <div class="S1">
                    <p> <em>Nom de entreprise :</em> <?php echo $res["nom"]; ?></p> </br>
                    <p> <em>Domaine :</em> <?php echo $res["domaine"]; ?></p> </br>
                    <p><em>titre poste :</em> <?php echo $res["poste"]; ?></p> </br>
                    <p><em>Description:</em> <?php echo $res["desc"]; ?> </p> </br>
                    <p><em>Mission:</em> <?php echo $res["mission"]; ?></p> </br>
                    <p><em>Pre-requis:</em> <?php echo $res["requis"]; ?></p> </br>
                    <p>Si vous avez intéresseé <a>
                    <p><a href="mailto:<?php echo $row["email"]; ?>"><button>postuler</button></a>.</p>
                </div>

                <?php } ?>
    </section>
    </div>
    </div>

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
<?php }?>