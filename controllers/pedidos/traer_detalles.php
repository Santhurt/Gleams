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
    $resultado = $pedido->traer_detalles($id_pedido);
    $detalle_pedidos = [];

    if ($resultado) {
        http_response_code(200);

        while ($fila = $resultado->fetch_assoc()) {
            $detalle_pedidos[] = $fila;
        }

        echo json_encode([
            "status" => 200,
            "datos" => $detalle_pedidos
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
