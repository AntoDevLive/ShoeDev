<?php
session_start();

// Verificar que el usuario esté logueado
if (!isset($_SESSION['id'])) {
  http_response_code(401);
  echo json_encode(['error' => 'Usuario no autenticado']);
  exit;
}

require 'backend/config/database.php';

$conexion = conectarDB();

try {
  $query = "SELECT 
              c.id AS compra_id, 
              c.fecha, 
              c.subtotal, 
              pc.cantidad, 
              pc.precio AS precio_compra, 
              p.titulo, 
              p.imagen, 
              p.marca 
            FROM compra c 
            INNER JOIN producto_compra pc ON pc.compra_id = c.id 
            INNER JOIN producto p ON p.id = pc.producto_id 
            WHERE c.usuario_id = :usuario_id
            ORDER BY c.id DESC";
  
  $stmt = $conexion->prepare($query);
  $stmt->execute(['usuario_id' => $_SESSION['id']]);
  $compras = $stmt->fetchAll(PDO::FETCH_ASSOC);

  header('Content-Type: application/json');
  echo json_encode($compras);

} catch (PDOException $e) {
  http_response_code(500);
  echo json_encode(['error' => 'Error al obtener las compras: ' . $e->getMessage()]);
}