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

if($_SERVER["REQUEST_METHOD"] == "GET") {
    if(!isset($_GET["id"]) || empty($_GET["id"])) {
        http_response_code(400);

        echo json_encode([
            "status" => 400,
            "mensaje" => "La id enviada es invalida"
        ]);
        exit;
    }



}
