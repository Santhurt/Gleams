<?php
require_once __DIR__ . "/../../model/usuarios.php";
use modelos\Usuario;

if($_SERVER["REQUEST_METHOD"] == "GET") {
    $usuario = new Usuario();
    $resultado = $usuario->traer_roles();
    $roles = [];

    while ($fila = $resultado->fetch_assoc()) {
        foreach ($fila as $campo => $value) {
            $fila[$campo] = htmlspecialchars($value); 
        }

        $roles[] = $fila;
    }

    if($resultado) {
        http_response_code(200);
        echo json_encode($roles);
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
