<nav class="navbar navbar-expand-lg navbar-light bg-black border-bottom">
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

<script src="../AJAX/ajax-asistencia.js"></script>
