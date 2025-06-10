<?php
include "utils.php";


?>

<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1" />
  <title>WWW.ROCKAAS.COM</title>
  <link rel="stylesheet" href="styles.css">
</head>
<body>
  <div class="container">
    <header>
          <?php if (isset($_SESSION['usuario'])): ?>
          <p>Bienvenido, <?= htmlspecialchars($_SESSION['usuario']) ?> | <a href="logout.php">Cerrar sesión</a></p>
          <?php else: ?>
          <?php endif; ?>

         <nav>
           <div class="botones">
             <button type="button" class="boton">
             <img src="rockstarneon.png" alt="Logo"/>
             </button>
             <h1 class="titulillo">WWW.ROCKAAS.COM</h1>
             <div class="iconos">
               <a href="login.php" class="iniciarsesion">
               <img src="usuario.png" alt="usuario">
               </a>
               <a href="carrito.php" class="carrito">
               <img src="elcarrito.png" alt="elcarrito">
               </a>
             </div>
           </div>
         </nav>
    </header>

    <main>
      <div class="row">
        <?php foreach ($productos as $id => $producto): ?>
          <div class="producto">
            <img 
              title="<?= htmlspecialchars($producto['nombre']) ?>" 
              src="imagenes/<?= htmlspecialchars($producto['imagen']) ?>" 
              alt="<?= htmlspecialchars($producto['nombre']) ?>" 
              width="400" /><br>

            <span><strong><?= htmlspecialchars($producto['nombre']) ?></strong></span><br>
            <span><?= number_format($producto['precio'], 2) ?> €</span><br>

            <form method="post" action="agregar_al_carrito.php">
              <input type="hidden" name="producto_id" value="<?= $id ?>" />
              <button class="botonProducto" type="submit">Agregar al carrito</button>
            </form>
          </div>
        <?php endforeach; ?>
      </div>
      <footer>
        <div class="footer">
          
        </div>
      </footer>
    </main>
  </div>
</body>
</html>
