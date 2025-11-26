<?php

session_start();

header('Content-Type: application/json');

require 'backend/config/database.php';

$conexion = conectarDB();

if (!isset($_SESSION['username'])) {
  echo json_encode([
    'status' => 'error',
    'message' => 'No hay sesión activa.'
  ]);
  exit;
}

if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
  echo json_encode([
    'status' => 'error',
    'message' => 'Acceso inválido.'
  ]);
  exit;
}

$email = $_POST['email'] ?? '';
$nombre = $_POST['nombre'] ?? '';
$apellidos = $_POST['apellidos'] ?? '';
$direccion = $_POST['direccion'] ?? '';
$nacimiento = $_POST['nacimiento'] ?? '';

$query_perfil = $conexion->prepare(
  "SELECT usuario.id, perfil.usuario_id
     FROM usuario
     JOIN perfil ON usuario.id = perfil.usuario_id
     WHERE usuario.username = :username"
);

$query_perfil->execute([
  ':username' => $_SESSION['username']
]);

$perfil = $query_perfil->fetch(PDO::FETCH_ASSOC);

if (!$perfil) {
  echo json_encode([
    'status' => 'error',
    'message' => 'Perfil no encontrado.'
  ]);
  exit;
}

$usuarioId = $perfil['usuario_id'];

// Actualizar email en usuario
$updateUsuario = $conexion->prepare(
  "UPDATE usuario SET email = :email WHERE id = :id"
);

$updateUsuario->execute([
  ':email' => $email,
  ':id' => $usuarioId
]);

// Actualizar datos del perfil
$updatePerfil = $conexion->prepare(
  "UPDATE perfil 
     SET nombre = :nombre,
         apellidos = :apellidos,
         direccion = :direccion,
         nacimiento = :nacimiento
     WHERE usuario_id = :id"
);

$updatePerfil->execute([
  ':nombre' => $nombre,
  ':apellidos' => $apellidos,
  ':direccion' => $direccion,
  ':nacimiento' => $nacimiento,
  ':id' => $usuarioId
]);

echo json_encode([
  'status' => 'success',
  'message' => 'Perfil actualizado correctamente'
]);

exit;
