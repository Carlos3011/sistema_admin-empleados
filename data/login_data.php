<?php
require_once '../controllers/LoginController.php';

try {
    $pdo = new PDO("mysql:host=localhost;dbname=sistema_asistencia", "root", "");
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    $controller = new LoginController($pdo);

    $action = $_GET['action'] ?? '';
    switch ($action) {
        case 'login':
            $input = json_decode(file_get_contents('php://input'), true);
            $correo = $input['correo'] ?? '';
            $password = $input['password'] ?? '';
            $controller->login($correo, $password);
            break;

        case 'logout':
            $controller->logout();
            break;

        default:
            echo json_encode(['error' => 'Acción no válida']);
            break;
    }
} catch (Exception $e) {
    echo json_encode(['error' => $e->getMessage()]);
}
