<?php
class EmpleadoController {
    private $model;

    public function __construct($pdo) {
        $this->model = new EmpleadoModel($pdo);
    }

    public function listarEmpleados() {
        try {
            $empleados = $this->model->getAllEmpleados();
            echo json_encode(['empleados' => $empleados]);
        } catch (Exception $e) {
            echo json_encode(['error' => $e->getMessage()]);
        }
    }

    public function obtenerEmpleado($id) {
        try {
            $empleado = $this->model->getEmpleadoById($id);
            echo json_encode($empleado);
        } catch (Exception $e) {
            echo json_encode(['error' => $e->getMessage()]);
        }
    }

    public function agregarEmpleado() {
        try {
            $nombre = $_POST['nombre'];
            $apellido = $_POST['apellido'];
            $correo = $_POST['correo'];
            $id_rol = $_POST['id_rol'];
            $activo = $_POST['activo'];
            $id_turno = $_POST['id_turno'] ?? null;

            $result = $this->model->addEmpleado($nombre, $apellido, $correo, $id_rol, $activo, $id_turno);
            echo json_encode(['success' => $result]);
        } catch (Exception $e) {
            echo json_encode(['error' => $e->getMessage()]);
        }
    }

    public function editarEmpleado() {
        try {
            $id = $_POST['id_empleado'];
            $nombre = $_POST['nombre'];
            $apellido = $_POST['apellido'];
            $correo = $_POST['correo'];
            $id_rol = $_POST['id_rol'];
            $activo = $_POST['activo'];
            $id_turno = $_POST['id_turno'] ?? null;

            $result = $this->model->editEmpleado($id, $nombre, $apellido, $correo, $id_rol, $activo, $id_turno);
            echo json_encode(['success' => $result]);
        } catch (Exception $e) {
            echo json_encode(['error' => $e->getMessage()]);
        }
    }

    public function eliminarEmpleado() {
        try {
            $id = $_GET['id'];
            $result = $this->model->deleteEmpleado($id);
            echo json_encode(['success' => $result]);
        } catch (Exception $e) {
            echo json_encode(['error' => $e->getMessage()]);
        }
    }

    public function listarTurnos() {
        try {
            $turnos = $this->model->getAllTurnos();
            echo json_encode(['turnos' => $turnos]);
        } catch (Exception $e) {
            echo json_encode(['error' => $e->getMessage()]);
        }
    }
}
