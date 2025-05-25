<?php session_start();
if (!isset($_SESSION["correo"]) || !isset($_SESSION["usuario"])) {
    header("Location: /user_views/shop.php");
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
    <link href="./css/pedidos.css" rel="stylesheet">
    <!-- Font Bootstrap -->
    <link href="../node_modules/bootstrap-icons/font/bootstrap-icons.min.css" rel="stylesheet">
    <link href="../node_modules/@fortawesome/fontawesome-free/css/all.css" rel="stylesheet">

    <link href="./css/transiciones.css" rel="stylesheet">
    <link href="./css/modal.css" rel="stylesheet">
    <link href="./css/toast.css" rel="stylesheet">

    <link href="./css/fonts.css" rel="stylesheet">
    <link href="./css/modal_carrito.css" rel="stylesheet">

    <style>
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

                <!-- Contenido colapsable (incluye menú y botones) -->
                <div class="collapse navbar-collapse" id="navbarContent">
                    <!-- Menú de navegación -->
                    <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                        <li class="nav-item">
                            <a class="nav-link" href="./shop.php">Tienda</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="#">Colecciones</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="#">Accesorios</a>
                        </li>
                        <?php if (isset($_SESSION["correo"]) && isset($_SESSION["usuario"])): ?>
                            <li class="nav-item">
                                <a class="nav-link active" href="./pedidos.php">Pedidos</a>
                            </li>
                        <?php endif; ?>
                        <li class="nav-item">
                            <a class="nav-link" href="#">Contacto</a>
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
                            <a href="./login.php" class="btn boton-fondo-morado ms-3 poppins-light">Ingresar</a>
                            <a href="./registro.php" type="button" class="btn boton-fondo-blanco poppins-light">Registrarse</a>
                        <?php endif; ?>
                    </div>
                </div>
            </div>
        </nav>

    </header>

    <div class="modal fade" id="mostrarDetalle" tabindex="-1" aria-labelledby="cancelarPedidoModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header color-base">
                    <h5 class="modal-title poppins-bold text-white" id="cancelarPedidoModalLabel">Detalles del pedido</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body" id="contenedor-detalles">
                </div>
            </div>
        </div>
    </div>

    <!-- Main Content -->
    <main class="fondo">
        <!--Aqui iria la seccion de pedidos-->
        <div class="container pedidos-section">
            <!-- Título de la sección -->
            <div class="row mb-4">
                <div class="col-12 text-center fade-in">
                    <h2 class="color-texto mb-3" style="letter-spacing: 2px;">MIS PEDIDOS</h2>
                    <p class="text-muted">Aquí puedes ver el estado de todos tus pedidos</p>
                </div>
            </div>

            <!-- Pestañas de navegación -->
            <ul class="nav nav-tabs justify-content-center mb-4" id="pedidosTabs" role="tablist">
                <li class="nav-item" role="presentation">
                    <button class="nav-link poppins-light active" id="pendientes-tab" data-bs-toggle="tab" data-bs-target="#pendientes" type="button" role="tab">
                        <i class="fas fa-clock me-2"></i>Pendientes
                    </button>
                </li>
                <li class="nav-item" role="presentation">
                    <button class="nav-link poppins-light" id="entregados-tab" data-bs-toggle="tab" data-bs-target="#entregados" type="button" role="tab">
                        <i class="fas fa-check-circle me-2"></i>Entregados
                    </button>
                </li>
            </ul>

            <!-- Contenido de las pestañas -->
            <div class="tab-content" id="pedidosTabContent">
                <!-- Pedidos Pendientes -->
                <div class="tab-pane active" id="pendientes" role="tabpanel">
                    <div class="row fade-in" id="contenedor-pendientes">

                        <div class="fade-in empty-state" id="mensaje-pendientes" style="display: none;">
                            <i class="fas fa-shopping-bag"></i>
                            <h4 class="poppins-light">No hay pedidos pendientes</h4>
                            <p class="poppins-light">Visita la tienda para realizar una nueva compra.</p>
                            <a href="./shop.php" class="btn boton-fondo-morado">
                                Ir a la tienda
                            </a>
                        </div>

                    </div>
                </div>

                <!-- Pedidos Entregados -->
                <div class="tab-pane" id="entregados" role="tabpanel">
                    <div class="row fade-in" id="contenedor-entregados">

                        <div class="fade-in empty-state" id="mensaje-entregados" style="display: none;">
                            <i class="fas fa-shopping-bag"></i>
                            <h4 class="poppins-light">Sin pedidos para mostrar</h4>
                            <p class="poppins-light">Aqui aparecerán tus pedidos una vez sean entregados.</p>
                        </div>

                    </div>
                </div>
            </div>

            <!-- Estado vacío (ejemplo para cuando no hay pedidos) -->
            <div class="fade-in empty-state" id="mensaje" style="display: block;">
                <i class="fas fa-shopping-bag"></i>
                <h4>No tienes pedidos aún</h4>
                <p>Cuando realices tu primera compra, aparecerá aquí</p>
                <a href="./shop.php" class="btn boton-fondo-morado">
                    Ir a la tienda
                </a>
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
                    <div class="mt-3">
                        <a href="#" class="social-icon"><i class="fab fa-facebook-f"></i></a>
                        <a href="#" class="social-icon"><i class="fab fa-instagram"></i></a>
                        <a href="#" class="social-icon"><i class="fab fa-pinterest"></i></a>
                        <a href="#" class="social-icon"><i class="fab fa-tiktok"></i></a>
                    </div>
                </div>

                <!-- Links Column 1 -->
                <div class="col-md-4 mb-4 mb-md-0">
                    <h5 class="footer-title">NAVEGACIÓN</h5>
                    <a href="#" class="footer-link">Inicio</a>
                    <a href="#" class="footer-link">Colecciones</a>
                    <a href="#" class="footer-link">Accesorios</a>
                    <a href="#" class="footer-link">Nosotros</a>
                    <a href="#" class="footer-link">Contacto</a>
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
                    <p class="text-muted small">© 2025 gleamns. Todos los derechos reservados.</p>
                </div>
            </div>
        </div>
    </footer>

    <!-- Bootstrap Bundle with Popper -->
    <script src="./js/main.js" type="module"></script>
    <script src="./js/bootstrap.bundle.min.js"></script>
</body>

</html>
