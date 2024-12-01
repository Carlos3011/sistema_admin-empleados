<?php
class AuthModel {
    private $pdo;

    public function __construct($pdo) {
        $this->pdo = $pdo;
    }

    public function verificarUsuario($correo, $password) {
        $query = "SELECT * FROM empleados WHERE correo = :correo";
        $stmt = $this->pdo->prepare($query);
        $stmt->execute(['correo' => $correo]);
        $empleado = $stmt->fetch(PDO::FETCH_ASSOC);

        if ($empleado && $password === $empleado['password']) {
            return $empleado;
        }

        return false;
    }

    public function guardarToken($id_empleado, $token) {
        $query = "INSERT INTO sesiones (id_empleado, auth_token) VALUES (:id_empleado, :auth_token)
                  ON DUPLICATE KEY UPDATE auth_token = :auth_token";
        $stmt = $this->pdo->prepare($query);
        $stmt->execute(['id_empleado' => $id_empleado, 'auth_token' => $token]);
    }
}
