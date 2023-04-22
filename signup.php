<?php

// Incluir archivo de conexión a la base de datos
require 'database.php';

// Inicializar variable mensaje
$message = '';

// Verificar si los campos de email y password en el formulario no están vacíos
if (!empty($_POST['email']) && !empty($_POST['password'])) {

  // Preparar la consulta SQL para insertar el email y el password en la tabla "users"
  $sql = "INSERT INTO users (email, password) VALUES (:email, :password)";

  // Preparar la sentencia de la consulta y vincular los parámetros
  $stmt = $conn->prepare($sql);
  $stmt->bindParam(':email', $_POST['email']);

  // Hash de la contraseña y vinculación del parámetro de contraseña
  $password = password_hash($_POST['password'], PASSWORD_BCRYPT);
  $stmt->bindParam(':password', $password);

  // Ejecutar la consulta y verificar si se ha insertado correctamente
  if ($stmt->execute()) {
    $message = 'Usuario creado satisfactoriamente';
  } else {
    $message = 'Pailas, no se pudo crear, intente de nuevo';
  }
}
?>


<!DOCTYPE html>
<html>

<head>
  <meta charset="utf-8">
  <title>Registrarse</title>
  <link href="https://fonts.googleapis.com/css?family=Roboto" rel="stylesheet">
  <link rel="stylesheet" href="assets/css/style.css">
</head>

<body>
<img src="assets/img/header.jpg" width= "100%" alt="Responsive image"> 
  <?php require 'partials/header.php' ?> <!-- Se importa el encabezado de la página -->

  <?php if (!empty($message)): ?> <!-- Si la variable $message no está vacía, muestra el mensaje -->
    <p>
      <?= $message ?> <!-- Se muestra el mensaje almacenado en la variable $message -->
    </p>
  <?php endif; ?>


  <h1>Registrarse</h1> <!-- Título principal de la página -->
  <span>o <a href="login.php">Login</a></span> <!-- Se muestra un enlace para ir a la página de inicio de sesión -->

  <form action="signup.php" method="POST"> <!-- Formulario para el registro de usuario -->
    <input name="email" type="text" placeholder="Escriba su Usuario"> <!-- Campo de entrada para el nombre de usuario -->
    <input name="password" type="password" placeholder="Esriba su Contraseña"> <!-- Campo de entrada para la contraseña del usuario -->
    <input name="confirm_password" type="password" placeholder="Confirme su Contraseña"> <!-- Campo de entrada para confirmar la contraseña del usuario -->
    <input type="submit" value="Submit"> <!-- Botón para enviar el formulario de registro -->
  </form>

</body>


</html>