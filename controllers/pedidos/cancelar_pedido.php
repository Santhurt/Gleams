<?php
session_start();

if (!isset($_SESSION["correo"]) || !isset($_SESSION["rol"]) || $_SESSION["rol"] !== "admin") {
    http_response_code(401);
    echo json_encode([
        "status" => 401,
        "mensaje" => "Acceso denegado"
    ]);
    exit;
}

require_once __DIR__ . "/../../model/pedidos.php";

use modelos\Pedido;

if ($_SERVER["REQUEST_METHOD"] == "GET") {
    if (!isset($_GET["id"]) || empty($_GET["id"])) {
        http_response_code(400);

        echo json_encode([
            "status" => 400,
            "mensaje" => "La id enviada es invalida"
        ]);
        exit;
    }

    $id_pedido = trim($_GET["id"]);

    $pedido = new Pedido();
    $respuesta = $pedido->eliminar_pedido($id_pedido);

    if ($respuesta) {
        http_response_code(200);

        $pedido_cancelado = $pedido->traer_pedido_porid($id_pedido);

        echo json_encode([
            "status" => 200,
            "datos" => $pedido_cancelado
        ]);
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
