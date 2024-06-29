<?php
include "conexion.php";


if (isset($_POST["nombre"])) {
    $nombre = $_POST["nombre"];
    
    $sql = "INSERT INTO tareas(nombre)
            VALUES (?)";

    $stmt = $conn->prepare($sql);
    $stmt->bind_param("s",$nombre);

    if ($stmt->execute()) {
        echo "<script> alert('Se creo la tarea correctamente');</script>";
        header("Location: tareas.php");
        exit;
    } else {
        echo "<script>alert('Error al agregar la tarea: " . $conn->error ."');</script>";
    }
    $stmt->close();
}

?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Agregar Tarea</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>

<?php include "menu.php" ?>
    
<h1>Agregar Tarea</h1>
<form action="tareas_crear.php" method="POST">
    <div class="form-group">
        <label for="nombre">Nombre de la tarea:</label>
        <input type="text" id="nombre" name="nombre" placeholder="Tarea">
    </div>
    <button type="submit" class="submit-button">Agregar Tarea</button>
</form>

<?php include "pie.php";?>
</body>
</html>
