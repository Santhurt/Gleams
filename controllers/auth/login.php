<?php
session_start();
$ruta = "/user_views/login.php";


require_once __DIR__ . "/../lib/validaciones.php";
require_once __DIR__ . "/../../model/usuarios.php";

use modelos\Usuario;
use lib\Validar;

if (!isset($_SESSION["intentos_login"])) {
    $_SESSION["intentos_login"] = 0;
    $_SESSION["tiempo_ultimo_intento"] = time();
} else {
    $min_5 = 300;

    if ((time() - $_SESSION["tiempo_ultimo_intento"]) > $min_5) {
        $_SESSION["intentos_login"] = 0;
        $_SESSION["tiempo_ultimo_intento"] = time();
    }

    if($_SESSION["intentos_login"] > 5) {
        $_SESSION["err_login"] = "Demasiados intentos, intentelo mas tarde";
        header("Location: {$ruta}");

        exit;
    }
}

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
    $_SESSION["intentos_login"]++;
    $_SESSION["tiempo_ultimo_intento"] = time();

    if ($usuario->verificar_usuario($correo, $password)) {
        $_SESSION["intentos_login"] = 0;
        $res_usuario = $usuario->traer_usuarioPorCorreo($correo);

        session_regenerate_id(true);

        $_SESSION["usuario"] = $res_usuario["nombre"];
        $_SESSION["correo"] = $correo;
        $_SESSION["rol"] = $res_usuario["rol"];

        $ruta_destino = ($res_usuario["rol"] == "admin") ? "/admin_views/dashboard.php" : "/user_views/shop.php";

        header("Location: {$ruta_destino}");
        exit;
    } else {
        $_SESSION["err_login"] = $usuario->get_error();
        header("Location: {$ruta}");
        exit;
    }
}
