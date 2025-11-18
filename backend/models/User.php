<?php

class User {

  private $conexion;

  public function __contruct($conexion) {
   $this->conexion = $conexion;
  }

  public function userRegister($username, $nombre, $apellidos, $nacimiento, $direccion, $email, $password) {
    $stmt = $this->conexion->prepare(
      "INSERT INTO usuarios (username, nombre, apellidos, nacimiento, direccion, email, password)
      VALUES (:username, :nombre, :apellidos, :nacimiento, :direccion, :email, :password)"
    );

    $stmt->execute([
      ':username' => $username,
      ':nombre' => $nombre,
      ':apellidos' => $apellidos,
      ':nacimiento' => $nacimiento,
      ':direccion' => $direccion,
      ':email' => $email,
      ':password' => $password,
    ]);
  }

}