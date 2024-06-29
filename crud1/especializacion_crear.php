<?php
include "conexion.php";

if (isset($_POST["nombre"])) {
    $nombre = $_POST["nombre"];
    
    $sql = "INSERT INTO especialidades(nombre)
            VALUES (?)";

    $stmt = $conn->prepare($sql);
    $stmt->bind_param("s",$nombre);

    if ($stmt->execute()) {
        echo "<script> alert('Se creo la tarea correctamente');</script>";
        header("Location: especializacion.php");
        exit;
    } else {
        echo "<script>alert('Error al agregar la especialización: " . $conn->error ."');</script>";
    }

    $stmt->close();
}

?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Agregar especializacion</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <?php include "menu.php";?>
    
    <h1>Agregar Especializacion</h1>
    <form action="especializacion_crear.php" method="POST">
    <div class="form-group">
        <label for="nombre">Nombre de la especialización:</label>
        <input type="text" id="nombre" name="nombre" placeholder="Especialización.">
    </div>
    <button type="submit" class="submit-button">Agregar Especialización</button>
    
</form>

<?php include "pie.php";?>
</body>
</html>
