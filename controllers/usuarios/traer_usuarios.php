<?php
require_once __DIR__ . "/../../model/usuarios.php";

use modelos\Usuario;

if ($_SERVER["REQUEST_METHOD"] == "GET") {

    $usuario = new Usuario();
    $respuesta = $usuario->traer_usuarios();
    $usuarios = [];

    if ($respuesta) {
        http_response_code(200);

        while ($fila = $respuesta->fetch_assoc()) {
            foreach ($fila as $campo => $valor) {
                $fila[$campo] = htmlspecialchars($valor);
            }

            $usuarios[] = $fila;
        }

        echo json_encode($usuarios);
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
