<?php
require_once __DIR__ . "/../../model/usuarios.php";
require_once __DIR__ . "/../lib/validaciones.php";

use lib\Validar;
use modelos\Usuario;


if ($_SERVER["REQUEST_METHOD"] == "POST") {
    header("Content-Type: application/json");
    $validar = new Validar($_POST);

    $vacios = $validar->requeridos(
        "nombre",
        "correo",
        "telefono",
        "password",
        "confirm-password",
        "direccion"
    );

    //para formatear mejor la salida
    $index_confirm = array_search("confirm-password", $vacios);
    $index_password = array_search("password", $vacios);

    if ($index_confirm !== false && $index_password !== false) {
        $vacios[$index_confirm] = "Contraseña";
        $vacios[$index_password] = "Confirmar contraseña";
    }


    if (count($vacios) > 0) {
        http_response_code(400);

        echo json_encode([
            "mensaje" => "Hacen falta los siguientes campos: " . implode(", ", $vacios)
        ]);
        exit;
    }

    if(!$validar->text("nombre" )) {
        http_response_code(400);

        echo json_encode([
            "mensaje" => "Carácteres inválidos en el nombre"
        ]);
        exit;
    }

    if(!$validar->password($_POST["password"])) {
        http_response_code(400);
        
        echo json_encode([
            "mensaje" => "Contraseña inválida"
        ]);
        exit;
    }

    if(!$validar->direccion(trim($_POST["direccion"]))) {
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


    if ($_POST["password"] !== $_POST["confirm-password"]) {
        http_response_code(400);

        echo json_encode([
            "mensaje" => "Las contraseñas no coinciden"
        ]);
        exit;
    }

    if (strlen($_POST["password"]) < 8) {
        http_response_code(400);
        echo json_encode([
            "mensaje" => "La contraseña debe ser minimo de 8 caracteres"
        ]);
        exit;
    }


    $usuario = new Usuario();
    $_POST["password"] = password_hash($_POST["password"], PASSWORD_DEFAULT);

    $validacion_correo = $usuario->verificar_correo($_POST["correo"]);
    if ($validacion_correo && !isset($validacion_correo["error_consulta"])) {
        http_response_code(400);

        echo json_encode([
            "mensaje" => "El correo electronico ya esta en uso"
        ]);
        exit;
        # Cuanto desearia que el hp inteliphense tuviera pa renombrar
    } else if(isset($validacion_correo["error_consulta"])) {
        http_response_code(400);

        echo json_encode([
            "mensaje" => "Error: " . $usuario->get_error()
        ]);
        exit;
    }


    $resultado = $usuario->insertar_usuario($_POST);
    unset($_POST["password"]);

    if ($resultado) {
        http_response_code(200);

        echo json_encode([
            "datos" => $_POST
        ]);
        exit;
    } else {
        http_response_code(500);

        echo json_encode([
            "mensaje" => "Error: " . $usuario->get_error()
        ]);
        exit;
    }
}
