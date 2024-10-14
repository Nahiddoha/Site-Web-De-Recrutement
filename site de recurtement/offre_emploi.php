<?php
// Vérification si l'utilisateur est connecté en tant que recruteur
session_start();
 
if (!isset($_SESSION['id_recruteur'])) {
    header('Location: connecter_R.php');
    exit();
}
else{
class Database {
    private $servername;
    private $username;
    private $password;
    private $dbname;
    private $conn;

    // Constructor to establish connection
    public function __construct($servername, $username, $password, $dbname) {
        $this->servername = $servername;
        $this->username = $username;
        $this->password = $password;
        $this->dbname = $dbname;

        // Create connection
        $this->conn = new mysqli($this->servername, $this->username, $this->password, $this->dbname);

        // Check connection
        if ($this->conn->connect_error) {
            die("Connection failed: " . $this->conn->connect_error);
        }
    }

    // Method to insert data into database
    
    public function insertData($nom, $domaine, $poste, $desc, $mission, $requis, $email,$id_recruteur) {
        if(empty($domaine)===false && empty($poste)===false && empty($mission)===false){
        $sql ="INSERT INTO `offre_emp` (`nom`,`domaine`, `poste`, `desc`, `mission`, `requis`,`email`,`id_recruteur`)
                VALUES ('$nom','$domaine','$poste', '$desc', '$mission', '$requis','$email','$id_recruteur');";

        if ($this->conn->query($sql) === TRUE) {
            header('location: mes_offres.php');
        } else {
            echo "Error: " . $sql . "<br>" . $this->conn->error;
        }
    } 
    else{
        header('Location: offre_emploi.php');
    }
}


    // Destructor to close connection
    public function __destruct() {
        $this->conn->close();
    }
}

// Handle form submission
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $nom = $_POST["nom"];
    $domaine = $_POST["domaine"];
    $poste = $_POST["poste"];
    $desc = $_POST["desc"];
    $mission = $_POST["mission"];
    $requis = $_POST["requis"];
    $email = $_POST["email"];
    
    $id_recruteur=$_SESSION["id_recruteur"];
    // Create object of Database class and insert data
    $db = new Database("localhost", "root", "", "siterec");
    $db->insertData($nom, $domaine, $poste, $desc, $mission, $requis, $email,$id_recruteur);
}
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Offre Emploi</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-GLhlTQ8iRABdZLl6O3oVMWSktQOp6b7In1Zl3/Jr59b6EGGoI1aFkw7cmDA6j6gD" crossorigin="anonymous">
    <style>
  @import url('https://fonts.googleapis.com/css2?family=Poppins:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap');

*{  font-family: 'Poppins', sans-serif;
 margin: auto;
 padding: auto;
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
body{
    background-color: beige;
}
.sec1{
    display: flex;
    justify-content: center;
    align-items: center;
    padding-top: 70px;
}
fieldset{
    border: 3px solid black;
    border-radius: 10px;
    width: 50%;
    text-align: center;
    background-color: #a0caf5;
}

legend{
    font-size: 30px;
    font-weight: 800;
    font-family: Arial, Helvetica, sans-serif;
}
label {
  display: block;
  font-weight: bold;
  margin-top: 10px;
}

input[type="text"] ,input[type="email"]{
  padding: 5px;
  border: 1px solid #ccc;
  border-radius: 4px;
  box-sizing: border-box;
  width: 100%;
  margin-bottom: 10px;
}

button {
  padding: 10px;
  background-color: blue;
  color: white;
  border: none;
  border-radius: 10px;
  cursor: pointer;
  font-size: 20px;
}
button:hover{
    background-color: blue;
    transform: scale(1.2,1.2);
    transition: 1.7s;
}

    </style>
</head>
<body>

<header>
        <a href="#" class="logo">LSID<em class="e1">recrutement</em></a>
        <nav class="navigation">
            <a href="acueil_recruteur.php">home</a>
            <a href="offre_emploi.php">Ajouter offre</a>
            <a href="#foot">Contact</a>
            <a href="mes_offres.php">mes offres</a>
            <a href="deconnexion_R.php">Deconnexion</a>
        </nav>
    </header>
<div class="sec1">
    <fieldset>
        <legend>Offre d'emploi</legend>
           <form action="" method="POST">
            <div><label>Nom de l'entreprise :</label>
                <input type="text" name="nom" ></div>
                <div><label>Domaine :</label>
                <input type="text" name="domaine"></div>
            <div><label>Titre de poste :</label>
                 <input type="text" name="poste" ></div>
            <div> <label>A propos de l'entreprise :</label>
                 <input name="desc" type="text"></div>
           <div> <label>Mission :</label>
                <input type="text" name="mission" ></div>
            <div><label>Pre-requis :</label>
                <input type="text" name="requis"></div>
                <div><label>Email :</label>
                <input type="email" name="email"></div>
            <div><button>Enregistrer</button></div>
           </form>        
    </fieldset>
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
    <h5 class="text-uppercase mb-4 font-weight-bold text-warning" > Contact</h5>
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