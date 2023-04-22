<?php


session_start(); // Inicia la sesión del usuario

if (isset($_SESSION['user_id'])) { // Verifica si el usuario ya ha iniciado sesión y si es así, lo redirecciona a la página principal
    header('Location: /login-php');
}

require 'database.php'; // Incluye el archivo de conexión a la base de datos

if (!empty($_POST['email']) && !empty($_POST['password'])) { // Verifica si los campos de email y contraseña no están vacíos
    $records = $conn->prepare('SELECT id, email, password FROM users WHERE email = :email'); // Prepara una consulta para obtener el id, email y password de un usuario con el email ingresado
    $records->bindParam(':email', $_POST['email']); // Vincula el parámetro :email con el valor del email ingresado
    $records->execute(); // Ejecuta la consulta preparada
    $results = $records->fetch(PDO::FETCH_ASSOC); // Obtiene el resultado de la consulta como un arreglo asociativo

    $message = ''; // Define una variable para almacenar mensajes de error o éxito

    if (count($results) > 0 && password_verify($_POST['password'], $results['password'])) { // Verifica si se obtuvieron resultados de la consulta y si la contraseña ingresada coincide con la contraseña almacenada en la base de datos
        $_SESSION['user_id'] = $results['id']; // Almacena el id del usuario en la sesión
        header("Location: /login-php"); // Redirecciona al usuario a la página principal
    } else {
        $message = 'Algo escribio mal, intente de nuevo'; // Si la autenticación falla, muestra un mensaje de error
    }
}

?>


<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <title>Login</title>
    <link href="https://fonts.googleapis.com/css?family=Roboto" rel="stylesheet">
    <link rel="stylesheet" href="assets/css/style.css">
  </head>
  <body>

  <img src="assets/img/header.jpg" width= "100%" alt="Responsive image">  
    <?php require 'partials/header.php' ?>

    <?php if(!empty($message)): ?>
      <p> <?= $message ?></p>
    <?php endif; ?>

    <h1>Login</h1>
    <span>O <a href="signup.php">Registrarse</a></span>

    <form action="login.php" method="POST">
      <input name="email" type="text" placeholder="Escriba su Usuario">
      <input name="password" type="password" placeholder="Escriba su contraseña">
      <input type="submit" value="Submit">
    </form>
  </body>
</html>