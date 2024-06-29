<?php
include "conexion.php";


$sql = "SELECT * FROM especialidades";
$resultado = $conn->query($sql);
$cont = 0;
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Lista de Especializaciones</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
<?php include "menu.php" ?>

<h1>Lista de Especializaciones</h1>
<a href="especializacion_crear.php" class="create-link">Crear</a>
<table class="styled-table">
    <thead>
        <tr>
            <th>ID</th>
            <th>Nombre</th>
            <th>Acciones</th>
        </tr>
    </thead>
    <tbody>
        <?php while($fila = $resultado->fetch_assoc()): 
            $cont = $cont + 1; ?>
            <tr>
                <td><?php echo $cont; ?></td>
                <td><?php echo $fila['nombre']; ?></td>
                <td>
                    <a href="especializacion_editar.php?id=<?php echo $fila["id"]; ?>" class="edit-link">Editar</a>
                    <a href="especializacion_eliminar.php?id=<?php echo $fila["id"]; ?>" class="delete-link">Eliminar</a>
                </td>
            </tr>
        <?php endwhile; ?>
    </tbody>
</table>

<?php include "pie.php";?>

</body>
</html>
