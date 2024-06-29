<?php
include "conexion.php";
if(!isset($_SESSION["id"]) && !isset($_SESSION["nombre_u"])){
// Verificar si se han enviado los datos del formulario antes de acceder a ellos
    if(isset($_POST["n_usuario"]) && isset($_POST["contraseña"])) { 
        $nombre = $_POST["n_usuario"];
        $contraseña = $_POST["contraseña"];

        // Preparar la consulta SQL con una sentencia preparada
        $sql = "SELECT id, nombre, contraseña FROM usuarios WHERE nombre = ? AND contraseña = ?";
        $stmt = $conn->prepare($sql);

        // Vincular parámetros
        $stmt->bind_param("ss", $nombre, $contraseña);

        // Ejecutar la consulta
        $stmt->execute();

        // Obtener el resultado de la consulta
        $resultado = $stmt->get_result();

        // Verificar si se encontraron filas
        if($resultado->num_rows > 0) {
            // Iniciar sesión
            session_start();
            $row = $resultado->fetch_assoc();
            $_SESSION["id"] = $row["id"];
            $_SESSION["nombre_u"] = $nombre;
            $_SESSION["contraseña"] = $contraseña;
            header("Location: index.php");
        } else {
            header("Location: login.php");
        }

        // Cerrar la sentencia preparada
        $stmt->close();
    }
}else{
    header("Location: index.php");
    exit;
}
$conn->close();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    
<h1>Inicia sesion</h1>
<form action="login.php" method="POST">
    <div class="form-group">
        <label for="n_usuario">Nombre de Usuario</label>
        <input type="text" id="n_usuario" name="n_usuario" placeholder="Usuario">
    </div>
    <div class="form-group">
        <label for="contraseña">Contraseña</label>
        <input type="password" id="contraseña" name="contraseña" placeholder="Password">
    </div>
    <button type="submit" class="submit-button">Ingresar</button>
</form>

<a href="login_crear.php" class="create-account-link">Agregar usuario</a>


    
</body>
</html>