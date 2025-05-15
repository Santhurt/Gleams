<?php
require_once __DIR__ . "/../../model/productos.php";

use modelos\Producto;

if ($_SERVER["REQUEST_METHOD"] === "GET") {
    $producto = new Producto();

    $resultado = $producto->traer_productos();
    $productos = [];
    $imagen = [];

    if ($resultado) {
        while ($fila = $resultado["imagenes"]->fetch_assoc()) {
            $id_producto = $fila["id_producto"];
            $imagen[$id_producto] = $fila;
        }

        while ($fila = $resultado["productos"]->fetch_assoc()) {
            $id_producto = $fila["id_producto"];
            $fila["imagen"] = $imagen[$id_producto] ?? "";
            $productos[] = $fila;
        }


        http_response_code(200);
        echo json_encode($productos);
        exit;
    } else {
        http_response_code(500);
        echo json_encode([
            "status" => 500,
            "mensaje" => "Error al traer los productos: " . $producto->get_error()
        ]);
        exit;
    }
}
