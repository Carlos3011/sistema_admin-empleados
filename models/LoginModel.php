<?php
class LoginModel {
    private $pdo;

    public function __construct($pdo) {
        $this->pdo = $pdo;
    }

    public function getUserByCorreo($correo) {
        $query = "SELECT id_empleado, nombre, id_rol, password FROM empleados WHERE correo = :correo";
        $stmt = $this->pdo->prepare($query);
        $stmt->execute(['correo' => $correo]);
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }
}
