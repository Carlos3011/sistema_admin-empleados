<nav class="navbar navbar-expand-lg navbar-light bg-black border-bottom">
    <div class="container-fluid">
        <button id="menu-toggle" class="btn btn-primary">
            <i class="fas fa-bars"></i>
        </button>
        <h3 class="ms-3 text-white">Gestor de Empleados</h3>
    </div>
</nav>

<div id="content-wrapper" class="container-fluid py-4">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h2>Gestor de Empleados</h2>
        <button class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#addEmployeeModal">
            <i class="fas fa-plus"></i> Agregar Empleado
        </button>
    </div>

    <div class="card">
        <div class="card-header bg-light">
            <h5 class="card-title">Lista de Empleados</h5>
        </div>
        <div class="card-body">
            <table id="employee-table" class="table table-striped table-bordered display nowrap" style="width:100%">
                <thead class="table-light">
                    <tr>
                        <th>ID</th>
                        <th>Nombre</th>
                        <th>Correo</th>
                        <th>Rol</th>
                        <th>Turno</th>
                        <th>Estado</th>
                        <th>Acciones</th>
                    </tr>
                </thead>
                <tbody>
                    <!-- Contenido dinámico cargado desde el JS -->
                </tbody>
            </table>
        </div>
    </div>
</div>

<!-- Modal para Agregar Empleado -->
<div class="modal fade" id="addEmployeeModal" tabindex="-1" aria-labelledby="addEmployeeModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="addEmployeeModalLabel">Agregar Empleado</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form id="add-employee-form">
                <div class="modal-body">
                    <div class="mb-3">
                        <label for="add-employee-name" class="form-label">Nombre</label>
                        <input type="text" class="form-control" id="add-employee-name" name="nombre" required>
                    </div>
                    <div class="mb-3">
                        <label for="add-employee-lastname" class="form-label">Apellidos</label>
                        <input type="text" class="form-control" id="add-employee-lastname" name="apellido" required>
                    </div>
                    <div class="mb-3">
                        <label for="add-employee-email" class="form-label">Correo</label>
                        <input type="email" class="form-control" id="add-employee-email" name="correo" required>
                    </div>
                    <div class="mb-3">
                        <label for="add-employee-role" class="form-label">Rol</label>
                        <select class="form-control" id="add-employee-role" name="id_rol" required>
                            <option value="1">Administrador</option>
                            <option value="2">Empleado</option>
                        </select>
                    </div>
                    <div class="mb-3">
                        <label for="add-employee-turn" class="form-label">Turno</label>
                        <select class="form-control" id="add-employee-turn" name="id_turno" required>
                            <!-- Opciones cargadas dinámicamente -->
                        </select>
                    </div>
                    <div class="mb-3">
                        <label for="add-employee-status" class="form-label">Estado</label>
                        <select class="form-control" id="add-employee-status" name="activo" required>
                            <option value="1">Activo</option>
                            <option value="0">Inactivo</option>
                        </select>
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

<!-- Modal para Editar Empleado -->
<div class="modal fade" id="editEmployeeModal" tabindex="-1" aria-labelledby="editEmployeeModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="editEmployeeModalLabel">Editar Empleado</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form id="edit-employee-form">
                <div class="modal-body">
                    <input type="hidden" id="edit-employee-id" name="id_empleado">
                    <div class="mb-3">
                        <label for="edit-employee-name" class="form-label">Nombre</label>
                        <input type="text" class="form-control" id="edit-employee-name" name="nombre" required>
                    </div>
                    <div class="mb-3">
                        <label for="edit-employee-lastname" class="form-label">Apellidos</label>
                        <input type="text" class="form-control" id="edit-employee-lastname" name="apellido" required>
                    </div>
                    <div class="mb-3">
                        <label for="edit-employee-email" class="form-label">Correo</label>
                        <input type="email" class="form-control" id="edit-employee-email" name="correo" required>
                    </div>
                    <div class="mb-3">
                        <label for="edit-employee-role" class="form-label">Rol</label>
                        <select class="form-control" id="edit-employee-role" name="id_rol" required>
                            <option value="1">Administrador</option>
                            <option value="2">Empleado</option>
                        </select>
                    </div>
                    <div class="mb-3">
                        <label for="edit-employee-turn" class="form-label">Turno</label>
                        <select class="form-control" id="edit-employee-turn" name="id_turno" required>
                            <!-- Opciones cargadas dinámicamente -->
                        </select>
                    </div>
                    <div class="mb-3">
                        <label for="edit-employee-status" class="form-label">Estado</label>
                        <select class="form-control" id="edit-employee-status" name="activo" required>
                            <option value="1">Activo</option>
                            <option value="0">Inactivo</option>
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

<script src="../AJAX/ajax-empleados.js"></script>