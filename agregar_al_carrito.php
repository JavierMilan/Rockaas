<?php
session_start();

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['producto_id'])) {
    $producto_id = $_POST['producto_id'];

    if (!isset($_SESSION['carrito'])) {
        $_SESSION['carrito'] = [];
    }

    // CORRECTO: guardar solo número
    if (!isset($_SESSION['carrito'][$producto_id]) || !is_numeric($_SESSION['carrito'][$producto_id])) {
        $_SESSION['carrito'][$producto_id] = 1;
    } else {
        $_SESSION['carrito'][$producto_id] += 1;
    }
}

header("Location: index.php");
exit();
