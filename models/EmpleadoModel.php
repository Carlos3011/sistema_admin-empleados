<?php
class EmpleadoModel {
    private $pdo;

    public function __construct($pdo) {
        $this->pdo = $pdo;
    }

    public function getAllEmpleados() {
        $query = "SELECT empleados.id_empleado, empleados.nombre, empleados.apellido, empleados.correo, roles.rol, empleados.activo, turnos_laborales.nombre_turno
                  FROM empleados
                  JOIN roles ON empleados.id_rol = roles.id_rol
                  LEFT JOIN empleados_turnos ON empleados.id_empleado = empleados_turnos.id_empleado
                  LEFT JOIN turnos_laborales ON empleados_turnos.id_turno = turnos_laborales.id_turno";
        $stmt = $this->pdo->query($query);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function getEmpleadoById($id) {
        $query = "SELECT empleados.id_empleado, empleados.nombre, empleados.apellido, empleados.correo, empleados.id_rol, empleados.activo, empleados_turnos.id_turno
                  FROM empleados
                  LEFT JOIN empleados_turnos ON empleados.id_empleado = empleados_turnos.id_empleado
                  WHERE empleados.id_empleado = ?";
        $stmt = $this->pdo->prepare($query);
        $stmt->execute([$id]);
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    public function addEmpleado($nombre, $apellido, $correo, $id_rol, $activo, $id_turno = null) {
        $this->pdo->beginTransaction();

        // Insertar el empleado
        $queryEmpleado = "INSERT INTO empleados (nombre, apellido, correo, id_rol, activo) VALUES (?, ?, ?, ?, ?)";
        $stmtEmpleado = $this->pdo->prepare($queryEmpleado);
        $stmtEmpleado->execute([$nombre, $apellido, $correo, $id_rol, $activo]);

        // Obtener el último ID insertado
        $id_empleado = $this->pdo->lastInsertId();

        // Asignar turno si se proporciona
        if ($id_turno) {
            $queryTurno = "INSERT INTO empleados_turnos (id_empleado, id_turno) VALUES (?, ?)";
            $stmtTurno = $this->pdo->prepare($queryTurno);
            $stmtTurno->execute([$id_empleado, $id_turno]);
        }

        return $this->pdo->commit();
    }

    public function editEmpleado($id, $nombre, $apellido, $correo, $id_rol, $activo, $id_turno = null) {
        $this->pdo->beginTransaction();

        // Actualizar el empleado
        $queryEmpleado = "UPDATE empleados SET nombre = ?, apellido = ?, correo = ?, id_rol = ?, activo = ? WHERE id_empleado = ?";
        $stmtEmpleado = $this->pdo->prepare($queryEmpleado);
        $stmtEmpleado->execute([$nombre, $apellido, $correo, $id_rol, $activo, $id]);

        // Eliminar el turno actual
        $queryDeleteTurno = "DELETE FROM empleados_turnos WHERE id_empleado = ?";
        $stmtDeleteTurno = $this->pdo->prepare($queryDeleteTurno);
        $stmtDeleteTurno->execute([$id]);

        // Asignar nuevo turno si se proporciona
        if ($id_turno) {
            $queryTurno = "INSERT INTO empleados_turnos (id_empleado, id_turno) VALUES (?, ?)";
            $stmtTurno = $this->pdo->prepare($queryTurno);
            $stmtTurno->execute([$id, $id_turno]);
        }

        return $this->pdo->commit();
    }

    public function deleteEmpleado($id) {
        $this->pdo->beginTransaction();

        // Eliminar turnos asociados
        $queryTurno = "DELETE FROM empleados_turnos WHERE id_empleado = ?";
        $stmtTurno = $this->pdo->prepare($queryTurno);
        $stmtTurno->execute([$id]);

        // Eliminar empleado
        $queryEmpleado = "DELETE FROM empleados WHERE id_empleado = ?";
        $stmtEmpleado = $this->pdo->prepare($queryEmpleado);
        $stmtEmpleado->execute([$id]);

        return $this->pdo->commit();
    }

    public function getAllTurnos() {
        $query = "SELECT id_turno, nombre_turno, hora_inicio, hora_fin FROM turnos_laborales";
        $stmt = $this->pdo->query($query);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

}
