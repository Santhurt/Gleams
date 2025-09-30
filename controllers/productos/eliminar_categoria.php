<?php
session_start();
use modelos\Producto;

if (!isset($_SESSION["correo"]) || !isset($_SESSION["rol"]) || $_SESSION["rol"] !== "admin") {
    http_response_code(401);
    echo json_encode([
        "status" => 401,
        "mensaje" => "Acceso denegado"
    ]);
    exit;
}

require_once __DIR__ . "/../../model/productos.php";

if ($_SERVER["REQUEST_METHOD"] === "GET") {
    header("Content-Type: application/json");


    if(!isset($_GET["id"]) || empty($_GET["id"])) {
        http_response_code(400);

        echo json_encode([
            "status" => 400,
            "mensaje" => "No se encontró el ID"
        ]);
        exit;

    }


    $producto = new Producto();

    $sin_productos_asignados = $producto->verificar_categoria($_GET["id"]);
    error_log("ID aver si funciona: ");

    if(!$sin_productos_asignados) {
        http_response_code(400);

        echo json_encode([
            "status" => 400,
            "mensaje" => "La categoría tiene productos asignados"
        ]);
        exit;
    }
    $resultado = $producto->eliminar_categoria($_GET["id"]);

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
