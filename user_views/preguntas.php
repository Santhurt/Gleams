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
    <link href="./css/preguntas.css" rel="stylesheet">

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
        <!-- FAQ Content -->
        <section class="container py-4 fade-in">
            <div class="faq-container">

                <!-- Intro -->
                <div class="intro-faq">
                    <div class="icon-container">
                        <i class="bi bi-question-circle"></i>
                    </div>
                    <h2>¿Cómo podemos ayudarte?</h2>
                    <p>Hemos recopilado las preguntas más frecuentes de nuestros clientes. Si no encuentras lo que buscas, no dudes en contactarnos.</p>
                </div>

                <!-- Accordion de Preguntas -->
                <div class="accordion" id="accordionFAQ">

                    <!-- Pregunta 1 -->
                    <div class="accordion-item">
                        <h2 class="accordion-header">
                            <button class="accordion-button" type="button" data-bs-toggle="collapse" data-bs-target="#collapse1" aria-expanded="true" aria-controls="collapse1">
                                ¿Dónde puedo conseguir sus joyas?
                            </button>
                        </h2>
                        <div id="collapse1" class="accordion-collapse collapse show" data-bs-parent="#accordionFAQ">
                            <div class="accordion-body">
                                Puedes adquirir nuestras piezas directamente a través de nuestra tienda virtual y en los puntos de venta autorizados.
                            </div>
                        </div>
                    </div>

                    <!-- Pregunta 2 -->
                    <div class="accordion-item">
                        <h2 class="accordion-header">
                            <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapse2" aria-expanded="false" aria-controls="collapse2">
                                ¿A qué ciudades hacen envíos?
                            </button>
                        </h2>
                        <div id="collapse2" class="accordion-collapse collapse" data-bs-parent="#accordionFAQ">
                            <div class="accordion-body">
                                Realizamos envíos a Pereira, Cartago y alrededores.
                            </div>
                        </div>
                    </div>

                    <!-- Pregunta 3 -->
                    <div class="accordion-item">
                        <h2 class="accordion-header">
                            <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapse3" aria-expanded="false" aria-controls="collapse3">
                                ¿Cuánto tiempo se demora en llegar mi pedido?
                            </button>
                        </h2>
                        <div id="collapse3" class="accordion-collapse collapse" data-bs-parent="#accordionFAQ">
                            <div class="accordion-body">
                                El tiempo de entrega depende de la ubicación del cliente.
                            </div>
                        </div>
                    </div>

                    <!-- Pregunta 4 -->
                    <div class="accordion-item">
                        <h2 class="accordion-header">
                            <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapse4" aria-expanded="false" aria-controls="collapse4">
                                ¿Qué métodos de pago aceptan?
                            </button>
                        </h2>
                        <div id="collapse4" class="accordion-collapse collapse" data-bs-parent="#accordionFAQ">
                            <div class="accordion-body">
                                Aceptamos transferencias bancarias, efectivo, así como plataformas de pago en línea (según disponibilidad).
                            </div>
                        </div>
                    </div>

                    <!-- Pregunta 5 -->
                    <div class="accordion-item">
                        <h2 class="accordion-header">
                            <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapse5" aria-expanded="false" aria-controls="collapse5">
                                ¿Las joyas son hipoalergénicas?
                            </button>
                        </h2>
                        <div id="collapse5" class="accordion-collapse collapse" data-bs-parent="#accordionFAQ">
                            <div class="accordion-body">
                                Sí, nuestras piezas están elaboradas con materiales de alta calidad como el rodio, que ayudan a prevenir reacciones en la piel.
                            </div>
                        </div>
                    </div>

                    <!-- Pregunta 6 -->
                    <div class="accordion-item">
                        <h2 class="accordion-header">
                            <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapse6" aria-expanded="false" aria-controls="collapse6">
                                ¿Ofrecen garantía?
                            </button>
                        </h2>
                        <div id="collapse6" class="accordion-collapse collapse" data-bs-parent="#accordionFAQ">
                            <div class="accordion-body">
                                Sí, cada joya cuenta con garantía por defectos de fabricación. La garantía no cubre daños ocasionados por golpes, contacto con químicos, perfumes o mal uso.
                            </div>
                        </div>
                    </div>

                    <!-- Pregunta 7 -->
                    <div class="accordion-item">
                        <h2 class="accordion-header">
                            <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapse7" aria-expanded="false" aria-controls="collapse7">
                                ¿Puedo cambiar una joya si no me gusta?
                            </button>
                        </h2>
                        <div id="collapse7" class="accordion-collapse collapse" data-bs-parent="#accordionFAQ">
                            <div class="accordion-body">
                                No realizamos cambios por gusto personal. Solo se aceptan cambios o devoluciones en caso de defectos de fábrica o errores en el envío.
                            </div>
                        </div>
                    </div>

                    <!-- Pregunta 8 -->
                    <div class="accordion-item">
                        <h2 class="accordion-header">
                            <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapse8" aria-expanded="false" aria-controls="collapse8">
                                ¿Fabrican joyas personalizadas?
                            </button>
                        </h2>
                        <div id="collapse8" class="accordion-collapse collapse" data-bs-parent="#accordionFAQ">
                            <div class="accordion-body">
                                No, somos revendedores. Sin embargo, contamos con un catálogo amplio de diseños modernos y elegantes.
                            </div>
                        </div>
                    </div>

                    <!-- Pregunta 9 -->
                    <div class="accordion-item">
                        <h2 class="accordion-header">
                            <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapse9" aria-expanded="false" aria-controls="collapse9">
                                ¿Puedo apartar un producto?
                            </button>
                        </h2>
                        <div id="collapse9" class="accordion-collapse collapse" data-bs-parent="#accordionFAQ">
                            <div class="accordion-body">
                                Sí, contamos con opción de apartado con un abono inicial. El saldo debe completarse dentro del plazo acordado.
                            </div>
                        </div>
                    </div>

                    <!-- Pregunta 10 -->
                    <div class="accordion-item">
                        <h2 class="accordion-header">
                            <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapse10" aria-expanded="false" aria-controls="collapse10">
                                ¿Cómo puedo contactarlos?
                            </button>
                        </h2>
                        <div id="collapse10" class="accordion-collapse collapse" data-bs-parent="#accordionFAQ">
                            <div class="accordion-body">
                                Puedes escribirnos por WhatsApp, correo electrónico o en nuestras redes sociales. Estaremos encantados de atenderte.
                            </div>
                        </div>
                    </div>

                </div>

                <!-- CTA de Contacto -->
                <div class="contacto-box">
                    <h3>¿No encontraste tu respuesta?</h3>
                    <p>Estamos aquí para ayudarte. Contáctanos y resolveremos todas tus dudas.</p>
                    <a href="./contacto.php" class="btn-contacto">
                        <i class="bi bi-chat-dots me-2"></i>Contáctanos
                    </a>
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
                threshold: 0.15
            },
        );

        elementosTransicion.forEach(elemento => {
            observer.observe(elemento);
        });
    </script>
</body>

</html>
