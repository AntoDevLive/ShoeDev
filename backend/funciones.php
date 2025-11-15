<?php 

//Conexión a la base de datos
function conectarDB() {
  try {
    return new PDO('mysql:hostname=localhost;dbname=shoedev', 'root', '');
  } catch (PDOException $e) {
    echo 'Error en la conexión: ' . $e->getMessage();
  }
}