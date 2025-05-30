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
require_once __DIR__ . "/../../model/comentarios.php";

use modelos\Comentario;

if ($_SERVER["REQUEST_METHOD"] == "GET") {
    $comentario = new Comentario();
    $resultado = $comentario->traer_comentarios();
    $comentarios = [];

    if ($resultado) {
        while ($fila = $resultado->fetch_assoc()) {
            foreach ($fila as $key => $value) {
                if($key == "estado") {
                    $fila[$key] = ($fila[$key] == 1) ? "Activo" : "Eliminado";

                    continue;
                }
                $fila[$key] = htmlspecialchars($value);
            }

            $comentarios[] = $fila;
        }

        http_response_code(200);

        echo json_encode([
            "status" => 200,
            "datos" => $comentarios
        ]);
        exit;
    } else {
        http_response_code(500);

        echo json_encode([
            "status" => 500,
            "mensaje" => "Error: " . $comentario->get_error()
        ]);
        exit;
    }
}
