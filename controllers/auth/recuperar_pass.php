<?php
session_start();
$ruta = "/user_views/recuperacion.php";
$ruta_login = "/user_views/login.php";

require_once __DIR__ . "/../../model/usuarios.php";
require_once __DIR__ . "/../lib/validaciones.php";
require_once __DIR__ . "/../lib/get_url.php";
require_once __DIR__ . "/../lib/mailer.php";

use modelos\Usuario;
use lib\Validar;
use lib\Correo;


if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (!isset($_POST["correo"]) || empty($_POST["correo"])) {
        $_SESSION["err_recuperacion"] = "Debe ingresar el correo";
        header("Location: {$ruta}");

        exit;
    }

    $validar = new Validar($_POST);

    if (!$validar->email("correo")) {
        $_SESSION["err_recuperacion"] = "El correo ingresado es invalido";
        header("Location: {$ruta}");

        exit;
    }

    $usuario = new Usuario();
    $correo_recuperacion = trim($_POST["correo"]);
    $codigo = bin2hex(random_bytes(10));  // Genera un código de 20 caracteres hexadecimales
    $respuesta = $usuario->crear_recuperacion($correo_recuperacion, $codigo);

    if ($respuesta) {
        $base_url = getBaseUrl();
        $enlace = $base_url. "user_views/recuperar.php?codigo=" . $codigo . "&correo=" . urlencode($correo_recuperacion);

        $correo = new Correo();
        $asunto = "Recuperación de contraseña";
        $mensaje = "Haz click en el siguiente enlace para recuperar tu contraseña: <a href='" . $enlace . "'>Recuperar Contraseña</a>";

        if ($correo->enviarCorreo($correo_recuperacion, $asunto, $mensaje)) {
            $_SESSION["err_recuperacion"] = "Mensaje enviado con éxito. Revisa tu correo para recuperar la contraseña";
            header("Location: {$ruta_login}");

            exit;
        }
    } else {
        $_SESSION["err_recuperacion"] = "Error: " . $usuario->get_error();
        header("Location: {$ruta}");

        exit;
    }
}
