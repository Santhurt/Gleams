<?php
require_once "../../model/productos.php";

use modelos\Producto;

if ($_SERVER["REQUEST_METHOD"] === "GET") {
    $producto = new Producto();
    $resultado = $producto->traer_productoPorId($_GET["id"]);

    if ($resultado) {
        http_response_code(200);

        echo json_encode($resultado);
        exit;
    } else {
        http_response_code(500);

        echo json_encode([
            "status" => 400,
            "mensaje" => "Error al traer los datos del producto"
        ]);
        exit;
    }
}
