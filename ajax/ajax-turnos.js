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