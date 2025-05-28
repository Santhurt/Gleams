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

use modelos\Producto;
use lib\Validar;

if($_SERVER["REQUEST_METHOD"] == "POST") {
    $validar = new Validar($_POST);

    $vacios = $validar->requeridos("id-producto", "descuento", "fecha-fin");

    if(count($vacios) > 0) {
        http_response_code(400);

        echo json_encode([
            "status" => 400,
            "mensaje" => "Hacen falta los siguientes campos: " . implode(", ", $vacios)
        ]);
        exit;
    }

    $id_producto = trim($_POST["id-producto"]);
    $descuento = trim($_POST["descuento"]);
    $fecha_fin = trim($_POST["fecha-fin"]);

    if($descuento <= 0 || $descuento > 100) {
        http_response_code(400);

        echo json_encode([
            "status" => 400,
            "mensaje" => "El descuento debe estar entre 1 y 100"
        ]);
        exit;

    } 

    $hoy = date("Y-m-d H:i");

    if(strtotime($fecha_fin) < strtotime($hoy)) {
        http_response_code(400);

        echo json_encode([
            "status" => 400,
            "mensaje" => "La fecha debe ser mayor a la actual"
        ]);
        exit;
    }

    $producto = new Producto();

    $respuesta = $producto->insertar_descuento($id_producto, $descuento, $fecha_fin);

    if($respuesta) {
        http_response_code(200);

        echo json_encode([
            "status" => 200,
            "mensaje" => "Descuento aplicado con exito"
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
?>
