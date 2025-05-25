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

require_once "../../model/comentarios.php";

use modelos\Comentario;

if ($_SERVER["REQUEST_METHOD"] == "GET") {
    if (!isset($_GET["id"]) || empty($_GET["id"])) {
        http_response_code(400);

        echo json_encode([
            "status" => 400,
            "mensaje" => "ID enviada invalida"
        ]);
        exit;
    }

    $id_comentario = $_GET["id"];

    $comentario = new Comentario();
    $respuesta = $comentario->eliminar_comentario($id_comentario);

    if ($respuesta) {
        http_response_code(200);

        echo json_encode([
            "status" => 200,
            "mensaje" => "Comentario eliminado con exito"
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
