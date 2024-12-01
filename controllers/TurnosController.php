<?php
require_once '../models/TurnosModel.php';

class TurnosController {
    private $model;

    public function __construct($pdo) {
        $this->model = new TurnosModel($pdo);
    }

    public function listarTurnos() {
        $turnos = $this->model->listarTurnos();
        echo json_encode($turnos);
    }

    public function agregarTurno() {
        $nombre_turno = $_POST['nombre_turno'];
        $hora_inicio = $_POST['hora_inicio'];
        $hora_fin = $_POST['hora_fin'];

        $result = $this->model->agregarTurno($nombre_turno, $hora_inicio, $hora_fin);
        echo json_encode(['success' => $result]);
    }

    public function obtenerTurno() {
        $id_turno = $_GET['id'];
        $turno = $this->model->obtenerTurnoPorId($id_turno);
        echo json_encode($turno);
    }

    public function editarTurno() {
        $id_turno = $_POST['id_turno'];
        $nombre_turno = $_POST['nombre_turno'];
        $hora_inicio = $_POST['hora_inicio'];
        $hora_fin = $_POST['hora_fin'];

        $result = $this->model->editarTurno($id_turno, $nombre_turno, $hora_inicio, $hora_fin);
        echo json_encode(['success' => $result]);
    }

    public function eliminarTurno() {
        $id_turno = $_POST['id_turno'];
        $result = $this->model->eliminarTurno($id_turno);
        echo json_encode(['success' => $result]);
    }
}
