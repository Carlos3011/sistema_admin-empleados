<nav class="navbar navbar-expand-lg navbar-light bg-black border-bottom">
    <div class="container-fluid">
        <button id="menu-toggle" class="btn btn-primary">
            <i class="fas fa-bars"></i>
        </button>
        <h3 class="ms-3 text-white">Gestor de Turnos Laborales</h3>
    </div>
</nav>

<div id="content-wrapper" class="container-fluid py-4">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h2>Gestor de Turnos Laborales</h2>
        <button class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#addTurnoModal">
            <i class="fas fa-plus"></i> Agregar Turno
        </button>
    </div>

    <div class="card">
        <div class="card-header bg-light">
            <h5 class="card-title">Lista de Turnos Laborales</h5>
        </div>
        <div class="card-body">
            <table id="turnos-table" class="table table-striped table-bordered display nowrap" style="width:100%">
                <thead class="table-light">
                    <tr>
                        <th>ID</th>
                        <th>Nombre del Turno</th>
                        <th>Hora Inicio</th>
                        <th>Hora Fin</th>
                        <th>Acciones</th>
                    </tr>
                </thead>
                <tbody>
                    <!-- Contenido dinámico aquí -->
                </tbody>
            </table>
        </div>
    </div>

    <!-- Modal para Agregar Turno -->
    <div class="modal fade" id="addTurnoModal" tabindex="-1" aria-labelledby="addTurnoModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="addTurnoModalLabel">Agregar Turno</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form id="add-turno-form">
                    <div class="modal-body">
                        <div class="mb-3">
                            <label for="nombre_turno" class="form-label">Nombre del Turno</label>
                            <input type="text" class="form-control" id="nombre_turno" name="nombre_turno" required>
                        </div>
                        <div class="mb-3">
                            <label for="hora_inicio" class="form-label">Hora Inicio</label>
                            <input type="time" class="form-control" id="hora_inicio" name="hora_inicio" required>
                        </div>
                        <div class="mb-3">
                            <label for="hora_fin" class="form-label">Hora Fin</label>
                            <input type="time" class="form-control" id="hora_fin" name="hora_fin" required>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
                        <button type="submit" class="btn btn-primary">Guardar</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <!-- Modal para Editar Turno -->
    <div class="modal fade" id="editTurnoModal" tabindex="-1" aria-labelledby="editTurnoModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="editTurnoModalLabel">Editar Turno</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form id="edit-turno-form">
                    <div class="modal-body">
                        <input type="hidden" id="edit-turno-id" name="id_turno">
                        <div class="mb-3">
                            <label for="edit-nombre-turno" class="form-label">Nombre del Turno</label>
                            <input type="text" class="form-control" id="edit-nombre-turno" name="nombre_turno" required>
                        </div>
                        <div class="mb-3">
                            <label for="edit-hora-inicio" class="form-label">Hora Inicio</label>
                            <input type="time" class="form-control" id="edit-hora-inicio" name="hora_inicio" required>
                        </div>
                        <div class="mb-3">
                            <label for="edit-hora-fin" class="form-label">Hora Fin</label>
                            <input type="time" class="form-control" id="edit-hora-fin" name="hora_fin" required>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
                        <button type="submit" class="btn btn-primary">Guardar Cambios</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<script src="../AJAX/ajax-turnos.js"></script>
