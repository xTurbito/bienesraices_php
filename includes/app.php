<?php 

require 'funciones.php';
require 'config/databases.php';
require __DIR__ . '/../vendor/autoload.php';



//Conectar a la base de datos
$db = conectarDB();

use App\Propiedad;

Propiedad::setDB($db);
