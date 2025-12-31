<?php
session_start();
header('Content-Type: application/json');

require __DIR__ . '/../../config/database.php';

$conexion = conectarDB();

// Leer JSON
$data = json_decode(file_get_contents("php://input"), true);

if (!$data || !isset($data['email'], $data['username'])) {
    echo json_encode(['message' => 'datos incompletos']);
    exit;
}

$email = trim($data['email']);
$username = trim($data['username']);

// Buscar email o username
$stmt = $conexion->prepare("SELECT email, username  FROM usuario  WHERE LOWER(email) = LOWER(:email) OR LOWER(username) = LOWER(:username) LIMIT 1");

$stmt->execute([
    ':email' => $email,
    ':username' => $username
]);

$found = $stmt->fetch(PDO::FETCH_ASSOC);

if ($found) {
    if (strtolower($found['email']) === strtolower($email)) {
        echo json_encode(['message' => 'used email']);
        exit;
    }

    if (strtolower($found['username']) === strtolower($username)) {
        echo json_encode(['message' => 'used username']);
        exit;
    }
}

// Si no existe ninguno
echo json_encode(['message' => 'success']);
exit;
