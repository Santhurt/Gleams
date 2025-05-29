<?php
session_start();
if (!isset($_SESSION["correo"]) || !isset($_SESSION["id_cliente"])) {
    http_response_code(401);
    echo json_encode([
        "status" => 401,
        "mensaje" => "Inicie sesion para comentar"
    ]);
    exit;
}
require_once __DIR__ . "/../../model/comentarios.php";
require_once __DIR__ . "/../lib/validaciones.php";

use modelos\Comentario;
use lib\Validar;

if($_SERVER["REQUEST_METHOD"] == "POST") {
    $validar = new Validar($_POST);

    $vacios = $validar->requeridos(
        "id-producto",
        "rating",
        "comentario"
    );

    if(count($vacios) > 0) {
        http_response_code(400);
        echo json_encode([
            "status" => 400,
            "mensaje" => "Hacen falta los siguientes campos: " . implode(", ", $vacios)
        ]);
        exit;
    }
    
    if (!$validar->numeros("rating")) {
        http_response_code(400);
        echo json_encode([
            "status" => 400,
            "mensaje" => "Calificion invalida"
        ]);
        exit;
    }
    
    if(!$validar->text("comentario")) {
        http_response_code(400);

        echo json_encode([
            "status" => 400,
            "mensaje" => "Carácteres invalidos en el comentario"
        ]);
        exit;
    }

    $comentario_data = [
        "id_cliente" => trim($_SESSION["id_cliente"]),
        "id_producto" => trim($_POST["id-producto"]),
        "comentario" => trim($_POST["comentario"]),
        "estrellas" => trim($_POST["rating"])
    ];

    $comentario = new Comentario();

    if($comentario->insertar_comentario($comentario_data)) {
        http_response_code(200);

        echo json_encode([
            "status" => 200,
            "datos" => $comentario
        ]);
        exit;
    } else {
        http_response_code(500);

        echo json_encode([
            "mensaje" => "Error al crear el comentario"
        ]);
        exit;
    }

}

?>
