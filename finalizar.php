<?php
session_start();
include "utils.php";

$productos = cargarProductosDesdeTxt("includes/productos.txt");


$carrito = $_SESSION['carrito'] ?? [];

if (empty($carrito)) {
    header("Location: carrito.php");
    exit();
}


$rutaVentas = "includes/ventas.txt";


$lineaVenta = "Fecha: " . date("Y-m-d H:i:s") . "\n";

$totalGeneral = 0;
foreach ($carrito as $id => $cantidad) {
    if (!isset($productos[$id])) continue;

    $producto = $productos[$id];
    $subtotal = $producto['precio'] * $cantidad;
    $totalGeneral += $subtotal;

    $lineaVenta .= "- {$producto['nombre']} x $cantidad = " . number_format($subtotal, 2) . " €\n";
}

$lineaVenta .= "TOTAL: " . number_format($totalGeneral, 2) . " €\n";
$lineaVenta .= "-----------------------------\n";


file_put_contents($rutaVentas, $lineaVenta, FILE_APPEND);


unset($_SESSION['carrito']);
?>

<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8" />
  <title>Compra Finalizada</title>
  <link rel="stylesheet" href="carrito.css" />
</head>
<body>
  <div class="container">
    <h1>¡Gracias por tu compra!</h1>
    <p>Tu pedido ha sido procesado correctamente.</p>
    <p>Se ha registrado la venta en el sistema.</p>
    <a href="index.php" class="boton">Volver a la tienda</a>
  </div>
</body>
</html>
