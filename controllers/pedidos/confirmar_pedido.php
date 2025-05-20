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

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $id_cliente = $_SESSION["id_cliente"];

    # TODO : obtener el total de los pedidos, o mirar si se puede hacer desde la base de datos
}
