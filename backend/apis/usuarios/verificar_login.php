<?php
session_start();
header('Content-Type: application/json');

require __DIR__ . '/../../config/database.php';

$conexion = conectarDB();

// Leer JSON
$data = json_decode(file_get_contents("php://input"), true);

if (!$data || !isset($data['email'], $data['password'])) {
    echo json_encode(['message' => 'datos incompletos']);
    exit;
}

$email = $data['email'];
$password = $data['password'];

// Buscar usuario por email
$stmt = $conexion->prepare(
    "SELECT * FROM usuario WHERE LOWER(email) = LOWER(:email)"
);
$stmt->execute([
    ':email' => $email
]);

$found_user = $stmt->fetch(PDO::FETCH_ASSOC);

if (!$found_user) {
    echo json_encode(['message' => 'wrong email']);
    exit;
}

// Verificar contraseña
if (password_verify($password, $found_user['password'])) {
    $_SESSION['id'] = $found_user['id'];
    echo json_encode(['message' => 'success']);
} else {
    echo json_encode(['message' => 'wrong password']);
}
