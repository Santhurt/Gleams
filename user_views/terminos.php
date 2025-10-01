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
    <link href="./css/terminos.css" rel="stylesheet">

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
        <!-- Hero Section -->
        <!-- <section class="hero-terminos"> -->
        <!--     <div class="container"> -->
        <!--         <h1>Términos y Condiciones</h1> -->
        <!--         <p>Por favor, lee cuidadosamente nuestros términos y condiciones antes de realizar tu compra</p> -->
        <!--     </div> -->
        <!-- </section> -->

        <!-- Términos y Condiciones -->
        <section class="container py-3">
            <div class="terminos-container fade-in">

                <div class="intro-text">
                    <i class="bi bi-info-circle" style="font-size: 2rem; color: var(--color-base); margin-bottom: 15px;"></i>
                    <p class="mb-0">Al realizar una compra en Gleamns, aceptas los siguientes términos y condiciones. Nos comprometemos a ofrecerte joyería de calidad con transparencia y confianza.</p>
                </div>

                <!-- Término 1 -->
                <div class="termino-item">
                    <div class="termino-header">
                        <div class="termino-numero">1</div>
                        <h2 class="termino-titulo">Productos</h2>
                    </div>
                    <div class="termino-contenido">
                        <p>
                            Garantizamos que cada pieza coincide con la descripción publicada en el catálogo en cuanto a material, diseño, color, medidas y características específicas.
                        </p>
                    </div>
                </div>

                <!-- Término 2 -->
                <div class="termino-item">
                    <div class="termino-header">
                        <div class="termino-numero">2</div>
                        <h2 class="termino-titulo">Disponibilidad de Inventario</h2>
                    </div>
                    <div class="termino-contenido">
                        <p>
                            El stock de productos puede variar sin previo aviso debido a la rotación. Una vez agotada una referencia, no aseguramos su reposición inmediata o futura.
                        </p>

                    </div>
                </div>

                <!-- Término 3 -->
                <div class="termino-item" id="envios">
                    <div class="termino-header">
                        <div class="termino-numero">3</div>
                        <h2 class="termino-titulo">Precios y Pagos</h2>
                    </div>
                    <div class="termino-contenido">
                        <p>
                            Los precios publicados incluyen impuestos aplicables y están sujetos a cambios sin previo aviso. Aceptamos los métodos de pago autorizados en la tienda. Los pedidos se procesan únicamente después de la confirmación del pago.
                        </p>
                    </div>
                </div>

                <!-- Término 4 -->
                <div class="termino-item">
                    <div class="termino-header">
                        <div class="termino-numero">4</div>
                        <h2 class="termino-titulo">Envíos</h2>
                    </div>
                    <div class="termino-contenido">
                        <p>
                            Realizamos envíos a Pereira, Cartago y alrededores. Los tiempos de entrega dependen de la ubicación del cliente y se informan al momento de la compra. La empresa no se hace responsable por retrasos atribuibles a la transportadora.
                        </p>
                    </div>
                </div>

                <!-- Término 5 -->
                <div class="termino-item">
                    <div class="termino-header">
                        <div class="termino-numero">5</div>
                        <h2 class="termino-titulo">Cambios y Devoluciones</h2>
                    </div>
                    <div class="termino-contenido">
                        <p>
                            Los cambios y devoluciones aplican únicamente en caso de defectos de fabricación o si el producto entregado no corresponde al solicitado. El cliente debe notificar la novedad dentro de los 3 días hábiles posteriores a la recepción. No se aceptan cambios por gusto personal, mal uso o desgaste natural.
                        </p>
                    </div>
                </div>

                <!-- Término 6 -->
                <div class="termino-item" id="privacidad">
                    <div class="termino-header">
                        <div class="termino-numero">6</div>
                        <h2 class="termino-titulo">Garantía</h2>
                    </div>
                    <div class="termino-contenido">
                        <p>
                            Cada joya cuenta con la garantía indicada por el proveedor, que cubre únicamente defectos de fabricación. La garantía no aplica en casos de daños ocasionados por golpes, contacto con químicos, agua, perfumes u otros agentes externos.
                        </p>
                    </div>
                </div>

                <!-- Término 7 -->
                <div class="termino-item">
                    <div class="termino-header">
                        <div class="termino-numero">7</div>
                        <h2 class="termino-titulo">Privacidad y Protección de Datos</h2>
                    </div>
                    <div class="termino-contenido">
                        <p>
                            La información suministrada por los clientes se maneja de forma confidencial y se utiliza exclusivamente para la gestión de compras, envíos y comunicaciones relacionadas. Nos comprometemos a no compartir ni vender datos personales a terceros.
                        </p>
                    </div>
                </div>

                <!-- Término 8 -->
                <div class="termino-item">
                    <div class="termino-header">
                        <div class="termino-numero">8</div>
                        <h2 class="termino-titulo">Uso de la Página Web</h2>
                    </div>
                    <div class="termino-contenido">
                        <p>
                            Al acceder y realizar compras en nuestro sitio, el cliente acepta proporcionar información veraz, actualizada y completa. La empresa se reserva el derecho de actualizar, modificar o suspender, de manera temporal o definitiva, cualquier contenido del sitio sin previo aviso.
                        </p>
                    </div>
                </div>

                <!-- Fecha de actualización -->
                <!-- <div class="fecha-actualizacion"> -->
                <!--     <p class="mb-0"><i class="bi bi-calendar-check me-2"></i>Última actualización: Enero 2025</p> -->
                <!-- </div> -->

                <!-- CTA Contacto -->
                <div class="contacto-cta">
                    <h3>¿Tienes alguna duda?</h3>
                    <p>Visita las preguntas más frecuentes que nos hacen nuestros clientes</p>
                    <a href="./preguntas.php" class="btn-contacto">Preguntas frecuentes</a>
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
