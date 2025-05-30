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
        "nombre",
        "telefono",
        "direccion",
        "password"
    );

    if (count($vacios) > 0) {
        $_SESSION["msg_edit"] = "Hacen falta los siguientes campos: " . implode(", ", $vacios);
        header("Location: {$ruta}");

        exit;
    }

    if (!$validar->text("nombre")) {
        $_SESSION["msg_edit"] = "Caracteres no permitidos en el nombre";
        header("Location: {$ruta}");

        exit;
    }

    if (!$validar->direccion($_POST["direccion"])) {
        $_SESSION["msg_edit"] = "Dirección invalida";
        header("Location: {$ruta}");

        exit;
    }

    if (!$validar->numeros("telefono") || strlen($_POST["telefono"]) > 10  || strlen($_POST["telefono"])  < 7) {
        $_SESSION["msg_edit"] = "Numero de telefono invalido";
        header("Location: {$ruta}");

        exit;
    }

    if (strlen($_POST["password"]) < 8) {
        $_SESSION["msg_edit"] = "La contraseña debe tener minimo 8 caracteres";
        header("Location: {$ruta}");

        exit;
    }

    $usuario = new Usuario();

    $correo = trim($_SESSION["correo"]);
    $id_usuario = trim($_SESSION["id_cliente"]);
    $password = trim($_POST["password"]);

    if ($usuario->verificar_usuario($correo, $password)) {

        $resultado_usuario = $usuario->traer_usuarioPorId($id_usuario);

        if(!$resultado_usuario) {
            $_SESSION["msg_edit"] = "Error al traer el usuario";
            header("Location: {$ruta}");

            exit;

        }

        $_POST["id"] = $id_usuario;
        $_POST["fecha"] = $resultado_usuario["fecha de registro"];
        $_POST["correo"] = $resultado_usuario["correo"];
        $_POST["roles"] = 2;


        $resultado_edicion = $usuario->editar_usuario($_POST);

        if ($resultado_edicion) {
            $_SESSION["msg_edit"] = "Usuario editado con exito";
            $_SESSION["edit_fail"] = false;
            header("Location: {$ruta}");

            exit;
        } else {
            $_SESSION["msg_edit"] = "Error: " . $usuario->get_error();
            header("Location: {$ruta}");

            exit;
        }
    } else {
        $_SESSION["msg_edit"] = "Error: " . $usuario->get_error();
        header("Location: {$ruta}");

        exit;
    }
}
