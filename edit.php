<?php
session_start();

require 'backend/config/database.php';

$conexion = conectarDB();

// Verificar que el usuario esté logueado
if (!isset($_SESSION['username'])) {
  die("Error: No hay sesión activa.");
}

// Verificar que se envió el formulario
if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
  die("Error: Acceso inválido.");
}

// Recibir datos POST
$email = $_POST['email'] ?? null;
$nombre = $_POST['nombre'] ?? null;
$apellidos = $_POST['apellidos'] ?? null;
$direccion = $_POST['direccion'] ?? null;
$nacimiento = $_POST['nacimiento'] ?? null;

// Obtener el perfil junto con el id del usuario
$query_perfil = $conexion->prepare(
  "SELECT usuario.id, usuario.email, perfil.*
     FROM usuario
     JOIN perfil ON usuario.id = perfil.usuario_id
     WHERE usuario.username = :username"
);

$query_perfil->execute([
  ':username' => $_SESSION['username']
]);

$perfil = $query_perfil->fetch(PDO::FETCH_ASSOC);

if (!$perfil) {
  die("Error: No se encontró el perfil del usuario.");
}

$usuarioId = $perfil['usuario_id']; // ID en tabla 'usuario'


//Actualizar email en la tabla USUARIO
$updateUsuario = $conexion->prepare(
  "UPDATE usuario SET email = :email WHERE id = :id"
);

$updateUsuario->execute([
  ':email' => $email,
  ':id' => $usuarioId
]);


//Actualizar datos del perfil en tabla PERFIL
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

header("Location: /shoedev/user/perfil.php");

exit;