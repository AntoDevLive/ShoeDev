<?php

session_start();

// Registrar las rutas
$user_model = __DIR__ . '/../models/User.php';
$database_php = __DIR__ . '/../config/database.php';

// Obtener el cuerpo JSON crudo
$rawData = file_get_contents("php://input");

// Convertir JSON a array asociativo
$data = json_decode($rawData, true);

// Verificar que las rutas existen
if (file_exists($database_php)) {
  require $database_php;
} else {
  $msg = "[" . date('Y-m-d H:i:s') . "] Error: No se encuentra el archivo $database_php\n";
  error_log($msg, 3, __DIR__ . '/../logs/db_errors.log');
  die("Lo sentimos, ha habido un error interno. Vuelva a intentarlo más tarde");
}


if (file_exists($user_model)) {
  require $user_model;
} else {
  $msg = "[" . date('Y-m-d H:i:s') . "] Error: No se encuentra el archivo $user_model\n";
  error_log($msg, 3, __DIR__ . '/../logs/db_errors.log');
  die("Lo sentimos, ha habido un error interno. Vuelva a intentarlo más tarde");
}



if ($_SERVER['REQUEST_METHOD'] === 'POST') {

  $action = $_POST['action'] ?? '';

  // Registrar usuario
  if ($action === 'register') {
    $username = $_POST['username'];
    $email = $_POST['email'];
    $password = $_POST['password'];
    $nombre = $_POST['nombre'];
    $apellidos = $_POST['apellidos'];
    $fecha_nacimiento = $_POST['fecha_nacimiento'];
    $direccion = $_POST['direccion'];
    $password_hashed = password_hash($password, PASSWORD_BCRYPT);

    $conexion = conectarDB();
    $user = new User($conexion);
    $user->register($username, $nombre, $apellidos, $fecha_nacimiento, $direccion, $email, $password_hashed);

    header('Location: /shoedev/index.php');
    exit;
  }


  // Iniciar sesión
  if ($action === 'login') {

    $email = $_POST['email'];
    $password = $_POST['password'];

    $conexion = conectarDB();
    $user = new User($conexion);
    $user->login($email, $password);
  }


  //Editar nombre de usuario
  if($action === 'setUsername') {

      $id = $_POST['id'];
      $username = $_POST['username'];

      $conexion = conectarDB();
      $user = new User($conexion);
      $user->editUsername($username, $id);

      header('Location: /shoedev/user/perfil.php');

      exit;
}

  //Cambiar imagen del perfil
  if ($action === 'profile-img') {

    $conexion = conectarDB();
    $user = new User($conexion);
    $user->changeProfileImage();

    header('Location: /shoedev/user/perfil.php');

    exit;
  }


  // Eliminar cuenta
  if ($action === 'eliminar-cuenta') {

    $password = $_POST['password'];

    $conexion = conectarDB();
    $user = new User($conexion);
    $user->eliminarCuenta($password); 

    exit;

  }

  // Editar info 
  if ($action === 'update-info') {
    $conexion = conectarDB();
    $user = new User($conexion);

    $email = $_POST['email'] ?? '';
    $nombre = $_POST['nombre'] ?? '';
    $apellidos = $_POST['apellidos'] ?? '';
    $direccion = $_POST['direccion'] ?? '';
    $nacimiento = $_POST['nacimiento'] ?? '';

    $result = $user->updateProfile($email, $nombre, $apellidos, $direccion, $nacimiento);

    header('Content-Type: application/json');
    echo json_encode($result);
    exit;
  }
}
