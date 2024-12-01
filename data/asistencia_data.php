<?php
require_once '../models/AsistenciaModel.php';
require_once '../controllers/AsistenciaController.php';

$pdo = new PDO("mysql:host=localhost;dbname=sistema_asistencia", "root", "");
$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

$controller = new AsistenciaController($pdo);

$action = $_GET['action'] ?? '';
switch ($action) {
    case 'listar':
        $filtros = [];
        if (!empty($_GET['fecha'])) {
            $filtros['fecha'] = $_GET['fecha'];
        }
        $controller->listarAsistencias($filtros);
        break;

    case 'exportar':
        $filtros = [];
        if (!empty($_GET['fecha'])) {
            $filtros['fecha'] = $_GET['fecha'];
        }
        $controller->exportarExcel($filtros);
        break;

    default:
        http_response_code(400);
        echo json_encode(['error' => 'Acción no válida']);
        break;
}
