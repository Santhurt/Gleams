<?php
require_once __DIR__ . "/../../model/comentarios.php";
use modelos\Comentario;

if($_SERVER["REQUEST_METHOD"] == "GET") {
    $comentario = new Comentario();
    $resultado = $comentario->traer_comentarios_por_producto($_GET["id"]);
    $comentarios = [];

    if($resultado) {
        while($fila = $resultado->fetch_assoc()) {
            foreach ($fila as $campo => $valor) {
                $fila[$campo] = htmlspecialchars($valor);
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
            "mensaje" => $comentario->get_error()
        ]);
        exit;
    }

}
?>
