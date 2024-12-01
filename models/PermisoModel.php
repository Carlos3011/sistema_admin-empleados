<?php
class PermisoModel {
    private $pdo;

    public function __construct($pdo) {
        $this->pdo = $pdo;
    }

    public function getPermisos($filtros = []) {
        $query = "SELECT 
                    permisos.id_permiso, 
                    empleados.nombre, 
                    empleados.apellido, 
                    permisos.tipo_permiso, 
                    permisos.fecha_inicio, 
                    permisos.fecha_fin, 
                    permisos.estado 
                  FROM permisos
                  JOIN empleados ON permisos.id_empleado = empleados.id_empleado";

        $params = [];
        if (!empty($filtros)) {
            $query .= " WHERE";
            $conditions = [];
            if (isset($filtros['estado'])) {
                $conditions[] = " permisos.estado = ?";
                $params[] = $filtros['estado'];
            }
            if (isset($filtros['tipo_permiso'])) {
                $conditions[] = " permisos.tipo_permiso = ?";
                $params[] = $filtros['tipo_permiso'];
            }
            $query .= implode(" AND ", $conditions);
        }

        $stmt = $this->pdo->prepare($query);
        $stmt->execute($params);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
    public function getPermisoById($id) {
        $query = "SELECT 
                    permisos.id_permiso, 
                    permisos.id_empleado, 
                    permisos.tipo_permiso, 
                    permisos.fecha_inicio, 
                    permisos.fecha_fin, 
                    permisos.estado 
                  FROM permisos
                  WHERE permisos.id_permiso = :id_permiso";
        $stmt = $this->pdo->prepare($query);
        $stmt->execute(['id_permiso' => $id]);
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }
    

    public function getEmpleados() {
        $query = "SELECT id_empleado, nombre, apellido FROM empleados WHERE activo = 1";
        $stmt = $this->pdo->query($query);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function addPermiso($data) {
        $query = "INSERT INTO permisos (id_empleado, tipo_permiso, fecha_inicio, fecha_fin, estado) 
                  VALUES (:id_empleado, :tipo_permiso, :fecha_inicio, :fecha_fin, 'pendiente')";
        $stmt = $this->pdo->prepare($query);
        return $stmt->execute($data);
    }

    public function updatePermiso($id, $data) {
        $query = "UPDATE permisos SET 
                  tipo_permiso = :tipo_permiso, 
                  fecha_inicio = :fecha_inicio, 
                  fecha_fin = :fecha_fin 
                  WHERE id_permiso = :id_permiso";
        $stmt = $this->pdo->prepare($query);
        $data['id_permiso'] = $id;
        return $stmt->execute($data);
    }

    public function updateEstadoPermiso($id, $estado) {
        $query = "UPDATE permisos SET estado = :estado WHERE id_permiso = :id_permiso";
        $stmt = $this->pdo->prepare($query);
        return $stmt->execute(['id_permiso' => $id, 'estado' => $estado]);
    }

    public function deletePermiso($id) {
        $query = "DELETE FROM permisos WHERE id_permiso = :id_permiso";
        $stmt = $this->pdo->prepare($query);
        return $stmt->execute(['id_permiso' => $id]);
    }
    
}
