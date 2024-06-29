<?php
include "conexion.php";


if (isset($_POST["nombre"])) {
    $num_proyecto=$_POST["num_proyecto"];
    $nombre = $_POST["nombre"];
    $f_i = $_POST["f_i"];
    $f_f = $_POST["f_f"];

    $sql = "INSERT INTO proyectos (num_proyecto,nombre, fecha_inicio,fecha_fin)
            VALUES (?,?,?,?)";

    $stmt = $conn->prepare($sql);
    $stmt->bind_param("ssss",$num_proyecto, $nombre, $f_i, $f_f);

    if ($stmt->execute()) {
        echo "<script> alert('Se creo el proyecto correctamente');</script>";
        header("Location: proyectos.php");
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
    <title>Agregar Proyecto</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>

<?php include "menu.php" ?>

<h1>Agregar Proyecto</h1>
<form action="proyectos_crear.php" method="POST">
    <div class="form-group">
        <label for="num_proyecto">Número del Proyecto:</label>
        <input type="text" id="num_proyecto" name="num_proyecto" placeholder="Proyecto">
    </div>
    <div class="form-group">
        <label for="nombre">Nombre del Proyecto:</label>
        <input type="text" id="nombre" name="nombre" placeholder="Proyecto">
    </div>
    <div class="form-group">
        <label for="f_i">Fecha de Inicio:</label>
        <input type="datetime-local" id="f_i" name="f_i">
    </div>
    <div class="form-group">
        <label for="f_f">Fecha Final:</label>
        <input type="datetime-local" id="f_f" name="f_f">
    </div>
    <button type="submit" class="submit-button">Agregar Proyecto</button>
</form>

<?php include "pie.php";?>
</body>
</html>