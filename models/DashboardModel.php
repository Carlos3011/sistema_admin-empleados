<?php
class DashboardModel {
    private $pdo;

    public function __construct($pdo) {
        $this->pdo = $pdo;
    }

    public function getTotalEmpleados() {
        $query = $this->pdo->query("SELECT COUNT(*) AS total FROM empleados");
        return $query->fetch(PDO::FETCH_ASSOC)['total'];
    }

    public function getTurnosProgramados() {
        $query = $this->pdo->query("SELECT COUNT(*) AS total FROM turnos_laborales");
        return $query->fetch(PDO::FETCH_ASSOC)['total'];
    }

    public function getAsistenciasTotales() {
        $query = $this->pdo->query("SELECT COUNT(*) AS total FROM registros_asistencia");
        return $query->fetch(PDO::FETCH_ASSOC)['total'];
    }

    public function getPermisosPendientes() {
        $query = $this->pdo->query("SELECT COUNT(*) AS total FROM permisos WHERE fecha_fin >= NOW()");
        return $query->fetch(PDO::FETCH_ASSOC)['total'];
    }

    public function getActividadesPorDia() {
        $diasSemana = ['Monday', 'Tuesday', 'Wednesday', 'Thursday', 'Friday', 'Saturday', 'Sunday'];
        $actividades = [];
        foreach ($diasSemana as $dia) {
            $query = $this->pdo->prepare("SELECT COUNT(*) AS total FROM registros_asistencia WHERE DAYNAME(fecha_hora) = :dia");
            $query->execute([':dia' => $dia]);
            $actividades[] = $query->fetch(PDO::FETCH_ASSOC)['total'];
        }
        return $actividades;
    }

    public function getTurnosPorTipo() {
        $query = $this->pdo->query("SELECT nombre_turno AS tipo, COUNT(*) AS total FROM turnos_laborales GROUP BY nombre_turno");
        return $query->fetchAll(PDO::FETCH_KEY_PAIR);
    }

    public function getPermisosPorTipo() {
        $query = $this->pdo->query("SELECT tipo_permiso AS tipo, COUNT(*) AS total FROM permisos GROUP BY tipo_permiso");
        return $query->fetchAll(PDO::FETCH_KEY_PAIR);
    }
}
