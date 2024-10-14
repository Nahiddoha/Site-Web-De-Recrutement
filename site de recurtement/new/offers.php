<?php
include 'menu.php'; 
session_start();

// Vérifier si l'utilisateur est connecté en tant que recruteur
if (!isset($_SESSION['user_id'])) {
    header('Location: connexion.php');
    exit();
}

// Récupérer l'identifiant du recruteur connecté
$recruteur_id = $_SESSION['user_id'];

// Se connecter à la base de données
$dsn = 'mysql:host=localhost;dbname=projet';
$username = 'root';
$password = '';
$options = array(
    PDO::MYSQL_ATTR_INIT_COMMAND => 'SET NAMES utf8',
);
$pdo = new PDO($dsn, $username, $password, $options);

// Préparer et exécuter la requête SQL pour récupérer les offres d'emploi du recruteur
$sql = "SELECT * FROM offres WHERE recruteur_id = ?";
$stmt = $pdo->prepare($sql);
$stmt->execute([$recruteur_id]);
$offres = $stmt->fetchAll();

?>

<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>Mes offres d'emploi</title>
    <style>
body {

  font-family: Arial, sans-serif;
      background-color: #f2f2f2;
    }

    h1 {
      text-align: center;
      margin-top: 50px;
    }

    table {
      border-collapse: collapse;
      margin: 50px auto;
      width: 80%;
      background-color: #fff;
      box-shadow: 0 0 10px rgba(0, 0, 0, 0.2);
    }

    th,
    td {
      padding: 10px;
      text-align: left;
    }

    th {
      background-color: #555;
      color: #fff;
    }

    tr:nth-child(even) {
      background-color: #f2f2f2;
    }

    a {
      display: inline-block;
      padding: 10px;
      background-color: #555;
      color: #fff;
      text-decoration: none;
      margin: 20px 0;
    }

    a:hover {
      background-color: #333;
    }

    </style>
</head>
<body>
    <h1>Mes offres d'emploi</h1>
    <a href="ajouter_offre.php">Ajouter une offre d'emploi</a>
    <table>
        <thead>
            <tr>
                <th>Titre</th>
                <th>Description</th>
                <th>Exigences</th>
                <th>Action</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($offres as $offre): ?>
                <tr>
                    <td><?= $offre['titre'] ?></td>
                    <td><?= $offre['description'] ?></td>
                    <td><?= $offre['exigences'] ?></td>
                    <td>
                        <a href="modifier_offre.php?id=<?= $offre['id'] ?>">Modifier</a>
                        <a href="supprimer_offre.php?id=<?= $offre['id'] ?>"  onclick="return confirmerSuppression()">Supprimer</a>
                    </td>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
</body>
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