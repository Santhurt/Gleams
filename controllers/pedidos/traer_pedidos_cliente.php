<?php
session_start();

if (!isset($_SESSION["correo"]) || !isset($_SESSION["id_cliente"])) {
    http_response_code(400);

    echo json_encode([
        "status" => 400,
        "mensaje" => "Debe de ingresar sesion"
    ]);
    exit;
}

require_once  __DIR__ ."/../../model/pedidos.php";
use modelos\Pedido;

if($_SERVER["REQUEST_METHOD"] == "GET") {
    $id_cliente = trim($_SESSION["id_cliente"]);

    $pedido = new Pedido();
    $resultado = $pedido->traer_pedidos_por_cliente($id_cliente);
    $pedidos = [];

    if($resultado) {

        while($fila = $resultado->fetch_assoc()) {
            foreach ($fila as $campo => $valor) {
                $fila[$campo] = htmlspecialchars($valor);
            }

            $pedidos[] = $fila;
        }

        http_response_code(200);
        echo json_encode([
            "status" => 200,
            "datos" => $pedidos
        ]);
        exit;

    } else {
        http_response_code(500);
        echo json_encode([
            "status" => 500,
            "mensaje" => "Error al traer los pedidos"
        ]);
        exit;
    }
}

