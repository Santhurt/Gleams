<?php
require_once __DIR__ . "/../../model/productos.php";

use modelos\Producto;

if ($_SERVER["REQUEST_METHOD"] === "GET") {
    header("Content-Type: application/json");

    $producto = new Producto();
    $resultado = $producto->traer_categorias();

    $categorias = [];

    if ($resultado) {
        while ($fila = $resultado->fetch_assoc()) {
            $categorias[] = $fila;
        }

        http_response_code(200);
        echo json_encode([
            "status" => 200,
            "categorias" => $categorias
        ]);
        exit;
    } else {
        http_response_code(500);
        echo json_encode([
            "status" => 500,
            "mensaje" => "Error en el servidor: {$producto->get_error()}"
        ]);
        exit;
    }
}
