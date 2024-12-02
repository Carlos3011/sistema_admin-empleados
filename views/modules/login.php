<div class="container d-flex justify-content-center align-items-center vh-100">
    <div class="card shadow-lg p-4" style="width: 100%; max-width: 400px;">
        <div class="text-center mb-4">
            <h4 class="text-primary fw-bold">Iniciar Sesión</h4>
            <p class="text-muted">Ingrese sus credenciales para continuar</p>
        </div>
        <div id="alert-messages"></div>
        <form id="login-form">
            <div class="mb-3">
                <label for="correo" class="form-label">Correo Electrónico</label>
                <div class="input-group">
                    <span class="input-group-text"><i class="fas fa-envelope"></i></span>
                    <input type="email" class="form-control" id="correo" name="correo" 
                           placeholder="ejemplo@correo.com" required>
                </div>
            </div>
            <div class="mb-3">
                <label for="password" class="form-label">Contraseña</label>
                <div class="input-group">
                    <span class="input-group-text"><i class="fas fa-lock"></i></span>
                    <input type="password" class="form-control" id="password" name="password" 
                           placeholder="Ingrese su contraseña" required>
                    <button class="btn btn-outline-secondary" type="button" id="togglePassword">
                        <i class="fas fa-eye"></i>
                    </button>
                </div>
            </div>
            <button type="submit" class="btn btn-primary w-100 mb-3">
                <i class="fas fa-sign-in-alt me-2"></i>Iniciar Sesión
            </button>
        </form>
    </div>
</div>

<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
<script src="../AJAX/ajax-login.js"></script>

<script>
document.getElementById('togglePassword').addEventListener('click', function() {
    const passwordInput = document.getElementById('password');
    const icon = this.querySelector('i');
    
    if (passwordInput.type === 'password') {
        passwordInput.type = 'text';
        icon.classList.remove('fa-eye');
        icon.classList.add('fa-eye-slash');
    } else {
        passwordInput.type = 'password';
        icon.classList.remove('fa-eye-slash');
        icon.classList.add('fa-eye');
    }
});
</script>
