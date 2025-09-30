<?php

use lib\Validar;
use modelos\Producto;

session_start();

if (!isset($_SESSION["correo"]) || !isset($_SESSION["rol"]) || $_SESSION["rol"] !== "admin") {
    http_response_code(401);
    echo json_encode([
        "status" => 401,
        "mensaje" => "Acceso denegado"
    ]);
    exit;
}

require_once __DIR__ . "/../../model/productos.php";
require_once __DIR__ . "/../lib/validaciones.php";

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    header("Content-Type: application/json");

    $validar = new Validar($_POST);

    if (!$validar->text("nombre")) {
        http_response_code(400);

        echo json_encode([
            "status" => 400,
            "mensaje" => "No se pueden ingresar caracteres especiales"
        ]);
        exit;
    }

    $producto = new Producto();
    $resultado = $producto->crearCategoria($_POST["nombre"]);

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
