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