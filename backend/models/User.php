<?php session_start();

class User {

  private $conexion;

  public function __construct($conexion) {
   $this->conexion = $conexion;
  }

  // Registrar nuevo usuario
  public function register($username, $nombre, $apellidos, $nacimiento, $direccion, $email, $password) {

    // INSERT usuario
    $stmt_user = $this->conexion->prepare(
      "INSERT INTO usuario (username, email, password, rol)
       VALUES (:username, :email, :password, :rol)"
    );

    // INSERT perfil
    $stmt_perfil = $this->conexion->prepare(
      "INSERT INTO perfil (nombre, apellidos, nacimiento, direccion, usuario_id)
       VALUES (:nombre, :apellidos, :nacimiento, :direccion, :usuario_id)"
    );

    try {

      // Insert usuario
      $stmt_user->execute([
        ':username' => $username,
        ':email'    => $email,
        ':password' => $password,
        ':rol' => 'user',
      ]);

      // Obtener ID generado
      $id = $this->conexion->lastInsertId();

      // Insert perfil
      $stmt_perfil->execute([
        ':nombre'     => $nombre,
        ':apellidos'  => $apellidos,
        ':nacimiento' => $nacimiento,
        ':direccion'  => $direccion,
        ':usuario_id' => $id
      ]);

      $_SESSION['id'] = $id;
      $_SESSION['username'] = $username;
      $_SESSION['profile_img'] = 'user-default.png';

    } catch (PDOException $e) {
      error_log($e->getMessage(), 3, __DIR__ . '/../logs/db_errors.log');
      die('Error al registrar el usuario. Por favor, inténtalo más tarde.');
    }

  }

  // Iniciar sesión
  public function login($email, $password) {
    
    try {

      // Obtener coincidencia con el email
      $stmt = $this->conexion->prepare("SELECT * FROM usuario WHERE LOWER(email) = LOWER(:email)");
      $stmt->execute([
        ':email' => $email
      ]);
      $found_user = $stmt->fetch();


      if($found_user) {
        //Capturar campo password de la fila del usuario encontrado
        $password_user = $found_user['password'];

        // Verificar password
        $password_verified = password_verify($password, $password_user);

        if ($password_verified) {
          // Obtener imagen del perfil
          $query = $this->conexion->prepare("SELECT imagen FROM perfil WHERE usuario_id = :id");
          $query->execute([
            ':id' => $found_user['id']
          ]);
          $profile = $query->fetch();

          $_SESSION['id'] = $found_user['id'];
          $_SESSION['username'] = $found_user['username'];
          $_SESSION['profile_img'] = $profile['imagen'];
          header('Location: /shoedev/index.php');
        } else {
          exit('contraseña mal');
        }

      } else {
        exit('email mal');
      }

    } catch (PDOException $e) {
      echo 'Error inicio de sesión ' . $e->getMessage();
      die('Error al iniciar sesión. Por favor, inténtalo más tarde.');
    }

  }


  //Editar username
  public function editUsername($username, $id) {

    $stmt = $this->conexion->prepare(
      "UPDATE usuario SET username = :username WHERE id = :id"
    );

    $stmt->execute([
      ':username' => $username,
      ':id' => $id,
    ]);

    if($stmt) {
      $_SESSION['username'] = $username;
    }

  }


  // Cambiar imagen de perfil
  public function changeProfileImage() {
    $folder = $_SERVER['DOCUMENT_ROOT'] . '/ShoeDev/backend/uploads/profile/';

    // Archivo subido
    $originalName = $_FILES['img-perfil']['name'];
    $extension = pathinfo($originalName, PATHINFO_EXTENSION); // obtiene extensión de archivo

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

    $stmt = $this->conexion->prepare("UPDATE perfil SET imagen = :imagen WHERE usuario_id = :id");
    $stmt->execute([
      ':imagen' => $_SESSION['profile_img'],
      ':id' => $_SESSION['id']
    ]);
  }


  // Eliminar cuenta
  public function eliminarCuenta($password) {

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

    // Eliminar perfil y usuario en una sola llamada usando una transacción
    $this->conexion->beginTransaction();

    $stmt = $this->conexion->prepare(
      "DELETE p, u FROM usuario u LEFT JOIN perfil p ON p.usuario_id = u.id WHERE u.id = :id"
    );

    $stmt->execute([':id' => $_SESSION['id']]);

    $this->conexion->commit();
    header('Location: /shoedev/backend/config/cerrar.php');
    return true;
  }
  
}