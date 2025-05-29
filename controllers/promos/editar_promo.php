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

require_once __DIR__ . "/../../model/promos.php";
require_once __DIR__ . "/../lib/validaciones.php";
require_once __DIR__ . "/../lib/crear_imagen.php";

use modelos\Promo;
use lib\Validar;

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $validar = new Validar($_POST);

    $vacios = $validar->requeridos("titulo", "descripcion");

    if (count($vacios) > 0) {
        http_response_code(400);

        echo json_encode([
            "status" => 400,
            "mensaje" => "Hacen falta los siguientes campos: " . implode(", ", $vacios)
        ]);
        exit;
    }

    if (!$validar->text("titulo", "descripcion")) {
        http_response_code(400);

        echo json_encode([
            "status" => 400,
            "mensaje" => "Carácteres no perimitidos"
        ]);
        exit;
    }
    $promo = new Promo();
    $id_promo = trim($_POST["id"]);
    $titulo = trim($_POST["titulo"]);
    $descripcion = trim($_POST["descripcion"]);

    $promo_anterior = $promo->traer_promo_por_id($id_promo);

    $imagen_nueva_subida = is_uploaded_file($_FILES["imagen"]["tmp_name"]);

    if ($imagen_nueva_subida) {
        $img_nueva = insertar_imagen("imagen", true, $promo_anterior["ruta"]);

        if (empty($img_nueva["ruta"])) {
            http_response_code(400);

            echo json_encode([
                "status" => 400,
                "mensaje" => "Error al subir la imagen: " . $img_nueva["error"]
            ]);
            exit;
        }
    } else {
        $img_nueva["ruta"] = $promo_anterior["ruta"];
    }

    $resultado = $promo->editar_promo($id_promo, $titulo, $descripcion, $img_nueva["ruta"]);

    if($resultado) {
        http_response_code(200);

        echo json_encode([
            "status" => 200,
            "mensaje" => "Promoción actualizada"
        ]);
        exit;

    } else {
        http_response_code(500);

        echo json_encode([
            "status" => 500,
            "mensaje" => "Error: " . $promo->get_error()
        ]);
        exit;

    }
}
