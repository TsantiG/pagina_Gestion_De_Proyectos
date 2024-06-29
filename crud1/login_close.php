<?php
session_start();

session_unset();

// Borrar la cookie de sesión
if (ini_get("session.use_cookies")) {
    $params = session_get_cookie_params();
    setcookie(session_name(), '', time() - 42000,
        $params["path"], $params["domain"],
        $params["secure"], $params["httponly"]
    );
}

session_destroy();

echo "<script>alert('Se ha cerrado sesion.');</script>";
header("Location: login.php");
exit;
?>