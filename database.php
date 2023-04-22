<?php

$server = 'localhost:3306';// Se define una variable $server con el valor de la dirección del servidor de la base de datos y el número de puerto.
$username = 'root';// Se define una variable $username con el valor del nombre de usuario de la base de datos.
$password = '';// Se define una variable $password con el valor de la contraseña de la base de datos.
$database = 'php_login_database';// Se define una variable $database con el valor del nombre de la base de datos.
try {
$conn = new PDO("mysql:host=$server;dbname=$database;", $username, $password);// Se establece una conexión a la base de datos utilizando los valores definidos en las variables $server, $database, $username y $password.
} catch (PDOException $e) {  // En caso de que la conexión falle, se captura la excepción y se ejecuta el siguiente bloque de código.
die('Connection Failed: ' . $e->getMessage()); // Se muestra un mensaje de error y se detiene la ejecución del script PHP. El mensaje de error contiene el mensaje de error específico capturado en la excepción.

}

?>