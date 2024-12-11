<?php

// Agregar salida de depuración para la ruta solicitada
echo "Ruta solicitada: " . $_SERVER['REQUEST_URI'] . "\n";

require_once 'config/config.php';
require_once '../prueba_teatrillo/App/Controllers/UserController.php';
require_once './App/Models/User.php';
require_once './App/Controllers/LoginController.php';
require_once './App/Models/LoginU.php';
require_once './App/View/layout/header.php';
require_once './App/Controllers/ButacasController.php';
require_once './App/Models/Butaca.php';


?>