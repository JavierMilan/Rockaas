<?php
session_start();
include "utils.php";

$mensaje = "";

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $usuario = $_POST['usuario'] ?? '';
    $clave = $_POST['clave'] ?? '';

    if (validarUsuario("includes/usuarios.txt", $usuario, $clave)) {
        $_SESSION['usuario'] = $usuario;
        header("Location: index.php");
        exit();
    } else {
        $mensaje = "Usuario o contraseña incorrectos.";
    }
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8" />
  <title>Iniciar Sesión</title>
  <link rel="stylesheet" href="carrito.css">
</head>
<body>
  <div class="container">
    <h1>Iniciar Sesión</h1>
    <?php if ($mensaje): ?>
      <p style="color:red;"><?= $mensaje ?></p>
    <?php endif; ?>

    <form method="post">
      <label>Usuario:</label><br>
      <input type="text" name="usuario" required><br><br>

      <label>Contraseña:</label><br>
      <input type="password" name="clave" required><br><br>

      <button type="submit">Entrar</button>
         <h1 class="titulillo">juan 1234</h1>
    </form>
  </div>
</body>
</html>
