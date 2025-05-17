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
require_once __DIR__ . "/../lib/validaciones.php";
require_once __DIR__ . "/../lib/crear_imagen.php";

use modelos\Producto;
use lib\Validar;

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    header("Content-Type: application/json");

    $validar = new Validar($_POST);

    $vacios = $validar->requeridos(
        "nombre",
        "descripcion",
        "precio",
        "stock",
        "categoria"
    );

    if (count($vacios) > 0) {
        http_response_code(400);
        echo json_encode([
            "status" => 400,
            "mensaje" => "Hacen falta los siguientes campos: " . implode(", ", $vacios)
        ]);
        exit;
    }

    if (!$validar->numeros("precio", "stock")) {
        http_response_code(400);
        echo json_encode([
            "status" => 400,
            "mensaje" => "Error al validar los numeros"
        ]);
        exit;
    }

    if(!$validar->text("nombre", "descripcion")) {
        http_response_code(400);

        echo json_encode([
            "status" => 400,
            "mensaje" => "No se pueden ingresar caracteres especiales"
        ]);
        exit;
    }

    $img_ruta = insertar_imagen("imagen");

    if (empty($img_ruta["ruta"])) {
        http_response_code(400);

        echo json_encode([
            "status" => 400,
            "mensaje" => $img_ruta["error"]
        ]);
        exit;
    }


    $producto = new Producto();
    $resultado = $producto->insertar_producto($_POST, $img_ruta["ruta"]);

    if ($resultado["producto_insertado"]) {
        http_response_code(200);

        $_POST["imagen"] = $img_ruta["ruta"];
        $_POST["id"] = $resultado["nueva_id"];
        $_POST["ok"] = true;

        echo json_encode($_POST);
        exit;
    } else {
        http_response_code(500);

        unlink($img_ruta["absoluta"]);
        echo json_encode([
            "status" => 500,
            "mensaje" => "Error en el servidor: " . $producto->get_error()
        ]);
        exit;
    }
}
