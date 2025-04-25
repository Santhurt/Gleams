<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard de Ventas</title>
    <link rel="stylesheet" href="css/style.css">
</head>
<body>
    <div class="container">
        <div class="header">
            <h1>Panel de Ventas</h1>
            <div class="user-info">
                <div class="user-avatar">A</div>
                <span>Admin</span>
            </div>
        </div>
        
        <div class="stats-container">
            <div class="stat-card primary">
                <h3>Ventas Mensuales</h3>
                <div class="stat-value">$45,780</div>
            </div>
            
            <div class="stat-card success">
                <h3>Usuarios Activos</h3>
                <div class="stat-value">1,250</div>
            </div>
            
            <div class="stat-card info">
                <h3>Pedidos Pendientes</h3>
                <div class="stat-value">27</div>
            </div>
            
            <div class="stat-card warning">
                <h3>Ingresos Totales</h3>
                <div class="stat-value">$215,750.50</div>
            </div>
        </div>
        
        <div class="charts-container">
            <div class="chart-card">
                <h3>Ventas Mensuales</h3>
                <div class="chart-placeholder">
                    <div class="chart-line"></div>
                    <div class="chart-points chart-point-1"></div>
                    <div class="chart-points chart-point-2"></div>
                    <div class="chart-points chart-point-3"></div>
                    <div class="chart-points chart-point-4"></div>
                    <div class="chart-points chart-point-5"></div>
                    <div class="chart-points chart-point-6"></div>
                    <div class="chart-points chart-point-7"></div>
                    <div class="chart-points chart-point-8"></div>
                    <div class="chart-points chart-point-9"></div>
                    <div class="chart-points chart-point-10"></div>
                    <div class="chart-points chart-point-11"></div>
                    <div class="chart-points chart-point-12"></div>
                    <div class="chart-labels">
                        <span class="chart-label">Ene</span>
                        <span class="chart-label">Feb</span>
                        <span class="chart-label">Mar</span>
                        <span class="chart-label">Abr</span>
                        <span class="chart-label">May</span>
                        <span class="chart-label">Jun</span>
                        <span class="chart-label">Jul</span>
                        <span class="chart-label">Ago</span>
                        <span class="chart-label">Sep</span>
                        <span class="chart-label">Oct</span>
                        <span class="chart-label">Nov</span>
                        <span class="chart-label">Dic</span>
                    </div>
                </div>
            </div>
            
            <div class="chart-card">
                <h3>Usuarios Registrados</h3>
                <table class="users-table">
                    <thead>
                        <tr>
                            <th>Nombre</th>
                            <th>Correo</th>
                            <th>Teléfono</th>
                            <th>Dirección</th>
                            <th>Acciones</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td>Ana López</td>
                            <td>ana.lopez@email.com</td>
                            <td>+34 612 345 678</td>
                            <td>Calle Principal 123, Madrid</td>
                            <td>
                                <div class="action-buttons">
                                    <button class="btn btn-edit"><i class="fa fa-edit"></i> Editar</button>
                                    <button class="btn btn-delete"><i class="fa fa-trash"></i> Eliminar</button>
                                </div>
                            </td>
                        </tr>
                        <tr>
                            <td>Carlos Ruiz</td>
                            <td>carlos.ruiz@email.com</td>
                            <td>+34 623 456 789</td>
                            <td>Av. Secundaria 456, Barcelona</td>
                            <td>
                                <div class="action-buttons">
                                    <button class="btn btn-edit"><i class="fa fa-edit"></i> Editar</button>
                                    <button class="btn btn-delete"><i class="fa fa-trash"></i> Eliminar</button>
                                </div>
                            </td>
                        </tr>
                        <tr>
                            <td>María Gómez</td>
                            <td>maria.gomez@email.com</td>
                            <td>+34 634 567 890</td>
                            <td>Plaza Mayor 789, Valencia</td>
                            <td>
                                <div class="action-buttons">
                                    <button class="btn btn-edit"><i class="fa fa-edit"></i> Editar</button>
                                    <button class="btn btn-delete"><i class="fa fa-trash"></i> Eliminar</button>
                                </div>
                            </td>
                        </tr>
                        <tr>
                            <td>Juan Pérez</td>
                            <td>juan.perez@email.com</td>
                            <td>+34 645 678 901</td>
                            <td>Calle Nueva 012, Sevilla</td>
                            <td>
                                <div class="action-buttons">
                                    <button class="btn btn-edit"><i class="fa fa-edit"></i> Editar</button>
                                    <button class="btn btn-delete"><i class="fa fa-trash"></i> Eliminar</button>
                                </div>
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</body>
</html>