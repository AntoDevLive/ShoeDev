<?php
require __DIR__ . '/../../config/database.php';

$conexion = conectarDB();

$query = $conexion->query("SELECT * FROM producto WHERE marca = 'puma'");
$productos = $query->fetchAll(PDO::FETCH_ASSOC);

header('Content-Type: application/json');
echo json_encode($productos);
