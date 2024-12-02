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
                } else if (result.role == 2) {
                    // Redirigir al servidor Python para empleados
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