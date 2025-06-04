<?php session_start();
if (!isset($_SESSION["correo"]) || !isset($_SESSION["usuario"])) {
    header("Location: /user_views/login.php");
    exit;
}
?>
<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Gleams</title>
    <!-- Bootstrap CSS -->
    <link href="./css/bootstrap.min.css" rel="stylesheet">
    <link href="./css/style.css" rel="stylesheet">
    <!-- Font Bootstrap -->
    <link href="../node_modules/bootstrap-icons/font/bootstrap-icons.min.css" rel="stylesheet">
    <link href="../node_modules/@fortawesome/fontawesome-free/css/all.css" rel="stylesheet">

    <link href="./css/transiciones.css" rel="stylesheet">
    <link href="./css/modal.css" rel="stylesheet">
    <link href="./css/toast.css" rel="stylesheet">

    <link href="./css/fonts.css" rel="stylesheet">
    <link href="./css/modal_carrito.css" rel="stylesheet">

    <style>
        .profile-container {
            background: white;
            border-radius: 15px;
            box-shadow: 0 10px 30px rgba(0, 0, 0, 0.1);
            overflow: hidden;
            margin-top: 30px;
        }

        .profile-header {
            background: linear-gradient(135deg, #f5d5dc 0%, #c98d9e 100%);
            color: white;
            padding: 40px 30px;
            text-align: center;
        }

        .profile-avatar {
            width: 120px;
            height: 120px;
            border-radius: 50%;
            background: rgba(255, 255, 255, 0.2);
            display: flex;
            align-items: center;
            justify-content: center;
            margin: 0 auto 20px;
            border: 4px solid rgba(255, 255, 255, 0.3);
        }

        .profile-avatar i {
            font-size: 60px;
        }

        .profile-tabs {
            border-bottom: 1px solid #eee;
        }

        .nav-pills {
            border-radius: 0;
            color: #6c757d;
            font-weight: 500;
            padding: 15px 25px;
            border-bottom: 3px solid transparent;
            transition: all 0.3s ease;
        }


        .nav-pills .nav-link.active {
            background: white;
        }

        .nav-link.active:hover {
            background-color: #f5d5dc;
        }


        .section-card {
            background: white;
            border-radius: 10px;
            padding: 25px;
            margin-bottom: 20px;
            border: 1px solid #e9ecef;
        }

        .section-title {
            color: #2c3e50;
            font-weight: 600;
            margin-bottom: 20px;
            padding-bottom: 10px;
            border-bottom: 2px solid #f1f3f4;
        }

        .danger-zone {
            border: 2px solid #ffebee;
            border-radius: 10px;
            background: #fff5f5;
        }

        .alert-custom {
            border-radius: 8px;
            padding: 15px 20px;
            margin-bottom: 20px;
        }

        .text-danger-custom {
            color: #e74c3c !important;
        }

        @media (max-width: 768px) {
            .profile-header {
                padding: 30px 20px;
            }

            .profile-avatar {
                width: 100px;
                height: 100px;
            }

            .profile-avatar i {
                font-size: 50px;
            }

            .nav-pills .nav-link {
                padding: 12px 15px;
                font-size: 14px;
            }

            .section-card {
                padding: 20px 15px;
            }
        }
    </style>

</head>

<body>

    <!-- Aquí inicia el modal derecho -->
    <div class="modal right fade" id="rightModal" tabindex="-1" aria-labelledby="rightModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-slideout">
            <div class="modal-content border-0 shadow-lg rounded-start poppins-light">
                <div class="modal-header bg-primary text-white color-base">
                    <h5 class="modal-title mb-0" id="rightModalLabel">Resumen de tu compra</h5>
                    <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Cerrar"></button>
                </div>
                <div class="modal-body p-4">
                    <!-- Lista de productos -->
                    <ul class="list-group list-group-flush mb-4" id="lista-pedidos">
                        <li class="list-group-item d-flex justify-content-between align-items-center px-0 py-2">
                            <div>
                                <h6 class="mb-1">Camisa Casual</h6>
                                <small class="text-muted">2 unidades</small>
                            </div>
                            <span class="fw-semibold">$59.98</span>
                        </li>
                        <li class="list-group-item d-flex justify-content-between align-items-center px-0 py-2">
                            <div>
                                <h6 class="mb-1">Pantalón Slim Fit</h6>
                                <small class="text-muted">1 unidad</small>
                            </div>
                            <span class="fw-semibold">$49.99</span>
                        </li>
                        <li class="list-group-item d-flex justify-content-between align-items-center px-0 py-2">
                            <div>
                                <h6 class="mb-1">Zapatillas Deportivas</h6>
                                <small class="text-muted">1 unidad</small>
                            </div>
                            <span class="fw-semibold">$89.95</span>
                        </li>
                    </ul>

                    <!-- Total -->
                    <div class="d-flex justify-content-between align-items-center border-top pt-3">
                        <h5 class="fw-bold mb-0">Total</h5>
                        <h5 class="fw-bold mb-0" id="total">$244.89</h5>
                    </div>
                </div>
                <div class="modal-footer border-0 d-flex justify-content-between">
                    <a type="button" href="./pago.php" id="confirmar-compra" class="btn boton-fondo-morado w-100">Finalizar Compra</a>
                </div>
            </div>
        </div>
    </div>


    <!-- Top bar -->
    <div class="container-fluid top-bar">
        <div class="row py-2">
            <div class="col-md-6 text-center text-md-start">
                <small>Envío gratuito en pedidos superiores a $150.000</small>
            </div>
        </div>
    </div>


    <div class="container-fluid">
        <div class="row justify-content-center">
            <div class="col text-center">
                <img src="./img/logoo.png" alt="">
            </div>
        </div>
    </div>

    <!-- Header -->
    <header class="sticky-top">

        <!-- Navbar -->
        <nav id="navbar" class="navbar navbar-expand-lg fondo">
            <div class="container">
                <!-- Logo -->

                <!-- Botón hamburguesa -->
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarContent">
                    <span class="navbar-toggler-icon"></span>
                </button>

                <div class="me-auto">
                    <a href="#" class="social-icon"><i class="fab fa-facebook-f"></i></a>
                    <a href="#" class="social-icon"><i class="fab fa-instagram"></i></a>
                    <a href="#" class="social-icon"><i class="fab fa-whatsapp"></i></a>
                </div>

                <!-- Contenido colapsable (incluye menú y botones) -->
                <div class="collapse navbar-collapse" id="navbarContent">
                    <!-- Menú de navegación -->
                    <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                        <li class="nav-item">
                            <a class="nav-link" href="./shop.php">Tienda</a>
                        </li>
                        <!-- <li class="nav-item"> -->
                        <!--     <a class="nav-link" href="#">Colecciones</a> -->
                        <!-- </li> -->
                        <!-- <li class="nav-item"> -->
                        <!--     <a class="nav-link" href="#">Accesorios</a> -->
                        <!-- </li> -->
                        <li class="nav-item">
                            <a class="nav-link" href="./pedidos.php">Pedidos</a>
                        </li>
                    </ul>

                    <!-- Botones de autenticación y carrito -->
                    <div class="d-flex align-items-center gap-3 justify-content-center">
                        <a href="#" class="text-dark position-relative" data-bs-toggle="modal" data-bs-target="#rightModal">
                            <i class="fas fa-shopping-bag"></i>
                            <!-- El contador se agregará dinámicamente aquí -->
                        </a>
                        <?php if (isset($_SESSION["correo"]) && isset($_SESSION["usuario"])): ?>
                            <a href="perfil.php" class="btn boton-fondo-morado poppins-light ms-3">
                                <i class="fas fa-user"></i>
                                <?php echo htmlspecialchars($_SESSION["usuario"] ?? 'Usuario'); ?>
                            </a>
                            <a href="../controllers/auth/logout.php" type="button" class="btn boton-fondo-blanco poppins-light">Cerrar sesion</a>
                        <?php else: ?>
                            <a href="./login.php" class="btn boton-fondo-morado me-2 poppins-light">Ingresar</a>
                            <a href="./registro.php" type="button" class="btn boton-fondo-blanco poppins-light">Registrarse</a>
                        <?php endif; ?>
                    </div>
                </div>
            </div>
        </nav>


    </header>

    <!-- Main Content -->
    <main class="fondo">
        <div class="container fade-in">
            <div class="row justify-content-center">
                <div class="col-12 col-lg-10">
                    <div class="profile-container">
                        <!-- Profile Header -->
                        <div class="profile-header">
                            <div class="profile-avatar">
                                <i class="fas fa-user"></i>
                            </div>
                            <h2 class="fs-1 mb-2" id="nombre-header">Maria Elena Rodriguez</h2>
                        </div>

                        <!-- Profile Tabs -->
                        <div id="msg" class="profile-tabs">
                            <ul class="nav nav-pills justify-content-center" id="profileTabs" role="tablist">
                                <li class="nav-item" role="presentation">
                                    <button class="nav-link active poppins-medium" id="info-tab" data-bs-toggle="pill" data-bs-target="#info" type="button" role="tab">
                                        <i class="fas fa-user me-2"></i>Información Personal
                                    </button>
                                </li>
                                <li class="nav-item" role="presentation">
                                    <button class="nav-link poppins-medium" id="password-tab" data-bs-toggle="pill" data-bs-target="#password" type="button" role="tab">
                                        <i class="fas fa-lock me-2"></i>Cambiar Contraseña
                                    </button>
                                </li>
                                <li class="nav-item" role="presentation">
                                    <button class="nav-link poppins-medium" id="account-tab" data-bs-toggle="pill" data-bs-target="#account" type="button" role="tab">
                                        <i class="fas fa-cog me-2"></i>Configuración
                                    </button>
                                </li>
                            </ul>
                        </div>

                        <!-- Tab Content -->
                        <div class="tab-content p-4" id="profileTabsContent">
                            <!-- Información Personal -->

                            <?php if (isset($_SESSION["edit_fail"]) && $_SESSION["edit_fail"]): ?>
                                <div class="alert alert-danger alert-custom">
                                    <i class="fas fa-info-circle me-2"></i>
                                    <strong>Error: </strong> <?php echo $_SESSION["msg_edit"]; ?>
                                </div>
                            <?php elseif (isset($_SESSION["msg_edit"])): ?>
                                <div class="alert alert-success alert-custom">
                                    <i class="fas fa-info-circle me-2"></i>
                                    <strong>Usuario editado</strong> <?php echo $_SESSION["msg_edit"]; ?>
                                </div>
                            <?php endif; ?>

                            <?php
                            unset($_SESSION["msg_edit"]);
                            unset($_SESSION["edit_fail"]);
                            ?>

                            <div class="tab-pane fade show active" id="info" role="tabpanel">
                                <div class="section-card">
                                    <h4 class="section-title poppins-semibold">
                                        <i class="fas fa-user-edit me-2"></i>
                                        Información Personal
                                    </h4>

                                    <form id="form-usuario" method="post" action="../controllers/usuarios/editar_usuario_sesion.php">
                                        <div class="row">
                                            <div class="col-md-6 mb-3">
                                                <label for="nombre" class="form-label poppins-medium">Nombre Completo</label>
                                                <input type="text" class="form-control poppins-light" id="nombre" name="nombre">
                                            </div>
                                            <div class="col-md-6 mb-3">
                                                <label for="email" class="form-label poppins-medium">Correo Electrónico</label>
                                                <input type="email" class="form-control poppins-light" disabled id="correo" value="maria.rodriguez@email.com">
                                            </div>
                                        </div>

                                        <div class="row">
                                            <div class="col-md-6 mb-3">
                                                <label for="telefono" class="form-label poppins-medium">Teléfono</label>
                                                <input type="tel" class="form-control poppins-light" id="telefono" name="telefono" value="+57 300 123 4567">
                                            </div>
                                            <div class="col-md-6 mb-3">
                                                <label for="fechaNacimiento" class="form-label poppins-medium">Fecha de registro</label>
                                                <input type="date" class="form-control poppins-light" disabled id="fecha" value="1990-05-15">
                                            </div>
                                        </div>

                                        <div class="mb-3">
                                            <label for="direccion" class="form-label poppins-medium">Dirección</label>
                                            <input type="text" class="form-control poppins-light" id="direccion" name="direccion" value="Calle 123 # 45-67, Bogotá, Colombia">
                                        </div>


                                        <input type="hidden" name="password" id="password-modal">


                                        <div class="d-flex justify-content-end">
                                            <button type="submit" form="form-usuario" class="btn boton-fondo-morado poppins-medium me-2">
                                                <i class="fas fa-save me-2"></i>Guardar Cambios
                                            </button>
                                        </div>
                                    </form>
                                </div>
                            </div>

                            <!-- Cambiar Contraseña -->
                            <div class="tab-pane fade" id="password" role="tabpanel">
                                <div class="section-card">
                                    <h4 class="section-title poppins-semibold">
                                        <i class="fas fa-shield-alt me-2"></i>
                                        Cambiar contraseña
                                    </h4>

                                    <!-- <div class="alert alert-info alert-custom"> -->
                                    <!--     <i class="fas fa-info-circle me-2"></i> -->
                                    <!--     <strong>Importante:</strong> Tu contraseña debe tener al menos 8 caracteres e incluir mayúsculas, minúsculas y números. -->
                                    <!-- </div> -->

                                    <form id="password-form" method="post" action="../controllers/usuarios/actualizar_pass.php">
                                        <div class="mb-3">
                                            <label for="passwordActual" class="form-label poppins-medium">Contraseña Actual</label>
                                            <div class="input-group">
                                                <input type="password" name="pass-actual" class="form-control poppins-light" id="passwordActual" placeholder="Ingresa tu contraseña actual">
                                                <button class="btn btn-outline-secondary pass" type="button">
                                                    <i class="fas fa-eye"></i>
                                                </button>
                                            </div>
                                        </div>

                                        <div class="mb-3">
                                            <label for="passwordNueva" class="form-label poppins-medium">Nueva Contraseña</label>
                                            <div class="input-group">
                                                <input type="password" name="pass-nueva" class="form-control poppins-light" id="passwordNueva" placeholder="Ingresa tu nueva contraseña">
                                                <button class="btn btn-outline-secondary pass" type="button">
                                                    <i class="fas fa-eye"></i>
                                                </button>
                                            </div>
                                        </div>

                                        <div class="mb-4">
                                            <label for="passwordConfirmar" class="form-label poppins-medium">Confirmar Nueva Contraseña</label>
                                            <div class="input-group">
                                                <input type="password" name="confirm-pass-nueva" class="form-control poppins-light" id="passwordConfirmar" placeholder="Confirma tu nueva contraseña">
                                                <button class="btn btn-outline-secondary pass" type="button">
                                                    <i class="fas fa-eye"></i>
                                                </button>
                                            </div>
                                        </div>

                                        <div class="d-flex justify-content-end">
                                            <button type="submit" form="password-form" class="btn boton-fondo-morado poppins-medium">
                                                <i class="fas fa-key me-2"></i>Cambiar Contraseña
                                            </button>
                                        </div>
                                    </form>
                                </div>
                            </div>

                            <!-- Configuración de Cuenta -->
                            <div class="tab-pane fade" id="account" role="tabpanel">
                                <!-- Zona de Peligro -->
                                <div class="section-card danger-zone">
                                    <h4 class="section-title poppins-semibold text-danger-custom">
                                        <i class="fas fa-exclamation-triangle me-2"></i>
                                        Eliminacion de cuenta
                                    </h4>

                                    <div class="alert alert-warning alert-custom">
                                        <i class="fas fa-warning me-2"></i>
                                        <strong>Atención:</strong> Esta accion es pemanente, una vez eliminada tu cuenta, no podras
                                        recuperarla.
                                    </div>

                                    <form id="form-eliminar" method="POST" action="../controllers/usuarios/eliminar_usuario_sesion.php">
                                        <input id="input-eliminar" type="hidden" name="password">
                                    </form>


                                    <div class="d-flex justify-content-between align-items-center">
                                        <button type="submit" form="form-eliminar" id="eliminar-cuenta" class="btn boton-danger-custom poppins-medium">
                                            <i class="fas fa-trash me-2"></i>Eliminar Cuenta
                                        </button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

    </main>

    <!-- Footer -->
    <footer class="footer">
        <div class="container">
            <div class="row">
                <!-- About Column -->
                <div class="col-md-4 mb-4 mb-md-0">
                    <h5 class="footer-title">gleamns</h5>
                    <p class="text-muted">Somos una marca colombiana de accesorios artesanales creados con amor y dedicación, apoyando el talento local.</p>
                </div>

                <!-- Links Column 1 -->
                <div class="col-md-4 mb-4 mb-md-0">
                    <h5 class="footer-title">NAVEGACIÓN</h5>
                    <a href="#" class="footer-link">Inicio</a>
                    <a href="#" class="footer-link">Colecciones</a>
                    <a href="#" class="footer-link">Accesorios</a>
                    <a href="#" class="footer-link">Nosotros</a>
                </div>

                <!-- Links Column 2 -->
                <div class="col-md-4 mb-4 mb-md-0">
                    <h5 class="footer-title">AYUDA</h5>
                    <a href="#" class="footer-link">Preguntas frecuentes</a>
                    <a href="#" class="footer-link">Envíos y devoluciones</a>
                    <a href="#" class="footer-link">Términos y condiciones</a>
                    <a href="#" class="footer-link">Política de privacidad</a>
                    <a href="#" class="footer-link">Contáctanos</a>
                </div>

            </div>

            <!-- Copyright -->
            <div class="row mt-5">
                <div class="col-12 text-center">
                    <p class="text-muted small">© 2025 Gleams. Todos los derechos reservados.</p>
                </div>
            </div>
        </div>
    </footer>

    <!-- Bootstrap Bundle with Popper -->
    <script src="./js/main.js" type="module"></script>
    <script src="./js/bootstrap.bundle.min.js"></script>
</body>

</html>
