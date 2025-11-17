<?php

class Producto {

  private $conexion;

  public function __construct($conexion) {
    $this->conexion = $conexion;
  }

  public function obtenerTodo() {
    $stmt = $this->conexion->prepare("SELECT * FROM productos");
    $stmt->execute();
    return $stmt->fetchAll();
  }
  
}
