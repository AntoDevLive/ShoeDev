<?php

class Producto {

  private $conexion;

  public function __construct($conexion) {
    $this->conexion = $conexion;
  }

  public function obtenerTodo() {
    $stmt = $this->conexion->prepare("SELECT * FROM producto");
    $stmt->execute();
    return $stmt->fetchAll();
  }
  
  public function crearProducto($titulo, $marca, $descripcion, $stock, $precio) {
    $stmt = $this->conexion->prepare(
      "INSERT INTO producto (titulo, marca, descripcion, stock, precio) VALUES (:titulo, :marca, :descripcion, :stock, :precio)"
    );
    $stmt->execute([
      ':titulo' => $titulo,
      ':marca' => $marca,
      ':descripcion' => $descripcion,
      ':stock' => $stock,
      ':precio' => $precio,
    ]);
  }

}
