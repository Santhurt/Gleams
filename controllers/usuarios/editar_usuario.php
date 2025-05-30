<?php
session_start();

if (!isset($_SESSION["correo"]) || !isset($_SESSION["rol"]) || $_SESSION["rol"] !== "admin") {
    http_response_code(401);
    echo json_encode([
        "status" => 401,
        "mensaje" => "Acceso denegado"
    ]);
    exit;
}

require_once __DIR__ . "/../../model/usuarios.php";
require_once  __DIR__ . "/../lib/validaciones.php";

use modelos\Usuario;
use lib\Validar;

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    header("Content-Type: application/json");

    if (!isset($_POST["id"])) {
        http_response_code(400);
        echo json_encode(["mensaje" => "Falta el campo 'id'"]);
        exit;
    }

    $validar = new Validar($_POST);

    $vacios = $validar->requeridos(
        "nombre",
        "telefono",
        "roles",
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

    if (!$validar->text("nombre")) {
        http_response_code(400);

        echo json_encode([
            "mensaje" => "No se pueden ingresar caracteres especiales"
        ]);
        exit;
    }

    if (!$validar->direccion(trim($_POST["direccion"]))) {
        http_response_code(400);

        echo json_encode([
            "mensaje" => "Direccion invalida"
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

    $usuario = new Usuario();
    $resultado_usuario = $usuario->traer_usuarioPorId($_POST["id"]);
    $correos_iguales = true;

    if ($_POST["correo"] != $resultado_usuario["correo"]) {
        if ($usuario->verificar_correo($_POST["correo"])) {
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
        $_POST["estado"] = "Activo";
        $_POST["fecha"] = $resultado_usuario["fecha de registro"];
        $_POST["roles"] = ($_POST["roles"] == 1) ? "admin" : "cliente";

        echo json_encode($_POST);
        exit;
    } else {
        echo json_encode([
            "status" => 500,
            "mensaje" => "Error: " . $usuario->get_error()
        ]);
        exit;
    }
}
