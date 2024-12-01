<?php
require_once '../models/DashboardModel.php';

class DashboardController {
    private $model;

    public function __construct($pdo) {
        $this->model = new DashboardModel($pdo);
    }

    public function getDashboardData() {
        try {
            $data = [
                'totalEmpleados' => $this->model->getTotalEmpleados(),
                'turnosProgramados' => $this->model->getTurnosProgramados(),
                'asistenciasTotales' => $this->model->getAsistenciasTotales(),
                'permisosPendientes' => $this->model->getPermisosPendientes(),
                'actividadesPorDia' => $this->model->getActividadesPorDia(),
                'turnosPorTipo' => $this->model->getTurnosPorTipo(),
                'permisosPorTipo' => $this->model->getPermisosPorTipo()
            ];

            header('Content-Type: application/json');
            echo json_encode($data);
        } catch (Exception $e) {
            echo json_encode(['error' => $e->getMessage()]);
        }
    }
}

