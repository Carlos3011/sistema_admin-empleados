<?php
require_once '../controllers/TurnosController.php';

$pdo = new PDO("mysql:host=localhost;dbname=sistema_asistencia", "root", "");
$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

$controller = new TurnosController($pdo);

$action = $_GET['action'] ?? '';

switch ($action) {
    case 'listar':
        $controller->listarTurnos();
        break;
    case 'agregar':
        $controller->agregarTurno();
        break;
    case 'obtener':
        $controller->obtenerTurno();
        break;
    case 'editar':
        $controller->editarTurno();
        break;
    case 'eliminar':
        $controller->eliminarTurno();
        break;
    default:
        echo json_encode(['error' => 'Acción no válida']);
        break;
}
