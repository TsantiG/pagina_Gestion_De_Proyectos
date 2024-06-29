<?php
include "conexion.php";

if(isset($_GET["id"])){

    $id = $_GET["id"];
    echo "ID obtenido de la URL: ";
    $sql = "SELECT * FROM especialidades WHERE id = ?";

    $stmt = $conn->prepare($sql);

    $stmt->bind_param("s", $id);

    $stmt->execute();

    $busqueda = $stmt->get_result();

    if($busqueda->num_rows > 0){
        $row = $busqueda->fetch_assoc();
        $nombre_1= $row["nombre"];
    }else{
        echo "<script>alert('No se encontró la especializacion con el ID proporcionado');</script>";
        exit;
    }

   

}
 $stmt->close();
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
<?php include "menu.php";?>

<h1>Editar Especialización</h1>
<form action="especializacion_editar_2.php" method="POST">
    <input id="id" name="id" type="hidden" value="<?php echo $id; ?>">
    <div class="form-group">
        <label for="especialidad">Nombre de la especialidad</label>
        <input id="especialidad" name="especialidad" type="text" placeholder="Especialidad" value="<?php echo $nombre_1?>">
    </div>
    <button type="submit" class="submit-button">Ingresar</button>
</form>

<a href="especializacion_eliminar.php?id=<?php echo $id; ?>" class="delete-link" style="margin-right: 35%; margin-left: 35%;">Eliminar</a>
<?php include "pie.php";?>
</body>
</html>