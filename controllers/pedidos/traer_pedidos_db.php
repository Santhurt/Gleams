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
    $pedido = new Pedido();
    $resultado = $pedido->traer_pedidos();

    $pedidos = [];

    if ($resultado) {
        http_response_code(200);

        while ($fila = $resultado->fetch_assoc()) {
            $pedidos[] = $fila;
        }

        echo json_encode([
            "status" => 200,
            "datos" => $pedidos
        ]);
        exit;
    } else {
        http_response_code(500);

        json_encode([
            "status" => 500,
            "mensaje" => "Error: " . $pedido->get_error()
        ]);
        exit;
    }
}
