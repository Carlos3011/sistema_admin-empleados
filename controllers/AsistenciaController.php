<?php
class AsistenciaController {
    private $model;

    public function __construct($pdo) {
        $this->model = new AsistenciaModel($pdo);
    }

    public function listarAsistencias($filtros = []) {
        try {
            $asistencias = $this->model->getAsistencias($filtros);
            echo json_encode(['asistencias' => $asistencias]);
        } catch (Exception $e) {
            error_log("Error en listarAsistencias: " . $e->getMessage());
            http_response_code(500);
            echo json_encode(['error' => 'Error al obtener las asistencias']);
        }
    }

    public function exportarExcel($filtros = []) {
        try {
            $asistencias = $this->model->getAsistencias($filtros);
            
            header("Content-Type: application/vnd.ms-excel");
            header("Content-Disposition: attachment; filename=asistencias.xls");
            
            $output = fopen("php://output", "w");
            fputcsv($output, ["ID", "Nombre Completo", "Correo", "Turno", "Evento", "Fecha y Hora"]);

            foreach ($asistencias as $row) {
                fputcsv($output, [
                    $row['id_registro'], 
                    "{$row['nombre_empleado']} {$row['apellido_empleado']}", 
                    $row['correo'], 
                    $row['nombre_turno'], 
                    $row['tipo_evento'], 
                    $row['fecha_hora']
                ]);
            }

            fclose($output);
        } catch (Exception $e) {
            error_log("Error en exportarExcel: " . $e->getMessage());
            http_response_code(500);
            echo "Error al exportar las asistencias.";
        }
    }
}
