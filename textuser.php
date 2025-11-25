<?php session_start();
require 'backend/config/database.php';

$conexion = conectarDB();

// Obtener el cuerpo JSON crudo
$rawData = file_get_contents("php://input");

// Convertir JSON a array asociativo
$data = json_decode($rawData, true);

// Comprobar que llegó la información
if (isset($data['id']) && isset($data['username'])) {

  $id = $data['id'];
  $username = $data['username'];

  $stmt = $conexion->prepare("UPDATE usuario SET username = :username WHERE id = :id");
  $stmt->execute([
    ':username' => $username,
    ':id' => $id,
  ]);

  // Respuesta JSON de confirmación
  if ($stmt) {
    echo json_encode([
      'success' => true,
      'message' => "Guardado correctamente",
      'id' => $id,
      'username' => $username
    ]);
    $_SESSION['username'] = $username;
  }
} else {
  echo json_encode([
    'success' => false,
    'message' => 'Datos incompletos'
  ]);
}
