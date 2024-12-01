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

        // Comparación directa porque no hay cifrado
        if ($empleado && $password === $empleado['password']) {
            return $empleado;
        }

        return false;
    }
}
