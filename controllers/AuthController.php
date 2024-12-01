<?php
require_once '../models/AuthModel.php';

class AuthController {
    private $model;

    public function __construct($pdo) {
        $this->model = new AuthModel($pdo);
    }

    public function login($correo, $password) {
        $empleado = $this->model->verificarUsuario($correo, $password);
    
        if ($empleado) {
            session_start();
            $_SESSION['id_empleado'] = $empleado['id_empleado'];
            $_SESSION['id_rol'] = $empleado['id_rol'];
    
            // Generar token único para validar en el servidor Python
            $token = bin2hex(random_bytes(16));
            $_SESSION['auth_token'] = $token;

            // Guardar el token en la base de datos
            $this->model->guardarToken($empleado['id_empleado'], $token);
    
            return [
                'success' => true,
                'role' => $empleado['id_rol'],
                'auth_token' => $token,
                'message' => 'Login exitoso'
            ];
        }
    
        return [
            'success' => false,
            'message' => 'Correo o contraseña incorrectos'
        ];
    }
}
