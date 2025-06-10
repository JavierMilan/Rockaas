<?php
session_start();
include "utils.php";

$productos = cargarProductosDesdeTxt("includes/productos.txt");
$carrito = $_SESSION['carrito'] ?? [];

// Eliminar producto individual
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['eliminar_id'])) {
    $idEliminar = $_POST['eliminar_id'];
    unset($_SESSION['carrito'][$idEliminar]);
    header("Location: carrito.php");
    exit();
}

?>

<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8" />
  <title>Carrito de Compras</title>
  <link rel="stylesheet" href="carrito.css">
</head>
<body>
  <div class="container">
    <h1>Carrito de Compras</h1>

    <?php if (empty($carrito)): ?>
      <p>Tu carrito está vacío.</p>
    <?php else: ?>
      <form method="post" action="finalizar.php" style="display:inline;">
      <button class="boton" type="submit" onclick="return confirm('¿Deseas finalizar la compra?')">Finalizar Compra</button>
      </form>

      <br>
      <table>
        <thead>
          <tr>
            <th>Producto</th>
            <th>Imagen</th>
            <th>Precio</th>
            <th>Cantidad</th>
            <th>Total</th>
            <th>Acción</th>
          </tr>
        </thead>
        <tbody>
          <?php
          $totalGeneral = 0;

          foreach ($carrito as $id => $cantidad):
              if (!isset($productos[$id])) continue;

              $producto = $productos[$id];
              $subtotal = $producto['precio'] * $cantidad;
              $totalGeneral += $subtotal;
              ?>
              <tr>
              <td><?= htmlspecialchars($producto['nombre']) ?></td>
              <td><img src="imagenes/<?= htmlspecialchars($producto['imagen']) ?>" width="100"></td>
              <td><?= number_format($producto['precio'], 2) ?> €</td>
              <td><?= $cantidad ?></td>
              <td><?= number_format($subtotal, 2) ?> €</td>
              <td>
                <form method="post" style="display:inline;">
                  <input type="hidden" name="eliminar_id" value="<?= $id ?>">
                  <button type="submit" class="boton" onclick="return confirm('¿Eliminar este producto?')">Eliminar</button>
                </form>
              </td>
            </tr>
          <?php endforeach; ?>
        </tbody>
        <tfoot>
          <tr>
            <td colspan="4" style="text-align:right;"><strong>Total:</strong></td>
            <td colspan="2"><strong><?= number_format($totalGeneral, 2) ?> €</strong></td>
          </tr>
        </tfoot>
      </table>
    <?php endif; ?>

    <br>
    <a href="index.php" class="boton">Seguir comprando</a>
  </div>
</body>
</html>
