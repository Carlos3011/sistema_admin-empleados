<?php
require_once '../models/EmpleadoModel.php';
require_once '../controllers/EmpleadoController.php';

try {
    // Conexión a la base de datos
    $pdo = new PDO("mysql:host=localhost;dbname=sistema_asistencia", "root", "");
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    // Inicializa el controlador
    $controller = new EmpleadoController($pdo);

    // Obtiene y valida la acción
    $action = $_GET['action'] ?? '';
    if (!in_array($action, ['listar', 'agregar', 'editar', 'eliminar', 'listar_turnos'])) {
        http_response_code(400); // Código HTTP para solicitudes inválidas
        echo json_encode(['error' => 'Acción no válida']);
        exit;
    }

    // Ejecuta la acción correspondiente
    switch ($action) {
        case 'listar':
            if (isset($_GET['id'])) {
                $controller->obtenerEmpleado($_GET['id']);
            } else {
                $controller->listarEmpleados();
            }
            break;
        case 'agregar':
            $controller->agregarEmpleado();
            break;
        case 'editar':
            $controller->editarEmpleado();
            break;
        case 'eliminar':
            $controller->eliminarEmpleado();
            break;
        case 'listar_turnos':
            $controller->listarTurnos();
            break;
    }
} catch (Exception $e) {
    // Manejo de errores generales
    http_response_code(500); // Código HTTP para errores internos del servidor
    echo json_encode(['error' => 'Error interno del servidor', 'message' => $e->getMessage()]);
}
