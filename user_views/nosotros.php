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

    <?php require_once __DIR__ . "/componentes/toplabel.php" ?>

    <div class="container-fluid">
        <div class="row justify-content-center">
            <div class="col text-center">
                <img src="./img/logoo.png" alt="">
            </div>
        </div>
    </div>

    <!-- Header -->
    <header class="sticky-top">

        <?php require_once __DIR__ . "/componentes/navbar.php" ?>

    </header>


    <!-- Main Content -->
    <main class="fondo">

        <!-- CTA Section -->
        <section class="container py-3 fade-in">
            <div class="cta-section">

                <h2 class="section-title playfair-title">Nosotros</h2>
                <p class="poppins-light" style="text-align: center;font-size: 1.1rem; line-height: 1.9;">
                    Somos una empresa colombiana dedicada a la comercialización de joyería y accesorios femeninos elaborados en rodio, hipoalergénicos y de alta calidad. Nacimos con el propósito de realzar la belleza y la autenticidad de cada mujer a través de piezas elegantes, modernas y accesibles.
                </p>
                <a href="./shop.php" class="btn btn-custom">Ver Productos</a>
            </div>
        </section>

        <section class="container mb-5">
            <div class="row g-4">
                <div class="col-md-4 fade-in">
                    <div class="card-nosotros">
                        <div class="icon">
                            <i class="bi bi-gem"></i>
                        </div>
                        <h3 class="playfair-title">Alta Calidad</h3>
                        <p class="poppins-light">Joyas elaboradas en rodio y materiales premium, hipoalergénicos y cuidadosamente seleccionados para garantizar durabilidad y elegancia.</p>
                    </div>
                </div>
                <div class="col-md-4 fade-in">
                    <div class="card-nosotros">
                        <div class="icon">
                            <i class="bi bi-heart"></i>
                        </div>
                        <h3 class="playfair-title">Diseños Únicos</h3>
                        <p class="poppins-light">Piezas modernas y elegantes que realzan la belleza natural de cada mujer, perfectas para cualquier ocasión especial.</p>
                    </div>
                </div>
                <div class="col-md-4 fade-in">
                    <div class="card-nosotros">
                        <div class="icon">
                            <i class="bi bi-shield-check"></i>
                        </div>
                        <h3 class="playfair-title">Confianza</h3>
                        <p class="poppins-light">Nuestro compromiso es brindar productos que combinen estilo, calidad y confianza, con garantía respaldada por el fabricante.</p>
                    </div>
                </div>
            </div>
        </section>

        <!-- Stats Section -->
        <section class="stats-section container">
            <div class="row d-flex justify-content-between">
                <div class="col-md-3 col-6">
                    <div class="stat-item">
                        <div class="number playfair-title">100%</div>
                        <div class="label poppins-light">Hipoalergénicas</div>
                    </div>
                </div>
                <div class="col-md-3 col-6">
                    <div class="stat-item">
                        <div class="number playfair-title">Premium</div>
                        <div class="label poppins-light">Calidad</div>
                    </div>
                </div>
                <div class="col-md-3 col-6">
                    <div class="stat-item">
                        <div class="number playfair-title">Colombia</div>
                        <div class="label poppins-light">Origen</div>
                    </div>
                </div>
            </div>
        </section>

    </main>

    <!-- Footer -->

    <?php require_once "./componentes/footer.php" ?>
    <!-- Bootstrap Bundle with Popper -->
    <script src="./js/main.js" type="module"></script>
    <script src="./js/bootstrap.bundle.min.js"></script>
    <script>
        const elementosTransicion = document.querySelectorAll(".fade-in");

        const observer = new IntersectionObserver(
            (observados) => {
                observados.forEach((observado, i) => {
                    if (observado.isIntersecting) {
                        const elementoVisible = observado.target;
                        elementoVisible.style.transitionDelay = `${i * 0.2}s`;
                        elementoVisible.classList.add("show");

                        observer.unobserve(observado.target);
                    }
                });
            }, {
                threshold: 0.2
            },
        );

        elementosTransicion.forEach(elemento => {
            observer.observe(elemento);
        });
    </script>
</body>

</html>
