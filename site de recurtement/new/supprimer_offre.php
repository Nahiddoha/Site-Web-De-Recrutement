<?php
// Vérifier si l'utilisateur est connecté en tant que recruteur
session_start();
if (!isset($_SESSION['user_id'])) {
    header('Location: connexion.php');
    exit();
}

// Vérifier si l'identifiant de l'offre a été fourni dans l'URL
if (!isset($_GET['id'])) {
    header("Location: mes_offres.php");
    exit();
}

// Récupérer l'identifiant de l'offre à supprimer
$id = $_GET['id'];

// Connexion à la base de données
$conn = mysqli_connect("localhost", "root", "", "projet");
if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}

// Vérifier si l'offre appartient au recruteur connecté
$recruteur_id = $_SESSION['user_id'];
$sql = "SELECT * FROM offres WHERE id='$id' AND recruteur_id='$recruteur_id'";
$result = mysqli_query($conn, $sql);
if (mysqli_num_rows($result) == 0) {
    mysqli_close($conn);
    header("Location: mes_offres.php");
    exit();
}

// Supprimer l'offre de la base de données
$sql = "DELETE FROM offres WHERE id='$id'";
if (mysqli_query($conn, $sql)) {
    mysqli_close($conn);
    header("Location: offers.php");
    exit();
} else {
    echo "Erreur lors de la suppression de l'offre: " . mysqli_error($conn);
}

mysqli_close($conn);
?>
