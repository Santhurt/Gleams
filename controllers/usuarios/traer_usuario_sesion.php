<?php
session_start();

if (!isset($_SESSION["correo"]) || !isset($_SESSION["id_cliente"])) {
    http_response_code(401);
    echo json_encode([
        "status" => 401,
        "mensaje" => "Acceso denegado"
    ]);
    exit;
}

require_once __DIR__ . "/../../model/usuarios.php";
use modelos\Usuario;

if ($_SERVER["REQUEST_METHOD"] === "GET") {
    $id_cliente = $_SESSION["id_cliente"];

    $usuario = new Usuario();
    $resultado = $usuario->traer_usuarioPorId($id_cliente);

    if ($resultado) {
        foreach ($resultado as $campo => $valor) {
            $resultado[$campo] = htmlspecialchars($valor);
        }

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
            "mensaje" => $usuario->get_error()
        ]);
        exit;
    }
}
?>
