<?php
require __DIR__ . '/backend/config/database.php';

$conexion = conectarDB();

try {
  $query = "SELECT  c.id AS compra_id, c.fecha, c.subtotal, c.usuario_id, u.username, GROUP_CONCAT(p.id ORDER BY p.id SEPARATOR ',') AS producto_ids, GROUP_CONCAT(p.titulo ORDER BY p.id SEPARATOR ',') AS productos_titulos, GROUP_CONCAT(p.imagen ORDER BY p.id SEPARATOR ',') AS productos_imagenes, GROUP_CONCAT(p.marca ORDER BY p.id SEPARATOR ',') AS productos_marcas FROM compra c INNER JOIN usuario u ON u.id = c.usuario_id INNER JOIN producto_compra pc ON pc.compra_id = c.id INNER JOIN producto p ON p.id = pc.producto_id GROUP BY c.id, c.fecha, c.subtotal, c.usuario_id, u.username ORDER BY c.id DESC";

  $stmt = $conexion->prepare($query);
  $stmt->execute();
  $compras = $stmt->fetchAll(PDO::FETCH_ASSOC);

  header('Content-Type: application/json');
  echo json_encode($compras);

} catch (PDOException $e) {
  http_response_code(500);
  echo json_encode(['error' => 'Error al obtener las compras: ' . $e->getMessage()]);
}
?>
