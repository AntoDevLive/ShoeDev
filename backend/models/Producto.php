<?php

class Producto
{

  private $conexion;

  public function __construct($conexion)
  {
    $this->conexion = $conexion;
  }

  // Obtener todos los productos
  public function obtenerTodo()
  {
    $stmt = $this->conexion->prepare("SELECT * FROM producto");
    $stmt->execute();
    return $stmt->fetchAll();
  }

  // Obtener un límite productos
  public function obtenerLimit($limite)
  {
    $stmt = $this->conexion->prepare("SELECT * FROM producto LIMIT :limite");
    $stmt->bindValue(':limite', (int)$limite, PDO::PARAM_INT);
    $stmt->execute();
    return $stmt->fetchAll();
  }

  // Obtener total de productos de una marca
  public function obtenerTotalMarca($marca)
  {
    $stmt = $this->conexion->prepare("SELECT COUNT(*) AS total FROM producto WHERE marca = :marca");
    $stmt->execute([
      ':marca' => $marca
    ]);
    $resultado = $stmt->fetch();
    return $resultado['total'];
  }

  // Obtener productos por marca
  public function obtenerMarca($marca)
  {
    $stmt = $this->conexion->prepare("SELECT * FROM producto WHERE marca = :marca");
    $stmt->execute([
      ':marca' => $marca
    ]);
    return $stmt->fetchAll();
  }

  // Crear producto
  public function crearProducto($titulo, $marca, $descripcion, $stock, $precio, $imagen)
  {

    // definir imagen por defecto
    if ($imagen === null) {
      $imagen = "product-default.jpg";
    }

    $stmt = $this->conexion->prepare(
      "INSERT INTO producto (titulo, marca, descripcion, stock, precio, imagen)
       VALUES (:titulo, :marca, :descripcion, :stock, :precio, :imagen)"
    );

    $stmt->execute([
      ':titulo' => $titulo,
      ':marca' => $marca,
      ':descripcion' => $descripcion,
      ':stock' => $stock,
      ':precio' => $precio,
      ':imagen' => $imagen
    ]);
  }
}
