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

    $estados_permitidos = ["pendiente", "cancelado", "entregado"];

    $id_pedido = trim($_GET["id"]);
    $estado = trim($_GET["estado"]);

    if (!in_array($estado, $estados_permitidos)) {
        http_response_code(400);

        echo json_encode([
            "status" => 400,
            "mensaje" => "El estado enviado es invalido"
        ]);
        exit;
    }



    $pedido = new Pedido();
    $pedido_a_cambiar = $pedido->traer_pedido_porid($id_pedido);

    if ($pedido_a_cambiar["estado"] == "cancelado") {
        http_response_code(400);

        echo json_encode([
            "status" => 400,
            "mensaje" => "El pedido ya fue cancelado"
        ]);
        exit;
    } else if ($pedido_a_cambiar["estado"] == "entregado") {
        http_response_code(400);

        echo json_encode([
            "status" => 400,
            "mensaje" => "El pedido ya fue entregado"
        ]);
        exit;
    }

    $respuesta = $pedido->cambiar_estado_pedido($id_pedido, $estado);


    if ($respuesta) {
        http_response_code(200);

        $pedido_cambiado = $pedido->traer_pedido_porid($id_pedido);

        echo json_encode([
            "status" => 200,
            "datos" => $pedido_cambiado
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
