<?php
session_start();

// If form is submitted
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
  
    // Get form data
    $email = $_POST['email'];
    $password = $_POST['password'];
    
    // Connect to database
    $pdo = new PDO('mysql:host=localhost;dbname=siterec', 'root', '');
    
    // Prepare SQL query to retrieve user with matching username
    $stmt = $pdo->prepare('SELECT * FROM condidat WHERE email = ?');
    $stmt->execute([$email]);
    $cand = $stmt->fetch();

  // Verify password 
  if ($cand && ($password===$cand['password'])) {
      $_SESSION['id_candidat'] = $cand['id_candidat'];
      header('Location: acueil_condidat.php');
    exit;
  } else {
    // If credentials are invalid, display error message
    $error_message = 'Invalid email or password';
  }
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>se connecter</title>

    <style>
 body,html{
    background-image: url(images/BACK3.jpg);
    background-size: cover;
    margin: 0;
    padding: 0;
}
.m1{
    color: rgb(148, 96, 96);
}
h1{
    border: 1px solid black;
    width: 300px;
    border-radius: 10px;
    box-shadow: #318ce7 3px 3px 3px;
    background-color: rgb(210, 210, 210);
}
.con{
    color: #318ce7;
    display: flex;
    justify-content: center;
    align-items: center;
    text-align: center;
    font-size: 50px;
    font-weight: 800;
    margin-top: 100px;
}
fieldset{
    padding-top: 40px;
    margin-top: 30px;
    background-color: rgba(255, 255, 255, 0.5);
    height: 350px;
}
.main{
     text-align: center;
     margin-top: auto;
}

input[type="email"],input[type="password"]{
    font-size: 20px;
    font-weight: 100;
    color: black;
    margin: 5px;
    background-color: white;
    border-radius: 20px;
    padding: 10px 30px;
    border: none;

}
.connexion {
    margin-bottom: 10px;
    color: whitesmoke;
    background-color: #318ce7;
    width: 10%;
    font-size: 17px;
    border-radius: 20px;
    border:1px solid black;
    padding: 12px 30px;
 }
 .connexion:hover{
     background-color: white;
     color: #318ce7;
     transform: scale(1.2,1.2);
     transition: 1.3s;
 }
 p,a{
    font-size: 25px;
    font-weight: 300;
    text-decoration: none;
    letter-spacing: 1x;
 }
    </style>

</head>
<body>
    <h1>LSID<em class="m1">recrutement</em></h1>
    <div >
        <em class="con">Connexion Candidat</em>
    </div>
    <fieldset>

    <?php if (isset($error_message)): ?>
      <p class="error"><?php echo $error_message;?></p>
    <?php endif; ?>

    <form class="main" action="" method="POST">
        <input type="email" name="email" placeholder="entrer votre email"> </br>
        <input type="password" name="password"  id="pass"  placeholder="entrer votre password"> 
       </br>
        <input type="submit" value="connexion" class="connexion"> </br></br>
        <p>N'avez pas de compte?<a href="candidat.php" >S'inscrire</a></p>
    </form>   
    </fieldset>
</body>
</html>