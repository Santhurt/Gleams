<?php session_start(); ?>
<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Gleams - Confirmación de Pago</title>
    <!--Boostrap-->
    <link href="./css/bootstrap.min.css" rel="stylesheet">
    <link href="./css/style.css" rel="stylesheet">
    <link href="./css/transiciones.css" rel="stylesheet">
    <link href="./css/fonts.css" rel="stylesheet">

    <link href="../node_modules/@fortawesome/fontawesome-free/css/all.css" rel="stylesheet">
    <link href="./css/modal_carrito.css" rel="stylesheet">
    <link href="./node_modules/bootstrap-icons/font/bootstrap-icons.min.css" rel="stylesheet">
    <link href="./css/pago.css" rel="stylesheet">
    
</head>

<body>

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
                <img src="./img/logoo.png" alt="Logo Gleams">
            </div>
        </div>
    </div>
    <header class="sticky-top">

        <!-- Navbar -->
        <nav class="navbar navbar-expand-lg fondo">
            <div class="container">
                <!-- Logo -->
                <a class="navbar-brand playfair-title" href="#">GLEAMS</a>

                <!-- Botón hamburguesa -->
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarContent">
                    <span class="navbar-toggler-icon"></span>
                </button>

                <!-- Contenido colapsable (incluye menú y botones) -->
                <div class="collapse navbar-collapse" id="navbarContent">
                    <!-- Menú de navegación -->
                    <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                        <li class="nav-item">
                            <a class="nav-link poppins-light" href="./shop.php">Inicio</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link poppins-light" href="#">Colecciones</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link poppins-light" href="#">Accesorios</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link poppins-light" href="#">Nosotros</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link poppins-light" href="#">Contacto</a>
                        </li>
                    </ul>

                    <!-- Botones de autenticación y carrito -->
                    <div class="d-flex align-items-center gap-3 justify-content-center">
                        <a href="#" class="text-dark position-relative">
                            <i class="fas fa-shopping-bag"></i>
                            <span class="position-absolute top-0 start-100 translate-middle badge rounded-pill bg-danger">3</span>
                        </a>

                        <?php if (isset($_SESSION["correo"]) && isset($_SESSION["usuario"])): ?>
                            <a href="../controllers/auth/logout.php" type="button" class="btn boton-fondo-blanco poppins-light">Cerrar sesión</a>
                            <span class="me-2">
                                <i class="fas fa-user"></i>
                                <?php echo htmlspecialchars($_SESSION["usuario"] ?? 'Usuario'); ?>
                            </span>
                        <?php else: ?>
                            <a href="./login.php" class="btn boton-fondo-morado me-2 poppins-light">Ingresar</a>
                            <a href="./registro.php" type="button" class="btn boton-fondo-blanco poppins-light">Registrarse</a>
                        <?php endif; ?>
                    </div>
                </div>
            </div>
        </nav>
    </header>

    <!-- Main Checkout Area -->
    <main class="checkout-container fondo">
        <div class="container">
            <h2 class="checkout-title text-center fade-in mb-4">Confirmación de Compra</h2>
            <div class="row">
                <!-- Formulario de datos de envío -->
                <div class="col-lg-7 mb-4 fade-in">
                    <div class="checkout-card">
                        <h3 class="checkout-subtitle">Información de Contacto</h3>
                        <form id="checkout-form">
                            <div class="mb-3">
                                <label for="email" class="form-label">Correo electrónico</label>
                                <input type="email" class="form-control" id="email" placeholder="tucorreo@ejemplo.com" required>
                            </div>

                            <div class="mb-3">
                                <label for="nombre" class="form-label">Nombre</label>
                                <input type="text" class="form-control" id="nombre" required>
                            </div>

                            <!-- <div class="mb-3"> -->
                            <!--     <label for="identificacion" class="form-label">Número de identificación</label> -->
                            <!--     <input type="text" class="form-control" id="identificacion" required> -->
                            <!-- </div> -->

                            <div class="mb-3">
                                <label for="direccion" class="form-label">Dirección</label>
                                <input type="text" class="form-control" id="direccion" placeholder="Calle, número, barrio" required>
                            </div>

                            <div class="mb-3">
                                <label for="telefono" class="form-label">Teléfono</label>
                                <input type="tel" class="form-control" id="telefono" required>
                            </div>

                            <div class="shipping-info">
                                <p class="shipping-info-title"><i class="fas fa-truck me-2"></i> Información de envío</p>
                                <p class="info-text">Los envíos se realizan en un plazo de 3 a 5 días hábiles. Recibirás un correo electrónico con el número de seguimiento una vez que tu pedido esté en camino.</p>
                            </div>
                        </form>
                    </div>
                </div>

                <!-- Resumen de compra -->
                <div class="col-lg-5 fade-in">
                    <div class="checkout-card">
                        <h3 class="checkout-subtitle">Resumen de Compra</h3>

                        <!-- Producto 1 -->
                        <div class="product-item d-flex align-items-center">
                            <div class="flex-grow-1">
                                <h5 class="product-name">Pendientes Tiburón</h5>
                                <p class="product-details">Cantidad: 1</p>
                            </div>
                            <div class="ms-3 text-end">
                                <span class="fw-bold">$79.900,00</span>
                            </div>
                        </div>

                        <!-- Resumen precios -->
                        <div class="price-summary">
                            <div class="price-row">
                                <span>Subtotal</span>
                                <span>$79.900,00</span>
                            </div>
                            <div class="price-row">
                                <span>Envío</span>
                                <span>$15.000,00</span>
                            </div>
                            <div class="price-row total-row">
                                <span>Total</span>
                                <span>$94.900,00</span>
                            </div>
                            <!-- <div class="info-text mt-2"> -->
                            <!--     <small>Incluye $15.152,10 de impuestos</small> -->
                            <!-- </div> -->
                        </div>

                        <!-- Botón confirmar pedido -->
                        <button type="submit" form="checkout-form" class="btn btn-confirmar">
                            Confirmar Pedido
                        </button>
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
                    <h5 class="footer-title">GLEAMS</h5>
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
                    <p class="text-muted small">© 2025 Gleams. Todos los derechos reservados.</p>
                </div>
            </div>
        </div>
    </footer>

    <script src="./js/bootstrap.bundle.min.js"></script>
    <script src="./js/main.js"></script>
</body>

</html>
