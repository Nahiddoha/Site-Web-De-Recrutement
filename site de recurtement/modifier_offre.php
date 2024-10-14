<?php
// Vérification si l'utilisateur est connecté en tant que recruteur
session_start();

if (!isset($_SESSION['id_recruteur'])) {
    header('Location: connecter_R.php');
    exit();
} else {
    $id_recruteur = $_SESSION["id_recruteur"];
    $host = 'localhost';
    $username = 'root';
    $password = '';
    $database = 'siterec';
    $conn = new mysqli($host, $username, $password, $database);
    $id_recruteur = mysqli_real_escape_string($conn, $id_recruteur);
    $sql = "SELECT * FROM offre_emp WHERE id_recruteur = '$id_recruteur'AND id_recruteur = '$id_recruteur'";
    $result = mysqli_query($conn, $sql);
    $offre = mysqli_fetch_assoc($result);

    if (!$offre) {
        header('Location: offre_emploi.php');
        exit();
    }

    // Handle form submission
    if ($_SERVER["REQUEST_METHOD"] === "POST") {
        $nom = mysqli_real_escape_string($conn, $_POST["nom"]);
        $domaine = mysqli_real_escape_string($conn, $_POST["domaine"]);
        $poste = mysqli_real_escape_string($conn, $_POST["poste"]);
        $desc = mysqli_real_escape_string($conn, $_POST["desc"]);
        $mission = mysqli_real_escape_string($conn, $_POST["mission"]);
        $requis = mysqli_real_escape_string($conn, $_POST["requis"]);
        $email = mysqli_real_escape_string($conn, $_POST["email"]);

        // Method to update data in database
        $sql = "UPDATE `offre_emp` SET nom='$nom', domaine='$domaine', poste='$poste', `desc`='$desc',
             mission='$mission', requis='$requis', email='$email' WHERE id_recruteur='$id_recruteur' AND id_recruteur = '$id_recruteur'";
        mysqli_query($conn, $sql);
        header('Location: mes_offres.php');
        exit();
    }

?>
    <!DOCTYPE html>
    <html lang="en">

    <head>
        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>modifier_offre</title>
        <style>
            body {
                display: flex;
                justify-content: center;
                align-items: center;
                background-image: url();
            }

            fieldset {
                border: 3px solid black;
                border-radius: 10px;
                width: 50%;
                text-align: center;
                background-color: #a0caf5;
            }

            legend {
                font-size: 30px;
                font-weight: 800;
                font-family: Arial, Helvetica, sans-serif;
            }

            label {
                display: block;
                font-weight: bold;
                margin-top: 10px;
            }

            input[type="text"],
            input[type="email"] {
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

            button:hover {
                background-color: blue;
                transform: scale(1.2, 1.2);
                transition: 1.7s;
            }
        </style>
    </head>

    <body>
        <fieldset>
            <legend>Modifier offre</legend>
            <form action="" method="POST">
                <h3>Modifier offre numero <?php echo $offre['poste']; ?></h3>
                <div><label>Nom de l'entreprise :</label>
                    <input type="text" name="nom" value="<?php echo $offre['nom']; ?>">
                </div>
                <div><label>Domaine :</label>
                    <input type="text" name="domaine" value="<?php echo $offre['domaine']; ?>">
                </div>
                <div><label>Titre de poste :</label>
                    <input type="text" name="poste" value="<?php echo $offre['poste']; ?>">
                </div>
                <div> <label>A propos de l'entreprise :</label>
                    <input name="desc" type="text" value="<?php echo $offre['desc']; ?>">
                </div>
                <div> <label>Mission :</label>
                    <input type="text" name="mission" value="<?php echo $offre['mission']; ?>">
                </div>
                <div><label>Pre-requis :</label>
                    <input type="text" name="requis" value="<?php echo $offre['requis']; ?>">
                </div>
                <div><label>Email :</label>
                    <input type="email" name="email" value="<?php echo $offre['email']; ?>">
                </div>
                <div><button>Modifier</button></div>
            </form>
        </fieldset>
    </body>

    </html>
<?php } ?>