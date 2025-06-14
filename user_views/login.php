<?php
session_start();
?>
<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>GLEAMS - Login</title>
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
                <h2 class="playfair-title">Iniciar Sesión</h2>
                <p class="text-muted">Ingresa a tu cuenta de GLEAMS</p>
            </div>

            <form method="POST" action="../controllers/auth/login.php">
                <div class="mb-3">
                    <label for="email" class="form-label">Correo electrónico</label>
                    <input type="email" name="correo" class="form-control" id="email" required>
                </div>

                <div class="mb-3">
                    <label for="password" class="form-label">Contraseña</label>
                    <input type="password" name="password" class="form-control" id="password">
                </div>

                <!-- <div class="mb-3 form-check"> -->
                <!--     <input type="checkbox" class="form-check-input" id="rememberMe"> -->
                <!--     <label class="form-check-label" for="rememberMe">Recordarme</label> -->
                <!-- </div> -->

                <?php if (!empty($_SESSION["err_login"]) && isset($_SESSION["err_login"])): ?>
                    <div class="alert alert-danger" role="alert">
                        Error: <?php echo $_SESSION["err_login"]; ?>
                    </div>
                <?php endif; ?>

                <?php  unset($_SESSION["err_login"]); ?>

                <?php if (!empty($_SESSION["err_recuperacion"]) && isset($_SESSION["err_recuperacion"])): ?>
                    <div class="alert alert-success" role="alert">
                        <?php echo $_SESSION["err_recuperacion"]; ?>
                    </div>
                <?php endif; ?>

                <?php  unset($_SESSION["err_recuperacion"]); ?>

                <div class="forgot-password">
                    <a href="./recuperacion.php">¿Olvidaste tu contraseña?</a>
                </div>

                <div class="d-grid">
                    <button type="submit" class="btn boton-fondo-morado">Ingresar</button>
                </div>

                <div class="register-link">
                    <p>¿No tienes una cuenta? <a href="./registro.php">Regístrate aquí</a></p>
                </div>
            </form>
        </div>
    </div>

    <script src="./js/main.js" type="module"></script>
    <script src="./js/bootstrap.bundle.min.js"></script>
</body>

</html>
