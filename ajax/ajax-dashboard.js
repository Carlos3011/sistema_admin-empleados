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