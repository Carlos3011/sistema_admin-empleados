<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sistema de Control</title>
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Iconos de FontAwesome -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet">
    <!-- Estilos personalizados -->
    <link rel="stylesheet" href="styles.css">
    <!-- DataTables CSS -->
    <link rel="stylesheet" href="https://cdn.datatables.net/1.13.4/css/jquery.dataTables.min.css">
    <!-- DataTables Responsive CSS -->
    <link rel="stylesheet" href="https://cdn.datatables.net/responsive/2.4.1/css/responsive.dataTables.min.css">
    <!-- SweetAlert2 -->
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
</head>

<body>
    <?php
    session_start();

    // Manejo de rutas y autenticación
    $page = isset($_GET['page']) ? $_GET['page'] : 'login';

    if ($page === 'cerrar-sesion') {
        // Cerrar sesión
        session_destroy();
        header("Location: index.php?page=login");
        exit();
    }

    if (!isset($_SESSION['id_empleado']) || !isset($_SESSION['id_rol'])) {
        // Si no está autenticado, mostrar login
        if ($page === 'login') {
            include '../views/modules/login.php';
        } else {
            header("Location: index.php?page=login");
            exit();
        }
    } else {
        // Si está autenticado, mostrar contenido según el rol
        ?>
        <div class="d-flex" id="wrapper">
            <?php 
            // Incluir el sidebar según el rol del usuario
            if ($_SESSION['id_rol'] == 1) {
                include '../views/sidebar.php'; // Sidebar para administrador
            } elseif($_SESSION['id_rol'] == 2) {
                include '../views/modules/empleados/sidebar.php'; // Sidebar para empleado // Sidebar para roles no reconocidos
            }
            ?>

            <!-- Contenido dinámico -->
            <div id="page-content-wrapper">
                <?php
                if ($_SESSION['id_rol'] == 1) {
                    // Rutas del administrador
                    switch ($page) {
                        case 'tablero':
                            include '../views/modules/tablero.php';
                            break;
                        case 'gestor':
                            include '../views/modules/gestor-empleados.php';
                            break;
                        case 'turnos-laborales':
                            include '../views/modules/turnos.php';
                            break;
                        case 'asistencia':
                            include '../views/modules/asistencia.php';
                            break;
                        case 'permisos':
                            include '../views/modules/permisos.php';
                            break;
                        default:
                            include '../views/modules/tablero.php'; // Página predeterminada
                            break;
                    }
                } elseif ($_SESSION['id_rol'] == 2) {
                    // Rutas del empleado
                    switch ($page) {
                        case 'asistencia':
                            include '../views/modules/empleados/asistencia.php';
                            break;
                        case 'permisos':
                            include '../views/modules/empleados/permisos.php';
                            break;
                        default:
                            include '../views/modules/empleados/asistencia.php'; // Página predeterminada
                            break;
                    }
                }else {
                    include '../views/modules/404.php'; // Página de error
                }
                ?>
            </div>
        </div>
        <?php
    }
    ?>

    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
    <!-- Chart.js -->
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <!-- jQuery (necesario para DataTables) -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <!-- DataTables JS -->
    <script src="https://cdn.datatables.net/1.13.4/js/jquery.dataTables.min.js"></script>
    <!-- DataTables Responsive JS -->
    <script src="https://cdn.datatables.net/responsive/2.4.1/js/dataTables.responsive.min.js"></script>
    <script>
        // Toggle sidebar
        document.getElementById('menu-toggle').addEventListener('click', function () {
            var sidebar = document.getElementById('sidebar-wrapper');
            var content = document.getElementById('content-wrapper');
            sidebar.classList.toggle('hidden');
            content.classList.toggle('expanded');
        });
    </script>
</body>

</html>