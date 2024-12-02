<nav class="navbar navbar-expand-lg navbar-light bg-black border-bottom">
    <div class="container-fluid">
        <button id="menu-toggle" class="btn btn-primary">
            <i class="fas fa-bars"></i>
        </button>
        <h3 class="ms-3 text-white">Gestor de Permisos</h3>
    </div>
</nav>

<div id="content-wrapper" class="container-fluid py-4">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h2>Gestor de Permisos</h2>
        <button class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#addPermisoModal">
            <i class="fas fa-plus"></i> Agregar Permiso
        </button>
    </div>

    <div class="card">
        <div class="card-header bg-light">
            <h5 class="card-title">Lista de Permisos</h5>
        </div>
        <div class="card-body">
            <table id="permisos-table" class="table table-striped table-bordered display nowrap" style="width:100%">
                <thead class="table-light">
                    <tr>
                        <th>ID</th>
                        <th>Empleado</th>
                        <th>Tipo de Permiso</th>
                        <th>Fecha Inicio</th>
                        <th>Fecha Fin</th>
                        <th>Estado</th>
                        <th>Acciones</th>
                    </tr>
                </thead>
                <tbody>
                    <!-- Contenido dinámico aquí -->
                </tbody>
            </table>
        </div>
    </div>

    <!-- Modal para Agregar Permiso -->
    <div class="modal fade" id="addPermisoModal" tabindex="-1" aria-labelledby="addPermisoModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="addPermisoModalLabel">Agregar Permiso</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form id="add-permiso-form">
                    <div class="modal-body">
                        <div class="mb-3">
                            <label for="empleado" class="form-label">Empleado</label>
                            <select class="form-control" id="empleado" name="id_empleado" required>
                                <!-- Opciones dinámicas -->
                            </select>
                        </div>
                        <div class="mb-3">
                            <label for="tipo_permiso" class="form-label">Tipo de Permiso</label>
                            <input type="text" class="form-control" id="tipo_permiso" name="tipo_permiso" required>
                        </div>
                        <div class="mb-3">
                            <label for="fecha_inicio" class="form-label">Fecha Inicio</label>
                            <input type="datetime-local" class="form-control" id="fecha_inicio" name="fecha_inicio" required>
                        </div>
                        <div class="mb-3">
                            <label for="fecha_fin" class="form-label">Fecha Fin</label>
                            <input type="datetime-local" class="form-control" id="fecha_fin" name="fecha_fin" required>
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

    <!-- Modal para Editar Permiso -->
    <div class="modal fade" id="editPermisoModal" tabindex="-1" aria-labelledby="editPermisoModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="editPermisoModalLabel">Editar Permiso</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form id="edit-permiso-form">
                    <div class="modal-body">
                        <input type="hidden" id="edit-id-permiso" name="id_permiso">
                        <div class="mb-3">
                            <label for="edit-tipo-permiso" class="form-label">Tipo de Permiso</label>
                            <input type="text" class="form-control" id="edit-tipo-permiso" name="tipo_permiso" required>
                        </div>
                        <div class="mb-3">
                            <label for="edit-fecha-inicio" class="form-label">Fecha Inicio</label>
                            <input type="datetime-local" class="form-control" id="edit-fecha-inicio" name="fecha_inicio" required>
                        </div>
                        <div class="mb-3">
                            <label for="edit-fecha-fin" class="form-label">Fecha Fin</label>
                            <input type="datetime-local" class="form-control" id="edit-fecha-fin" name="fecha_fin" required>
                        </div>
                        <div class="mb-3">
                            <label for="edit-estado" class="form-label">Estado</label>
                            <select class="form-control" id="edit-estado" name="estado" required>
                                <option value="pendiente">Pendiente</option>
                                <option value="aprobado">Aprobado</option>
                                <option value="rechazado">Rechazado</option>
                            </select>
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

<script src="../ajax/ajax-permisos.js"></script>
