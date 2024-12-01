<nav class="navbar navbar-expand-lg navbar-light bg-dark border-bottom">
    <div class="container-fluid">
        <button id="menu-toggle" class="btn btn-primary">
            <i class="fas fa-bars"></i>
        </button>
        <h3 class="ms-3 text-white">Control de Asistencias</h3>
    </div>
</nav>

<div id="content-wrapper" class="container-fluid py-4">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h2>Registro de Asistencias</h2>
        <div>
            <button class="btn btn-success" id="exportar-btn">
                <i class="fas fa-file-export"></i> Exportar Asistencias
            </button>
        </div>
    </div>

    <!-- Filtro de Fecha -->
    <div class="card-body mb-5">
        <div class="row g-3">
            <div class="col-md-4">
                <label for="filtro-fecha" class="form-label">Fecha</label>
                <input type="date" id="filtro-fecha" class="form-control">
            </div>
            <div class="col-md-4 d-flex align-items-end">
                <button class="btn btn-primary" id="filtrar-btn">
                    <i class="fas fa-search"></i> Filtrar
                </button>
            </div>
            <div class="col-md-4 d-flex align-items-end">
                <button class="btn btn-secondary" id="limpiar-btn">
                    <i class="fas fa-times"></i> Limpiar Filtro
                </button>
            </div>
        </div>
    </div>

    <!-- Tabla de Asistencias -->
    <div class="card">
        <div class="card-header bg-light">
            <h5 class="card-title">Lista de Asistencias</h5>
        </div>
        <div class="card-body">
            <table id="asistencia-table" class="table table-striped table-bordered display nowrap" style="width:100%">
                <thead class="table-light">
                    <tr>
                        <th>ID</th>
                        <th>Empleado</th>
                        <th>Correo</th>
                        <th>Turno</th>
                        <th>Evento</th>
                        <th>Fecha y Hora</th>
                    </tr>
                </thead>
                <tbody>
                    <!-- Contenido dinámico cargado desde el JS -->
                </tbody>
            </table>
        </div>
    </div>
</div>

<script>
document.addEventListener('DOMContentLoaded', () => {
    const apiUrl = '../data/asistencia_data.php';
    let dataTable;

    // Cargar asistencias
    const cargarAsistencias = async (filters = {}) => {
        try {
            let query = `${apiUrl}?action=listar`;
            if (Object.keys(filters).length > 0) {
                query += `&${new URLSearchParams(filters).toString()}`;
            }

            const response = await fetch(query);
            if (!response.ok) {
                throw new Error('Error al cargar datos del servidor.');
            }

            const data = await response.json();

            if (dataTable) {
                dataTable.clear();
                dataTable.rows.add(data.asistencias || []);
                dataTable.draw();
            } else {
                dataTable = $('#asistencia-table').DataTable({
                    responsive: true,
                    language: {
                        url: '//cdn.datatables.net/plug-ins/1.13.4/i18n/es-ES.json',
                    },
                    data: data.asistencias || [],
                    columns: [
                        { data: 'id_registro' },
                        { 
                            data: null, 
                            render: (data) => `${data.nombre_empleado} ${data.apellido_empleado}` 
                        },
                        { data: 'correo' },
                        { data: 'nombre_turno' },
                        { data: 'tipo_evento' },
                        { data: 'fecha_hora' },
                    ],
                });
            }
        } catch (error) {
            console.error('Error al cargar asistencias:', error);
            alert('Ocurrió un error al cargar las asistencias. Por favor, intenta de nuevo.');
        }
    };

    // Exportar asistencias
    const exportarAsistencias = (filters = {}) => {
        let query = `${apiUrl}?action=exportar`;
        if (Object.keys(filters).length > 0) {
            query += `&${new URLSearchParams(filters).toString()}`;
        }
        window.location.href = query;
    };

    // Inicializar carga de asistencias
    cargarAsistencias();

    // Filtrar asistencias
    document.getElementById('filtrar-btn').addEventListener('click', () => {
        const fecha = document.getElementById('filtro-fecha').value;
        if (fecha) {
            cargarAsistencias({ fecha });
        } else {
            alert('Por favor, selecciona una fecha para filtrar.');
        }
    });

    // Limpiar filtro
    document.getElementById('limpiar-btn').addEventListener('click', () => {
        document.getElementById('filtro-fecha').value = ''; // Limpiar campo de fecha
        cargarAsistencias(); // Cargar todos los datos sin filtro
    });

    // Exportar a Excel
    document.getElementById('exportar-btn').addEventListener('click', () => {
        const fecha = document.getElementById('filtro-fecha').value;
        const filters = fecha ? { fecha } : {};
        exportarAsistencias(filters);
    });
});


</script>
