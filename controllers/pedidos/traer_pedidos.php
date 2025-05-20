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

    if (isset($_SESSION["pedido"])) {
        http_response_code(200);
        $pedidos = [];

        foreach ($_SESSION["pedido"] as $pedido) {
            $pedidos[] = $pedido;
        }

        echo json_encode([
            "status" => 200,
            "datos" => $pedidos
        ]);
        exit;
    } else {
        http_response_code(404);

        echo json_encode([
            "status" => 404,
            "mensaje" => "No hay pedidos creados"
        ]);
        exit;
    }
}
