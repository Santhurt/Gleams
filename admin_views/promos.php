<?php
session_start();

if (!isset($_SESSION["correo"]) || !isset($_SESSION["rol"]) || $_SESSION["rol"] !== "admin") {
    header("Location: /user_views/login.php");
    exit;
}
?>
<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard de Administración</title>
    <link href="./css/bootstrap.min.css" rel="stylesheet">
    <link href="../node_modules/@fortawesome/fontawesome-free/css/all.css" rel="stylesheet">
    <link href="./css/style.css" rel="stylesheet">
    <link href="../node_modules/datatables.net-bs5/css/dataTables.bootstrap5.min.css" rel="stylesheet">


</head>

<body>
    <!-- Overlay for mobile -->
    <div class="overlay" id="sidebar-overlay"></div>

    <!-- Sidebar -->
    <div class="sidebar" id="sidebar">
        <div class="logo d-flex align-items-center">
            <i class="fas fa-cube me-2"></i>
            <span class="sidebar-text">Gleams</span>
        </div>

        <div class="user-info d-flex align-items-center p-3 border-bottom">
            <img src="./img/user.jpg" alt="Profile picture" class="profile-pic me-3">
            <div class="sidebar-text">
                <?php if (isset($_SESSION["usuario"])): ?>
                    <div class="fw-bold"><?php echo htmlspecialchars($_SESSION["usuario"] ?? "usuario"); ?></div>
                    <div class="text-muted small">Administrador</div>
                <?php endif; ?>
            </div>
        </div>

        <div class="mt-3">
            <a href="./dashboard.php" class="sidebar-item">
                <i class="fas fa-home"></i>
                <span class="sidebar-text">Dashboard</span>
            </a>

            <!--Inicio de opciones de productos-->
            <a class="sidebar-item" data-bs-toggle="collapse" href="#productos-options" aria-expanded="false" aria-controls="productos-options">
                <i class="fas fa-th"></i>
                <span class="sidebar-text">Productos</span>
                <i class="fas fa-chevron-right ms-auto"></i>
            </a>

            <div class="collapse" id="productos-options">
                <a class="d-flex ms-3 sidebar-item align-items-center" href="./listado.php">
                    <i class="fa fa-list"></i>
                    <span class="sidebar-text">Listar</span>
                </a>

                <a class="d-flex ms-3 sidebar-item align-items-center" href="./productos.php">
                    <i class="fas fa-plus"></i>
                    <span class="sidebar-text">Gestionar</span>
                </a>
            </div>

            <!--Inicio de opciones de usuarios-->
            <a class="sidebar-item" href="./usuarios.php">
                <i class="fas fa-users"></i>
                <span class="sidebar-text">Usuarios</span>
            </a>

            <!--Inicio de opciones de pedidos-->
            <a class="sidebar-item" href="./pedidos.php">
                <i class="fas fa-receipt"></i>
                <span class="sidebar-text">Pedidos</span>
            </a>

            <!--Inicio de opciones de reseñas-->
            <a class="sidebar-item" href="./comentarios.php">
                <i class="fas fa-star"></i>
                <span class="sidebar-text">Reseñas</span>
            </a>

            <a class="sidebar-item active" href="./promos.php">
                <i class="fas fa-search"></i>
                <span class="sidebar-text">Promociones</span>
            </a>
        </div>
    </div>

    <!-- Main Content -->
    <div class="main-content" id="main-content">
        <!-- Top Navbar -->
        <nav class="navbar navbar-expand-lg navbar-light bg-white py-2 px-3 mb-4 rounded">
            <div class="container-fluid">
                <button class="btn btn-sm border-0" id="sidebar-toggle">
                    <i class="fas fa-bars"></i>
                </button>

                <div class="d-flex align-items-center ms-auto">
                    <div class="d-flex align-items-center">
                        <div class="dropdown me-3">
                            <button class="btn dropdown-toggle d-flex align-items-center" type="button" id="userDropdown" data-bs-toggle="dropdown">
                                <img src="./img/user.jpg" alt="Profile picture" class="profile-pic me-2 d-sm-block">
                                <?php if (isset($_SESSION["usuario"])): ?>
                                    <span class="d-md-block"><?php echo htmlspecialchars($_SESSION["usuario"] ?? "usuario") ?></span>
                                <?php endif; ?>
                            </button>

                            <ul class="dropdown-menu dropdown-menu-end">
                                <li>
                                    <a href="../controllers/auth/logout.php" class="dropdown-item text-danger">Cerrar sesion</a>
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </nav>

        <!-- Dashboard Header -->
        <div class="d-flex justify-content-between align-items-center mb-4">
            <div class="d-flex align-items-center">
                <div class="bg-primary text-white p-3 rounded me-3 dashboard-title d-none d-sm-block">
                    <i class="fas fa-tachometer-alt"></i>
                </div>
                <h4 class="mb-0">Dashboard</h4>
            </div>
        </div>

        <!-- Charts -->
        <div class="row g-4">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-body">

                        <div class="chart-container">
                            <div class="gap-3 d-flex">
                                <button
                                    class="btn btn-primary"
                                    data-bs-toggle="modal"
                                    data-bs-target="#modal-promo"
                                    id="1"
                                    type="button">
                                    Editar imagen promocional 1
                                </button>

                                <button
                                    class="btn btn-info"
                                    data-bs-toggle="modal"
                                    data-bs-target="#modal-promo"
                                    id="2"
                                    type="button">
                                    Editar imagen promocional 2
                                </button>

                            </div>

                        </div>
                    </div>
                </div>
            </div>

        </div>

        <div class="modal fade" id="modal-promo" tabindex="-1" aria-labelledby="minimalModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title fw-bold">Editar imagen promocional</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <form id="form-promo">
                            <div class="mb-3">
                                <label for="" class="form-label">Titulo</label>
                                <input type="text" id="titulo" name="titulo" class="form-control">
                            </div>

                            <div class="mb-3">
                                <label for="" class="form-label">Descripcion</label>
                                <textarea class="form-control" id="descripcion" name="descripcion"  placeholder="Descripcion del producto"></textarea>
                            </div>

                            <div class="mb-3">
                                <label for="" class="form-label">Imagen</label>
                                <input type="file" name="imagen" class="form-control">
                            </div>
                        </form>

                    </div>
                    <div class="modal-footer">
                        <button type="submit" form="form-promo" class="btn btn-primary">Actualizar promoción</button>
                        <button type="button" class="btn btn-light" data-bs-dismiss="modal">Close</button>
                    </div>
                </div>
            </div>
        </div>

        <div class="row mt-2 g-4">
            <div class="col-md-6">
                <div class="card">
                    <div class="card-body">
                        <div class="chart-container">
                            <div class="gap-3 d-flex">

                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-md-6">
                <div class="card">
                    <div class="card-body">

                        <div class="chart-container">
                            <div class="gap-3 d-flex">

                            </div>
                        </div>
                    </div>
                </div>
            </div>

        </div>

    </div>

    <script src="../node_modules/jquery/dist/jquery.min.js"></script>
    <script src="./js/bootstrap.bundle.min.js"></script>
    <script src="../node_modules/datatables.net/js/dataTables.min.js"></script>
    <script src="../node_modules/datatables.net-bs5/js/dataTables.bootstrap5.min.js"></script>
    <script src="../node_modules/datatables.net-responsive/js/dataTables.responsive.min.js"></script>
    <script src="../node_modules/datatables.net-responsive-bs5/js/responsive.bootstrap5.min.js"></script>

    <script src="./js/main.js"></script>

</body>

</html>
