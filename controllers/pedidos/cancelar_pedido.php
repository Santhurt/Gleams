<?php
session_start();

if (!isset($_SESSION["correo"]) || !isset($_SESSION["id_cliente"])) {
    http_response_code(400);

    echo json_encode([
        "status" => 400,
        "mensaje" => "Debe de ingresar sesion"
    ]);
    exit;
}

require_once  __DIR__ . "/../../model/pedidos.php";

use modelos\Pedido;

if ($_SERVER["REQUEST_METHOD"] == "GET") {
    if (!isset($_GET["id_pedido"]) || empty($_GET["id_pedido"])) {
        http_response_code(400);
        echo json_encode([
            "status" => 400,
            "mensaje" => "Falta el parámetro id_pedido"
        ]);
        exit;
    }

    $id_cliente = trim($_SESSION["id_cliente"]);
    $id_pedido = trim($_GET["id_pedido"]);

    $pedido = new Pedido();
    $resultado = $pedido->cancelar_pedido_cliente($id_cliente, $id_pedido);

    if ($resultado) {
        http_response_code(200);

        echo json_encode([
            "status" => 200,
            "mensaje" => "Pedido cancelado"
        ]);
        exit;
    } else {
        http_response_code(500);

        echo json_encode([
            "status" => 500,
            "mensaje" => "Error al cancelar el pedido"
        ]);
        exit;
    }
}
