<nav class="navbar navbar-expand-lg navbar-light bg-black border-bottom">
    <div class="container-fluid">
        <button id="menu-toggle" class="btn btn-primary">
            <i class="fas fa-bars"></i>
        </button>
        <h3 class="ms-3 text-white">Dashboard</h3>
    </div>
</nav>

<div id="content-wrapper" class="container-fluid py-4">
    <div class="row g-4">
        <!-- Total Empleados -->
        <div class="col-md-3">
            <a href="/sistema-asistencia/public/index.php?page=gestor" class="text-decoration-none">
                <div class="card stat-card text-white bg-primary">
                    <div class="card-body">
                        <div class="d-flex justify-content-between">
                            <h5 class="card-title">Empleados</h5>
                            <i class="fas fa-users fa-2x"></i>
                        </div>
                        <p class="card-text mt-3"><span id="total-empleados">0</span> registrados</p>
                    </div>
                </div>
            </a>
        </div>

        <!-- Turnos Programados -->
        <div class="col-md-3">
            <a href="/sistema-asistencia/public/index.php?page=turnos-laborales" class="text-decoration-none">
                <div class="card stat-card text-white bg-success">
                    <div class="card-body">
                        <div class="d-flex justify-content-between">
                            <h5 class="card-title">Turnos</h5>
                            <i class="fas fa-calendar-alt fa-2x"></i>
                        </div>
                        <p class="card-text mt-3"><span id="turnos-programados">0</span> programados</p>
                    </div>
                </div>
            </a>
        </div>

        <!-- Registros de Asistencia -->
        <div class="col-md-3">
            <a href="/sistema-asistencia/public/index.php?page=asistencia" class="text-decoration-none">
                <div class="card stat-card text-white bg-warning">
                    <div class="card-body">
                        <div class="d-flex justify-content-between">
                            <h5 class="card-title">Asistencias</h5>
                            <i class="fas fa-check-circle fa-2x"></i>
                        </div>
                        <p class="card-text mt-3"><span id="asistencias-totales">0</span> registradas</p>
                    </div>
                </div>
            </a>
        </div>

        <!-- Permisos Activos -->
        <div class="col-md-3">
            <a href="/sistema-asistencia/public/index.php?page=permisos" class="text-decoration-none">
                <div class="card stat-card text-white bg-danger">
                    <div class="card-body">
                        <div class="d-flex justify-content-between">
                            <h5 class="card-title">Permisos</h5>
                            <i class="fas fa-file-alt fa-2x"></i>
                        </div>
                        <p class="card-text mt-3"><span id="permisos-pendientes">0</span> pendientes</p>
                    </div>
                </div>
            </a>
        </div>
    </div>

    <!-- Detalles de Actividades -->
    <div class="row mt-4">
        <div class="col-lg-12">
            <div class="card">
                <div class="card-header bg-light">
                    <h5 class="card-title">Resumen de Actividades</h5>
                </div>
                <div class="card-body">
                    <canvas id="activityChart" height="100"></canvas>
                </div>
            </div>
        </div>
    </div>

    <!-- Gráficas Adicionales -->
    <div class="row mt-4">
        <div class="col-lg-6">
            <div class="card">
                <div class="card-header bg-light">
                    <h5 class="card-title">Distribución de Turnos</h5>
                </div>
                <div class="card-body">
                    <canvas id="turnosChart" height="100"></canvas>
                </div>
            </div>
        </div>
        <div class="col-lg-6">
            <div class="card">
                <div class="card-header bg-light">
                    <h5 class="card-title">Permisos por Tipo</h5>
                </div>
                <div class="card-body">
                    <canvas id="permisosChart" height="100"></canvas>
                </div>
            </div>
        </div>
    </div>
</div>

<script src="../AJAX/ajax-dashboard.js"></script>
