<?php
include "conexion.php";

// Consulta SQL para obtener la lista de miembros
$sql_miembros = "SELECT m.*, u.nombre AS nombre_usuario, p.num_proyecto, t.nombre AS nombre_tarea 
                 FROM miembros m 
                 LEFT JOIN usuarios u ON m.usuario_id = u.id 
                 LEFT JOIN proyectos p ON m.num_proyecto_asignado = p.id 
                 LEFT JOIN tareas t ON m.tarea_id = t.id";
$resultado_miembros = $conn->query($sql_miembros);

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $miembro_id = $_POST["miembro_id"];

    // Eliminar miembro de la tabla miembros
    $sql_eliminar = "DELETE FROM miembros WHERE id=?";
    $stmt = $conn->prepare($sql_eliminar);
    $stmt->bind_param("i", $miembro_id);
    if ($stmt->execute()) {
        header("Location: miembros.php");
        exit();
    } else {
        $error_message = "Error al eliminar el miembro: " . $conn->error;
    }
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Eliminar Miembro</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
<?php include "menu.php" ?>

    <h1>Eliminar Miembro</h1>
    <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
        <label for="miembro_id">Selecciona un Miembro:</label>
        <select id="miembro_id" name="miembro_id">
            <?php while ($row = $resultado_miembros->fetch_assoc()) { ?>
                <option value="<?php echo $row["id"]; ?>"><?php echo $row["nombre_usuario"]; ?></option>
            <?php } ?>
        </select><br>
        <input type="submit" value="Eliminar Miembro">
    </form>
    <?php if (isset($error_message)) { ?>
        <p><?php echo $error_message; ?></p>
    <?php } ?>

    <?php include "pie.php";?>
</body>
</html>
