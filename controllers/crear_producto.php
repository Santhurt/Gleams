<?php
include_once "../model/productos.php";
include_once "./lib/validaciones.php";

use modelos\Producto;
use lib\Validar;

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    header("Content-Type: application/json");

    $validar = new Validar($_POST);

    $vacios = $validar->requeridos(
        "nombre",
        "descripcion",
        "precio",
        "stock"
    );

    if (count($vacios) > 0) {
        http_response_code(400);
        echo json_encode([
            "status" => 400,
            "camposVacios" => true,
            "mensaje" => $vacios
        ]);

        exit;
    }

    if (!$validar->numeros("precio", "stock")) {
        http_response_code(400);
        echo json_encode([
            "status" => 400,
            "numerosInvalidos" => true,
            "mensaje" => "Error al validar los numeros"
        ]);

        exit;
    }

    $producto = new Producto();
    $resultado = $producto->insertar_producto($_POST);

    if ($resultado) {
        http_response_code(200);
        echo json_encode([
            "status" => 200,
            "mensaje" => "Producto creado con exito"
        ]);
    } else {
        http_response_code(500);
        echo json_encode([
            "status" => 500,
            "mensaje" => "Error en el servidor: " . $producto->get_error()
        ]);
    }
}
