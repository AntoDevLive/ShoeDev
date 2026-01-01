<?php session_start();

require '../backend/config/database.php';

$conexion = conectarDB();

$idUsuario = $_SESSION['id'];

$stmt = $conexion->prepare("SELECT perfil.nombre, perfil.apellidos, perfil.direccion, usuario.email FROM usuario LEFT JOIN perfil ON usuario.id = perfil.usuario_id WHERE usuario.id = :id");

$stmt->bindParam(':id', $idUsuario, PDO::PARAM_INT);
$stmt->execute();

$info = $stmt->fetch(PDO::FETCH_ASSOC);

require_once '../frontend/views/compra_user.view.php';