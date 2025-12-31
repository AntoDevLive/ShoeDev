<?php session_start();

$id = $_GET['id'];

require 'backend/config/database.php';

$conexion = conectarDB();

$stmt = $conexion->prepare("SELECT * FROM producto WHERE id = :id");
$stmt->execute([
  ':id' => $id
]);
$infoProducto = $stmt->fetch();

require 'frontend/views/producto.view.php';