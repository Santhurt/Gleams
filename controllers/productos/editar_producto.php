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
require_once __DIR__ . "/../lib/validaciones.php";
require_once __DIR__ . "/../lib/crear_imagen.php";

use modelos\Producto;
use lib\Validar;

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    header("Content-Type: application/json");
    $validar = new Validar($_POST);

    $vacios  = $validar->requeridos(
        "id",
        "nombre",
        "descripcion",
        "precio"
    );

    if (count($vacios) > 0) {
        http_response_code(400);

        echo json_encode([
            "status" => 400,
            "mensaje" => "Hacen falta los siguientes campos: " . implode(", ", $vacios)
        ]);
        exit;
    }

    if (!$validar->text("nombre", "descripcion")) {
        http_response_code(400);

        echo json_encode([
            "status" => 400,
            "mensaje" => "No se pueden ingresar caracteres especiales"
        ]);
        exit;
    }

    if (!$validar->numeros("id", "precio", "stock", "categoria")) {
        http_response_code(400);

        echo json_encode([
            "status" => 400,
            "mensaje" => "Los numeros ingresados son invalidos"
        ]);
        exit;
    }


    $producto = new Producto();
    $producto_antiguo = $producto->traer_productoPorId($_POST["id"]);

    $imagen_nueva_subida = is_uploaded_file($_FILES["imagen"]["tmp_name"]);
    $img_nueva = [];

    if ($imagen_nueva_subida) {
        error_log("holaaaa");
        error_log(implode(", ", $_FILES["imagen"]));
        $img_nueva = insertar_imagen("imagen", true, $producto_antiguo["ruta"], true, 800, 600, 85);

        if (empty($img_nueva["ruta"])) {
            http_response_code(400);

            echo json_encode([
                "status" => 400,
                "mensaje" => "Error al subir la imagen: " . $img_nueva["error"]
            ]);
            exit;
        }
    } else {
        $img_nueva["ruta"] = $producto_antiguo["ruta"];
    }


    $resultado = $producto->editar_producto($_POST, $img_nueva["ruta"]);

    if ($resultado) {
        http_response_code(200);
        $_POST["ok"] = true;
        $_POST["imagen"] = $img_nueva["ruta"];

        echo json_encode($_POST);
        exit;
    } else {
        http_response_code(500);

        unlink($img_nueva["ruta_absoluta"]);
        echo json_encode([
            "status" => 500,
            "mensaje" => "Error al insertar el producto: " . $producto->get_error()
        ]);
        exit;
    }
}
