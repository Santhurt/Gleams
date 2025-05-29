<?php
session_start();
?>
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
                <h2 class="playfair-title">Recuperar cuenta</h2>
                <p class="text-muted">Enviaremos un mensaje de recuperación a tu correo</p>
            </div>

            <form method="POST" action="../controllers/auth/recuperar_pass.php">
                <div class="mb-3">
                    <label for="email" class="form-label">Correo electrónico</label>
                    <input type="email" name="correo" class="form-control" id="email" required>
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
