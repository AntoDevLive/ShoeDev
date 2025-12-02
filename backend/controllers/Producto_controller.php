<?php

// Registrar las rutas
$producto_model = __DIR__ . '/../models/Producto.php';
$database_php = __DIR__ . '/../config/database.php'; 


// Verificar que las rutas existen
if(file_exists($database_php)) {
  require $database_php;
} else {
  $msg = "[" . date('Y-m-d H:i:s') . "] Error: No se encuentra el archivo $database_php\n";
  error_log($msg, 3, __DIR__ . '/../logs/db_errors.log');
  die("Lo sentimos, ha habido un error interno. Vuelva a intentarlo más tarde");
}


if (file_exists($producto_model)) {
  require $producto_model;
} else {
  $msg = "[" . date('Y-m-d H:i:s') . "] Error: No se encuentra el archivo $producto_model\n";
  error_log($msg, 3, __DIR__ . '/../logs/db_errors.log');
  die("Lo sentimos, ha habido un error interno. Vuelva a intentarlo más tarde");
}


// Manejar Model Producto
class ProductoController {

  public function index() {

    $conexion = conectarDB();
    $productoModel = new Producto($conexion);

    $productos_estrella = $productoModel->obtenerLimit(3);

    require_once __DIR__ . '/../../frontend/views/index.view.php';

  }

}


if ($_SERVER['REQUEST_METHOD'] === 'POST') {

  $action = $_POST['action'];

  // Crear producto
  if ($action === 'crear-producto') {

    $titulo = $_POST['titulo'];
    $marca = $_POST['marca'];
    $descripcion = $_POST['descripcion'];
    $stock = $_POST['stock'];
    $precio = $_POST['precio'];
    $precio = $_FILES['imagen']['tmp_name'] | null;

    $conexion = conectarDB();
    $producto = new Producto($conexion);
    $producto->crearProducto($titulo, $marca, $descripcion, $stock, $precio, $imagen);

    exit;

  }
}



$productoController = new ProductoController();
$productoController->index();
