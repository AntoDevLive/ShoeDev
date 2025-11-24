<?php session_start();


require __DIR__ . '/../backend/config/database.php';

$conexion = conectarDB();

$stmt = $conexion->prepare(
  "SELECT usuario.id, usuario.email, perfil.* 
   FROM usuario
   JOIN perfil ON usuario.id = perfil.usuario_id
   WHERE usuario.username = :username"
);

$stmt->execute([
  ':username' => $_SESSION['username']
]);
$usuario = $stmt->fetch();

require __DIR__ . '/../frontend/views/perfil.view.php';