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
    <!-- Sidebar -->
    <div class="sidebar">
        <div class="logo d-flex align-items-center">
            <i class="fas fa-cube me-2"></i>
            <span>Gleams</span>
        </div>

        <div class="user-info d-flex align-items-center p-3 border-bottom">
            <img src="./img/user.jpg" alt="Profile picture" class="profile-pic me-3">
            <div>
                <div class="fw-bold">David Grey</div>
                <div class="text-muted small">Administrador</div>
            </div>
        </div>

        <div class="mt-3">
            <a href="./dashboard.php" class="sidebar-item">
                <i class="fas fa-home"></i>
                <span>Dashboard</span>
                <i class="fas fa-chevron-right ms-auto"></i>
            </a>


            <!--Inicio de opciones de productos-->

            <a class="sidebar-item active" data-bs-toggle="collapse" href="#productos-options" aria-expanded="false" aria-controls="productos-options">
                <i class="fas fa-th"></i>
                <span>Productos</span>
                <i class="fas fa-chevron-right ms-auto"></i>
            </a>

            <div class="collapse" id="productos-options">
                <a class="d-flex ms-3 sidebar-item align-items-center" href="./listado.php">
                    <i class="fa fa-list"></i>
                    Listar
                </a>

                <a class="d-flex ms-3 sidebar-item align-items-center" href="./productos.php">
                    <i class="fas fa-plus"></i>
                    Gestionar
                </a>
            </div>

            <!--Inicio de opciones de usuarios-->

            <a class="sidebar-item">
                <i class="fas fa-users"></i>
                <span>Usuarios</span>
            </a>

            <!--Inicio de opciones de pedidos-->

            <a class="sidebar-item">
                <i class="fas fa-receipt"></i>
                <span>Pedidos</span>
            </a>


            <!--Inicio de opciones de reseñas-->

            <a class="sidebar-item">
                <i class="fas fa-star"></i>
                <span>Reseñas</span>
            </a>

            <!--Inicio de opciones de reseñas-->

            <a class="sidebar-item">
                <i class="fas fa-search"></i>
                <span>Consultas</span>
            </a>

        </div>
    </div>

    <!-- Main Content -->
    <div class="main-content">
        <!-- Top Navbar -->
        <nav class="navbar navbar-expand-lg navbar-light bg-white py-2 px-3 mb-4 rounded">
            <div class="container-fluid">
                <button class="btn btn-sm border-0">
                    <i class="fas fa-bars"></i>
                </button>

                <div class="d-flex align-items-center ms-auto">
                    <div class="d-flex align-items-center">
                        <div class="dropdown me-3">
                            <button class="btn dropdown-toggle d-flex align-items-center" type="button" id="userDropdown" data-bs-toggle="dropdown">
                                <img src="./img/user.jpg" alt="Profile picture" class="profile-pic me-2">
                                <span>David Greymaax</span>
                            </button>

                            <ul class="dropdown-menu">
                                <li>
                                    <a href="#" class="dropdown-item">Ver perfil</a>
                                </li>

                                <li>
                                    <a href="#" class="dropdown-item">Cambiar de cuenta</a>
                                </li>
                            </ul>

                        </div>
                        <button class="btn">
                            <i class="fas fa-power-off"></i>
                        </button>
                    </div>
                </div>
            </div>
        </nav>

        <!-- Dashboard Header -->
        <div class="d-flex justify-content-between align-items-center mb-4">
            <div class="d-flex align-items-center">
                <div class="bg-primary text-white p-3 rounded me-3 dashboard-title">
                    <i class="fas fa-tachometer-alt"></i>
                </div>
                <h4 class="mb-0">Dashboard</h4>
            </div>
        </div>

        <!-- Charts -->
        <div class="row g-4 mt-3">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-body">
                        <div class="d-flex justify-content-between mb-4">
                            <h5 class="card-title">Lista de productos</h5>
                        </div>
                        <div class="chart-container" id="contenedor-productos">
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

    <script src="./js/main.js" type="module"></script>





</body>

</html>
