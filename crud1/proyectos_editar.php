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
    
    $sql = "SELECT * FROM proyectos WHERE id = ?";

    $stmt = $conn->prepare($sql);

    $stmt->bind_param("s", $id);

    $stmt->execute();

    $busqueda = $stmt->get_result();

    if($busqueda->num_rows > 0){
        $row = $busqueda->fetch_assoc();
        $num_proyecto=$row["num_proyecto"];
        $nombre= $row["nombre"];
        $f_i = $row["fecha_inicio"];
        $f_f = $row["fecha_fin"];
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

<h1>Editar Proyecto</h1>
<form action="proyectos_editar2.php" method="POST">
    <input type="hidden" id="id" name="id" value="<?php echo $id; ?>">
    <div class="form-group">
        <label for="num_proyecto">Número del Proyecto</label>
        <input type="text" id="num_proyecto" name="num_proyecto" placeholder="Número del proyecto" value="<?php echo $num_proyecto ?>">
    </div>
    <div class="form-group">
        <label for="proyecto">Nombre del Proyecto</label>
        <input type="text" id="proyecto" name="proyecto" placeholder="Nombre del proyecto" value="<?php echo $nombre ?>">
    </div>
    <div class="form-group">
        <label for="f_i">Fecha de Inicio</label>
        <input type="datetime-local" id="f_i" name="f_i" value="<?php echo $f_i ?>">
    </div>
    <div class="form-group">
        <label for="f_f">Fecha Final</label>
        <input type="datetime-local" id="f_f" name="f_f" value="<?php echo $f_f ?>">
    </div>
    <button type="submit" class="submit-button">Guardar Cambios</button>
</form>


    <a href="tareas_eliminar.php?id=<?php echo $id; ?>" class="delete-link" style="margin-right: 35%; margin-left: 35%;">eliminar</a>
</body>
</html>