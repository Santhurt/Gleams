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
                <i class="fas fa-chevron-right ms-auto"></i>
            </a>

            <!--Inicio de opciones de productos-->
            <a class="sidebar-item active" data-bs-toggle="collapse" href="#productos-options" aria-expanded="false" aria-controls="productos-options">
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
            <a class="sidebar-item">
                <i class="fas fa-star"></i>
                <span class="sidebar-text">Reseñas</span>
            </a>

            <!--Inicio de opciones de consultas-->
            <a class="sidebar-item">
                <i class="fas fa-search"></i>
                <span class="sidebar-text">Consultas</span>
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
                                <img src="./img/user.jpg" alt="Profile picture" class="profile-pic me-2 d-none d-sm-block">
                                <?php if (isset($_SESSION["usuario"])): ?>
                                    <span class="d-none d-md-block"><?php echo htmlspecialchars($_SESSION["usuario"] ?? "usuario") ?></span>
                                <?php endif; ?>
                            </button>

                            <ul class="dropdown-menu dropdown-menu-end">
                                <li>
                                    <a href="#" class="dropdown-item">Ver perfil</a>
                                </li>

                                <li>
                                    <a href="#" class="dropdown-item">Cambiar de cuenta</a>
                                </li>

                                <li class="dropdown-divider"></li>

                                <li>
                                    <a href="../controllers/auth/logout.php" class="dropdown-item text-danger">Cerrar sesion</a>
                                </li>
                            </ul>
                        </div>
                        <button class="btn d-none d-lg-block">
                            <i class="fas fa-power-off"></i>
                        </button>
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

        <!-- Stats Cards - Added for better visualization -->
        <div class="row g-4 mb-4">
            <div class="col-12 col-sm-6 col-lg-3 mb-3">
                <div class="widget-card sales-card">
                    <h6 class="text-white-50">Total Ventas</h6>
                    <h3 class="mt-2">$12,450</h3>
                    <div class="progress mt-3" style="height: 5px;">
                        <div class="progress-bar bg-white" role="progressbar" style="width: 75%;" aria-valuenow="75" aria-valuemin="0" aria-valuemax="100"></div>
                    </div>
                    <small class="text-white-50 mt-2 d-block">+15% desde el mes pasado</small>
                </div>
            </div>
            <div class="col-12 col-sm-6 col-lg-3 mb-3">
                <div class="widget-card orders-card">
                    <h6 class="text-white-50">Pedidos</h6>
                    <h3 class="mt-2">248</h3>
                    <div class="progress mt-3" style="height: 5px;">
                        <div class="progress-bar bg-white" role="progressbar" style="width: 65%;" aria-valuenow="65" aria-valuemin="0" aria-valuemax="100"></div>
                    </div>
                    <small class="text-white-50 mt-2 d-block">+8% desde el mes pasado</small>
                </div>
            </div>
            <div class="col-12 col-sm-6 col-lg-3 mb-3">
                <div class="widget-card visitors-card">
                    <h6 class="text-white-50">Usuarios</h6>
                    <h3 class="mt-2">1,250</h3>
                    <div class="progress mt-3" style="height: 5px;">
                        <div class="progress-bar bg-white" role="progressbar" style="width: 85%;" aria-valuenow="85" aria-valuemin="0" aria-valuemax="100"></div>
                    </div>
                    <small class="text-white-50 mt-2 d-block">+12% desde el mes pasado</small>
                </div>
            </div>
            <div class="col-12 col-sm-6 col-lg-3 mb-3">
                <div class="widget-card dashboard-title">
                    <h6 class="text-white-50">Productos</h6>
                    <h3 class="mt-2">85</h3>
                    <div class="progress mt-3" style="height: 5px;">
                        <div class="progress-bar bg-white" role="progressbar" style="width: 50%;" aria-valuenow="50" aria-valuemin="0" aria-valuemax="100"></div>
                    </div>
                    <small class="text-white-50 mt-2 d-block">+5% desde el mes pasado</small>
                </div>
            </div>
        </div>

        <!-- Charts -->
        <div class="row g-4 mt-3">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-body">
                        <div class="d-flex justify-content-between align-items-center flex-wrap mb-4">
                            <h5 class="card-title">Lista de productos</h5>
                            <div class="d-flex mt-2 mt-md-0">
                                <button class="btn btn-sm btn-primary me-2">
                                    <i class="fas fa-plus me-1"></i>
                                    <span class="d-none d-sm-inline">Añadir</span>
                                </button>
                                <button class="btn btn-sm btn-outline-secondary">
                                    <i class="fas fa-filter me-1"></i>
                                    <span class="d-none d-sm-inline">Filtrar</span>
                                </button>
                            </div>
                        </div>
                        <div class="table-responsive">
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
