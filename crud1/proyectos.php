<?php
include "conexion.php";

$sql = "SELECT * FROM proyectos ";

$stmt = $conn->prepare($sql);
$stmt->execute();
$busqueda = $stmt->get_result();

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Proyectos</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
<?php include "menu.php"; ?>


<h1>Lista de Proyectos</h1>
<a href="proyectos_crear.php" class="action-link">Agregar proyectos</a>
<table class="styled-table">
    <thead>
        <tr>
            <th>Numero Proyecto</th>
            <th>Nombre del proyecto</th>
            <th>Lista de Miembros</th>
            <th>Fecha Inicio</th>
            <th>Fecha Final</th>
            <th>Acciones</th>
        </tr>
    </thead>
    <tbody>
        <?php while($fila = $busqueda->fetch_assoc()): 
            $num=$fila["num_proyecto"];?>
            <tr>
                <td><?php echo $num; ?></td>
                <td><?php echo $fila['nombre']; ?></td>
                <td><a href="miembros_propios.php?nump=<?php echo $num;?>" class="action-link">Miembros del proyecto</a></td>
                <td><?php echo $fila['fecha_inicio']; ?></td>
                <td><?php echo $fila['fecha_fin']; ?></td>
                <td>
                    <a href="proyectos_editar.php?id=<?php echo $fila["id"]; ?>" class="edit-link">Editar</a>
                    <a href="proyectos_eliminar.php?id=<?php echo $fila["id"]; ?>" class="delete-link">Eliminar</a>
                </td>
            </tr>
        <?php endwhile; ?>
    </tbody>
</table>

<?php include "pie.php";?>
</body>
</html>