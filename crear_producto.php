<?php
session_start();

// RUTAS CORRECTAS
require_once __DIR__ . "/backend/config/database.php";
require_once __DIR__ . "/backend/models/Producto.php";

// Validación
$required = ['titulo', 'marca', 'descripcion', 'stock', 'precio'];
foreach ($required as $campo) {
  if (empty($_POST[$campo])) {
    die("El campo $campo es obligatorio");
  }
}

$titulo      = $_POST['titulo'];
$marca       = $_POST['marca'];
$descripcion = $_POST['descripcion'];
$stock       = $_POST['stock'];
$precio      = $_POST['precio'];

$imagen = null;
$uploadDir = __DIR__ . "/backend/uploads/products/";

// Procesar imagen
if (isset($_FILES['imagen']) && $_FILES['imagen']['error'] === 0) {

  $tmpName = $_FILES['imagen']['tmp_name'];
  $ext = strtolower(pathinfo($_FILES['imagen']['name'], PATHINFO_EXTENSION));

  // Extensiones válidas
  $validExt = ['jpg', 'jpeg', 'png', 'webp', 'jfif'];

  if (!in_array($ext, $validExt)) {
    die("Formato de imagen no permitido");
  }

  // Nombre único
  $imagen = uniqid('img_', true) . "." . $ext;

  // Mover archivo
  if (!move_uploaded_file($tmpName, $uploadDir . $imagen)) {
    die("Error al subir la imagen");
  }
}

// GUARDAR EN BD
try {
  $conexion = conectarDB();
  $producto = new Producto($conexion);

  $producto->crearProducto($titulo, $marca, $descripcion, $stock, $precio, $imagen);

  header("Location: /shoedev/backend/admin/productos.php");
  exit;
} catch (Exception $e) {
  die("Error en la BD: " . $e->getMessage());
}
