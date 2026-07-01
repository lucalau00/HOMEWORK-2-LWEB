<?php
require_once 'connection.php';
// Prendi i dati dal form
if ($_SERVER["REQUEST_METHOD"] == "POST") {
  $email = isset($_POST['email']) ? $_POST['email'] : '';
  $password = isset($_POST['password']) ? $_POST['password'] : '';

  $sql = "SELECT * FROM cliente WHERE email = ?";
  $stmt = $conn->prepare($sql);
  $stmt->bind_param("s", $email);
  $stmt->execute();
  $result = $stmt->get_result();
  $user = $result->fetch_assoc();
  

  if ($user) {
    if (password_verify($password, $user["password"])) {
          $_SESSION["email"] = $user["email"];
          $_SESSION["id_cliente"] = $user["id_cliente"];
          $_SESSION["loggedin"] = true;
          $_SESSION["CF"] = $user["CF"]; 

      
          header("Location: home2.php");
          exit();
      } else {
          $login_error = "Password non valida";
      }
  } else {
      $login_error = "email non valida";
  }

  $stmt->close();
}

$conn->close();
?>
<?xml version="1.0" encoding="UTF-8"?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN"
  "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">

<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="it" lang="it">

<head>
<title>login</title>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
    <link rel="stylesheet" type="text/css" href="css\style2.css" />
</head>

<body>


    <div class="container">
       
        <div class="left-panel">
          <img src="Immagini/login.jpg" /> 
          <h2>Vivi la tua prossima avventura!</h2>
          <p>Scopri il mondo con noi, un viaggio alla volta</p>
        </div>
    
        
        <div class="right-panel">
            <h1 class="logo">Scopri. Esplora. Vivi.</h1>
            <h2>Benvenuti a TravelUp!</h2>
           
          <form action="#" method="post" class="login-form">
          
            <label for="email">Email</label>
            <input type="email" id="email" name="email" placeholder="Inserisci email" required>
            <label for="password">Password</label>
            <input type="password" id="password" name="password" placeholder="Inserisci Password" required>
        
          <br/>
          <button type="submit" class="btn a" href = "home2.php">Accedi</button>
          <p class="signup">Non hai un account? </p>

           <a href= "account.php" type="submit" class="btn a"> Create Account</a> 
          </form>
        </div>
      </div>
    </body>
    </html>