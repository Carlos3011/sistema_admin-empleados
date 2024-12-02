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

<script>
document.addEventListener('DOMContentLoaded', () => {
    const apiUrl = '../data/dashboard_data.php';

    const cargarDashboard = async () => {
        try {
            const response = await fetch(`${apiUrl}?action=dashboard`);
            const data = await response.json();

            if (data.error) {
                console.error('Error del backend:', data.error);
                return;
            }

            document.getElementById('total-empleados').innerText = data.totalEmpleados;
            document.getElementById('turnos-programados').innerText = data.turnosProgramados;
            document.getElementById('asistencias-totales').innerText = data.asistenciasTotales;
            document.getElementById('permisos-pendientes').innerText = data.permisosPendientes;

            renderActivityChart(data.actividadesPorDia);
            renderTurnosChart(data.turnosPorTipo);
            renderPermisosChart(data.permisosPorTipo);
        } catch (error) {
            console.error('Error en la solicitud:', error);
        }
    };

    function renderActivityChart(data) {
        const ctx = document.getElementById('activityChart').getContext('2d');
        new Chart(ctx, {
            type: 'line',
            data: {
                labels: ['Lunes', 'Martes', 'Miércoles', 'Jueves', 'Viernes', 'Sábado', 'Domingo'],
                datasets: [{
                    label: 'Asistencias',
                    data: data,
                    borderColor: 'rgba(75, 192, 192, 1)',
                    backgroundColor: 'rgba(75, 192, 192, 0.2)',
                    borderWidth: 2
                }]
            }
        });
    }

    function renderTurnosChart(data) {
        const ctx = document.getElementById('turnosChart').getContext('2d');
        new Chart(ctx, {
            type: 'doughnut',
            data: {
                labels: Object.keys(data),
                datasets: [{
                    data: Object.values(data),
                    backgroundColor: ['#4CAF50', '#FF9800', '#3F51B5', '#FFC107', '#E91E63']
                }]
            }
        });
    }

    function renderPermisosChart(data) {
        const ctx = document.getElementById('permisosChart').getContext('2d');
        new Chart(ctx, {
            type: 'bar',
            data: {
                labels: Object.keys(data),
                datasets: [{
                    label: 'Permisos',
                    data: Object.values(data),
                    backgroundColor: ['#FF5722', '#2196F3', '#FFC107', '#8BC34A', '#9C27B0']
                }]
            }
        });
    }

    cargarDashboard();
});

</script>
