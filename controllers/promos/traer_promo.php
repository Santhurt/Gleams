<?php

use modelos\Promo;

session_start();

if (!isset($_SESSION["correo"]) || !isset($_SESSION["rol"]) || $_SESSION["rol"] !== "admin") {
    http_response_code(401);
    echo json_encode([
        "status" => 401,
        "mensaje" => "Acceso denegado"
    ]);
    exit;
}

require_once __DIR__ . "/../lib/validaciones.php";
require_once __DIR__ . "/../../model/promos.php";


if ($_SERVER["REQUEST_METHOD"] == "GET") {

    if (!isset($_GET["id"]) || empty($_GET["id"])) {
        http_response_code(400);

        echo json_encode([
            "status" => 400,
            "mensaje" => "ID no encontrada"
        ]);
        exit;
    }

    $id_promo = trim($_GET["id"]);

    $promo = new Promo();
    $resultado = $promo->traer_promo_por_id($id_promo);

    if ($resultado) {
        http_response_code(200);

        echo json_encode([
            "status" => 200,
            "datos" => $resultado
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
