<?php session_start(); ?>
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
    <link href="./css/carrousel.css" rel="stylesheet">

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
                        <!--Aqui iria el mensaje-->
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

    <!--Aqui inicia el modal izquierdo-->

    <!-- Botón para abrir el filtro en móviles -->
    <button class="filter-toggle-btn d-md-none" type="button" data-bs-toggle="offcanvas" data-bs-target="#filterOffcanvas">
        <i class="bi bi-funnel" style="font-size: 24px;"></i>
    </button>

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
                <div class="me-auto">
                    <a href="#" class="social-icon"><i class="fab fa-facebook-f"></i></a>
                    <a href="#" class="social-icon"><i class="fab fa-instagram"></i></a>
                    <a href="#" class="social-icon"><i class="fab fa-whatsapp"></i></a>
                </div>


                <!-- Botón hamburguesa -->
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarContent">
                    <span class="navbar-toggler-icon"></span>
                </button>

                <!-- Contenido colapsable (incluye menú y botones) -->
                <div class="collapse navbar-collapse" id="navbarContent">
                    <!-- Menú de navegación -->
                    <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                        <li class="nav-item">
                            <a class="nav-link active" href="./shop.php">Tienda</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="#">Colecciones</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="#">Accesorios</a>
                        </li>
                        <?php if (isset($_SESSION["correo"]) && isset($_SESSION["usuario"])): ?>
                            <li class="nav-item">
                                <a class="nav-link" href="./pedidos.php">Pedidos</a>
                            </li>
                        <?php endif; ?>
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


    <!-- Main Content -->
    <main class="fondo">
        <!-- Carrusel Promocional -->
        <section class="promotional-carousel">
            <div id="promotionalCarousel" class="carousel slide" data-bs-ride="carousel" data-bs-interval="5000">
                <!-- Indicadores -->
                <div class="carousel-indicators">
                    <button type="button" data-bs-target="#promotionalCarousel" data-bs-slide-to="0" class="active" aria-current="true" aria-label="Slide 1"></button>
                    <button type="button" data-bs-target="#promotionalCarousel" data-bs-slide-to="1" aria-label="Slide 2"></button>
                </div>
                <!-- Slides -->
                <div class="carousel-inner">
                    <!-- Slide 1 -->
                    <div class="carousel-item active">
                        <div class="carousel-split-container">
                            <div class="carousel-image-section fade-opacity">
                                <img src="https://images.unsplash.com/photo-1515562141207-7a88fb7ce338?ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D&auto=format&fit=crop&w=2070&q=80" class="carousel-image" alt="Nueva Colección">
                            </div>
                            <div class="carousel-content-section fade-opacity">
                                <h2 class="carousel-title">Nueva Colección</h2>
                                <p class="carousel-subtitle">Descubre nuestra exclusiva línea de accesorios artesanales, creados con amor y dedicación para resaltar tu belleza única. Cada pieza cuenta una historia especial.</p>
                                <a href="#" class="carousel-btn">Explorar Ahora</a>
                            </div>
                        </div>
                    </div>
                    <!-- Slide 2 -->
                    <div class="carousel-item">
                        <div class="carousel-split-container">
                            <div class="carousel-image-section">
                                <img src="https://images.unsplash.com/photo-1441986300917-64674bd600d8?ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D&auto=format&fit=crop&w=2070&q=80" class="carousel-image" alt="Envío Gratis">
                            </div>
                            <div class="carousel-content-section">
                                <h2 class="carousel-title">Envío Gratis</h2>
                                <p class="carousel-subtitle">En compras superiores a $150.000. Recibe tus accesorios favoritos directamente en la comodidad de tu hogar, sin costos adicionales de envío.</p>
                                <a href="#" class="carousel-btn">Comprar Ahora</a>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- Controles -->
                <button class="carousel-control-prev" type="button" data-bs-target="#promotionalCarousel" data-bs-slide="prev">
                    <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                    <span class="visually-hidden">Anterior</span>
                </button>
                <button class="carousel-control-next" type="button" data-bs-target="#promotionalCarousel" data-bs-slide="next">
                    <span class="carousel-control-next-icon" aria-hidden="true"></span>
                    <span class="visually-hidden">Siguiente</span>
                </button>
            </div>
        </section>
        <!-- Filter Bar -->
        <div class="container mt-4 fade-opacity" id="filter-bar">
            <div class="row justify-content-center filter-bar align-items-center">
                <div class="col-md-6">

                    <div class="d-flex align-items-center">
                        <input id="buscar" class="form-control me-2 poppins-light" type="search" placeholder="Buscar productos" aria-label="Search">
                        <i class="fas fa-search"></i>
                    </div>

                </div>
            </div>
        </div>

        <!-- Products Grid -->
        <div class="container mb-5">
            <div class="row" id="contenedor-productos">
                <!-- Product 1 -->
                <div class="col-6 col-md-4 col-lg-3 fade-in">
                    <div class="product-card">
                        <img src="./img/accesorio2.webp" class="card-img-top rounded-3 img-fluid" alt="Aretes Luna">
                        <div class="card-body d-flex flex-column flex-md-row align-items-start align-items-md-center px-0">
                            <div>
                                <h4 class="product-title playfair-title">Aretes Luna</h4>
                                <p class="product-price poppins-light">$45.000</p>
                            </div>
                            <a href="./producto.php" class="btn  ms-0 ms-md-auto mt-1 mt-md-0 boton-fondo-morado">
                                <i class="bi bi-bag-plus"></i>
                            </a>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Pagination -->
            <!-- <div class="d-flex justify-content-center mt-5"> -->
            <!--     <nav aria-label="Page navigation"> -->
            <!--         <ul class="pagination"> -->
            <!--             <li class="page-item disabled"> -->
            <!--                 <a class="page-link" href="#" tabindex="-1" aria-disabled="true"> -->
            <!--                     <i class="bi bi-chevron-left"></i> -->
            <!--                 </a> -->
            <!--             </li> -->
            <!--             <li class="page-item active .color-paginacion"><a class="page-link" href="#">1</a></li> -->
            <!--             <li class="page-item"><a class="page-link" href="#">2</a></li> -->
            <!--             <li class="page-item"><a class="page-link" href="#">3</a></li> -->
            <!--             <li class="page-item"> -->
            <!--                 <a class="page-link" href="#"> -->
            <!--                     <i class="bi bi-chevron-right"></i> -->
            <!--                 </a> -->
            <!--             </li> -->
            <!--         </ul> -->
            <!--     </nav> -->
            <!-- </div> -->
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
