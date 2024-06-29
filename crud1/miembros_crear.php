<?php
include "conexion.php";

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
    $usuario_id = $_POST["usuario_id"];
    $num_proyecto_asignado = $_POST["num_proyecto_asignado"];
    $tarea_id = $_POST["tarea_id"];
    $horas_trabajadas = $_POST["horas_trabajadas"];

    // Insertar nuevo miembro en la tabla miembros
    $sql_insertar = "INSERT INTO miembros (usuario_id, num_proyecto_asignado, tarea_id, horas_trabajadas) 
                     VALUES (?, ?, ?, ?)";
    $stmt = $conn->prepare($sql_insertar);
    $stmt->bind_param("iiii", $usuario_id, $num_proyecto_asignado, $tarea_id, $horas_trabajadas);
    if ($stmt->execute()) {
        header("Location: miembros.php");
        exit();
    } else {
        $error_message = "Error al crear el miembro: " . $conn->error;
    }
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Crear Miembro</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
<?php include "menu.php" ?>

    <h1>Crear Nuevo Miembro</h1>
    <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
        <div class="form-group">
            <label for="usuario_id">Usuario:</label>
            <select id="usuario_id" name="usuario_id">
                <?php while ($row = $resultado_usuarios->fetch_assoc()) { ?>
                    <option value="<?php echo $row["id"]; ?>"><?php echo $row["nombre"]; ?></option>
                <?php } ?>
            </select>
        </div>
        <div class="form-group">
            <label for="num_proyecto_asignado">Número de Proyecto Asignado:</label>
            <select id="num_proyecto_asignado" name="num_proyecto_asignado">
                <?php while ($row = $resultado_proyectos->fetch_assoc()) { ?>
                    <option value="<?php echo $row["id"]; ?>"><?php echo $row["num_proyecto"]; ?></option>
                <?php } ?>
            </select>
        </div>
        <div class="form-group">
            <label for="tarea_id">Tarea Asignada:</label>
            <select id="tarea_id" name="tarea_id">
                <?php while ($row = $resultado_tareas->fetch_assoc()) { ?>
                    <option value="<?php echo $row["id"]; ?>"><?php echo $row["nombre"]; ?></option>
                <?php } ?>
            </select>
        </div>
        <div class="form-group">
            <label for="horas_trabajadas">Horas Trabajadas:</label>
            <input type="text" id="horas_trabajadas" name="horas_trabajadas">
        </div>
        <input type="submit" value="Crear Miembro" class="submit-button">
    </form>
    <?php if (isset($error_message)) { ?>
        <p class="error-message"><?php echo $error_message; ?></p>
    <?php } ?>

    <?php include "pie.php";?>
</body>
</html>
