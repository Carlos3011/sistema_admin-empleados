
<div class="container d-flex justify-content-center align-items-center vh-100">
    <div class="card shadow p-4" style="width: 100%; max-width: 400px;">
        <div class="text-center mb-4">
            <h4 class="text-primary">Iniciar Sesión</h4>
            <p class="text-muted">Ingrese sus credenciales para continuar</p>
        </div>
        <form id="login-form">
            <div class="mb-3">
                <label for="correo" class="form-label">Correo Electrónico</label>
                <input type="email" class="form-control" id="correo" name="correo" required>
            </div>
            <div class="mb-3">
                <label for="password" class="form-label">Contraseña</label>
                <input type="password" class="form-control" id="password" name="password" required>
            </div>
            <button type="submit" class="btn btn-primary w-100">Iniciar Sesión</button>
        </form>
    </div>
</div>

<script>
document.getElementById("login-form").addEventListener("submit", async function(e) {
    e.preventDefault();
    const formData = new FormData(this);

    try {
        const response = await fetch('../data/auth_data.php?action=login', {
            method: 'POST',
            body: formData
        });
        const result = await response.json();

        if (result.success) {
            Swal.fire({
                title: 'Éxito',
                text: 'Inicio de sesión exitoso.',
                icon: 'success',
                timer: 1500,
                showConfirmButton: false
            }).then(() => {
                if (result.role == 1) {
                    // Administrador
                    window.location.href = 'index.php?page=tablero';
                } else {
                    // Empleado, redirigir al servidor Python
                    window.location.href = `http://localhost:5000/asistencia?token=${result.auth_token}`;
                }
            });
        } else {
            Swal.fire({
                title: 'Error',
                text: result.message || 'Credenciales incorrectas.',
                icon: 'error'
            });
        }
    } catch (error) {
        console.error('Error al iniciar sesión:', error);
        Swal.fire({
            title: 'Error',
            text: 'No se pudo conectar al servidor.',
            icon: 'error'
        });
    }
});

</script>
