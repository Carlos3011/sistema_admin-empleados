<?php
require_once '../models/PermisoModel.php';

class PermisoController {
    private $model;

    public function __construct($pdo) {
        $this->model = new PermisoModel($pdo);
    }

    public function listarPermisos($filtros = []) {
        $permisos = $this->model->getPermisos($filtros);
        echo json_encode(['permisos' => $permisos]);
    }

    public function listarEmpleados() {
        $empleados = $this->model->getEmpleados();
        echo json_encode(['empleados' => $empleados]);
    }

    public function obtenerPermiso($id) {
        $permiso = $this->model->getPermisoById($id);
        echo json_encode($permiso);
    }

    public function agregarPermiso($data) {
        $result = $this->model->addPermiso($data);
        echo json_encode(['success' => $result]);
    }

    public function editarPermiso($id, $data) {
        $result = $this->model->updatePermiso($id, $data);
        echo json_encode(['success' => $result]);
    }

    public function cambiarEstadoPermiso($id, $estado) {
        $result = $this->model->updateEstadoPermiso($id, $estado);
        echo json_encode(['success' => $result]);
    }

    public function eliminarPermiso($id) {
        $result = $this->model->deletePermiso($id);
        if ($result) {
            echo json_encode(['success' => true]);
        } else {
            echo json_encode(['success' => false, 'error' => 'Error al eliminar el permiso.']);
        }
    }
}
?>
