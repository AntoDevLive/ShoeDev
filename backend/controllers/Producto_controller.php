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

  // Index
  public function index() {

    $conexion = conectarDB();
    $productoModel = new Producto($conexion);

    $productos_limite = $productoModel->obtenerLimit(3);
    $productos_total_nike = $productoModel->obtenerTotalMarca("nike");
    $productos_total_adidas = $productoModel->obtenerTotalMarca("adidas");
    $productos_total_puma = $productoModel->obtenerTotalMarca("puma");
    $productos_estrella = $productoModel->obtenerRandom(3);
    $productos_temporada = $productoModel->obtenerRandom(8);
    $productos_nike = $productoModel->obtenerMarca("nike");
    $productos_adidas = $productoModel->obtenerMarca("adidas");
    $productos_puma = $productoModel->obtenerMarca("puma");

    require_once __DIR__ . '/../../frontend/views/index.view.php';
  }


  // Tienda
  public function tienda() {
    $conexion = conectarDB();
    $productoModel = new Producto($conexion);

    $productos_nike = $productoModel->obtenerMarca("nike");
    $productos_adidas = $productoModel->obtenerMarca("adidas");
    $productos_puma = $productoModel->obtenerMarca("puma");

    require __DIR__ . '/../../frontend/views/tienda.view.php';
  }

}


if ($_SERVER['REQUEST_METHOD'] === 'POST') {

  $action = $_POST['action'];

  if ($action === 'crear-producto') {

    $titulo = $_POST['titulo'];
    $marca = $_POST['marca'];
    $descripcion = $_POST['descripcion'];
    $stock = $_POST['stock'];
    $precio = $_POST['precio'];

    // Manejar imagen
    if ($_FILES['imagen']['error'] === 0) {
      $imagen = $_FILES['imagen']['name'];
      move_uploaded_file($_FILES['imagen']['tmp_name'], __DIR__ . "/../../uploads/$imagen");
    } else {
      $imagen = null;
    }

    $conexion = conectarDB();
    $producto = new Producto($conexion);
    $producto->crearProducto($titulo, $marca, $descripcion, $stock, $precio, $imagen);

    exit;
  }
}


// Lógica de rutas
$productoController = new ProductoController();
$page = basename($_SERVER['PHP_SELF']);

if ($page === "index.php") {
  $productoController->index();
} elseif ($page === "tienda.php") {
  $productoController->tienda();
}
