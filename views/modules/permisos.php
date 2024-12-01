<nav class="navbar navbar-expand-lg navbar-light bg-dark border-bottom">
    <div class="container-fluid">
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



<script>
document.addEventListener("DOMContentLoaded", () => {
    const apiUrl = "../data/permisos_data.php";
    let dataTable;

    // Función para cargar permisos
    const cargarPermisos = async () => {
        try {
            const response = await fetch(`${apiUrl}?action=listar`);
            const data = await response.json();

            if (!dataTable) {
                // Inicializar DataTable si no está ya creado
                dataTable = $("#permisos-table").DataTable({
                    responsive: true,
                    language: {
                        url: "//cdn.datatables.net/plug-ins/1.13.4/i18n/es-ES.json",
                    },
                    data: data.permisos,
                    columns: [
                        { data: "id_permiso" },
                        { data: null, render: (d) => `${d.nombre} ${d.apellido}` },
                        { data: "tipo_permiso" },
                        { data: "fecha_inicio" },
                        { data: "fecha_fin" },
                        { data: "estado" },
                        {
                            data: null,
                            render: (d) => `
                                <button class="btn btn-warning btn-sm edit-btn" data-id="${d.id_permiso}">Editar</button>
                                <button class="btn btn-danger btn-sm delete-btn" data-id="${d.id_permiso}">Eliminar</button>
                            `,
                        },
                    ],
                });
            } else {
                // Actualizar DataTable si ya existe
                dataTable.clear().rows.add(data.permisos).draw();
            }
        } catch (error) {
            console.error("Error al cargar permisos:", error);
        }
    };

    // Función para cargar empleados en el formulario de agregar
    const cargarEmpleados = async () => {
        try {
            const response = await fetch(`${apiUrl}?action=listar_empleados`);
            const data = await response.json();
            const empleadoSelect = document.getElementById("empleado");
            empleadoSelect.innerHTML = data.empleados
                .map((e) => `<option value="${e.id_empleado}">${e.nombre} ${e.apellido}</option>`)
                .join("");
        } catch (error) {
            console.error("Error al cargar empleados:", error);
        }
    };

    // Agregar permiso
    document.getElementById("add-permiso-form").addEventListener("submit", async (e) => {
        e.preventDefault();
        const formData = new FormData(e.target);

        try {
            const response = await fetch(`${apiUrl}?action=agregar`, {
                method: "POST",
                body: formData,
            });
            const result = await response.json();
            if (result.success) {
                Swal.fire({
                    title: "Éxito",
                    text: "Permiso agregado exitosamente.",
                    icon: "success",
                });
                $("#addPermisoModal").modal("hide");
                cargarPermisos();
            } else {
                Swal.fire({
                    title: "Error",
                    text: "Error al agregar permiso.",
                    icon: "error",
                });
            }
        } catch (error) {
            console.error("Error al agregar permiso:", error);
        }
    });

    
    // Editar permiso
    $("#permisos-table").on("click", ".edit-btn", async function () {
        const id = $(this).data("id");
        console.log("ID del permiso a editar:", id); // Verifica el ID antes de la solicitud

        try {
            const response = await fetch(`${apiUrl}?action=obtener&id_permiso=${id}`);
            const text = await response.text(); // Lee la respuesta como texto
            console.log("Respuesta como texto (sin procesar):", text); // Verifica lo que devuelve el servidor

            const permiso = JSON.parse(text); // Intenta convertir la respuesta a JSON
            console.log("JSON del permiso:", permiso); // Verifica los datos en formato JSON

            if (permiso.error) {
                Swal.fire("Error", permiso.error, "error");
                return;
            }

            // Cargar los datos en el formulario del modal
            $("#edit-id-permiso").val(permiso.id_permiso);
            $("#edit-tipo-permiso").val(permiso.tipo_permiso);
            $("#edit-fecha-inicio").val(permiso.fecha_inicio.replace(" ", "T"));
            $("#edit-fecha-fin").val(permiso.fecha_fin.replace(" ", "T"));

            $("#editPermisoModal").modal("show");
        } catch (error) {
            console.error("Error al procesar los datos del permiso:", error);
            Swal.fire("Error", "No se pudieron cargar los datos del permiso.", "error");
        }
    });


    // Guardar cambios en permiso editado
    document.getElementById("edit-permiso-form").addEventListener("submit", async (e) => {
        e.preventDefault(); // Prevenir envío estándar del formulario

        // Crear un FormData con los datos del formulario
        const formData = new FormData(e.target);

        try {
            // Enviar la solicitud al backend
            const response = await fetch(`${apiUrl}?action=editar`, {
                method: "POST",
                body: formData,
            });

            const result = await response.json(); // Parsear la respuesta
            if (result.success) {
                Swal.fire({
                    title: "Éxito",
                    text: "El permiso ha sido actualizado correctamente.",
                    icon: "success",
                });

                // Ocultar el modal y recargar la tabla
                $("#editPermisoModal").modal("hide");
                cargarPermisos();
            } else {
                Swal.fire({
                    title: "Error",
                    text: result.error || "Error al editar el permiso.",
                    icon: "error",
                });
            }
        } catch (error) {
            console.error("Error al guardar cambios en el permiso:", error);
            Swal.fire({
                title: "Error",
                text: "Hubo un error al intentar guardar los cambios.",
                icon: "error",
            });
        }
    });


    $("#permisos-table").on("click", ".delete-btn", function () {
        const id = $(this).data("id");

        // SweetAlert2 para confirmar eliminación
        Swal.fire({
            title: "¿Estás seguro?",
            text: "No podrás deshacer esta acción.",
            icon: "warning",
            showCancelButton: true,
            confirmButtonText: "Sí, eliminar",
            cancelButtonText: "Cancelar",
        }).then((result) => {
            if (result.isConfirmed) {
                //console.log("ID a eliminar:", id); // Log del ID

                const requestBody = JSON.stringify({ id_permiso: id });
                //console.log("Cuerpo de la solicitud (JSON):", requestBody); // Log del JSON enviado

                fetch(`${apiUrl}?action=eliminar`, {
                    method: "POST",
                    headers: {
                        "Content-Type": "application/json",
                    },
                    body: requestBody,
                })
                    .then((response) => {
                        //console.log("Respuesta del servidor (sin procesar):", response); // Log de la respuesta inicial
                        if (!response.ok) {
                            throw new Error("Error en la respuesta del servidor");
                        }
                        return response.text(); // Leer como texto para inspeccionar si hay HTML en lugar de JSON
                    })
                    .then((responseText) => {
                        //console.log("Respuesta como texto:", responseText); // Log del texto completo recibido
                        const result = JSON.parse(responseText); // Intentar parsear como JSON
                        //console.log("Respuesta procesada del servidor (JSON):", result);

                        if (result.success) {
                            Swal.fire({
                                title: "¡Eliminado!",
                                text: "El permiso fue eliminado exitosamente.",
                                icon: "success",
                            });
                            cargarPermisos();
                        } else {
                            Swal.fire({
                                title: "Error",
                                text: result.error || "Error al eliminar el permiso.",
                                icon: "error",
                            });
                        }
                    })
                    .catch((error) => {
                        //console.error("Error al eliminar permiso:", error); // Log de errores
                        Swal.fire({
                            title: "Error",
                            text: "Error al eliminar el permiso. Verifica la consola para más detalles.",
                            icon: "error",
                        });
                    });
            }
        });
    });




    // Cargar permisos al inicio
    cargarPermisos();
    cargarEmpleados();
});



</script>