<nav class="navbar navbar-expand-lg navbar-light bg-dark border-bottom">
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

<script>
document.addEventListener("DOMContentLoaded", () => {
  const apiUrl = "../data/turnos_data.php";
  let dataTable;

  // Cargar turnos en la tabla
  const cargarTurnos = async () => {
    try {
      const response = await fetch(`${apiUrl}?action=listar`);
      const data = await response.json();

      if (!dataTable) {
        // Inicializa DataTable si aún no existe
        dataTable = $("#turnos-table").DataTable({
          responsive: true,
          language: {
            url: "//cdn.datatables.net/plug-ins/1.13.4/i18n/es-ES.json",
          },
          data: data,
          columns: [
            { data: "id_turno" },
            { data: "nombre_turno" },
            { data: "hora_inicio" },
            { data: "hora_fin" },
            {
              data: null,
              render: (data) =>
                `
                <button class="btn btn-sm btn-warning edit-btn" data-id="${data.id_turno}">Editar</button>
                <button class="btn btn-sm btn-danger delete-btn" data-id="${data.id_turno}">Eliminar</button>
              `,
            },
          ],
        });
      } else {
        // Si DataTable ya existe, recargar los datos
        dataTable.clear();
        dataTable.rows.add(data);
        dataTable.draw();
      }
    } catch (error) {
      console.error("Error al cargar turnos:", error);
    }
  };

  // Agregar turno
  document
    .getElementById("add-turno-form")
    .addEventListener("submit", async (e) => {
      e.preventDefault();
      const formData = new FormData(e.target);

      try {
        const response = await fetch(`${apiUrl}?action=agregar`, {
          method: "POST",
          body: formData,
        });
        const result = await response.json();
        if (result.success) {
          Swal.fire("Agregado", "Turno agregado exitosamente.", "success");
          e.target.reset();
          bootstrap
            .Modal.getInstance(document.getElementById("addTurnoModal"))
            .hide();
          cargarTurnos();
        } else {
          Swal.fire("Error", result.error || "Error al agregar turno.", "error");
        }
      } catch (error) {
        Swal.fire("Error", "Error al enviar la solicitud.", "error");
      }
    });

  // Editar turno
  document.querySelector("#turnos-table").addEventListener("click", async (e) => {
    if (e.target.classList.contains("edit-btn")) {
      const id = e.target.getAttribute("data-id");

      try {
        const response = await fetch(`${apiUrl}?action=obtener&id=${id}`);
        const turno = await response.json();

        document.getElementById("edit-turno-id").value = turno.id_turno;
        document.getElementById("edit-nombre-turno").value = turno.nombre_turno;
        document.getElementById("edit-hora-inicio").value = turno.hora_inicio;
        document.getElementById("edit-hora-fin").value = turno.hora_fin;

        new bootstrap.Modal(document.getElementById("editTurnoModal")).show();
      } catch (error) {
        console.error("Error al obtener turno:", error);
      }
    }
  });

  // Guardar cambios al editar turno
  document
    .getElementById("edit-turno-form")
    .addEventListener("submit", async (e) => {
      e.preventDefault();
      const formData = new FormData(e.target);

      try {
        const response = await fetch(`${apiUrl}?action=editar`, {
          method: "POST",
          body: formData,
        });
        const result = await response.json();
        if (result.success) {
          Swal.fire("Editado", "Turno editado exitosamente.", "success");
          bootstrap
            .Modal.getInstance(document.getElementById("editTurnoModal"))
            .hide();
          cargarTurnos();
        } else {
          Swal.fire("Error", result.error || "Error al editar turno.", "error");
        }
      } catch (error) {
        Swal.fire("Error", "Error al enviar la solicitud.", "error");
      }
    });

  // Eliminar turno
  document.querySelector("#turnos-table").addEventListener("click", (e) => {
    if (e.target.classList.contains("delete-btn")) {
      const id = e.target.getAttribute("data-id");

      Swal.fire({
        title: "¿Estás seguro?",
        text: "Esta acción no se puede deshacer.",
        icon: "warning",
        showCancelButton: true,
        confirmButtonText: "Sí, eliminar",
        cancelButtonText: "Cancelar",
      }).then(async (result) => {
        if (result.isConfirmed) {
          try {
            const response = await fetch(`${apiUrl}?action=eliminar`, {
              method: "POST",
              headers: {
                "Content-Type": "application/json",
              },
              body: JSON.stringify({ id_turno: id }),
            });
            const result = await response.json();
            if (result.success) {
              Swal.fire("Eliminado", "Turno eliminado exitosamente.", "success");
              cargarTurnos();
            } else {
              Swal.fire("Error", result.error || "Error al eliminar turno.", "error");
            }
          } catch (error) {
            Swal.fire("Error", "Error al enviar la solicitud.", "error");
          }
        }
      });
    }
  });

  // Cargar turnos al iniciar
  cargarTurnos();
});

</script>
