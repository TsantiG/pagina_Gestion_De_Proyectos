<?php
include "conexion.php";
session_start();
if(isset($_SESSION["id"])){

}else{
    header("Location:login.php");
    exit;
}

if(isset($_GET["id"])){

    $id = $_GET["id"];
    
    $sql = "SELECT * FROM tareas WHERE id = ?";

    $stmt = $conn->prepare($sql);

    $stmt->bind_param("s", $id);

    $stmt->execute();

    $busqueda = $stmt->get_result();

    if($busqueda->num_rows > 0){
        $row = $busqueda->fetch_assoc();
        $nombre_1= $row["nombre"];
    }else{
        echo "<script>alert('No se encontró la tarea con el ID proporcionado');</script>";
        exit;
    }

    $stmt->close();

}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Actualizar</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>

<form action="tareas_editar_2.php" method="POST">
    <input type="hidden" id="id" name="id" value="<?php echo $id; ?>">
    <div class="form-group">
        <label for="tarea">Nombre de la Tarea</label>
        <input type="text" id="tarea" name="tarea" placeholder="Tarea" value="<?php echo $nombre_1 ?>">
    </div>
    <button type="submit" class="submit-button">Guardar Cambios</button>
</form>

<a href="tareas_eliminar.php?id=<?php echo $id; ?>" class="delete-link" style="margin-right: 35%; margin-left: 35%;">Eliminar</a>

</body>
</html>