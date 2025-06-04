<?php
require_once __DIR__ . "/../../model/consultar.php";

use modelos\Consultar;

if ($_SERVER["REQUEST_METHOD"] == "GET") {
    if (!isset($_GET["consulta"]) || empty($_GET["consulta"])) {
        http_response_code(404);

        echo json_encode([
            "status" => 404,
            "mensaje" => "Error al enviar la consulta"
        ]);
        exit;
    }

    $consulta = trim($_GET["consulta"]);

    $permitidos = ["ventas_mes", "ventas_dia", "cant_usuarios"];

    if (!in_array($consulta, $permitidos)) {
        http_response_code(400);

        echo json_encode([
            "status" => 400,
            "mensaje" => "La consulta no esta perimitida"
        ]);
        exit;
    }

    $consultar = new Consultar();

    switch ($consulta) {
        case 'ventas_mes':
            $resultado = $consultar->ventas_del_mes();
            break;

        case 'ventas_dia':
            $resultado = $consultar->ventas_del_dia();
            break;

        case 'cant_usuarios':
            $resultado = $consultar->usuarios_activos();
            break;

        default:
            # code...
            break;
    }

    if ($resultado) {
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
            "mensaje" => "Error: " . $consultar->get_error()
        ]);
        exit;
    }
}
