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

<script>
document.addEventListener('DOMContentLoaded', async () => {
    const apiUrl = '../data/empleados_data.php';
    let dataTable;

    // Función para cargar empleados
    const cargarEmpleados = async () => {
        try {
            const response = await fetch(`${apiUrl}?action=listar`);
            const data = await response.json();

            if (!dataTable) {
                dataTable = $('#employee-table').DataTable({
                    responsive: true,
                    language: {
                        url: '//cdn.datatables.net/plug-ins/1.13.4/i18n/es-ES.json'
                    },
                    data: data.empleados,
                    columns: [
                        { data: 'id_empleado' },
                        { data: null, render: (data) => `${data.nombre} ${data.apellido}` },
                        { data: 'correo' },
                        { data: 'rol' },
                        { data: 'nombre_turno', defaultContent: 'No asignado' },
                        { data: 'activo', render: (data) => (data === 1 ? 'Activo' : 'Inactivo') },
                        {
                            data: null,
                            render: (data) => `
                                <button class="btn btn-sm btn-warning edit-btn" data-id="${data.id_empleado}">Editar</button>
                                <button class="btn btn-sm btn-danger delete-btn" data-id="${data.id_empleado}">Eliminar</button>
                            `
                        }
                    ]
                });
            } else {
                dataTable.clear();
                dataTable.rows.add(data.empleados);
                dataTable.draw();
            }
        } catch (error) {
            console.error('Error al cargar empleados:', error);
        }
    };

    // Función para cargar turnos
    const cargarTurnos = async (selectElementId) => {
        try {
            const response = await fetch(`${apiUrl}?action=listar_turnos`);
            const data = await response.json();

            const turnSelect = document.getElementById(selectElementId);
            turnSelect.innerHTML = '';
            data.turnos.forEach((turno) => {
                const option = document.createElement('option');
                option.value = turno.id_turno;
                option.textContent = `${turno.nombre_turno} (${turno.hora_inicio} - ${turno.hora_fin})`;
                turnSelect.appendChild(option);
            });
        } catch (error) {
            console.error('Error al cargar turnos:', error);
        }
    };

    // Cargar turnos para el formulario de agregar
    $('#addEmployeeModal').on('show.bs.modal', () => {
        cargarTurnos('add-employee-turn');
    });

    // Manejar envío del formulario de agregar empleado
    document.getElementById('add-employee-form').addEventListener('submit', async (e) => {
        e.preventDefault();
        const formData = new FormData(e.target);

        try {
            const response = await fetch(`${apiUrl}?action=agregar`, {
                method: 'POST',
                body: formData
            });
            const result = await response.json();
            if (result.success) {
                Swal.fire('Agregado', 'Empleado agregado exitosamente.', 'success');
                bootstrap.Modal.getInstance(document.getElementById('addEmployeeModal')).hide();
                cargarEmpleados();
            } else {
                Swal.fire('Error', result.error || 'Error al agregar empleado.', 'error');
            }
        } catch (error) {
            Swal.fire('Error', 'Error al enviar la solicitud.', 'error');
        }
    });

    // Manejar clic en el botón "Editar"
    document.querySelector('#employee-table tbody').addEventListener('click', async (e) => {
        if (e.target.classList.contains('edit-btn')) {
            const id = e.target.getAttribute('data-id'); // Obtén el ID del empleado
            try {
                // Solicita los datos del empleado a la API
                const response = await fetch(`${apiUrl}?action=obtener&id=${id}`);
                const data = await response.json();

                if (data) {
                    if (data.id_empleado) { // Validación de datos recibidos
                        // Llena el formulario del modal con los datos del empleado
                        document.getElementById('edit-employee-id').value = data.id_empleado;
                        document.getElementById('edit-employee-name').value = data.nombre;
                        document.getElementById('edit-employee-lastname').value = data.apellido;
                        document.getElementById('edit-employee-email').value = data.correo;
                        document.getElementById('edit-employee-role').value = data.id_rol;
                        document.getElementById('edit-employee-status').value = data.activo;

                        // Cargar turnos y seleccionar el actual
                        await cargarTurnos('edit-employee-turn');
                        document.getElementById('edit-employee-turn').value = data.id_turno || '';

                        // Abre el modal de edición
                        const editModal = new bootstrap.Modal(document.getElementById('editEmployeeModal'));
                        editModal.show();
                    } else {
                        Swal.fire('Error', 'Datos del empleado no encontrados.', 'error');
                    }
                } else {
                    Swal.fire('Error', 'Error al obtener los datos del empleado.', 'error');
                }
            } catch (error) {
                console.error('Error al obtener datos del empleado:', error);
                Swal.fire('Error', 'No se pudo cargar la información del empleado.', 'error');
            }
        }
    });


    // Manejar envío del formulario de edición de empleado
    document.getElementById('edit-employee-form').addEventListener('submit', async (e) => {
        e.preventDefault();
        const formData = new FormData(e.target);

        try {
            const response = await fetch(`${apiUrl}?action=editar`, {
                method: 'POST',
                body: formData
            });
            const result = await response.json();

            if (result.success) {
                Swal.fire('Actualizado', 'Empleado actualizado exitosamente.', 'success');
                bootstrap.Modal.getInstance(document.getElementById('editEmployeeModal')).hide();
                cargarEmpleados();
            } else {
                Swal.fire('Error', result.error || 'Error al actualizar empleado.', 'error');
            }
        } catch (error) {
            console.error('Error al actualizar empleado:', error);
            Swal.fire('Error', 'Error al enviar la solicitud.', 'error');
        }
    });

    // Manejar eliminación de empleado
    document.querySelector('#employee-table').addEventListener('click', async (e) => {
        if (e.target.classList.contains('delete-btn')) {
            const id = e.target.getAttribute('data-id');

            Swal.fire({
                title: '¿Estás seguro?',
                text: 'Esta acción no se puede deshacer.',
                icon: 'warning',
                showCancelButton: true,
                confirmButtonText: 'Sí, eliminar',
                cancelButtonText: 'Cancelar'
            }).then(async (result) => {
                if (result.isConfirmed) {
                    try {
                        const response = await fetch(`${apiUrl}?action=eliminar&id=${id}`, {
                            method: 'DELETE'
                        });
                        const result = await response.json();

                        if (result.success) {
                            Swal.fire('Eliminado', 'Empleado eliminado exitosamente.', 'success');
                            cargarEmpleados();
                        } else {
                            Swal.fire('Error', result.error || 'Error al eliminar empleado.', 'error');
                        }
                    } catch (error) {
                        console.error('Error al eliminar empleado:', error);
                        Swal.fire('Error', 'Error al enviar la solicitud.', 'error');
                    }
                }
            });
        }
    });

    // Cargar empleados al inicio
    await cargarEmpleados();
});

</script>







