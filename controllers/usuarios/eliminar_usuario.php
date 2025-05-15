<?php
require_once "../../model/usuarios.php";

use modelos\Usuario;

if ($_SERVER["REQUEST_METHOD"] == "DELETE") {
    $input = file_get_contents("php://input");
    $_DELETE = json_decode($input, true);

    $id = $_DELETE["id_usuario"] ?? null;

    if (!$id) {

        http_response_code(400);
        echo json_encode([
            "status" => 400,
            "mensaje" => "La id enviada es vacia"
        ]);
        exit;
    }

    $usuario = new Usuario();
    $datos_usuario = $usuario->traer_usuarioPorId($id);

    $respuesta = $usuario->eliminar_usuario($id);

    if ($respuesta) {
        http_response_code(200);

        echo json_encode([
            "status" => 200,
            "mensaje" => "Usuario eliminado con exito"

        ]);
        exit;
    } else {
        http_response_code(500);

        echo json_encode([
            "status" => 500,
            "mensaje" => "Error: " . $usuario->get_error()
        ]);
        exit;
    }
}
