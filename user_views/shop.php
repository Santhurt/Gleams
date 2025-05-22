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

    <!--Aqui inicia el modal izquierdo-->

    <!-- Botón para abrir el filtro en móviles -->
    <button class="filter-toggle-btn d-md-none" type="button" data-bs-toggle="offcanvas" data-bs-target="#filterOffcanvas">
        <i class="bi bi-funnel" style="font-size: 24px;"></i>
    </button>


    <!-- Modal de filtros lateral (Offcanvas) -->
    <div class="offcanvas offcanvas-start poppins-light" tabindex="-1" id="filterOffcanvas" aria-labelledby="filterOffcanvasLabel">
        <div class="offcanvas-header d-flex align-items-center text-white">
            <h5 class="offcanvas-title" id="filterOffcanvasLabel">Filtrar</h5>
            <button type="button" class="btn-close text-reset" data-bs-dismiss="offcanvas" aria-label="Close"></button>
        </div>
        <div class="offcanvas-body">

            <!-- Filtro de Categorías -->
            <div class="filter-section">
                <div class="filter-header" data-bs-toggle="collapse" data-bs-target="#categoryCollapse" aria-expanded="true">
                    <span>CATEGORIAS</span>
                    <i class="bi bi-chevron-down" style="font-size: 16px;"></i>
                </div>
                <div class="collapse show filter-body" id="categoryCollapse">
                    <div class="filter-item">
                        <div class="form-check">
                            <input class="form-check-input" type="checkbox" value="" id="catAnillos">
                            <label class="form-check-label" for="catAnillos">
                                Anillos
                            </label>
                        </div>
                    </div>
                    <div class="filter-item">
                        <div class="form-check">
                            <input class="form-check-input" type="checkbox" value="" id="catPendientes">
                            <label class="form-check-label" for="catPendientes">
                                Pendientes
                            </label>
                        </div>
                    </div>
                    <div class="filter-item">
                        <div class="form-check">
                            <input class="form-check-input" type="checkbox" value="" id="catCollares">
                            <label class="form-check-label" for="catCollares">
                                Collares
                            </label>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Filtro de Precio -->
            <div class="filter-section">
                <div class="filter-header" data-bs-toggle="collapse" data-bs-target="#priceCollapse" aria-expanded="true">
                    <span>PRECIO</span>
                    <i class="bi bi-chevron-down" style="font-size: 16px;"></i>
                </div>
                <div class="collapse show filter-body" id="priceCollapse">
                    <div class="filter-item">
                        <div class="form-check">
                            <input class="form-check-input" type="checkbox" value="" id="price1">
                            <label class="form-check-label" for="price1">
                                Menos de $25.000
                            </label>
                        </div>
                    </div>
                    <div class="filter-item">
                        <div class="form-check">
                            <input class="form-check-input" type="checkbox" value="" id="price2">
                            <label class="form-check-label" for="price2">
                                $25.000 - $50.000
                            </label>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Botones de acción -->
            <div class="d-flex gap-2 mt-4">
                <button class="btn btn-filter flex-grow-1">Aplicar filtros</button>
            </div>
        </div>
    </div>
    <!--Aqui termina el modal-->


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
                            <a class="nav-link" href="#">Inicio</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="#">Colecciones</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="#">Accesorios</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="#">Nosotros</a>
                        </li>
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
                            <a href="../controllers/auth/logout.php" type="button" class="btn boton-fondo-blanco poppins-light">Cerrar sesion</a>
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

    <div class="row justify-content-center">
        <div class="col-10 col-sm-8 col-md-6 col-lg-4 col-xl-3 p-3">
            <div class="d-flex align-items-center">
                <input class="form-control me-2 poppins-light" type="search" placeholder="Buscar productos" aria-label="Search">
                <i class="fas fa-search"></i>
            </div>
        </div>
    </div>

    <!-- Main Content -->
    <main class="fondo">

        <!-- Hero Section -->
        <section class="hero-section fade-opacity color-base" id="hero-section">
            <div class="container">
                <h1 class="hero-title color-texto playfair-title">NUEVA COLECCIÓN ACCESORIOS</h1>
                <p class="text-muted poppins-light">Descubre nuestra nueva selección de accesorios artesanales</p>
            </div>
        </section>

        <!-- Filter Bar -->
        <div class="container mt-4 fade-opacity" id="filter-bar">
            <div class="row filter-bar align-items-center">
                <div class="col-md-6">
                    <!-- Botón para abrir el filtro en desktop -->
                    <div class="container mt-4 d-none d-md-block">
                        <button class="btn btn-filter poppins-light" id="btn-filter" type="button" data-bs-toggle="offcanvas" data-bs-target="#filterOffcanvas">
                            <i class="bi bi-funnel"></i>
                            Filtrar productos
                        </button>
                    </div>
                </div>
                <div class="col-md-6 text-md-end">
                    <select class="filter-dropdown rounded-4 text-secondary">
                        <option>12 por página</option>
                        <option>24 por página</option>
                        <option>36 por página</option>
                    </select>
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
            <div class="d-flex justify-content-center mt-5">
                <nav aria-label="Page navigation">
                    <ul class="pagination">
                        <li class="page-item disabled">
                            <a class="page-link" href="#" tabindex="-1" aria-disabled="true">
                                <i class="bi bi-chevron-left"></i>
                            </a>
                        </li>
                        <li class="page-item active .color-paginacion"><a class="page-link" href="#">1</a></li>
                        <li class="page-item"><a class="page-link" href="#">2</a></li>
                        <li class="page-item"><a class="page-link" href="#">3</a></li>
                        <li class="page-item">
                            <a class="page-link" href="#">
                                <i class="bi bi-chevron-right"></i>
                            </a>
                        </li>
                    </ul>
                </nav>
            </div>
        </div>
    </main>

    <!-- Footer -->
    <footer class="footer">
        <div class="container">
            <div class="row">
                <!-- About Column -->
                <div class="col-md-4 mb-4 mb-md-0">
                    <h5 class="footer-title">ENTRELAZOS</h5>
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
                    <p class="text-muted small">© 2025 Entrelazos. Todos los derechos reservados.</p>
                </div>
            </div>
        </div>
    </footer>

    <!-- Bootstrap Bundle with Popper -->
    <script src="./js/main.js" type="module"></script>
    <script src="./js/bootstrap.bundle.min.js"></script>
</body>

</html>
