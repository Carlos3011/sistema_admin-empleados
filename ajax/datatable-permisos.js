document.addEventListener("DOMContentLoaded", () => {
    const apiUrl = "../data/permisos_data.php";
    let dataTable;

    // Cargar permisos
    const cargarPermisos = async () => {
        try {
            const response = await fetch(`${apiUrl}?action=listar`);
            const data = await response.json();

            if (!dataTable) {
                dataTable = $("#permisos-table").DataTable({
                    responsive: true,
                    language: { url: "//cdn.datatables.net/plug-ins/1.13.4/i18n/es-ES.json" },
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
                            render: (d) =>
                                `<button class="btn btn-warning btn-sm edit-btn" data-id="${d.id_permiso}">Editar</button>
                                <button class="btn btn-danger btn-sm delete-btn" data-id="${d.id_permiso}">Eliminar</button>`,
                        },
                    ],
                });
            } else {
                dataTable.clear().rows.add(data.permisos).draw();
            }
        } catch (error) {
            console.error("Error al cargar permisos:", error);
        }
    };

    // Cargar empleados
    const cargarEmpleados = async () => {
        try {
            const response = await fetch(`${apiUrl}?action=listar_empleados`);
            const data = await response.json();
            document.getElementById("empleado").innerHTML = data.empleados
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
            const response = await fetch(`${apiUrl}?action=agregar`, { method: "POST", body: formData });
            const result = await response.json();
            if (result.success) {
                Swal.fire("Éxito", "Permiso agregado correctamente.", "success");
                $("#addPermisoModal").modal("hide");
                cargarPermisos();
            } else {
                Swal.fire("Error", "No se pudo agregar el permiso.", "error");
            }
        } catch (error) {
            console.error("Error al agregar permiso:", error);
        }
    });

    // Editar permiso
    $("#permisos-table").on("click", ".edit-btn", async function () {
        const id = $(this).data("id");
        try {
            const response = await fetch(`${apiUrl}?action=obtener&id_permiso=${id}`);
            const permiso = await response.json();
            if (permiso.error) {
                Swal.fire("Error", permiso.error, "error");
                return;
            }
            $("#edit-id-permiso").val(permiso.id_permiso);
            $("#edit-tipo-permiso").val(permiso.tipo_permiso);
            $("#edit-fecha-inicio").val(permiso.fecha_inicio.replace(" ", "T"));
            $("#edit-fecha-fin").val(permiso.fecha_fin.replace(" ", "T"));
            $("#edit-estado").val(permiso.estado);
            $("#editPermisoModal").modal("show");
        } catch (error) {
            console.error("Error al obtener permiso:", error);
        }
    });

    // Guardar cambios en permiso editado
    document.getElementById("edit-permiso-form").addEventListener("submit", async (e) => {
        e.preventDefault();
        const formData = new FormData(e.target);
        try {
            const response = await fetch(`${apiUrl}?action=editar`, { method: "POST", body: formData });
            const result = await response.json();
            if (result.success) {
                Swal.fire("Éxito", "Permiso actualizado correctamente.", "success");
                $("#editPermisoModal").modal("hide");
                cargarPermisos();
            } else {
                Swal.fire("Error", "No se pudo actualizar el permiso.", "error");
            }
        } catch (error) {
            console.error("Error al actualizar permiso:", error);
        }
    });

    // Eliminar permiso
    $("#permisos-table").on("click", ".delete-btn", async function () {
        const id = $(this).data("id");
        const result = await Swal.fire({
            title: "¿Estás seguro?",
            text: "No podrás deshacer esta acción.",
            icon: "warning",
            showCancelButton: true,
            confirmButtonText: "Sí, eliminar",
            cancelButtonText: "Cancelar",
        });
        if (result.isConfirmed) {
            try {
                const response = await fetch(`${apiUrl}?action=eliminar`, {
                    method: "POST",
                    headers: { "Content-Type": "application/json" },
                    body: JSON.stringify({ id_permiso: id }),
                });
                const data = await response.json();
                if (data.success) {
                    Swal.fire("Eliminado", "Permiso eliminado correctamente.", "success");
                    cargarPermisos();
                } else {
                    Swal.fire("Error", "No se pudo eliminar el permiso.", "error");
                }
            } catch (error) {
                console.error("Error al eliminar permiso:", error);
            }
        }
    });

    // Cargar permisos y empleados al inicio
    cargarPermisos();
    cargarEmpleados();
});