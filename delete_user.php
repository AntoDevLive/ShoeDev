<?php
header("Content-Type: application/json; charset=UTF-8");

// capturar JSON enviado por fetch
$input = file_get_contents("php://input");
$data = json_decode($input, true);

// Sacar el id
$id = $data['id'] ?? null;

require __DIR__ . '/backend/config/database.php';
$conexion = conectarDB();

// Eliminar datos de la tabla usuario
$stmtUsuario = $conexion->prepare("DELETE FROM usuario WHERE id = ?");
$okUsuario = $stmtUsuario->execute([$id]);

// Eliminar datos de la tabla usuario
$stmtPerfil = $conexion->prepare("DELETE FROM perfil WHERE usuario_id = ?");
$okPerfil = $stmtPerfil->execute([$id]);



  echo json_encode([
    "ok" => true,
    "message" => "Usuario eliminado correctamente"
  ]);



