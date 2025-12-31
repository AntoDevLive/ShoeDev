<?php session_start();

require __DIR__ . '/../../config/database.php';

$conexion = conectarDB();

$data = json_decode(file_get_contents("php://input"), true);
$password = $data['password'];


//Obtener password del usuario
$stmt = $conexion->prepare("SELECT password FROM usuario WHERE id = :id");
$stmt->execute([
    ':id' => $_SESSION['id']
]);
$found = $stmt->fetch();

if (!$found || !password_verify($password, $found['password'])) {
      echo json_encode([
    'message' => 'unsuccess'
  ]);
    return false; // contraseña incorrecta
} else {
  echo json_encode([
    'message' => 'success'
  ]);
}

