<?php
require_once '../models/LoginModel.php';

class LoginController {
    private $model;

    public function __construct($pdo) {
        $this->model = new LoginModel($pdo);
    }

    public function login($correo, $password) {
        $user = $this->model->getUserByCorreo($correo);

        if ($user && password_verify($password, $user['password'])) {
            session_start();
            $_SESSION['user_id'] = $user['id_empleado'];
            $_SESSION['user_name'] = $user['nombre'];
            $_SESSION['user_role'] = $user['id_rol'];
            echo json_encode(['success' => true, 'role' => $user['id_rol']]);
        } else {
            echo json_encode(['success' => false, 'message' => 'Credenciales incorrectas']);
        }
    }

    public function logout() {
        session_start();
        session_destroy();
        echo json_encode(['success' => true]);
    }
}
