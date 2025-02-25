<?php
// Incluir los archivos necesarios
require_once __DIR__ . '/app/core/Router.php'; // Incluye el archivo Router.php
require_once __DIR__ . '/app/controllers/LibroController.php'; // Incluye el archivo LibroController.php
require_once __DIR__ . '/app/controllers/AutorController.php'; // Incluye el archivo AutorController.php

// Inicializar el enrutador
$router = new Router();

// Redirigir a indexed.php
header('Location: /Proyecto_Final_Jimenez_Chiluiza_Loor/public/index.php');
exit(); // Asegura que el código no continúe ejecutándose después de la redirección.
?>