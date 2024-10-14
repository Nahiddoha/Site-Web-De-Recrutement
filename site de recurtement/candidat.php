<?php
session_start();
// Connexion à la base de données
$host = "localhost"; // nom de l'hôte
$user = "root"; // nom d'utilisateur
$password = ""; // mot de passe
$database = "siterec"; // nom de la base de données

$conn = mysqli_connect($host, $user, $password, $database);
if (!$conn) {die("La connexion a échoué : " . mysqli_connect_error());}
// Vérification si le formulaire a été soumis
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Récupération des valeurs du formulaire
    $nom = $_POST["nom"];
    $prenom = $_POST["prenom"];
    $email = $_POST["email"];
    $password = $_POST["password"];
    $passwordconf = $_POST["passwordconf"];
    $domaine = $_POST["domaine"];
    $Sexe = $_POST["Sexe"];

  // Validate the input values
  $errors = array();
  
  if (empty($email)) {
    $errors[] = "email is required";
  }
  
  if (empty($password)) {
    $errors[] = "Password is required";
  }
  
  if ($password != $passwordconf) {
    $errors[] = "Passwords do not match";
  }

 
  // Check if the username already exists in the database
  $query = "SELECT * FROM condidat WHERE email='$email'";
  $result = mysqli_query($conn, $query);
  if (mysqli_num_rows($result) > 0) {
    $errors[] = "Username already exists";
  }
  
  // If there are no errors, insert the user into the database
  if (empty($errors)) {
    $query = "INSERT INTO condidat (nom, prenom, email,password,domaine,Sexe)
    VALUES ('$nom', '$prenom', '$email','$password','$domaine','$Sexe');";
    mysqli_query($conn, $query);

    if($sql){
      $result=mysqli_query($conn,"SELECT * from condidat where email='$email'");
      $row=mysqli_fetch_assoc($result);
      $_SESSION['id_candidat']=$row['id_candidat'];
  }
    // Redirect to the login page
    header('Location: connecter_C.php');
    exit();
  }
}



// Fermeture de la connexion
mysqli_close($conn);
?>
<!DOCTYPE html>
<html>
    <head>
        <title>
            LSID Inscription
</title>
    <style>
  body {
  font-family: Arial, sans-serif;
  margin: 0;
  padding: 0;
  background-color: whitesmoke;
  background-size: cover;
  background-attachment: fixed;
}

a {
  text-decoration: none;
  color: #a844a8;
  font-size: 1.1em;
  font-weight: 400;
}

fieldset {
  margin: 10px auto;
  width: 60%;
  background-color: #a0caf5;
  border-radius: 15px;
  border: 3px solid white;
  box-shadow: 0px 0px 5px #ddd;
  margin-top: 5px;
}

legend {
  font-size: 1.2em;
  font-weight: bold;
  font-family: Arial;
  color: ghostwhite;
}


table {
  margin: 0 ;
  padding: 0 ;
}

td {

  font-weight: bold;
}

input[type="text"],
input[type="email"],
input[type="password"],
select {
  padding: 5px;
  border-radius: 10px;
  border: 1px solid #ddd;
  width: 60%;
  box-sizing: border-box;
  margin-bottom: 5px;
}

.sihi {
  display: block;
  width: 100%;
}

.sihi1 {
  margin-right: 10px;
}

button {
  background-color: #0066cc;
  color: #fff;
  padding: 10px 20px;
  border-radius: 5px;
  border: none;
  cursor: pointer;
  font-size: 1.2em;
  margin-top: 20px;
}

button:hover {
  background-color: #004b8f;
}

p {
  text-align: center;
  font-size: 1.1em;
  color: #333;
  margin-bottom: 0;
}

p a {
  color: #0066cc;
}

p a:hover {
  text-decoration: underline;
}
.error{
    color: red;
    font-size: 20px;
    font-weight: 500;
    display: flex;
    justify-content: center;
}
    </style> 
    </head>

<body >
    <fieldset >

    <?php if (!empty($errors)): ?>
      <div class="error">
        <ul>
          <?php foreach ($errors as $error): ?>
            <li><?php echo $error; ?></li>
          <?php endforeach; ?>
        </ul>
      </div>
    <?php endif; ?>

    <legend  > Inscription du candidat</legend>
        <form method ="POST" action ="">
        <table>
        <tr>
            <td>
                Nom:
            </td>
            <td>
                <input type ="text" name="nom" placeholder ="saisir votre nom " class="sih"><br><br>
            </td>
        </tr>
        <tr>
            <td>
                Prenom:
            </td>
            <td>
                <input type ="text" name="prenom" placeholder ="saisir votre prenom " class="sih"><br><br>
            </td>
        </tr>
        <tr>
            <td>
                Email:
            </td>
            <td>
                <input type ="email" name="email" placeholder ="saisir votre email "class="sih"><br><br>
            </td>
        </tr>
        <tr>
            <td>
            mot de passe:
        </td>
        <td>
            <input type ="password" name="password" placeholder ="saisir votre mot de passe "class="sih"><br><br>
        </td>
        </tr>
        <tr>
            <td>
                confirmer le mot de passe:
            </td>
            <td width =50%>
                <input type ="password" name="passwordconf" placeholder ="confirmer votre mot de passe "class="sih"><br><br>
            </td>
        </tr>
        <tr>
            <td>
    Domaine d'activité:
            </td>
            <td>
                <select name="domaine" >
                    <option value="informatique" selected="selected" >informatique</option>
                    <option value="Electronique" selected="selected" >Electronique</option>
                    <option value="Energitique" selected="selected" >Energitique</option>
                    <option value="mécanique" selected="selected" >mécanique</option>
                </select>
                <br><br>
            </td>
        </tr>
        <tr>
            <td>
                Sexe:
            </td>
            <td >
                <input type ="radio" name="Sexe" value="masculin" class="sih1"> Masculin
                <input type ="radio" name="Sexe" value="féminin"  class="sih1" > Feminin
                <br> <br>
            </td>
        </tr>
        <tr>
            <td>
            </td>
            <td  >
               <button >S'inscrire</button>
            </td>
          </tr>
        </table>
</form>
</fieldset>
</body>

</html>