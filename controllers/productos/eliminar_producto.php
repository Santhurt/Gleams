<?php
session_start();

if(!isset($_SESSION["correo"]) || !isset($_SESSION["rol"]) || $_SESSION["rol"] !== "admin") {
    http_response_code(401);
    echo json_encode([
        "status" => 401,
        "mensaje" => "Acceso denegado"
    ]);
    exit;
}

require_once __DIR__ . "/../../model/productos.php";

use modelos\Producto;

if ($_SERVER["REQUEST_METHOD"] == "DELETE") {
    $input = file_get_contents("php://input");
    $_DELETE = json_decode($input, true);

    $id_producto = $_DELETE["id_producto"] ?? null;

    if (!$id_producto) {
        http_response_code(400);
        echo json_encode([
            "status" => 400,
            "mensaje" => "La id enviada es vacia"
        ]);
        exit;
    }

    $producto = new Producto();
    $datos_producto = $producto->traer_productoPorId($id_producto);
    $respuesta = $producto->eliminar_producto($id_producto);


    if ($respuesta) {
        http_response_code(200);
        unlink(__DIR__ . "/../../{$datos_producto["ruta"]}");
        echo json_encode([
            "status" => 200,
            "mensaje" => "Producto eliminado con exito"
        ]);
        exit;
    } else {
        http_response_code(500);
        echo json_encode([
            "status" => 500,
            "mensaje" => "Error al eliminar el producto {$producto->get_error()}"
        ]);
        exit;
    }
}
