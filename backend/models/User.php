<?php session_start();

class User {

  private $conexion;

  public function __construct($conexion) {
   $this->conexion = $conexion;
  }

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

      // 1. Insert usuario
      $stmt_user->execute([
        ':username' => $username,
        ':email'    => $email,
        ':password' => $password,
        ':rol'      => 'usuario'
      ]);

      // 2. Obtener ID generado
      $id = $this->conexion->lastInsertId();

      // 3. Insert perfil
      $stmt_perfil->execute([
        ':nombre'     => $nombre,
        ':apellidos'  => $apellidos,
        ':nacimiento' => $nacimiento,
        ':direccion'  => $direccion,
        ':usuario_id' => $id
      ]);

      $_SESSION['username'] = $username;
    } catch (PDOException $e) {
      error_log($e->getMessage(), 3, __DIR__ . '/../logs/db_errors.log');
    }
  }
}