<?php
include "conexion.php";

session_start();
if(isset($_SESSION["id"])) {
    $id = $_SESSION["id"];
} else {
    header("Location:login.php");
    exit;
}

if(isset($_POST["n_usuario"]) && isset($_POST["email"]) && isset($_POST["telefono"]) && isset($_POST["contraseña"]) && isset($_POST["especialidad"])) {
    $nombre_1 = $_POST["n_usuario"];
    $email_1 = $_POST["email"];
    $telefono_1 = $_POST["telefono"];
    $contraseña_1 = $_POST["contraseña"];
    $especialidad_id = $_POST["especialidad"];

    // Preparar la consulta SQL con una sentencia preparada
    $sql = "UPDATE usuarios SET nombre=?, email=?, telefono=?, contraseña=?, especialidad_id=? WHERE id=?";

    $stmt = $conn->prepare($sql);

    // Vincular parámetros
    $stmt->bind_param("ssssii", $nombre_1, $email_1, $telefono_1, $contraseña_1, $especialidad_id, $id);

    // Ejecutar la consulta
    if($stmt->execute()) {
        echo "<script>alert('Se ha actualizado el usuario de forma correcta');</script>";
        header("Location: index.php");
        exit;
    } else {
        echo "<script>alert('Hubo un error al actualizar: " . $conn->error ."');</script>";
        header("Location: login_actualizar.php");
        exit;
    }

    // Cerrar la sentencia preparada
    $stmt->close();
}

$conn->close();
?>
