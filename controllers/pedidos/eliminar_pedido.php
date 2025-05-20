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

if ($_SERVER["REQUEST_METHOD"] == "GET") {
    if (!isset($_GET["id"]) || empty($_GET["id"]) || !is_numeric($_GET["id"])) {
        http_response_code(400);

        echo json_encode([
            "status" => 400,
            "mensaje" => "Id del producto invalido para eliminar"
        ]);
        exit;
    }

    $idProducto = $_GET["id"];

    if (isset($_SESSION["pedido"]) && isset($_SESSION["pedido"][$idProducto])) {
        unset($_SESSION["pedido"][$idProducto]);

        http_response_code(200);
        echo json_encode([
            "status" => 200,
            "mensaje" => "Producto eliminado de la sesión del carrito."
        ]);
        error_log(print_r($_SESSION, true));
        exit;
    } else {
        http_response_code(404);
        echo json_encode([
            "status" => 404,
            "mensaje" => "El producto no se encontró en la sesión del carrito."
        ]);
        exit;
    }
}
