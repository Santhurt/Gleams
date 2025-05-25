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
            <a href="./dashboard.php" class="sidebar-item active">
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
                                <img src="./img/user.jpg" alt="Profile picture" class="profile-pic me-2 d-sm-block">
                                <?php if (isset($_SESSION["usuario"])): ?>
                                    <span class="d-md-block"><?php echo htmlspecialchars($_SESSION["usuario"] ?? "usuario") ?></span>
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

        <!-- Widgets -->
        <div class="row mb-4 g-4">
            <div class="col-md-4">
                <div class="widget-card sales-card">
                    <div class="mb-3">Usuarios registrados</div>
                    <h2 class="mb-3" id="cantidad-usuarios"></h2>
                    <div class="text-end">
                        <i class="fas fa-chart-line fa-2x opacity-50"></i>
                    </div>
                </div>
            </div>

            <!-- <div class="col-md-4"> -->
            <!--     <div class="widget-card sales-card"> -->
            <!--         <div class="mb-3">Usuarios registrados</div> -->
            <!--         <h2 class="mb-3">300</h2> -->
            <!--         <div>10 usuarios nuevos este mes</div> -->
            <!--         <div class="text-end"> -->
            <!--             <i class="fas fa-chart-line fa-2x opacity-50"></i> -->
            <!--         </div> -->
            <!--     </div> -->
            <!-- </div> -->

            <div class="col-md-4">
                <div class="widget-card orders-card">
                    <div class="mb-3">Ventas del mes</div>
                    <h2 class="mb-3" id="total-ventas">500</h2>
                    <div class="text-end">
                        <i class="fas fa-bookmark fa-2x opacity-50"></i>
                    </div>
                </div>
            </div>

            <div class="col-md-4">
                <div class="widget-card visitors-card">
                    <div class="mb-3">Cantidad de pedidos del mes</div>
                    <h2 class="mb-3">$1200000</h2>
                    <div>Aumento del 5%</div>
                    <div class="text-end">
                        <i class="fas fa-heart fa-2x opacity-50"></i>
                    </div>
                </div>
            </div>
        </div>

        <!-- Charts -->
        <div class="row g-4">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-body">
                        <div class="d-flex justify-content-between mb-4">
                            <h5 class="card-title">Pedidos pendientes</h5>
                            <div>
                                <span class="badge rounded-pill bg-light text-secondary me-1">
                                    <span class="me-1" style="color: #A976F8;">●</span> CHN
                                </span>
                                <span class="badge rounded-pill bg-light text-secondary me-1">
                                    <span class="me-1" style="color: #38BFED;">●</span> USA
                                </span>
                                <span class="badge rounded-pill bg-light text-secondary">
                                    <span class="me-1" style="color: #FF9E8A;">●</span> UK
                                </span>
                            </div>
                        </div>
                        <div class="chart-container">
                            <!-- Aquí iría el gráfico -->
                            <img src="/api/placeholder/700/300" alt="Chart placeholder" class="img-fluid">
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-md-4">
                <div class="card position-relative">
                    <div class="card-body">
                        <h5 class="card-title mb-4">Ventas recientes</h5>
                        <div class="chart-container">
                            <!-- Aquí iría el gráfico de pastel -->
                            <img src="/api/placeholder/300/300" alt="Pie chart placeholder" class="img-fluid">
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
