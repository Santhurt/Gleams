<?php

session_start();

use lib\Validar;
use modelos\Producto;



if (!isset($_SESSION["correo"]) || !isset($_SESSION["rol"]) || $_SESSION["rol"] !== "admin") {
    http_response_code(401);
    echo json_encode([
        "status" => 401,
        "mensaje" => "Acceso denegado"
    ]);
    exit;
}

error_log("holaaaaaaa");

require_once __DIR__ . "/../../model/productos.php";
require_once __DIR__ . "/../lib/validaciones.php";

if ($_SERVER["REQUEST_METHOD"] === "GET") {
    header("Content-Type: application/json");

    $validar = new Validar($_POST);


    if (!isset($_GET["monto"]) || empty($_GET["monto"])) {
        http_response_code(400);

        echo json_encode([
            "status" => 400,
            "mensaje" => "No se encontró el monto"
        ]);
        exit;
    }

    if (!is_numeric($_GET["monto"])) {
        http_response_code(400);

        echo json_encode([
            "status" => 400,
            "mensaje" => "El monto debe ser un número"
        ]);
        exit;
    }

    $producto = new Producto();
    $resultado = $producto->asignar_domicilio($_GET["monto"]);

    if ($resultado) {
        http_response_code(200);

        echo  json_encode([
            "status" => 200,
            "data" => $resultado
        ]);
        exit;
    } else {
        http_response_code(500);

        echo json_encode([
            "status" => 500,
            "mensaje" => "Error: " . $producto->get_error()
        ]);
        exit;
    }
}
