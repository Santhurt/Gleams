<?php $current_page = basename($_SERVER["PHP_SELF"]) ?>
<!-- Navbar -->
<nav id="navbar" class="navbar navbar-expand-lg fondo">
    <div class="container">
        <!-- Logo -->
        <div class="me-auto social-links">
            <a href="https://www.instagram.com/gleamns_accesorios/" class="social-icon"><i class="fab fa-instagram"></i></a>
            <a href="https://wa.me/3104502353" class="social-icon"><i class="fab fa-whatsapp"></i></a>
        </div>


        <!-- Botón hamburguesa -->
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarContent">
            <span class="navbar-toggler-icon"></span>
        </button>

        <!-- Contenido colapsable (incluye menú y botones) -->
        <div class="collapse navbar-collapse" id="navbarContent">
            <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                <li class="nav-item">
                    <a class="nav-link <?= ($current_page == 'shop.php') ? 'active' : '' ?>" href="./shop.php">Tienda</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link <?= ($current_page == 'nosotros.php') ? 'active' : '' ?>" href="./nosotros.php">Nosotros</a>
                </li>
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle <?= (in_array($current_page, ['faq.php', 'envios.php', 'contacto.php'])) ? 'active' : '' ?>"
                        href="#"
                        id="navbarDropdownAyuda"
                        role="button"
                        data-bs-toggle="dropdown"
                        aria-expanded="false">
                        Ayuda
                    </a>
                    <ul class="dropdown-menu" aria-labelledby="navbarDropdownAyuda">
                        <li><a class="dropdown-item <?= ($current_page == 'terminos.php') ? 'active' : '' ?>" href="./terminos.php">Términos y condiciones</a></li>
                        <li><a class="dropdown-item <?= ($current_page == 'preguntas.php') ? 'active' : '' ?>" href="./preguntas.php">Preguntas frecuentes</a></li>
                        <li>
                            <hr class="dropdown-divider">
                        </li>
                        <li><a class="dropdown-item <?= ($current_page == 'contacto.php') ? 'active' : '' ?>" href="./contacto.php">Contacto</a></li>
                    </ul>
                </li>
                <?php if (isset($_SESSION["correo"]) && isset($_SESSION["usuario"])): ?>
                    <li class="nav-item">
                        <a class="nav-link <?= ($current_page == 'pedidos.php') ? 'active' : '' ?>" href="./pedidos.php">Pedidos</a>
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
