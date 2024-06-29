<?php
include "conexion.php";


$sql = "SELECT * FROM tareas";
$resultado = $conn->query($sql);
$cont = 0;
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Lista de Tareas</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
<?php include "menu.php" ?>

   
<h1>Lista de Tareas</h1>
<a href="tareas_crear.php" class="action-link">Crear</a>
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
            $cont++; ?>
            <tr>
                <td><?php echo $cont; ?></td>
                <td><?php echo $fila['nombre']; ?></td>
                <td>
                    <a href="tareas_editar.php?id=<?php echo $fila["id"]; ?>" class="edit-link">Editar</a>
                    <a href="tareas_eliminar.php?id=<?php echo $fila["id"]; ?>" class="delete-link">Eliminar</a>
                </td>
            </tr>
        <?php endwhile; ?>
    </tbody>
</table>

<?php include "pie.php";?>
</body>
</html>
