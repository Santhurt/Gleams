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

require_once __DIR__ . "/../../model/productos.php";

use modelos\Producto;

if ($_SERVER["REQUEST_METHOD"] == "GET") {
    if (!isset($_GET["id"]) || empty($_GET["id"])) {
        http_response_code(400);

        echo json_encode([
            "status" => 400,
            "mensaje" => "ID Del producto invalida"
        ]);
        exit;
    }

    $producto = new Producto();
    $id_producto = trim($_GET["id"]);

    $respuesta = $producto->eliminar_descuento($id_producto);

    if($respuesta) {
        http_response_code(200);

        echo json_encode([
            "status" => 200,
            "mensaje" => "Descuento eliminado"
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
