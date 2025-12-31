<?php

require __DIR__ . '/../../config/database.php';

$conexion = conectarDB();


// Obtener password del usuario
$stmt = $this->conexion->prepare("SELECT password FROM usuario WHERE id = :id");
$stmt->execute([
    ':id' => $_SESSION['id']
]);
$found = $stmt->fetch();

if (!$found || !password_verify($password, $found['password'])) {
    header('Location: /shoedev/user/perfil.php');
    return false; // contraseña incorrecta
}
