<?php session_start();
?>
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

        <?php require_once __DIR__ . "/componentes/navbar.php" ?>

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
                    </ul>

                    <!-- Total -->
                    <div class="d-flex justify-content-between align-items-center border-top pt-3">
                        <h5 class="fw-bold mb-0">Total</h5>
                        <h5 class="fw-bold mb-0" id="total"></h5>
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
                    <h2 class="mb-3 mt-3 playfair-title" id="titulo"></h2>

                    <div class="price-container mb-3">
                        <!-- Contenedor para precios original y con descuento -->
                        <div class="precios-detalle mb-2">
                            <span class="precio-original-detalle text-muted text-decoration-line-through me-3" id="precio-original" style="display: none;"></span>
                            <h3 class="precio-actual poppins-light d-inline" id="precio"></h3>
                            <span class="badge bg-danger ms-2" id="badge-descuento" style="display: none;"></span>
                        </div>
                        <p class="text-muted small">Impuesto incluido. Los gastos de envío se calculan en la pantalla de pagos.</p>
                    </div>

                    <div class="mb-4">
                        <p class="mb-2 poppins-light">Cantidad</p>
                        <div class="contador-producto d-flex align-items-center gap-2">
                            <button class="btn boton-fondo-blanco btn-cantidad" data-op="restar" type="button">−</button>
                            <input id="input-cantidad" disabled type="text" class="cantidad-input text-center" value="1">
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

                </div>

            </div>
        </div>
    </section>


    <?php require_once "./componentes/footer.php" ?>

    <script src="./js/bootstrap.bundle.min.js"></script>
    <script src="./js/main.js"></script>
</body>

</html>
