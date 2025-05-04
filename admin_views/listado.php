<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard de Administración</title>
    <link href="./css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet">
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
            <a href="./dashboard.php" class="sidebar-item active">
                <i class="fas fa-home"></i>
                <span>Dashboard</span>
            </a>

            <!--Inicio de opciones de productos-->

            <a class="sidebar-item" data-bs-toggle="collapse" href="#productos-options" aria-expanded="false" aria-controls="productos-options">
                <i class="fas fa-th"></i>
                <span>Productos</span>
                <i class="fas fa-chevron-right ms-auto"></i>
            </a>

            <div class="collapse" id="productos-options">
                <div class="d-flex ms-3 sidebar-item align-items-center">
                    <i class="fa fa-list"></i>
                    <a href="">Listar productos</a>
                </div>
                <div class="d-flex ms-3 sidebar-item align-items-center">
                    <i class="fas fa-plus"></i>
                    <a href="">Nuevo producto</a>
                </div>
            </div>

            <!--Inicio de opciones de usuarios-->

            <a class="sidebar-item" data-bs-toggle="collapse" href="#usuarios-options" aria-expanded="false" aria-controls="usuarios-options">
                <i class="fas fa-users"></i>
                <span>Usuarios</span>
                <i class="fas fa-chevron-right ms-auto"></i>
            </a>

            <div class="collapse" id="usuarios-options">
                <div class="d-flex ms-3 sidebar-item align-items-center">
                    <i class="fas fa-list"></i>
                    <a href="">Listar usuarios</a>
                </div>
                <div class="d-flex ms-3 sidebar-item align-items-center">
                    <i class="fas fa-plus"></i>
                    <a href="">Nuevo usuario</a>
                </div>
            </div>

            <!--Inicio de opciones de pedidos-->

            <a class="sidebar-item" data-bs-toggle="collapse" href="#pedidos-options" aria-expanded="false" aria-controls="pedidos-options">
                <i class="fas fa-receipt"></i>
                <span>Pedidos</span>
                <i class="fas fa-chevron-right ms-auto"></i>
            </a>

            <div class="collapse" id="pedidos-options">
                <div class="d-flex ms-3 sidebar-item align-items-center">
                    <i class="fas fa-list"></i>
                    <a href="">Listar pedidos</a>
                </div>
            </div>

            <!--Inicio de opciones de reseñas-->

            <a class="sidebar-item" data-bs-toggle="collapse" href="#resenas-options" aria-expanded="false" aria-controls="resenas-options">
                <i class="fas fa-star"></i>
                <span>Reseñas</span>
                <i class="fas fa-chevron-right ms-auto"></i>
            </a>

            <!--Inicio de opciones de reseñas-->

            <a class="sidebar-item" data-bs-toggle="collapse" href="#consultas-options" aria-expanded="false" aria-controls="consultas-options">
                <i class="fas fa-search"></i>
                <span>Consultas</span>
                <i class="fas fa-chevron-right ms-auto"></i>
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

        <div class="row g-4">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-body">
                        <div class="chart-container">
                            <div class="gap-3 d-flex">
                                <button
                                    class="btn btn-primary"
                                    type="button"
                                    data-bs-toggle="collapse"
                                    data-bs-target="#multiCollapseExample2"
                                    aria-expanded="false"
                                    aria-controls="multiCollapseExample2">
                                    Crear usuario
                                </button>

                                <button type="button" class="btn btn-success">Generar reporte</button>
                            </div>

                            <div class="row">
                                <div class="col">
                                    <div class="collapse multi-collapse" id="multiCollapseExample2">
                                        <form>
                                            <div class="mt-3">
                                                <label for="" class="label-form">Nombre</label>
                                                <input type="text" name="" class="form-control">
                                            </div>

                                            <div class="mt-3">
                                                <label for="" class="label-form">Precio</label>
                                                <input type="number" name="" class="form-control">
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>

                        </div>
                    </div>
                </div>
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
                        <div class="chart-container">
                            <table id="example" class="table align-middle table-hover table-borderless table-striped">
                                <thead>
                                    <tr>
                                        <th>Name</th>
                                        <th>Position</th>
                                        <th>Office</th>
                                        <th>Age</th>
                                        <th>Start date</th>
                                        <th class="text-center">Accion</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <td>Tiger Nixon</td>
                                        <td>System Architect</td>
                                        <td>Edinburgh</td>
                                        <td>61</td>
                                        <td>2011-04-25</td>
                                        <td>
                                            <div class="d-flex gap-2 justify-content-center">
                                                <button type="button" class="btn btn-warning btn-sm" data-bs-toggle="tooltip" title="Editar">
                                                    <i class="fas fa-edit"></i>
                                                </button>
                                                <button type="button" class="btn btn-danger btn-sm" data-bs-toggle="tooltip" title="Eliminar">
                                                    <i class="fas fa-trash"></i>
                                                </button>
                                            </div>
                                        </td>
                                    </tr>

                                    <tr>
                                        <td>Ashton Cox</td>
                                        <td>Junior Technical Author</td>
                                        <td>San Francisco</td>
                                        <td>66</td>
                                        <td>2009-01-12</td>
                                        <td>
                                            <div class="d-flex gap-2 justify-content-center">
                                                <button type="button" class="btn btn-warning btn-sm" data-bs-toggle="tooltip" title="Editar">
                                                    <i class="fas fa-edit"></i>
                                                </button>
                                                <button type="button" class="btn btn-danger btn-sm" data-bs-toggle="tooltip" title="Eliminar">
                                                    <i class="fas fa-trash"></i>
                                                </button>
                                            </div>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>Cedric Kelly</td>
                                        <td>Senior Javascript Developer</td>
                                        <td>Edinburgh</td>
                                        <td>22</td>
                                        <td>2012-03-29</td>
                                        <td>
                                            <div class="d-flex gap-2 justify-content-center">
                                                <button type="button" class="btn btn-warning btn-sm" data-bs-toggle="tooltip" title="Editar">
                                                    <i class="fas fa-edit"></i>
                                                </button>
                                                <button type="button" class="btn btn-danger btn-sm" data-bs-toggle="tooltip" title="Eliminar">
                                                    <i class="fas fa-trash"></i>
                                                </button>
                                            </div>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>Airi Satou</td>
                                        <td>Accountant</td>
                                        <td>Tokyo</td>
                                        <td>33</td>
                                        <td>2008-11-28</td>
                                        <td>
                                            <div class="d-flex gap-2 justify-content-center">
                                                <button type="button" class="btn btn-warning btn-sm" data-bs-toggle="tooltip" title="Editar">
                                                    <i class="fas fa-edit"></i>
                                                </button>
                                                <button type="button" class="btn btn-danger btn-sm" data-bs-toggle="tooltip" title="Eliminar">
                                                    <i class="fas fa-trash"></i>
                                                </button>
                                            </div>
                                        </td>
                                    </tr>
                                </tbody>
                            </table>
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


    <script src="./js/app.js"></script>



</body>

</html>
