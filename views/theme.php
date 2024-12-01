<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>SCA</title>
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Iconos de FontAwesome -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet">
    <style>
        body {
            overflow-x: hidden;
        }

        #sidebar-wrapper {
            min-width: 250px;
            max-width: 250px;
            height: 100vh;
        }

        #page-content-wrapper {
            width: 100%;
        }

        @media (max-width: 768px) {
            #sidebar-wrapper {
                display: none;
            }

            #sidebar-wrapper.show {
                display: block;
                position: absolute;
                z-index: 1000;
                background: #343a40;
                width: 250px;
                height: 100vh;
            }
        }

        #menu-toggle {
            border: none;
            background: none;
        }
    </style>
</head>

<body>
    <div class="d-flex" id="wrapper">
        <!-- Sidebar -->
        <div class="bg-dark text-white" id="sidebar-wrapper">
            <div class="sidebar-heading text-center py-4 primary-text fs-4 fw-bold border-bottom">
                <i class="fas fa-tools me-2"></i>SCA
            </div>
            <div class="list-group list-group-flush my-3">
                <a href="#" class="list-group-item list-group-item-action bg-transparent text-white active">
                    <i class="fas fa-tachometer-alt me-2"></i>Dashboard
                </a>
                <a href="#" class="list-group-item list-group-item-action bg-transparent text-white">
                    <i class="fas fa-users me-2"></i>Gestión de Empleados
                </a>
                <a href="#" class="list-group-item list-group-item-action bg-transparent text-white">
                    <i class="fas fa-calendar-check me-2"></i>Turnos Laborales
                </a>
                <a href="#" class="list-group-item list-group-item-action bg-transparent text-white">
                    <i class="fas fa-list-alt me-2"></i>Asistencia
                </a>
                <a href="#" class="list-group-item list-group-item-action bg-transparent text-white">
                    <i class="fas fa-file-alt me-2"></i>Permisos
                </a>
                <a href="#" class="list-group-item list-group-item-action bg-transparent text-white">
                    <i class="fas fa-sign-out-alt me-2"></i>Cerrar Sesión
                </a>
            </div>
        </div>
        <!-- /#sidebar-wrapper -->

        <!-- Page Content -->
        <div id="page-content-wrapper">
            <nav class="navbar navbar-expand-lg navbar-light bg-light border-bottom">
                <div class="container-fluid">
                    <button id="menu-toggle" class="btn">
                        <i class="fas fa-bars"></i>
                    </button>
                    <h3 class="ms-3">Título de la Página</h3>
                </div>
            </nav>

            <div class="container-fluid px-4 mt-4">
                <!-- Contenido dinámico aquí -->
                <div class="row">
                    <div class="col">
                        <p class="text-muted">Aquí puedes agregar tu contenido...</p>
                    </div>
                </div>
            </div>
        </div>
        <!-- /#page-content-wrapper -->

        <!-- Footer -->
        <footer class="bg-dark text-white text-center py-3 w-100">
            <div class="container">
                <p class="mb-0">© 2023 Tu Empresa. Todos los derechos reservados.</p>
            </div>
        </footer>
        <!-- /Footer -->

    </div>
    <!-- /#wrapper -->

    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        // Toggle sidebar
        document.getElementById("menu-toggle").addEventListener("click", function () {
            const sidebar = document.getElementById("sidebar-wrapper");
            sidebar.classList.toggle("show");
        });
    </script>
</body>

</html>
