<?php 
session_start();
// Connexion à la base de données
$conn = mysqli_connect("localhost", "root", "", "siterec");

if($_SERVER['REQUEST_METHOD']==='POST'){
// Récupération des données du formulaire
$nom = $_POST["nom"];
$prenom = $_POST["prenom"];
$email = $_POST["email"];
$password=$_POST["password"];
$sex = $_POST["sex"];
$passwordconf = $_POST["passwordconf"];
$fonctionnalite = $_POST["fonctionnalite"];
$societe = $_POST["societe"];
$secteur = $_POST["secteur"];

// Validate the input values
  $errors = array();
  if (empty($email)) {
    $errors[] = "Email est vide";
  }
  if (empty($password)) {
    $errors[] = "Password est vide";
  }
  if ($password != $passwordconf) {
    $errors[] = "Password nest pas compatible";
  }
   $query = "SELECT * FROM recruteur WHERE email='$email'";
   $result = mysqli_query($conn, $query);
  if (mysqli_num_rows($result) > 0) {
    $errors[] = "Username already exists";
  }

// Insertion des données dans la table "recruteur"
if (empty($errors)) {
  $sql="INSERT INTO recruteur (nom, prenom, email, password, sex, fonctionnalite, societe, secteur) 
  VALUES ('$nom', '$prenom', '$email', '$password', '$sex', '$fonctionnalite', '$societe', '$secteur');";
  mysqli_query($conn, $sql);
if($sql){
    $result=mysqli_query($conn,"SELECT * from recruteur where email='$email'");
    $row=mysqli_fetch_assoc($result);
    $_SESSION['id_recruteur']=$row['id_recruteur'];
}
// Redirect to the login page
header('Location: connecter_R.php');
exit();
}
}
?>



<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>recruteur </title>
    <style>
 body{
    padding:0px;
    margin: 0px; 
    background-color: whitesmoke;
 }

fieldset{
    background-color: #a0caf5;
    border-radius: 20px;
    color:black;
    height: 600px;
    margin: 50px auto;
    width: 700px;
    border: 3px solid white;
    font-size: 15px;
}

.connexion {
   margin: 20px 35px;
   color: whitesmoke;
   background-color: #3b8bdc;
   width: 150px;
   font-size: 17px;
   border-radius: 20px;
   border:1px solid black;
   padding: 10px;
   margin-left: 90px;

}
.connexion:hover{
    background-color: blue;
    transform: scale(1.2,1.2);
    transition: 1.3s;
}
.sih{
  color: gray;
  font-size: 16px;
  border: none;
  outline: none;
  background: none;
  border-bottom: 1px solid white;
  margin-left: 10px;
  width: 100%;
}
.sih1{
  font-size: 16px;
  margin-top: 20px;
  background: none;
  padding-top: 10px;
}

.con{
  display: flex;
  text-align: center;
  align-items: center;
  justify-content: center;
}

p,a{
  text-decoration: none;
  font-size: 20px;
  font-weight: 400;
  margin-bottom: 20px;
}
legend{
  font-size: 30px;
  font-weight: 500;
  color: black;
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
<body>

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

<legend>Inscription Recruteur</legend>
<form method="POST" action="">
    <table>

<tr >
    <td >Nom        :</td>
    <td >  <input type="text" name="nom" placeholder="entrer un nom" class="sih"> <br><br> </td> 
</tr>

<tr>
    <td>Prenom     :</td>
    <td> <input type="text" name="prenom" placeholder="entrer un prenom" class="sih"><br><br> </td>
</tr>

<tr>
    <td class="h1">Email     :</td>
    <td><input type="email" name="email" placeholder="exemple@gmail.com " class="sih"><br><br> </td>
</tr>

<tr>
    <td class="h1">Password     :</td>
    <td><input type="password" name="password" placeholder="entrer password " class="sih"><br><br> </td>
</tr>

<tr>
    <td class="h1">Confirme Password     :</td>
    <td><input type="password" name="passwordconf" placeholder="renter password " class="sih"><br><br> </td>
</tr>

<tr>
    <td>Sex    :</td>
    <td>
    <input type="radio" name="sex" value="F" > Feminin
    <input type="radio" name="sex" value="M" > Masculin <br><br>
    </td>
</tr>

<tr>
    <td>Fonctionnalite :</td>
    <td><input type="text" name="fonctionnalite" placeholder="entrer  votre fonctialite"class="sih"><br><br> </td>
</tr>

<tr>
    <td>Societe   :</td>
    <td><input type="text" name="societe" placeholder="entrer votre societe" class="sih"><br><br> </td>
</tr>

<tr>
    <td>Secteur    :</td>
    <td><select class="sih1" name="secteur">
    <option>Informatique</option>
    <option>Electronique</option>
    <option>Commerce</option>
    </select><br><br></td>
</tr>

<tr>
    <td><input type="submit" value="enregistrer" class="connexion"><br><br>
</tr>

</table>
</form>
</fieldset> 
</body>
</html>