<?php
session_start();
$ruta = "/user_views/perfil.php#msg";

if (!isset($_SESSION["correo"]) || !isset($_SESSION["id_cliente"])) {
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

$_SESSION["edit_fail"] = true;

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $validar = new Validar($_POST);

    $vacios = $validar->requeridos(
        "pass-actual",
        "pass-nueva",
        "confirm-pass-nueva",
    );

    if (count($vacios) > 0) {
        $_SESSION["msg_edit"] = "Hacen falta los siguientes campos: " . implode(", ", $vacios);
        header("Location: {$ruta}");

        exit;
    }

    if (!$validar->password("pass-nueva", "confirm-pass-nueva")) {
        $_SESSION["msg_edit"] = "Contraseña inválida";
        header("Location: {$ruta}");

        exit;
    }
    if (strlen($_POST["pass-nueva"]) < 8) {
        $_SESSION["msg_edit"] = "La contraseña debe tener minimo 8 caracteres";
        header("Location: {$ruta}");

        exit;
    }

    if (trim($_POST["pass-nueva"]) != trim($_POST["confirm-pass-nueva"])) {
        $_SESSION["msg_edit"] = "Las contraseñas no coinciden";
        header("Location: {$ruta}");

        exit;
    }

    $pass_actual = trim($_POST["pass-actual"]);
    $pass_nueva = trim($_POST["pass-nueva"]);
    $confirm_pass_nueva = trim($_POST["confirm-pass-nueva"]);


    $usuario = new Usuario();
    $correo = trim($_SESSION["correo"]);

    if ($usuario->verificar_usuario($correo, $pass_actual)) {
        $resultado = $usuario->actualizar_pass($correo, $pass_nueva);

        if ($resultado) {

            require_once __DIR__ . "/../auth/logout_log.php";
        } else {
            $_SESSION["msg_edit"] = "Error al actualizar el usuario";
            header("Location: {$ruta}");

            exit;
        }
    } else {
        $_SESSION["msg_edit"] = "Contraseña incorrecta";
        header("Location: {$ruta}");

        exit;
    }
}
