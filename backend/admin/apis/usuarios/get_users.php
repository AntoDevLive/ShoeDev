<?php

require '../../../config/database.php';

$conexion = conectarDB();

$stmt_usuario = $conexion->prepare(
  "SELECT usuario.id, usuario.username, usuario.email, usuario.rol, perfil.nombre, perfil.apellidos, perfil.direccion, perfil.nacimiento FROM usuario LEFT JOIN perfil on usuario.id = perfil.usuario_id"
);
$stmt_usuario->execute();
$usuarios = $stmt_usuario->fetchAll(PDO::FETCH_ASSOC);

header('Content-Type: application/json');
echo json_encode($usuarios);