<?php
class TurnosModel {
    private $pdo;

    public function __construct($pdo) {
        $this->pdo = $pdo;
    }

    public function listarTurnos() {
        $query = "SELECT * FROM turnos_laborales";
        $stmt = $this->pdo->query($query);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function agregarTurno($nombre_turno, $hora_inicio, $hora_fin) {
        $query = "INSERT INTO turnos_laborales (nombre_turno, hora_inicio, hora_fin) VALUES (?, ?, ?)";
        $stmt = $this->pdo->prepare($query);
        return $stmt->execute([$nombre_turno, $hora_inicio, $hora_fin]);
    }

    public function obtenerTurnoPorId($id_turno) {
        $query = "SELECT * FROM turnos_laborales WHERE id_turno = ?";
        $stmt = $this->pdo->prepare($query);
        $stmt->execute([$id_turno]);
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    public function editarTurno($id_turno, $nombre_turno, $hora_inicio, $hora_fin) {
        $query = "UPDATE turnos_laborales SET nombre_turno = ?, hora_inicio = ?, hora_fin = ? WHERE id_turno = ?";
        $stmt = $this->pdo->prepare($query);
        return $stmt->execute([$nombre_turno, $hora_inicio, $hora_fin, $id_turno]);
    }

    public function eliminarTurno($id_turno) {
        $query = "DELETE FROM turnos_laborales WHERE id_turno = ?";
        $stmt = $this->pdo->prepare($query);
        return $stmt->execute([$id_turno]);
    }
}
