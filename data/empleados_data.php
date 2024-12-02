<?php
require_once '../models/EmpleadoModel.php';
require_once '../controllers/EmpleadoController.php';

// Habilitar visualización de errores para depuración
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

try {
    // Conexión a la base de datos
    $pdo = new PDO("mysql:host=localhost;dbname=sistema_asistencia", "root", "");
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    // Inicializa el controlador
    $controller = new EmpleadoController($pdo);

    // Obtiene y valida la acción
    $action = $_GET['action'] ?? '';
    if (!in_array($action, ['listar', 'obtener', 'agregar', 'editar', 'eliminar', 'listar_turnos'])) {
        http_response_code(400); // Código HTTP para solicitudes inválidas
        echo json_encode(['error' => 'Acción no válida']);
        exit;
    }

    // Ejecuta la acción correspondiente
    switch ($action) {
        case 'listar':
            $controller->listarEmpleados();
            break;

        case 'obtener':
            if (isset($_GET['id'])) {
                $controller->obtenerEmpleado($_GET['id']);
            } else {
                http_response_code(400);
                echo json_encode(['error' => 'ID de empleado no proporcionado']);
            }
            break;

        case 'agregar':
            $controller->agregarEmpleado();
            break;

        case 'editar':
            $controller->editarEmpleado();
            break;

        case 'eliminar':
            if (isset($_GET['id'])) {
                $controller->eliminarEmpleado($_GET['id']);
            } else {
                http_response_code(400);
                echo json_encode(['error' => 'ID de empleado no proporcionado']);
            }
            break;

        case 'listar_turnos':
            $controller->listarTurnos();
            break;

        default:
            http_response_code(400);
            echo json_encode(['error' => 'Acción no reconocida']);
            break;
    }
} catch (PDOException $e) {
    http_response_code(500); // Código HTTP para errores de base de datos
    echo json_encode(['error' => 'Error en la base de datos', 'message' => $e->getMessage()]);
} catch (Exception $e) {
    http_response_code(500); // Código HTTP para errores generales
    echo json_encode(['error' => 'Error interno del servidor', 'message' => $e->getMessage()]);
}
