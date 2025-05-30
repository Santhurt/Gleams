<?php
session_start();

if (!isset($_SESSION["correo"]) || !isset($_SESSION["usuario"])) {
    http_response_code(401);

    echo json_encode([
        "status" => 401,
        "mensaje" => "Debe de ingresar sesion"
    ]);
    exit;
}

require_once __DIR__ . "/../../model/pedidos.php";
require_once __DIR__ . "/../../model/productos.php";

use modelos\Producto;

if ($_SERVER["REQUEST_METHOD"] == "GET") {
    $id_producto = trim($_GET["id"]);
    if (
        !isset($id_producto)
        || empty($id_producto)
        || !is_numeric($id_producto) || $id_producto <= 0
    ) {
        http_response_code(400);

        echo json_encode([
            "status" => 400,
            "mensaje" => "Id del producto invalido"
        ]);
        exit;
    }

    $cantidad = trim($_GET["cantidad"]) ?? 0;

    if (
        !isset($cantidad)
        || empty($cantidad)
        || $cantidad <= 0 || !is_numeric($cantidad) || $cantidad > 50
    ) {
        http_response_code(400);

        echo json_encode([
            "status" => 400,
            "mensaje" => "La cantidad enviada es invalida"
        ]);
        exit;
    }

    $producto = new Producto();
    $respuesta = $producto->traer_productoPorId($id_producto);
    $respuesta["cantidad"] = isset($_GET["cantidad"]) ? intval($_GET["cantidad"]) : 1;
    $respuesta["descuento"] = $respuesta["descuento"] ?? 0;
    $respuesta["precio"] = ($respuesta["descuento"] > 0) ? $respuesta["precio"] * (1 - $respuesta["descuento"] / 100) : $respuesta["precio"];

    if ($respuesta) {

        if (!isset($_SESSION["pedido"])) {
            $_SESSION["pedido"] = [];
        }

        $idProducto = $respuesta["id_producto"];

        $_SESSION["pedido"][$idProducto] = $respuesta;


        http_response_code(200);
        echo json_encode([
            "status" => 200,
            "mensaje" => "Producto añadido a la lista del carrito"
        ]);
        error_log(print_r($_SESSION, true));

        exit;
    } else {
        http_response_code(500);

        echo json_encode([
            "status" => 500,
            "mensaje" => "Error: " . $producto->get_error()
        ]);
        exit;
    }
}
