<?php session_start();


require __DIR__ . '/../backend/config/database.php';

$conexion = conectarDB();

$query_perfil = $conexion->prepare(
  "SELECT usuario.id, usuario.email, perfil.* 
   FROM usuario
   JOIN perfil ON usuario.id = perfil.usuario_id
   WHERE usuario.username = :username"
);

$query_perfil->execute([
  ':username' => $_SESSION['username']
]);

$perfil = $query_perfil->fetch();;

$query_usuario = $conexion->prepare("SELECT * FROM usuario");
$query_usuario->execute();
$usuario = $query_usuario->fetch();



require __DIR__ . '/../frontend/views/perfil.view.php';