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
                <h2 class="playfair-title">Registro</h2>
                <p class="text-muted">Registra tu cuenta</p>
            </div>
            
            <form id="form-registro">
                <div class="mb-3">
                    <label for="email" class="form-label">Nombre</label>
                    <input type="text" class="form-control" name="nombre">
                </div>

                <div class="mb-3">
                    <label for="email" class="form-label">Correo electrónico</label>
                    <input type="email" class="form-control" name="correo">
                </div>

                <div class="mb-3">
                    <label for="email" class="form-label">Telefono</label>
                    <input type="text" class="form-control" name="telefono">
                </div>
                
                <div class="mb-3">
                    <label for="password" class="form-label">Contraseña</label>
                    <input type="password" class="form-control" name="password">
                </div>

                <div class="mb-3">
                    <label for="password" class="form-label">Confirmar contraseña</label>
                    <input type="password" class="form-control" name="confirm-password">
                </div>

                <div class="mb-3">
                    <label for="email" class="form-label">Direccion completa</label>
                    <input type="text" class="form-control" name="direccion">
                </div>
                
                <div class="d-grid">
                    <button type="submit" class="btn boton-fondo-morado">Crear cuenta</button>
                </div>
                
                <div class="register-link">
                    <p>¿Ya tienes una cuenta? <a href="./login.php">Iniciar sesion</a></p>
                </div>
            </form>

        </div>
    </div>

    <script src="./js/main.js" type="module"></script>
    <script src="./js/bootstrap.bundle.min.js"></script>
</body>
</html>
