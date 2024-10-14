<?php
include 'header.php'; ?>
<!DOCTYPE html>
<html>
<head>
	<title>Liste des offres</title>
	
</head>
<style>

body {
  font-family: Arial, sans-serif;
}

.container {
  max-width: 800px;
  margin: 0 auto;
  padding: 20px;
}

h1 {
  text-align: center;
  margin-bottom: 30px;
}

.offre {
  border: 1px solid #ddd;
  margin-bottom: 20px;
  padding: 20px;
}

.offre h2 {
  margin-top: 0;
}

.offre p {
  margin-bottom: 20px;
}

.offre label {
  display: block;
  margin-bottom: 10px;
}

.offre textarea {
  width: 100%;
  height: 100px;
  padding: 10px;
  margin-bottom: 20px;
  border: 1px solid #ddd;
  box-sizing: border-box;
}

.offre input[type="submit"] {
  background-color: #4CAF50;
  color: white;
  padding: 10px 20px;
  border: none;
  border-radius: 4px;
  cursor: pointer;
}

.offre input[type="submit"]:hover {
  background-color: #45a049;
}

.error {
  color: red;
  margin-bottom: 10px;
}

</style>
<body>
	<?php
	// Connexion à la base de données
	$db_host = "localhost";
	$db_user = "root";
	$db_pass = "";
	$db_name = "projet";
	$conn = mysqli_connect($db_host, $db_user, $db_pass, $db_name);
	if (!$conn) {
	    die("Connexion échouée: " . mysqli_connect_error());
	}

	// Vérification si un utilisateur est connecté
	session_start();
    if (!isset($_SESSION['user_id'])) {
        header('Location: connexion.php');
        exit();
    }
	$user_id = $_SESSION["user_id"];

	// Traitement du formulaire de candidature
	if (isset($_POST["submit_candidature"])) {
	    $offre_id = $_POST["offre_id"];
	    $motivation = $_POST["motivation"];
	    $query = "INSERT INTO candidatures (candidat_id, offre_id, motivation) VALUES ('$user_id', '$offre_id', '$motivation')";
	    mysqli_query($conn, $query);
	    header("Location: candidature.php");
	    exit();
	}

	// Récupération des offres existantes
	$query = "SELECT * FROM offres";
	$result = mysqli_query($conn, $query);
	?>

	<div class="container">
		<h1>Liste des offres</h1>

		<?php
		// Affichage des offres avec formulaire de candidature
		while ($row = mysqli_fetch_assoc($result)) {
		    echo "<div class='offre'>";
		    echo "<h2>" . $row["titre"] . "</h2>";
		    echo "<p>" . $row["description"] . "</p>";
		    echo "<form method='post'>";
		    echo "<input type='hidden' name='offre_id' value='" . $row["id"] . "'>";
		    echo "<label for='motivation'>Motivation :</label><br>";
		    echo "<textarea name='motivation' required></textarea><br>";
		    echo "<input type='submit' name='submit_candidature' value='Postuler'>";
		    echo "</form>";
		    echo "</div>";
		}
		?>

		<a href="deconnexion.php" class="deconnexion">Déconnexion</a>
	</div>

	<?php
	// Fermeture de la connexion à la base de données
	mysqli_close($conn);
	?>
</body>
</html>
