<?php session_start(); ?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Nombre del producto</title>
    <!--Boostrap-->
    <link href="./css/bootstrap.min.css" rel="stylesheet">
    <link href="./css/style.css" rel="stylesheet">
    <link href="./css/transiciones.css" rel="stylesheet">
    <link href="./css/fonts.css" rel="stylesheet">
    <link href="./css/toast.css" rel="stylesheet">

    <link href="../node_modules/@fortawesome/fontawesome-free/css/all.css" rel="stylesheet">
    <link href="./css/modal_carrito.css" rel="stylesheet">
    <link href="./node_modules/bootstrap-icons/font/bootstrap-icons.min.css" rel="stylesheet">
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
                <img src="./img/logoo.png" alt="">
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
                            <a class="nav-link poppins-light" href="./shop.php">Tienda</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link poppins-light" href="#">Colecciones</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link poppins-light" href="#">Accesorios</a>
                        </li>
                        <?php if (isset($_SESSION["correo"]) && isset($_SESSION["usuario"])): ?>
                            <li class="nav-item">
                                <a class="nav-link" href="./pedidos.php">Pedidos</a>
                            </li>
                        <?php endif; ?>
                        <li class="nav-item">
                            <a class="nav-link poppins-light" href="#">Contacto</a>
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
    <main class="fondo">
        <p hidden id="producto-hidden" id-producto="<?php echo $_GET['id'] ?? 0; ?>"></p>
        <div class="container mb-5">
            <div class="row">
                <div class="col-lg-6 fade-in">
                    <div class="img-crop-card">
                        <img src="" id="imagen" class="img-fluid" alt="Set de 3 Pines Fauna Tropical">
                    </div>
                </div>
                <div class="col-lg-6 fade-in">
                    <h2 class="mb-3 mt-3 playfair-title" id="titulo">Set de 3 Pines Fauna Tropical</h2>

                    <div class="price-container mb-3">
                        <h3 class="poppins-light" id="precio">$49.900</h3>
                        <p class="text-muted small">Impuesto incluido. Los gastos de envío se calculan en la pantalla de pagos.</p>
                    </div>

                    <div class="mb-4">
                        <p class="mb-2 poppins-light">Cantidad</p>
                        <div class="contador-producto d-flex align-items-center gap-2">
                            <button class="btn boton-fondo-blanco btn-cantidad" data-op="restar" type="button">−</button>
                            <input id="input-cantidad" type="text" class="cantidad-input text-center" value="1">
                            <button class="btn boton-fondo-blanco btn-cantidad" data-op="agregar" type="button">+</button>
                        </div>
                        <div class="d-flex align-items-center mt-3">
                            <span class="text-success me-2">●</span>
                            <span class="poppins-light">En stock</span>
                        </div>
                    </div>

                    <div class="d-grid gap-2 mb-4" id="contenedor-botones">
                        <button class="btn boton-fondo-blanco agregar poppins-light py-2">AGREGAR AL CARRITO</button>
                        <button class="btn boton-fondo-morado comprar poppins-light py-2">COMPRAR AHORA</button>
                    </div>

                    <div class="accordion mb-3">
                        <div class="accordion-item">
                            <h2 class="accordion-header">
                                <button class="accordion-button collapsed poppins-light text-secondary" type="button" data-bs-toggle="collapse" data-bs-target="#descripcion">
                                    DESCRIPCIÓN
                                </button>
                            </h2>
                            <div id="descripcion" class="accordion-collapse collapse">
                                <div class="accordion-body">
                                    <p class="text-secondary poppins-light" id="descripcion-texto">Descripción detallada del producto.</p>
                                </div>
                            </div>
                        </div>
                        <div class="accordion-item">
                            <h2 class="accordion-header">
                                <button class="accordion-button collapsed poppins-light text-secondary" type="button" data-bs-toggle="collapse" data-bs-target="#cuidado">
                                    CUIDADO Y GARANTÍA
                                </button>
                            </h2>
                            <div id="cuidado" class="accordion-collapse collapse">
                                <div class="accordion-body">
                                    <p class="text-secondary poppins-light">Detalles sobre el cuidado del producto y garantía.</p>
                                </div>
                            </div>
                        </div>
                        <div class="accordion-item">
                            <h2 class="accordion-header">
                                <button class="accordion-button collapsed poppins-light text-secondary" type="button" data-bs-toggle="collapse" data-bs-target="#envios">
                                    ENVÍOS
                                </button>
                            </h2>
                            <div id="envios" class="accordion-collapse collapse">
                                <div class="accordion-body">
                                    <p class="text-secondary poppins-light">Información sobre los envíos y tiempos de entrega.</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </main>

    <!-- Sección de comentarios - justo después del acordeón y antes del footer -->
    <section class="container mb-5">

        <!-- Formulario para dejar una reseña -->
        <div class="card fondo">
            <div class="card-body">
                <form id="form-comentario">
                    <!-- Calificación -->
                    <div class="mb-3">
                        <div class="rating">
                            <input type="hidden" name="id-producto" value="<?php echo $_GET['id'] ?? 0; ?>">

                            <div class="form-check form-check-inline">
                                <input class="form-check-input" type="radio" name="rating" id="rating5" value="5" checked>
                                <label class="form-check-label" for="rating5">5★</label>
                            </div>
                            <div class="form-check form-check-inline">
                                <input class="form-check-input" type="radio" name="rating" id="rating4" value="4">
                                <label class="form-check-label" for="rating4">4★</label>
                            </div>
                            <div class="form-check form-check-inline">
                                <input class="form-check-input" type="radio" name="rating" id="rating3" value="3">
                                <label class="form-check-label" for="rating3">3★</label>
                            </div>
                            <div class="form-check form-check-inline">
                                <input class="form-check-input" type="radio" name="rating" id="rating2" value="2">
                                <label class="form-check-label" for="rating2">2★</label>
                            </div>
                            <div class="form-check form-check-inline">
                                <input class="form-check-input" type="radio" name="rating" id="rating1" value="1">
                                <label class="form-check-label" for="rating1">1★</label>
                            </div>
                        </div>
                    </div>

                    <!-- Comentario -->
                    <div class="mb-3">
                        <label for="reviewText" class="form-label poppins-light">Tu comentario</label>
                        <textarea class="form-control" name="comentario" id="comentario" rows="3" placeholder="Cuéntanos tu experiencia con este producto"></textarea>
                    </div>

                    <!-- Botón de envío -->
                    <button type="submit" class="btn boton-fondo-morado poppins-light">Publicar comentario</button>
                </form>
            </div>
        </div>

        <div class="row mt-3">
            <div class="col-12">

                <!-- Reseñas existentes -->
                <div class="mb-4" id="comentarios">
                    <!-- Reseña 1 -->
                    <div class="card mb-3 fondo">
                        <div class="card-body">
                            <div class="d-flex justify-content-between mb-2">
                                <h5 class="card-title poppins-light">Laura Martínez</h5>
                                <div>
                                    <span class="text-warning">★★★★★</span>
                                    <small class="text-muted ms-2">15/04/2025</small>
                                </div>
                            </div>
                            <p class="card-text poppins-light">¡Me encantaron los pines! La calidad es excelente y los diseños son hermosos. Definitivamente volveré a comprar más productos.</p>
                        </div>
                    </div>

                    <!-- Reseña 2 -->
                    <div class="card mb-3 fondo">
                        <div class="card-body">
                            <div class="d-flex justify-content-between mb-2">
                                <h5 class="card-title poppins-light">Carlos Ramírez</h5>
                                <div>
                                    <span class="text-warning">★★★★☆</span>
                                    <small class="text-muted ms-2">02/04/2025</small>
                                </div>
                            </div>
                            <p class="card-text poppins-light">Buen producto, los colores son vibrantes y el acabado es de calidad. Solo le quito una estrella porque uno de los pines venía con un pequeño defecto en el broche.</p>
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </section>

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

    <script src="./js/bootstrap.bundle.min.js"></script>
    <script src="./js/main.js"></script>
</body>

</html>
