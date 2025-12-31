<?php
require __DIR__ . '/../../config/database.php';
$conexion = conectarDB();

header('Content-Type: application/json');

$action = $_POST['action'] ?? null;
$id = $_POST['id'] ?? null;


if (!$action) {
  echo json_encode(['status' => 'error', 'message' => 'No se recibió acción']);
  exit;
}


if ($action === 'obtener') {

  if (!$id) {
    echo json_encode(['status' => 'error', 'message' => 'No se recibió ID']);
    exit;
  }

  $stmt = $conexion->prepare("SELECT * FROM producto WHERE id = :id");
  $stmt->execute([':id' => $id]);
  $campos = $stmt->fetch(PDO::FETCH_ASSOC);

  if (!$campos) {
    echo json_encode(['status' => 'error', 'message' => 'Producto no encontrado']);
    exit;
  }

  echo json_encode([
    'status' => 'success',
    'message' => 'ID recibido: ' . $id,
    'imagen' => $campos['imagen'],
    'titulo' => $campos['titulo'],
    'descripcion' => $campos['descripcion'],
    'marca' => $campos['marca'],
    'stock' => $campos['stock'],
    'precio' => $campos['precio']
  ]);
  exit;
}



if ($action === 'editar-producto') {

  if (!$id) {
    echo json_encode(['status' => 'error', 'message' => 'No se recibió ID para editar']);
    exit;
  }

  $titulo = $_POST['titulo'] ?? '';
  $descripcion = $_POST['descripcion'] ?? '';
  $marca = $_POST['marca'] ?? '';
  $stock = $_POST['stock'] ?? '';
  $precio = $_POST['precio'] ?? '';

  $uploadDir = __DIR__ . "/../../uploads/products/";

  // Obtener la imagen actual
  $stmt = $conexion->prepare("SELECT imagen FROM producto WHERE id = :id");
  $stmt->execute([':id' => $id]);
  $producto = $stmt->fetch(PDO::FETCH_ASSOC);
  $imagenActual = $producto['imagen'] ?? null;

  $nuevaImagen = $imagenActual;

  // Si se subió nueva imagen
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

    // Nombre único para la nueva imagen
    $nuevaImagen = uniqid('img_', true) . "." . $ext;

    if (!move_uploaded_file($tmpName, $uploadDir . $nuevaImagen)) {
      echo json_encode([
        "status" => "error",
        "message" => "Error al subir la imagen"
      ]);
      exit;
    }

    // Borrar la imagen antigua si existía
    if ($imagenActual && file_exists($uploadDir . $imagenActual)) {
      unlink($uploadDir . $imagenActual);
    }
  }

  // Actualizar BD con la nueva imagen si aplica
  $query = $conexion->prepare("
        UPDATE producto 
        SET titulo = :titulo, descripcion = :descripcion, marca = :marca, stock = :stock, precio = :precio, imagen = :imagen
        WHERE id = :id
    ");

  $query->execute([
    ':id' => $id,
    ':titulo' => $titulo,
    ':descripcion' => $descripcion,
    ':marca' => $marca,
    ':stock' => $stock,
    ':precio' => $precio,
    ':imagen' => $nuevaImagen
  ]);

  echo json_encode([
    'status' => 'success',
    'message' => 'Producto actualizado correctamente'
  ]);
  exit;
}


echo json_encode(['status' => 'error', 'message' => 'Acción no válida']);
exit;
