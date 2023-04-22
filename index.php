<?php
  session_start();

  require 'database.php';

  if (isset($_SESSION['user_id'])) {
    $records = $conn->prepare('SELECT id, email, password FROM users WHERE id = :id');
    $records->bindParam(':id', $_SESSION['user_id']);
    $records->execute();
    $results = $records->fetch(PDO::FETCH_ASSOC);

    $user = null;

    if (count($results) > 0) {
      $user = $results;
    }
  }
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://fonts.googleapis.com/css?family=Roboto" rel="stylesheet">
    <link rel="stylesheet" href="assets/css/style.css">
    <title>Login</title>
</head>
<body>
<img src="assets/img/header.jpg" width= "100%" alt="Responsive image">  
  
<h1>Login ¿Que Cocinar?</h1>

<?php require 'partials/header.php' ?>

<?php if(!empty($user)): ?>
  <br> Bienvenido. <?= $user['email']; ?>
  <br>Logueaste con exito!!
  <a href="logout.php">Salir</a>
<?php else: ?>
  <h1>Por favor Login o Registrese</h1>

  <a href="login.php">Login</a> or
  <a href="signup.php">Registrarse</a>
<?php endif; ?>
</body>
</html>
