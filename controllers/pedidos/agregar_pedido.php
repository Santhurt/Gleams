<?php


session_start();

if (!isset($_SESSION["correo"]) || !isset($_SESSION["usuario"])) {
    http_response_code(400);

    echo json_encode([
        "status" => 400,
        "mensaje" => "Debe de ingresar sesion"
    ]);
    exit;
}

require_once __DIR__ . " /../../model/pedidos.php";
require_once __DIR__ . "/../../model/productos.php";

use modelos\Producto;

if ($_SERVER["REQUEST_METHOD"] == "GET") {
    if (!isset($_GET["id"]) || empty($_GET["id"]) || !is_numeric($_GET["id"])) {
        http_response_code(400);

        echo json_encode([
            "status" => 400,
            "mensaje" => "Id del producto invalido"
        ]);
        exit;
    }

    $producto = new Producto();
    $respuesta = $producto->traer_productoPorId($_GET["id"]);
    $respuesta["cantidad"] = isset($_GET["cantidad"]) ? intval($_GET["cantidad"]) : 1;

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
