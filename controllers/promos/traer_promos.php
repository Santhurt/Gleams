<?php
require_once __DIR__ . "/../../model/promos.php";

use modelos\Promo;

if ($_SERVER["REQUEST_METHOD"] == "GET") {
    $promo = new Promo();
    $promos = [];

    $respuesta = $promo->traer_promos();

    if ($respuesta) {
        http_response_code(200);

        while ($fila = $respuesta->fetch_assoc()) {
            foreach ($fila as $key => $value) {
                $fila[$key] = htmlspecialchars($value);
            }

            $promos[] = $fila;
        }

        echo json_encode([
            "status" => 200,
            "datos" => $promos
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
