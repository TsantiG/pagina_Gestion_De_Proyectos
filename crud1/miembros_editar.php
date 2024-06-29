<?php
include "conexion.php";

// Consulta SQL para obtener la lista de miembros
$sql_miembros = "SELECT m.*, u.nombre AS nombre_usuario, p.num_proyecto, t.nombre AS nombre_tarea 
                 FROM miembros m 
                 LEFT JOIN usuarios u ON m.usuario_id = u.id 
                 LEFT JOIN proyectos p ON m.num_proyecto_asignado = p.id 
                 LEFT JOIN tareas t ON m.tarea_id = t.id";
$resultado_miembros = $conn->query($sql_miembros);

// Consulta SQL para obtener la lista de usuarios
$sql_usuarios = "SELECT id, nombre FROM usuarios";
$resultado_usuarios = $conn->query($sql_usuarios);

// Consulta SQL para obtener la lista de proyectos
$sql_proyectos = "SELECT id, num_proyecto FROM proyectos";
$resultado_proyectos = $conn->query($sql_proyectos);

// Consulta SQL para obtener la lista de tareas
$sql_tareas = "SELECT id, nombre FROM tareas";
$resultado_tareas = $conn->query($sql_tareas);

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $miembro_id = $_POST["miembro_id"];
    $usuario_id = $_POST["usuario_id"];
    $num_proyecto_asignado = $_POST["num_proyecto_asignado"];
    $tarea_id = $_POST["tarea_id"];
    $horas_trabajadas = $_POST["horas_trabajadas"];

    // Actualizar miembro en la tabla miembros
    $sql_actualizar = "UPDATE miembros 
                       SET usuario_id=?, num_proyecto_asignado=?, tarea_id=?, horas_trabajadas=? 
                       WHERE id=?";
    $stmt = $conn->prepare($sql_actualizar);
    $stmt->bind_param("iiiii", $usuario_id, $num_proyecto_asignado, $tarea_id, $horas_trabajadas, $miembro_id);
    if ($stmt->execute()) {
        header("Location: miembros.php");
        exit();
    } else {
        $error_message = "Error al actualizar el miembro: " . $conn->error;
    }
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Editar Miembro</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
<?php include "menu.php" ?>

    <h1>Editar Miembro</h1>
    <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
        <label for="miembro_id">Selecciona un Miembro:</label>
        <select id="miembro_id" name="miembro_id">
            <?php while ($row = $resultado_miembros->fetch_assoc()) { ?>
                <option value="<?php echo $row["id"]; ?>"><?php echo $row["nombre_usuario"]; ?></option>
            <?php } ?>
        </select><br>
        <label for="usuario_id">Usuario:</label>
        <select id="usuario_id" name="usuario_id">
            <?php while ($row = $resultado_usuarios->fetch_assoc()) { ?>
                <option value="<?php echo $row["id"]; ?>"><?php echo $row["nombre"]; ?></option>
            <?php } ?>
        </select><br>
        <label for="num_proyecto_asignado">Número de Proyecto Asignado:</label>
        <select id="num_proyecto_asignado" name="num_proyecto_asignado">
            <?php while ($row = $resultado_proyectos->fetch_assoc()) { ?>
                <option value="<?php echo $row["id"]; ?>"><?php echo $row["num_proyecto"]; ?></option>
            <?php } ?>
        </select><br>
        <label for="tarea_id">Tarea Asignada:</label>
        <select id="tarea_id" name="tarea_id">
            <?php while ($row = $resultado_tareas->fetch_assoc()) { ?>
                <option value="<?php echo $row["id"]; ?>"><?php echo $row["nombre"]; ?></option>
            <?php } ?>
        </select><br>
        <label for="horas_trabajadas">Horas Trabajadas:</label>
        <input type="text" id="horas_trabajadas" name="horas_trabajadas"><br>
        <input type="submit" value="Actualizar Miembro">
    </form>
    <?php if (isset($error_message)) { ?>
        <p><?php echo $error_message; ?></p>
    <?php } ?>

    <?php include "pie.php";?>
</body>
</html>
