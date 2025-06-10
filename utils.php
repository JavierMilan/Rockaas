<?php
function cargarProductosDesdeTxt($ruta) {
    $productos = [];

    if (file_exists($ruta)) {
        $archivo = fopen($ruta, "r");

        while (($linea = fgets($archivo)) !== false) {
            $datos = explode(";", trim($linea));
            if (count($datos) === 4) {
                list($id, $nombre, $precio, $imagen) = $datos;
                $productos[$id] = [
                    'nombre' => $nombre,
                    'precio' => (float)$precio,
                    'imagen' => $imagen
                ];
            }
        }
        fclose($archivo);
    }
    return $productos;
}
$productos = cargarProductosDesdeTxt("includes/productos.txt");

function validarUsuario($archivo, $usuario, $clave) {
    if (!file_exists($archivo)) return false;

    $lineas = file($archivo);
    foreach ($lineas as $linea) {
        list($u, $p) = explode(";", trim($linea));
        if ($usuario === $u && $clave === $p) {
            return true;
        }
    }
    return false;
}
?>
