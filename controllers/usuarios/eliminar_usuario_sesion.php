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
    $vacios = $validar->requeridos("password");

    if (count($vacios) > 0) {
        $_SESSION["msg_delete"] = "Hace falta la contraseña";
        header("Location: {$ruta}");

        exit;
    }

    if (strlen(trim($_POST["password"])) < 8) {
        $_SESSION["msg_edit"] = "La contraseña debe tener minimo 8 caracteres";
        header("Location: {$ruta}");

        exit;
    }

    $usuario = new Usuario();
    $password = trim($_POST["password"]);
    $correo = trim($_SESSION["correo"]);
    $id_usuario = trim($_SESSION["id_cliente"]);

    if ($usuario->verificar_usuario($correo, $password)) {
        $resultado = $usuario->borrar_usuario($id_usuario);

        if ($resultado) {
            $_SESSION = array();

            require_once __DIR__ . "/../auth/logout.php";
        } else {
            $_SESSION["msg_edit"] = "Error al eliminar el usuario" . $usuario->get_error();
            header("Location: {$ruta}");

            exit;
        }
    } else {
        $_SESSION["msg_edit"] = "Contraseña incorrecta";
        header("Location: {$ruta}");

        exit;
    }
}
