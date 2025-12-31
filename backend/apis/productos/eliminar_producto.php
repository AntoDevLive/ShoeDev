<?php
require __DIR__ . '/../../config/database.php';
$conexion = conectarDB();

header('Content-Type: application/json');

$id = $_POST['id'] ?? null;

if (!$id) {
  echo json_encode(['status' => 'error', 'message' => 'No se recibió ID']);
  exit;
}

// Obtener imagen para borrarla
$stmt = $conexion->prepare("SELECT imagen FROM producto WHERE id = :id");
$stmt->execute([':id' => $id]);
$producto = $stmt->fetch(PDO::FETCH_ASSOC);

if ($producto && $producto['imagen']) {
  $path = __DIR__ . "/backend/uploads/products/" . $producto['imagen'];
  if (file_exists($path)) unlink($path);
}

// Eliminar producto
$stmt = $conexion->prepare("DELETE FROM producto WHERE id = :id");
$stmt->execute([':id' => $id]);

echo json_encode([
  'status' => 'success',
  'message' => 'Producto eliminado correctamente',
]);
exit;
