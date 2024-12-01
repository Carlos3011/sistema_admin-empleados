<?php
require_once '../controllers/AuthController.php';

try {
    $pdo = new PDO("mysql:host=localhost;dbname=sistema_asistencia", "root", "");
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    $controller = new AuthController($pdo);

    $action = $_GET['action'] ?? '';

    switch ($action) {
        case 'login':
            $correo = $_POST['correo'];
            $password = $_POST['password'];
            $result = $controller->login($correo, $password);
            echo json_encode($result);
            break;

        default:
            echo json_encode(['success' => false, 'message' => 'Acción no válida']);
    }
} catch (Exception $e) {
    echo json_encode(['success' => false, 'message' => $e->getMessage()]);
}
