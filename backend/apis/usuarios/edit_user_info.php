<?php
header("Content-Type: application/json; charset=UTF-8");

$id         = $_POST['id'];
$username   = $_POST['username'];
$email      = $_POST['email'];
$rol        = $_POST['rol'];
$nombre     = $_POST['nombre'];
$apellidos  = $_POST['apellidos'];
$direccion  = $_POST['direccion'];
$nacimiento = $_POST['nacimiento'];

require __DIR__ . '/../../config/database.php';
$conexion = conectarDB();

// Actualizar tabla usuario
$stmtUsuario = $conexion->prepare("UPDATE usuario SET username = ?, email = ?, rol = ? WHERE id = ?");
$okUsuario = $stmtUsuario->execute([$username, $email, $rol, $id]);

// Actualizar tabla perfil
$stmtPerfil = $conexion->prepare("UPDATE perfil SET nombre = ?, apellidos = ?, direccion = ?, nacimiento = ? WHERE usuario_id = ?");
$okPerfil = $stmtPerfil->execute([$nombre, $apellidos, $direccion, $nacimiento, $id]);


if ($okUsuario && $okPerfil) {
  echo json_encode([
    "ok" => true,
    "message" => "Usuario actualizado correctamente"
  ]);
} else {
  echo json_encode([
    "ok" => false,
    "message" => "Error al actualizar el usuario"
  ]);
}