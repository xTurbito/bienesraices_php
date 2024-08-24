<?php
//Importar la conexión
require 'includes/config/databases.php';
$db = conectarDB();


//Crear u email y password
$email = "correo@correo.com";
$password = "12345";

$passwordHash = password_hash($password, PASSWORD_DEFAULT);

//Query para crear al usuario
$query = " INSERT INTO usuarios (email, password) VALUES ('{$email}' , '{$passwordHash}')";



//Agregar a la base de datos
mysqli_query($db,$query);
?>