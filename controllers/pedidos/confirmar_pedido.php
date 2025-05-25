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

require_once __DIR__ . "/../../model/pedidos.php";
require_once __DIR__ . "/../lib/validaciones.php";

use modelos\Pedido;

if ($_SERVER["REQUEST_METHOD"] == "GET") {
    header("Content-Type. application/json");
    $id_cliente = $_SESSION["id_cliente"];


    $pedidos = [];

    foreach ($_SESSION["pedido"] as $pedido) {
        $pedidos[] = $pedido;
    }


    $total = array_reduce($pedidos, function ($suma, $pedido) {
        return $suma + $pedido["cantidad"] * $pedido["precio"];
    }, 0);

    $pedido = new Pedido();
    $respuesta = $pedido->insertar_pedido($id_cliente, $total, $pedidos);

    if ($respuesta) {
        http_response_code(200);
        echo json_encode([
            "status" => 200,
            "mensaje" => "Compra realizada con exito"
        ]);
        unset($_SESSION["pedido"]);

        exit;

    } else {
        http_response_code(500);

        echo json_encode([
            "status" => 500,
            "mensaje" => "Error: " . $pedido->get_error()
        ]);
        exit;
    }
}
