<?php
// Start the session
session_start();

// Connect to the database
$db = mysqli_connect('localhost', 'root', '', 'projet');

// Check if the form was submitted
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
  // Get the input values from the form
  $username = $_POST['username'];
  $password = $_POST['password'];
  $confirm_password = $_POST['confirm_password'];
  $role = $_POST['role'];
  
  // Validate the input values
  $errors = array();
  
  if (empty($username)) {
    $errors[] = "Username is required";
  }
  
  if (empty($password)) {
    $errors[] = "Password is required";
  }
  
  if ($password != $confirm_password) {
    $errors[] = "Passwords do not match";
  }
  
  // Check if the username already exists in the database
  $query = "SELECT * FROM users WHERE username='$username'";
  $result = mysqli_query($db, $query);
  if (mysqli_num_rows($result) > 0) {
    $errors[] = "Username already exists";
  }
  
  // If there are no errors, insert the user into the database
  if (empty($errors)) {
    $query = "INSERT INTO users (username, password, role) VALUES ('$username', '$password', '$role')";
    mysqli_query($db, $query);
    
    // Redirect to the login page
    header('Location: connexion.php');
    exit();
  }
}

?>

<!DOCTYPE html>
<html>
<head>
  <title>Register</title>
  <style>
    body {
      font-family: Arial, sans-serif;
            /* Set background image */
     background-image: url('img/BACK1.jpeg');
      background-repeat: no-repeat;
      background-position: center center;
      margin: 0;
      padding: 0;
    }
    
    #container {
      width: 400px;
      margin: 0 auto;
      padding: 20px;
      border: 1px solid #ccc;
      background-color: #f8f8f8;
      /* Center the container horizontally and vertically */
      position: absolute;
      top: 50%;
      left: 50%;
      transform: translate(-50%, -50%);
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
    input[type="password"] {
      width: 100%;
      padding: 10px;
      margin-bottom: 20px;
      border: 1px solid #ccc;
      border-radius: 5px;
      box-sizing: border-box;
      font-size: 16px;
    }
    
    select {
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
      width: 100%;
      padding: 10px;
      border: none;
      border-radius: 5px;
      background-color: #4CAF50;
      color: #fff;
      font-size: 16px;
      cursor: pointer;
    }
    
    .error {
      color: red;
    }
  </style>
</head>
<body>
  <div id="container">
    <h1>Register</h1>
    
    <?php if (!empty($errors)): ?>
      <div class="error">
        <ul>
          <?php foreach ($errors as $error): ?>
            <li><?php echo $error; ?></li>
          <?php endforeach; ?>
        </ul>
      </div>
    <?php endif; ?>
    
    <form method="post">
      <label for="username">Username:</label>
      <input type="text" id="username" name="username" required>
      
      <label for="password">Password:</label>
      <input type="password" id="password" name="password" required>
      
      <label for="confirm_password">Confirm Password:</label>
      <input type="password" id="confirm_password" name="confirm_password" required>
      
      <label for="role">Role:</label>
      <select id="role" name="role">
        <option value="candidat">Candidat</option>
        <option value="recreteur">Recreteur</option>
      </select>
      
      <input type="submit" value="Register">
    </form>
    
    <p>Already have an account? <a href="login.php">Login here</a></p>
  </div>
</body>
</html>