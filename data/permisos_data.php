<?php
require_once '../controllers/PermisoController.php';

try {
    $pdo = new PDO("mysql:host=localhost;dbname=sistema_asistencia", "root", "");
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    $controller = new PermisoController($pdo);

    $action = $_GET['action'] ?? '';
    switch ($action) {
        case 'listar':
            $filtros = [];
            if (!empty($_GET['estado'])) {
                $filtros['estado'] = $_GET['estado'];
            }
            if (!empty($_GET['tipo_permiso'])) {
                $filtros['tipo_permiso'] = $_GET['tipo_permiso'];
            }
            $controller->listarPermisos($filtros);
            break;

        case 'listar_empleados':
            $controller->listarEmpleados();
            break;

        case 'agregar':
            $data = [
                'id_empleado' => $_POST['id_empleado'],
                'tipo_permiso' => $_POST['tipo_permiso'],
                'fecha_inicio' => $_POST['fecha_inicio'],
                'fecha_fin' => $_POST['fecha_fin']
            ];
            $controller->agregarPermiso($data);
            break;

        case 'editar':
            $id = $_POST['id_permiso'];
            $data = [
                'tipo_permiso' => $_POST['tipo_permiso'],
                'fecha_inicio' => $_POST['fecha_inicio'],
                'fecha_fin' => $_POST['fecha_fin']
            ];
            $controller->editarPermiso($id, $data);
            break;

        case 'cambiar_estado':
            $id = $_POST['id_permiso'];
            $estado = $_POST['estado'];
            $controller->cambiarEstadoPermiso($id, $estado);
            break;
        case 'obtener':
            if (!empty($_GET['id_permiso'])) {
                $id = $_GET['id_permiso'];
                $controller->obtenerPermiso($id); // Llama al método público en lugar de acceder directamente
            } else {
                echo json_encode(['error' => 'ID de permiso no proporcionado']);
            }
            break;
            
        case 'eliminar':
            // Decodificar JSON desde el cuerpo de la solicitud
            $input = json_decode(file_get_contents('php://input'), true);
        
            // Verificar si se recibió el id_permiso
            if (isset($input['id_permiso'])) {
                $id = $input['id_permiso'];
                $controller->eliminarPermiso($id);
            } else {
                echo json_encode(['error' => 'ID de permiso no proporcionado']);
            }
            break;
            
        default:
            echo json_encode(['error' => 'Acción no válida']);
            break;
    }
} catch (Exception $e) {
    echo json_encode(['error' => $e->getMessage()]);
}
