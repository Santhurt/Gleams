<?php
session_start();
$ruta = "/user_views/login.php";


require_once __DIR__ . "/../lib/validaciones.php";
require_once __DIR__ . "/../../model/usuarios.php";

use modelos\Usuario;
use lib\Validar;

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $validar = new Validar($_POST);
    $vacios = $validar->requeridos("correo", "password");

    $index_password = array_search("password", $vacios);

    if ($index_password !== false) {
        $vacios[$index_password] = "Contraseña";
    }

    if (count($vacios) > 0) {
        $_SESSION["err_login"] = "Hacen falta los siguientes campos: " . implode(", ", $vacios);
        header("Location: {$ruta}");

        exit;
    }

    if (!$validar->email("correo")) {
        $_SESSION["err_login"] = "El correo ingresado es invalido";
        header("Location: {$ruta}");

        exit;
    }

    if (strlen($_POST["password"]) < 8) {
        $_SESSION["err_login"] = "La contraseeña debe tener minimo 8 caracteres";
        header("Location: {$ruta}");

        exit;
    }

    $correo = trim($_POST["correo"]);
    $password = trim($_POST["password"]);

    $usuario = new Usuario();

    if ($usuario->verificar_usuario($correo, $password)) {
        $res_usuario = $usuario->traer_usuarioPorCorreo($correo);
        error_log("entro condicional");

        if ($res_usuario["rol"] = "cliente") {
            $ruta_shop = "/user_views/shop.php";

            $_SESSION["correo"] = $correo;
            $_SESSION["password"] = $password;

            header("Location: {$ruta_shop}");
            exit;
        }
    } else {
        $_SESSION["err_login"] = $usuario->get_error();
        error_log("entro else");
        header("Location: {$ruta}");
        exit;
    }
}
