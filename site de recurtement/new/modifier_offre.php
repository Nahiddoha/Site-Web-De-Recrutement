<?php
// Vérification si l'utilisateur est connecté en tant que recruteur
session_start();
include 'menu.php'; 
if (!isset($_SESSION['user_id'])) {
    header('Location: connexion.php');
    exit();
}

// Récupération de l'ID de l'offre à modifier depuis l'URL
if (!isset($_GET['id'])) {
    header('Location: offres.php');
    exit;
}
$id = $_GET['id'];

// Récupération des informations de l'offre à modifier depuis la base de données
$host = 'localhost';
    $username = 'root';
    $password = '';
    $database = 'projet';
$conn = new mysqli($host, $username, $password, $database);
$sql = "SELECT * FROM offres WHERE id = $id AND recruteur_id = " . $_SESSION['user_id'];
$result = mysqli_query($conn, $sql);
$offre = mysqli_fetch_assoc($result);

// Vérification si l'offre à modifier appartient bien à l'utilisateur connecté
if (!$offre) {
    header('Location: offres.php');
    exit;
}

// Traitement du formulaire de modification d'offre
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $title = $_POST['title'];
    $description = $_POST['description'];
    $requirements = $_POST['requirements'];

    $sql = "UPDATE offres SET titre = '$title', description = '$description', exigences = '$requirements' WHERE id = $id AND recruteur_id = " . $_SESSION['recruteur_id'];
    mysqli_query($conn, $sql);

    header('Location: mes_offres.php');
    exit;
}

// Affichage du formulaire de modification d'offre
?>
<!DOCTYPE html>
<html>
<head>
    <title>Modifier l'offre "<?php echo $offre['titre']; ?>"</title>
    
</head> 
<style>
form {
  max-width: 600px;
  margin: 0 auto;
  padding: 20px;
  background-color: #f7f7f7;
  border-radius: 10px;
}

form label {
  display: block;
  margin-bottom: 8px;
}

form input[type="text"],
form textarea {
  width: 100%;
  padding: 12px;
  border: 1px solid #ccc;
  border-radius: 4px;
  box-sizing: border-box;
  margin-bottom: 16px;
}

form textarea {
  height: 200px;
}

form input[type="submit"] {
  background-color: #4CAF50;
  color: #fff;
  border: none;
  padding: 12px 20px;
  border-radius: 4px;
  cursor: pointer;
}

form input[type="submit"]:hover {
  background-color: #45a049;
}


</style>
<body>
    <h1>Modifier l'offre "<?php echo $offre['titre']; ?>"</h1>

    <form method="POST">
        <label for="title">Titre :</label>
        <input type="text" id="title" name="title" value="<?php echo $offre['titre']; ?>">

        <label for="description">Description :</label>
        <textarea id="description" name="description"><?php echo $offre['description']; ?></textarea>

        <label for="requirements">Exigences :</label>
        <textarea id="requirements" name="requirements"><?php echo $offre['exigences']; ?></textarea>

        <input type="submit" value="Enregistrer les modifications">
    </form>
</body>
</html>
