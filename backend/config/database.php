<?php

//Conexión a la base de datos
function conectarDB() {
  try {
    return new PDO('mysql:hostname=localhost;dbname=shoedev', 'root', '');
  } catch (PDOException $e) {
    // Registra el error en un archivo seguro
    error_log($e->getMessage(), 3, __DIR__ . '/logs/db_errors.log');

    // Muestra un mensaje genérico al usuario
    die('Error de conexión a la base de datos. Por favor, inténtalo más tarde.');
  }
}
