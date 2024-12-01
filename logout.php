<?php
// archivo: logout.php
session_destroy(); // Destruye la sesión actual

// Opcional: Elimina cookies relacionadas con la sesión
if (ini_get("session.use_cookies")) {
    $params = session_get_cookie_params();
    setcookie(session_name(), '', time() - 42000,
        $params["path"], $params["domain"],
        $params["secure"], $params["httponly"]
    );
}

// Redirigir al usuario (por ejemplo, al login o página principal)
header("Location: public");
exit();
