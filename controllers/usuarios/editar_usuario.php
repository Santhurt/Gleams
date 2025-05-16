<?php
require_once __DIR__ . "/../../model/usuarios.php";
require_once  __DIR__ . "/../lib/validaciones.php";

use modelos\Usuario;
use lib\Validar;

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    header("Content-Type: application/json");

    $validar = new Validar($_POST);

    $vacios = $validar->requeridos(
        "nombre",
        "telefono",
        "roles",
        "fecha",
        "correo",
        "direccion"
    );

    if (count($vacios) > 0) {
        http_response_code(400);

        echo json_encode([
            "mensaje" => "Hacen falta los siguientes campos: " . implode(", ", $vacios)
        ]);
        exit;
    }

    if (!$validar->text("nombre", "direccion")) {
        http_response_code(400);

        echo json_encode([
            "mensaje" => "No se pueden ingresar caracteres especiales"
        ]);
        exit;
    }

    if (!$validar->numeros("telefono") || strlen($_POST["telefono"]) > 10  || strlen($_POST["telefono"])  < 7) {
        http_response_code(400);

        echo json_encode([
            "mensaje" => "El telefono es invalido"
        ]);
        exit;
    }

    if (!$validar->email("correo")) {
        http_response_code(400);

        echo json_encode([
            "mensaje" => "El correo es invalido"
        ]);
        exit;
    }

    if (!$validar->date($_POST["fecha"])) {
        http_response_code(400);

        echo json_encode([
            "status" => 400,
            "mensaje" => "La fecha ingresada es invalida"
        ]);
        exit;
    }

    $usuario = new Usuario();
    $resultado_usuario = $usuario->traer_usuarioPorId($_POST["id"]);
    $correos_iguales = true;

    if ($_POST["correo"] != $resultado_usuario["correo"]) {
        if ($usuario->correo_existe($_POST["correo"])) {
            http_response_code(400);

            echo json_encode([
                "status" => 400,
                "mensaje" => "El nuevo correo ya esta asignado a otro usuario"
            ]);
            exit;
        }

        $correos_iguales = false;
    }


    $resultado = $usuario->editar_usuario($_POST);

    if ($resultado) {
        http_response_code(200);
        $_POST["estado"] = 1;
        $_POST["roles"] = ($_POST["roles"] == 1) ? "admin" : "cliente";

        echo json_encode($_POST);
        exit;
    } else {
        json_encode([
            "status" => 500,
            "mensaje" => "Error: " . $usuario->get_error()
        ]);
        exit;
    }
}
