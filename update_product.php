<?php

require 'backend/config/database.php';

$conexion = conectarDB();


header('Content-Type: application/json');


$id = $_POST['id'] ?? null;


$stmt = $conexion->prepare("SELECT * FROM producto WHERE id = :id");
$stmt->execute([
  ':id' => $id
]);
$campos = $stmt->fetch();



echo json_encode([
    'status' => 'success',
    'message' => "ID recibido: " . $id,
    'imagen' => $campos['imagen'],
    'titulo' => $campos['titulo'],
    'descripcion' => $campos['descripcion'],
    'marca' => $campos['marca'],
    'stock' => $campos['stock'],
    'precio' => $campos['precio'],
]);

