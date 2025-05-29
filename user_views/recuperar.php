<?php
session_start();

require_once __DIR__ . "/../model/usuarios.php";
require_once __DIR__ . "/../controllers/lib/validaciones.php";

use modelos\Usuario;
use lib\Validar;

if (!isset($_GET['codigo']) || empty($_GET["codigo"]) || !isset($_GET['correo']) || empty($_GET["correo"])) {
    $_SESSION["err_recuperacion"] = "Hacen falta el codigo y correo";
}
$correo = trim($_GET["correo"]);
$codigo = trim($_GET["codigo"]);

$usuario = new Usuario();

if (!$usuario->verificar_recuperacion($correo, $codigo)) {
    $_SESSION["err_recuperacion"] = $usuario->get_error();
}

?>
<?php if ($_SERVER["REQUEST_METHOD"] == "POST"): ?>
    <?php
    $validar = new Validar($_POST);

    if (count($validar->requeridos("password")) > 0) {
        $_SESSION["err_recuperacion"] = "Ingrese la contraseña";
        header("Location: recuperar.php?codigo={$codigo}&correo=" . urlencode($correo));
        exit;
    }

    if (!$validar->text("password")) {
        $_SESSION["err_recuperacion"] = "Contraseña invalida";
        header("Location: recuperar.php?codigo={$codigo}&correo=" . urlencode($correo));
        exit;
    }

    if (strlen($_POST["password"]) < 8) {
        $_SESSION["err_recuperacion"] = "La contraseña debe tener minimo 8 caracteres";
        header("Location: recuperar.php?codigo={$codigo}&correo=" . urlencode($correo));
        exit;
    }


    $password = trim($_POST["password"]);
    $resultado = $usuario->actualizar_pass($correo, $password);

    if ($resultado) {
        $_SESSION["err_recuperacion"] = "Contraseña cambiada con exito";
        header("Location: login.php"); 
        exit;
    } else {
        $_SESSION["err_recuperacion"] = "Error: " . $usuario->get_error();
        header("Location: recuperar.php?codigo={$codigo}&correo=" . urlencode($correo));
        exit;
    }

    ?>
<?php elseif ($_SERVER["REQUEST_METHOD"] == "GET"): ?>
    <!DOCTYPE html>
    <html lang="es">

    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>GLEAMS - Recuperación</title>
        <!-- Bootstrap CSS -->
        <link href="./css/bootstrap.min.css" rel="stylesheet">
        <link href="./css/login.css" rel="stylesheet">
        <link rel="stylesheet" href="./css/style.css">
        <link rel="stylesheet" href="./css/transiciones.css">
        <link rel="stylesheet" href="./css/fonts.css">
    </head>

    <body>
        <div class="container-fluid poppins-light">
            <div class="login-container fade-in">
                <div class="login-header">
                    <h2 class="playfair-title">Recuperación de cuenta</h2>
                    <p class="text-muted">Ingresa tu nueva contraseña</p>
                </div>

                <form method="POST" action="#">
                    <div class="mb-3">
                        <label for="email" class="form-label">Nueva contraseña</label>
                        <input type="password" name="password" class="form-control" id="password" required>
                    </div>


                    <?php if (!empty($_SESSION["err_recuperacion"]) && isset($_SESSION["err_recuperacion"])): ?>
                        <div class="alert alert-danger" role="alert">
                            <?php echo $_SESSION["err_recuperacion"]; ?>
                        </div>
                    <?php endif; ?>

                    <?php unset($_SESSION["err_recuperacion"]); ?>


                    <div class="d-grid">
                        <button type="submit" class="btn boton-fondo-morado">Enviar correo</button>
                    </div>

                </form>
            </div>
        </div>

        <script src="./js/main.js" type="module"></script>
        <script src="./js/bootstrap.bundle.min.js"></script>
    </body>

    </html>

<?php endif; ?>
