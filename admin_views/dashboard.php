<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard Administrativo</title>
    <!-- Bootstrap CSS -->
    <link href="css/bootstrap.min.css" rel="stylesheet">
    <link href="css/style.css" rel="stylesheet">

    <!-- Bootstrap Icons -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-icons/1.11.1/font/bootstrap-icons.min.css" rel="stylesheet">
    <style>
    </style>
</head>
<body>
    <div class="container-fluid">
        <div class="row">
            <!-- Sidebar -->
            <div class="col-lg-2 sidebar p-0">
                <div class="d-flex flex-column flex-shrink-0 p-3 text-white">
                    <a href="/" class="d-flex align-items-center mb-3 mb-md-0 me-md-auto text-white text-decoration-none">
                        <span class="fs-4">Admin Panel</span>
                    </a>
                    <hr>
                    <ul class="nav nav-pills flex-column mb-auto">
                        <li class="nav-item">
                            <a href="#" class="nav-link active" aria-current="page">
                                <i class="bi bi-speedometer2"></i>
                                Dashboard
                            </a>
                        </li>
                        <li>
                            <a href="#" class="nav-link">
                                <i class="bi bi-people"></i>
                                Usuarios
                            </a>
                        </li>
                        <li>
                            <a href="#" class="nav-link">
                                <i class="bi bi-box-seam"></i>
                                Productos
                            </a>
                        </li>
                        <li>
                            <a href="#" class="nav-link">
                                <i class="bi bi-cart3"></i>
                                Órdenes
                            </a>
                        </li>
                        <li>
                            <a href="#" class="nav-link">
                                <i class="bi bi-gear"></i>
                                Configuración
                            </a>
                        </li>
                    </ul>
                    <hr>
                    <div class="dropdown">
                        <a href="#" class="d-flex align-items-center text-white text-decoration-none dropdown-toggle" id="dropdownUser1" data-bs-toggle="dropdown" aria-expanded="false">
                            <img src="/api/placeholder/32/32" alt="Admin" width="32" height="32" class="rounded-circle me-2">
                            <strong>Admin</strong>
                        </a>
                        <ul class="dropdown-menu dropdown-menu-dark text-small shadow" aria-labelledby="dropdownUser1">
                            <li><a class="dropdown-item" href="#">Perfil</a></li>
                            <li><a class="dropdown-item" href="#">Configuración</a></li>
                            <li><hr class="dropdown-divider"></li>
                            <li><a class="dropdown-item" href="#">Cerrar sesión</a></li>
                        </ul>
                    </div>
                </div>
            </div>
            
            <!-- Main Content -->
            <div class="col-lg-10 main-content">
                <div class="p-4">
                    <!-- Header -->
                    <div class="d-flex justify-content-between align-items-center mb-4">
                        <h2 class="h3">Dashboard</h2>
                        <div class="d-flex align-items-center">
                            <div class="input-group me-3" style="width: 300px;">
                                <span class="input-group-text bg-white border-end-0">
                                    <i class="bi bi-search"></i>
                                </span>
                                <input type="text" class="form-control border-start-0" placeholder="Buscar...">
                            </div>
                            <div class="dropdown">
                                <button class="btn btn-sm btn-outline-secondary dropdown-toggle" type="button" id="notificationsDropdown" data-bs-toggle="dropdown" aria-expanded="false">
                                    <i class="bi bi-bell"></i>
                                </button>
                                <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="notificationsDropdown">
                                    <li><a class="dropdown-item" href="#">Notificación 1</a></li>
                                    <li><a class="dropdown-item" href="#">Notificación 2</a></li>
                                    <li><a class="dropdown-item" href="#">Notificación 3</a></li>
                                </ul>
                            </div>
                        </div>
                    </div>
                    
                    <!-- Stats Cards -->
                    <div class="row mb-4">
                        <!-- Users Card -->
                        <div class="col-md-6 col-xl-3 mb-4">
                            <div class="card shadow-sm card-dashboard card-users">
                                <div class="card-body">
                                    <div class="d-flex justify-content-between align-items-center mb-3">
                                        <div class="card-icon icon-users">
                                            <i class="bi bi-people-fill fs-4"></i>
                                        </div>
                                        <div class="text-end">
                                            <h5 class="mb-0">1,250</h5>
                                            <p class="text-muted mb-0 small">Usuarios</p>
                                        </div>
                                    </div>
                                    <div class="d-flex align-items-center mt-3">
                                        <span class="text-success me-2">
                                            <i class="bi bi-arrow-up"></i> 8%
                                        </span>
                                        <span class="text-muted small">Desde el último mes</span>
                                    </div>
                                </div>
                            </div>
                        </div>
                        
                        <!-- Products Card -->
                        <div class="col-md-6 col-xl-3 mb-4">
                            <div class="card shadow-sm card-dashboard card-products">
                                <div class="card-body">
                                    <div class="d-flex justify-content-between align-items-center mb-3">
                                        <div class="card-icon icon-products">
                                            <i class="bi bi-box-seam-fill fs-4"></i>
                                        </div>
                                        <div class="text-end">
                                            <h5 class="mb-0">384</h5>
                                            <p class="text-muted mb-0 small">Productos</p>
                                        </div>
                                    </div>
                                    <div class="d-flex align-items-center mt-3">
                                        <span class="text-success me-2">
                                            <i class="bi bi-plus"></i> 12
                                        </span>
                                        <span class="text-muted small">Nuevos productos</span>
                                    </div>
                                </div>
                            </div>
                        </div>
                        
                        <!-- Orders Card -->
                        <div class="col-md-6 col-xl-3 mb-4">
                            <div class="card shadow-sm card-dashboard card-orders">
                                <div class="card-body">
                                    <div class="d-flex justify-content-between align-items-center mb-3">
                                        <div class="card-icon icon-orders">
                                            <i class="bi bi-cart-fill fs-4"></i>
                                        </div>
                                        <div class="text-end">
                                            <h5 class="mb-0">1,823</h5>
                                            <p class="text-muted mb-0 small">Órdenes</p>
                                        </div>
                                    </div>
                                    <div class="d-flex align-items-center mt-3">
                                        <span class="text-success me-2">
                                            <i class="bi bi-arrow-up"></i> 15%
                                        </span>
                                        <span class="text-muted small">Desde el último mes</span>
                                    </div>
                                </div>
                            </div>
                        </div>
                        
                        <!-- Revenue Card -->
                        <div class="col-md-6 col-xl-3 mb-4">
                            <div class="card shadow-sm card-dashboard card-revenue">
                                <div class="card-body">
                                    <div class="d-flex justify-content-between align-items-center mb-3">
                                        <div class="card-icon icon-revenue">
                                            <i class="bi bi-currency-dollar fs-4"></i>
                                        </div>
                                        <div class="text-end">
                                            <h5 class="mb-0">$42,580</h5>
                                            <p class="text-muted mb-0 small">Ingresos</p>
                                        </div>
                                    </div>
                                    <div class="d-flex align-items-center mt-3">
                                        <span class="text-success me-2">
                                            <i class="bi bi-arrow-up"></i> 5%
                                        </span>
                                        <span class="text-muted small">Desde el último mes</span>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    
                    <!-- Recent Users -->
                    <div class="card shadow-sm mb-4">
                        <div class="card-header bg-white d-flex justify-content-between align-items-center">
                            <h5 class="card-title mb-0">Usuarios Recientes</h5>
                            <button class="btn btn-sm btn-primary">Ver Todos</button>
                        </div>
                        <div class="card-body p-0">
                            <div class="table-responsive">
                                <table class="table table-hover align-middle mb-0">
                                    <thead class="table-light">
                                        <tr>
                                            <th>Usuario</th>
                                            <th>Email</th>
                                            <th>Fecha de registro</th>
                                            <th>Estado</th>
                                            <th>Acciones</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr>
                                            <td>
                                                <div class="d-flex align-items-center">
                                                    <img src="/api/placeholder/40/40" class="rounded-circle me-2" width="40" height="40" alt="Avatar">
                                                    <div>Juan Pérez</div>
                                                </div>
                                            </td>
                                            <td>juan@ejemplo.com</td>
                                            <td>10/04/2025</td>
                                            <td><span class="badge bg-success status-badge">Activo</span></td>
                                            <td>
                                                <button class="btn btn-sm btn-outline-primary me-1">Editar</button>
                                                <button class="btn btn-sm btn-outline-secondary">Ver</button>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>
                                                <div class="d-flex align-items-center">
                                                    <img src="/api/placeholder/40/40" class="rounded-circle me-2" width="40" height="40" alt="Avatar">
                                                    <div>María López</div>
                                                </div>
                                            </td>
                                            <td>maria@ejemplo.com</td>
                                            <td>08/04/2025</td>
                                            <td><span class="badge bg-success status-badge">Activo</span></td>
                                            <td>
                                                <button class="btn btn-sm btn-outline-primary me-1">Editar</button>
                                                <button class="btn btn-sm btn-outline-secondary">Ver</button>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>
                                                <div class="d-flex align-items-center">
                                                    <img src="/api/placeholder/40/40" class="rounded-circle me-2" width="40" height="40" alt="Avatar">
                                                    <div>Carlos Ruiz</div>
                                                </div>
                                            </td>
                                            <td>carlos@ejemplo.com</td>
                                            <td>05/04/2025</td>
                                            <td><span class="badge bg-danger status-badge">Inactivo</span></td>
                                            <td>
                                                <button class="btn btn-sm btn-outline-primary me-1">Editar</button>
                                                <button class="btn btn-sm btn-outline-secondary">Ver</button>
                                            </td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                    
                    <!-- Recent Products and Orders -->
                    <div class="row">
                        <!-- Products Section -->
                        <div class="col-lg-6 mb-4">
                            <div class="card shadow-sm h-100">
                                <div class="card-header bg-white d-flex justify-content-between align-items-center">
                                    <h5 class="card-title mb-0">Productos Recientes</h5>
                                    <button class="btn btn-sm btn-primary">Ver Todos</button>
                                </div>
                                <div class="card-body p-0">
                                    <div class="table-responsive">
                                        <table class="table table-hover align-middle mb-0">
                                            <thead class="table-light">
                                                <tr>
                                                    <th>Producto</th>
                                                    <th>Precio</th>
                                                    <th>Stock</th>
                                                    <th>Estado</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <tr>
                                                    <td>
                                                        <div class="d-flex align-items-center">
                                                            <img src="/api/placeholder/40/40" class="rounded me-2" width="40" height="40" alt="Product">
                                                            <div>Smartphone XYZ</div>
                                                        </div>
                                                    </td>
                                                    <td>$599.99</td>
                                                    <td>45</td>
                                                    <td><span class="badge bg-success status-badge">En Stock</span></td>
                                                </tr>
                                                <tr>
                                                    <td>
                                                        <div class="d-flex align-items-center">
                                                            <img src="/api/placeholder/40/40" class="rounded me-2" width="40" height="40" alt="Product">
                                                            <div>Laptop Pro</div>
                                                        </div>
                                                    </td>
                                                    <td>$1,299.99</td>
                                                    <td>12</td>
                                                    <td><span class="badge bg-warning text-dark status-badge">Stock Bajo</span></td>
                                                </tr>
                                                <tr>
                                                    <td>
                                                        <div class="d-flex align-items-center">
                                                            <img src="/api/placeholder/40/40" class="rounded me-2" width="40" height="40" alt="Product">
                                                            <div>Audífonos Inalámbricos</div>
                                                        </div>
                                                    </td>
                                                    <td>$149.99</td>
                                                    <td>78</td>
                                                    <td><span class="badge bg-success status-badge">En Stock</span></td>
                                                </tr>
                                                <tr>
                                                    <td>
                                                        <div class="d-flex align-items-center">
                                                            <img src="/api/placeholder/40/40" class="rounded me-2" width="40" height="40" alt="Product">
                                                            <div>Monitor 4K</div>
                                                        </div>
                                                    </td>
                                                    <td>$349.99</td>
                                                    <td>0</td>
                                                    <td><span class="badge bg-danger status-badge">Sin Stock</span></td>
                                                </tr>
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>
                        </div>
                        
                        <!-- Orders Section -->
                        <div class="col-lg-6 mb-4">
                            <div class="card shadow-sm h-100">
                                <div class="card-header bg-white d-flex justify-content-between align-items-center">
                                    <h5 class="card-title mb-0">Órdenes Recientes</h5>
                                    <button class="btn btn-sm btn-primary">Ver Todas</button>
                                </div>
                                <div class="card-body p-0">
                                    <div class="table-responsive">
                                        <table class="table table-hover align-middle mb-0">
                                            <thead class="table-light">
                                                <tr>
                                                    <th>Orden #</th>
                                                    <th>Cliente</th>
                                                    <th>Fecha</th>
                                                    <th>Total</th>
                                                    <th>Estado</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <tr>
                                                    <td>#ORD-7829</td>
                                                    <td>Ana Torres</td>
                                                    <td>02/05/2025</td>
                                                    <td>$826.50</td>
                                                    <td><span class="badge bg-primary status-badge">Completada</span></td>
                                                </tr>
                                                <tr>
                                                    <td>#ORD-7828</td>
                                                    <td>Roberto Gómez</td>
                                                    <td>01/05/2025</td>
                                                    <td>$1,245.00</td>
                                                    <td><span class="badge bg-warning text-dark status-badge">Pendiente</span></td>
                                                </tr>
                                                <tr>
                                                    <td>#ORD-7827</td>
                                                    <td>Laura Sánchez</td>
                                                    <td>30/04/2025</td>
                                                    <td>$498.75</td>
                                                    <td><span class="badge bg-primary status-badge">Completada</span></td>
                                                </tr>
                                                <tr>
                                                    <td>#ORD-7826</td>
                                                    <td>Miguel Hernández</td>
                                                    <td>28/04/2025</td>
                                                    <td>$712.30</td>
                                                    <td><span class="badge bg-danger status-badge">Cancelada</span></td>
                                                </tr>
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Bootstrap JS Bundle with Popper -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.3.2/js/bootstrap.bundle.min.js"></script>
</body>
</html>
