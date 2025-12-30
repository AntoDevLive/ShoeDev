<?php

require __DIR__ . '/../../config/database.php';

$conexion = conectarDB();

if($_SERVER['REQUEST_METHOD'] === 'POST') {

  header('Access-Control-Allow-Origin: *');
  header('Content-Type: application/json');

  // Obtener el cuerpo de la petición
  $inputJSON = file_get_contents('php://input');
  $input = json_decode($inputJSON, true);


  $total = $input['total'];
  $productos = $input['productos'];
  $userId = $input['userId'];
  $producto_compra = [];



  // Insertar en la tabla compra
  $stmt_compra = $conexion->prepare(
    "INSERT INTO compra (subtotal, usuario_id) VALUES (:subtotal, :usuario_id)"
  );

  $stmt_compra->execute([
    ':subtotal' => $total,
    ':usuario_id' => $userId
  ]);

  // Obtener el id recién insertado
  $compra_id = $conexion->lastInsertId();


  foreach ($productos as $producto) {
    $producto_id = $producto['id'];
    $cantidad = $producto['cantidad'];
    $precio = $producto['precio'];

    $producto_compra[] = [
      'producto_id' => $producto_id,
      'cantidad' => $cantidad,
      'precio' => $precio,
      'compra_id' => $compra_id,
    ];

  }


  // Insertar en la tabla producto_compra
  foreach($productos as $producto) {

    $stmt_producto = $conexion->prepare(
      "INSERT INTO producto_compra (cantidad, precio, producto_id, compra_id) VALUES (:cantidad, :precio, :producto_id, :compra_id)"
    );

    $stmt_producto->execute([
      ':cantidad' => $producto['cantidad'],
      ':precio' => $producto['precio'],
      ':producto_id' => $producto['id'],
      ':compra_id' => $compra_id,
    ]);


    // Actualizar stock
    $query_update = $conexion->prepare("UPDATE producto SET stock = stock - :cantidad WHERE id = :producto_id");
    $query_update->execute([
      ':cantidad' => $producto['cantidad'],
      ':producto_id' => $producto['id']
    ]);
  }


  // Devolver respuesta JSON
  echo json_encode([
    'message' => $userId
  ]);

}