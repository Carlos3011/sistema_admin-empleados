<!-- Sidebar -->
<div class="bg-black text-white" id="sidebar-wrapper">
    <div class="sidebar-heading text-center py-4 fs-4 fw-bold text-truncate">
        <i class="fas fa-tools me-2"></i><span class="sidebar-text">SCA</span>
    </div>
    <div class="list-group list-group-flush">
        <a href="/sistema-asistencia/public/index.php?page=tablero" class="list-group-item list-group-item-action bg-transparent text-white">
            <i class="fas fa-tachometer-alt me-3"></i><span class="sidebar-text">Tablero</span>
        </a>
        <a href="/sistema-asistencia/public/index.php?page=gestor" class="list-group-item list-group-item-action bg-transparent text-white">
            <i class="fas fa-users me-3"></i>Gestión de Empleados
        </a>
        <a href="/sistema-asistencia/public/index.php?page=turnos-laborales" class="list-group-item list-group-item-action bg-transparent text-white">
            <i class="fas fa-calendar-check me-3"></i>Turnos Laborales
        </a>
        <a href="/sistema-asistencia/public/index.php?page=asistencia" class="list-group-item list-group-item-action bg-transparent text-white">
            <i class="fas fa-list-alt me-3"></i>Asistencias
        </a>
        <a href="/sistema-asistencia/public/index.php?page=permisos" class="list-group-item list-group-item-action bg-transparent text-white">
            <i class="fas fa-file-alt me-3"></i>Permisos
        </a>
        <a href="/sistema-asistencia/public/index.php?page=cerrar-sesion" class="list-group-item list-group-item-action bg-transparent text-danger mt-auto">
            <i class="fas fa-sign-out-alt me-3"></i><span class="sidebar-text">Cerrar Sesión</span>
        </a>
    </div>
</div>
<!-- /#sidebar-wrapper -->

<style>
.list-group-item-action:hover {
    background-color: rgba(255, 255, 255, 0.1) !important;
    color: white !important;
}

#sidebar-wrapper {
    min-height: 100vh;
    box-shadow: 2px 0 5px rgba(0,0,0,0.1);
}
</style>