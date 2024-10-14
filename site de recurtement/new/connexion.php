<?php

session_start();

// If user is already logged in, redirect to dashboard
if (isset($_SESSION['user_id'])) {
  if ($_SESSION['user_role'] == 'candidat') {
    header('Location: candidature.php');
  } else {
    header('Location: offers.php');
  }
  exit;
}

// If form is submitted
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
  
  // Get form data
  $username = $_POST['username'];
  $password = $_POST['password'];
  
  // Connect to database
  $pdo = new PDO('mysql:host=localhost;dbname=projet', 'root', '');
  
  // Prepare SQL query to retrieve user with matching username
  $stmt = $pdo->prepare('SELECT id, username, role, password FROM users WHERE username = ?');
  $stmt->execute([$username]);
  $user = $stmt->fetch();
  
  // Verify password 
  if ($user && ($password==$user['password'])) {
    // If credentials are valid, set session variables and redirect to appropriate page
    $_SESSION['user_id'] = $user['id'];
    $_SESSION['user_role'] = $user['role'];
    if ($user['role'] == 'candidat') {
      header('Location: candidature.php');
    } else {
      header('Location: offers.php');
    }
    exit;
  } else {
    // If credentials are invalid, display error message
    $error_message = 'Invalid username or password';
  }
}

?>

<!DOCTYPE html>
<html>
<head>
  <title>Login</title>
  <style>   
   body {
      font-family: Arial, sans-serif;
      margin: 0;
      padding: 0;
      /* Set background image */
      background-image: url('img/BACK1.jpeg');
      background-repeat: no-repeat;
      background-position: center center;
      background-size: cover;
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
    
    input[type="submit"] {
      display: block;
      width: 100%;
      padding: 10px;
      background-color: #4CAF50;
      color: #fff;
      border: none;
      border-radius: 5px;
      font-size: 16px;
      cursor: pointer;
    }
    
    input[type="submit"]:hover {
      background-color: #3e8e41;
    }
    
    .error {
      color: #f00;
      font-size: 16px;
      margin-bottom: 20px;
    }
  </style>
</head>
<body>
  
  <div id="container">
  
    <h1>Login</h1>
    
    <?php if (isset($error_message)): ?>
      <p class="error"><?php echo $error_message;echo $_POST['password']; ?></p>
    <?php endif; ?>
    
    <form method="POST">
      <label for="username">Username:</label>
      <input type="text" name="username" required>
      <label for="password">Password:</label>
      <input type="password" name="password" required>
      <input type="submit" value="Login">
    </form>
    <p>Don't have an account? <a href="register.php">Register</a></p>
  </div>
  
</body>
</html>