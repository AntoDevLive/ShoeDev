<?php
session_start();

// RUTAS CORRECTAS
require_once __DIR__ . "/../../config/database.php";
require_once __DIR__ . "/../../models/Producto.php";

// Validación mínima
$required = ['titulo', 'marca', 'descripcion', 'stock', 'precio'];
foreach ($required as $campo) {
  if (empty($_POST[$campo])) {
    echo json_encode([
      "status" => "error",
      "message" => "El campo $campo es obligatorio"
    ]);
    exit;
  }
}

$titulo      = $_POST['titulo'];
$marca       = $_POST['marca'];
$descripcion = $_POST['descripcion'];
$stock       = $_POST['stock'];
$precio      = $_POST['precio'];

$imagen = null;
$uploadDir = __DIR__ . "/../../uploads/products/";

// Procesar imagen
if (isset($_FILES['imagen']) && $_FILES['imagen']['error'] === 0) {
  $tmpName = $_FILES['imagen']['tmp_name'];
  $ext = strtolower(pathinfo($_FILES['imagen']['name'], PATHINFO_EXTENSION));
  $validExt = ['jpg', 'jpeg', 'png', 'webp', 'jfif'];

  if (!in_array($ext, $validExt)) {
    echo json_encode([
      "status" => "error",
      "message" => "Formato de imagen no permitido"
    ]);
    exit;
  }

  $imagen = uniqid('img_', true) . "." . $ext;
  if (!move_uploaded_file($tmpName, $uploadDir . $imagen)) {
    echo json_encode([
      "status" => "error",
      "message" => "Error al subir la imagen"
    ]);
    exit;
  }
}

// Guardar en BD
try {
  $conexion = conectarDB();
  $producto = new Producto($conexion);

  $producto->crearProducto($titulo, $marca, $descripcion, $stock, $precio, $imagen);

  echo json_encode([
    "status" => "success",
    "message" => "Producto creado correctamente"
  ]);
} catch (Exception $e) {
  echo json_encode([
    "status" => "error",
    "message" => "Error en la BD: " . $e->getMessage()
  ]);
}
