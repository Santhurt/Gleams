<?php
require_once __DIR__. "/../../model/usuarios.php";
use modelos\Usuario;

if($_SERVER["REQUEST_METHOD"] == "GET") {
    if(!isset($_GET["id"]) || empty(trim($_GET["id"]))) {
        http_response_code(400);

        echo json_encode([
            "status" => 400,
            "mensaje" => "Id vacia enviada"
        ]);
        exit;
    }

    if(!is_numeric($_GET["id"]) || $_GET["id"] < 0) {
        http_response_code(400);

        echo json_encode([
            "status" => 400,
            "mensaje" => "ID Invalida enviada"
        ]);
        exit;
    }

    $usuario = new Usuario();
    $resultado = $usuario->traer_usuarioPorId($_GET["id"]);

    # Sanitizacion
    foreach ($resultado as $campo => $valor) {
        $resultado[$campo] = htmlspecialchars($valor);
    }


    if($resultado) {
        http_response_code(200);

        echo json_encode($resultado);
        exit;
    } else {
        http_response_code(500);

        echo json_encode([
            "status" => 500,
            "menaje" => "Error: " . $usuario->get_error()
        ]);
        exit;
    }

}
?>
