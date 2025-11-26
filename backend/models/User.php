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

  // Verificar usuario e iniciar sesión
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
          $_SESSION['id'] = $found_user['id'];
          $_SESSION['username'] = $found_user['username'];
          $_SESSION['profile_img'] = 'user-default.png';
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


}