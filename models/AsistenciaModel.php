<?php
class AsistenciaModel {
    private $pdo;

    public function __construct($pdo) {
        $this->pdo = $pdo;
    }

    public function getAsistencias($filtros = []) {
        try {
            $query = "SELECT 
                        registros_asistencia.id_registro, 
                        empleados.nombre AS nombre_empleado, 
                        empleados.apellido AS apellido_empleado, 
                        empleados.correo, 
                        turnos_laborales.nombre_turno, 
                        registros_asistencia.tipo_evento, 
                        registros_asistencia.fecha_hora
                      FROM registros_asistencia
                      INNER JOIN empleados ON registros_asistencia.id_empleado = empleados.id_empleado
                      LEFT JOIN empleados_turnos ON empleados.id_empleado = empleados_turnos.id_empleado
                      LEFT JOIN turnos_laborales ON empleados_turnos.id_turno = turnos_laborales.id_turno";

            $params = [];
            if (!empty($filtros)) {
                $query .= " WHERE";
                $conditions = [];
                if (isset($filtros['fecha'])) {
                    $conditions[] = "DATE(registros_asistencia.fecha_hora) = ?";
                    $params[] = $filtros['fecha'];
                }
                $query .= " " . implode(" AND ", $conditions);
            }

            $query .= " ORDER BY registros_asistencia.fecha_hora DESC";

            $stmt = $this->pdo->prepare($query);
            $stmt->execute($params);

            return $stmt->fetchAll(PDO::FETCH_ASSOC);
        } catch (Exception $e) {
            error_log("Error en getAsistencias: " . $e->getMessage());
            throw $e;
        }
    }
}
