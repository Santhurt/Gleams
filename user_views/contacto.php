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
    <link href="./css/contacto.css" rel="stylesheet">

    <style>
        p {
            font-family: "Poppins", sans-serif;
            font-weight: 400;
            font-style: normal;
            letter-spacing: 1px;
        }

        h2 {
            font-family: "Playfair Display", serif;
            font-optical-sizing: auto;
            font-weight: bold;
            font-style: normal;
            letter-spacing: 1.5px;
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

        <?php require_once __DIR__ . "/componentes/navbar.php" ?>

    </header>


    <!-- Main Content -->
    <main class="fondo">
        <!-- Contacto Content -->
        <section class="container contacto-container fade-in">

            <!-- Intro -->
            <div class="intro-text pt-5">
                <h2>¿Cómo prefieres contactarnos?</h2>
                <p>Elige el canal que más te convenga. Nuestro equipo está listo para atender todas tus consultas sobre nuestros productos y servicios.</p>
            </div>

            <!-- Tarjetas de Contacto -->
            <div class="row g-4">

                <!-- WhatsApp -->
                <div class="col-lg-4 col-md-6">
                    <div class="contact-card">
                        <div class="contact-icon">
                            <i class="bi bi-whatsapp"></i>
                        </div>
                        <h3>WhatsApp</h3>
                        <p>Chatea con nosotros en tiempo real y recibe respuesta inmediata</p>
                        <span class="contact-link">+57 310 450 2353</span>
                        <a href="https://wa.me/3104502353" target="_blank" class="btn-contact">
                            <i class="bi bi-chat-dots me-2"></i>Enviar Mensaje
                        </a>
                    </div>
                </div>

                <!-- Instagram -->
                <div class="col-lg-4 col-md-6">
                    <div class="contact-card">
                        <div class="contact-icon">
                            <i class="bi bi-instagram"></i>
                        </div>
                        <h3>Instagram</h3>
                        <p>Síguenos y escríbenos por mensaje directo para ver nuestras últimas colecciones</p>
                        <span class="contact-link">@gleamns_accesorios</span>
                        <a href="https://www.instagram.com/gleamns_accesorios/" target="_blank" class="btn-contact">
                            <i class="bi bi-arrow-right me-2"></i>Seguir
                        </a>
                    </div>
                </div>

                <!-- Correo -->
                <div class="col-lg-4 col-md-6">
                    <div class="contact-card">
                        <div class="contact-icon">
                            <i class="bi bi-envelope"></i>
                        </div>
                        <h3>Correo Electrónico</h3>
                        <p>Envíanos un email y te responderemos con toda la información que necesites</p>
                        <span class="contact-link">sanchezsotojhonnysteban@gmail.com</span>
                        <a href="mailto:sanchezsotojhonnysteban@gmail.com" class="btn-contact">
                            <i class="bi bi-send me-2"></i>Enviar Email
                        </a>
                    </div>
                </div>

            </div>

            <!-- Información Adicional -->
            <div class="info-adicional">
                <h3>Horario de Atención</h3>
                <p>Nuestro equipo está disponible para atenderte en los siguientes horarios:</p>
                <div class="horarios">
                    <div class="horario-item">
                        <i class="bi bi-calendar-week"></i>
                        Lunes a Viernes: 9:00 AM - 6:00 PM
                    </div>
                    <div class="horario-item">
                        <i class="bi bi-calendar-check"></i>
                        Sábados: 10:00 AM - 2:00 PM
                    </div>
                </div>
                <p class="mt-4 mb-0" style="color: #999; font-size: 0.95rem;">
                    <i class="bi bi-clock-history me-2"></i>
                    Tiempo de respuesta estimado: 24 horas hábiles
                </p>
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
                threshold: 0.15
            },
        );

        elementosTransicion.forEach(elemento => {
            observer.observe(elemento);
        });
    </script>
</body>

</html>
