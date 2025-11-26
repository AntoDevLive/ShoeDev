<?php

session_start();

require __DIR__ . '/../backend/config/database.php';

$folder = '../backend/uploads/profile/';

// Archivo subido
$originalName = $_FILES['img-perfil']['name'];
$extension = pathinfo($originalName, PATHINFO_EXTENSION); // obtiene jpg, png, etc.

// Generar un nombre corto único
$newFileName = uniqid('img_', true) . '.' . $extension;

// Ruta destino
$destinationPath = $folder . $newFileName;


// Si el usuario ya tenía una foto guardada en sesión, la eliminamos
if (isset($_SESSION['profile_img'])) {
  $oldFileName = $_SESSION['profile_img'];
  $oldFile = $folder . $oldFileName;

  // Evitar que se elimine la imagen por defecto
  if ($oldFileName !== 'user-default.png') {
    if (file_exists($oldFile)) {
      unlink($oldFile); // elimina la foto anterior
    }
  }
}


// Mover la nueva imagen subida
move_uploaded_file($_FILES['img-perfil']['tmp_name'], $destinationPath);

// Guardar la nueva imagen en sesión
$_SESSION['profile_img'] = $newFileName;

$conexion = conectarDB();

$stmt = $conexion->prepare("UPDATE perfil SET imagen = :imagen WHERE usuario_id = :id");
$stmt->execute([
  ':imagen' => $_SESSION['profile_img'],
  ':id' => $_SESSION['id']
]);

header('Location: /shoedev/user/perfil.php');