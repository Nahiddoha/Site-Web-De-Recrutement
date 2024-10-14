<?php
// Vérifier si l'utilisateur est connecté en tant que recruteur
session_start();
include 'menu.php'; 
if (!isset($_SESSION['user_id'])) {
  header('Location: connexion.php');
  exit();
}

// Traitement du formulaire de publication d'offre
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
  $errors = [];
  
  // Validation des données du formulaire
  $title = trim($_POST['title']);
  if (empty($title)) {
    $errors[] = 'Title is required';
  }
  
  $description = trim($_POST['description']);
  if (empty($description)) {
    $errors[] = 'Description is required';
  }
  
  $requirements = trim($_POST['requirements']);
  if (empty($requirements)) {
    $errors[] = 'Requirements are required';
  }
  
  // Si aucune erreur de validation n'a été trouvée
  if (empty($errors)) {
    // Connexion à la base de données
    $host = 'localhost';
    $username = 'root';
    $password = '';
    $database = 'projet';
    $conn = new mysqli($host, $username, $password, $database);
    if ($conn->connect_error) {
      die('Connection failed: ' . $conn->connect_error);
    }
    
    // Échapper les données du formulaire pour éviter les injections SQL
    $title = $conn->real_escape_string($title);
    $description = $conn->real_escape_string($description);
    $requirements = $conn->real_escape_string($requirements);
    $recruteur_id = $_SESSION['user_id'];
    
    // Insérer l'offre dans la base de données
    $sql = "INSERT INTO offres (titre, description, exigences, recruteur_id) VALUES ('$title', '$description', '$requirements', '$recruteur_id')";
    if ($conn->query($sql) === TRUE) {
      // Rediriger vers la page d'accueil des recruteurs
      header('Location: offers.php');
      exit();
    } else {
      echo 'Error: ' . $sql . '<br>' . $conn->error;
    }
    
    // Fermer la connexion à la base de données
    $conn->close();
  }
}
?>

<!DOCTYPE html>
<html>
<head>
  <title>Post a job offer</title>
  <style>
    body {
      font-family: Arial, sans-serif;
      margin: 0;
      padding: 0;
    }
    
    #container {
      width: 600px;
      margin: 0 auto;
      padding: 20px;
      border: 1px solid #ccc;
      background-color: #f8f8f8;
    }
    
    h1 {
      font-size: 24px;
      margin: 0 0 20px 0;
    }
    
    label {
      display: block;
      font-size: 16px;
      margin-bottom: 5px;
    }
    
    input[type="text"],
    textarea {
      width: 100%;
      padding: 10px;
      margin-bottom: 20px;
      border: 1px solid #ccc;
      border-radius: 5px;
      box-sizing: border-box;
      font-size: 16px;
    }
    
    input[type="submit"] {
        display: block;
      padding: 10px;
      background-color: #4CAF50;
      color: white;
      border: none;
      border-radius: 5px;
      font-size: 18px;
      cursor: pointer;
    }
    
    input[type="submit"]:hover {
      background-color: #3e8e41;
    }
    
    .error {
      color: red;
      margin-bottom: 10px;
    }
  </style>
</head>
<body>
  <div id="container">
    <h1>Post a job offer</h1>
    <?php if (!empty($errors)): ?>
      <div class="error">
        <ul>
          <?php foreach ($errors as $error): ?>
            <li><?= $error ?></li>
          <?php endforeach; ?>
        </ul>
      </div>
    <?php endif; ?>
    <form method="POST">
      <label for="title">Title</label>
      <input type="text" id="title" name="title">
      <label for="description">Description</label>
      <textarea id="description" name="description"></textarea>
      <label for="requirements">Requirements</label>
      <textarea id="requirements" name="requirements"></textarea>
      <input type="submit" value="Submit">
    </form>
  </div>
</body>
</html>

