<?php
include "conexion.php";

$sql = "SELECT m.*, u.nombre AS nombre_usuario, u.especialidad_id, e.nombre AS nombre_especialidad, p.num_proyecto, t.nombre AS nombre_tarea 
        FROM miembros m 
        LEFT JOIN usuarios u ON m.usuario_id = u.id 
        LEFT JOIN especialidades e ON u.especialidad_id = e.id 
        LEFT JOIN proyectos p ON m.num_proyecto_asignado = p.id 
        LEFT JOIN tareas t ON m.tarea_id = t.id";
$resultado = $conn->query($sql);
$cont = 0;
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Lista de Miembros</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
<?php include "menu.php" ?>

   
<h1>Lista de Miembros</h1>
<a href="miembros_crear.php" class="action-link">Crear Miembro</a>
<a href="miembros_editar.php" class="action-link">Editar Miembro</a>
<a href="miembros_eliminar.php" class="action-link">Eliminar Miembro</a>
<table class="styled-table">
    <thead>
        <tr>
            <th>ID</th>
            <th>Nombre de Usuario</th>
            <th>Especialidad</th>
            <th>Número de Proyecto Asignado</th>
            <th>Tarea Asignada</th>
            <th>Horas Trabajadas</th>
        </tr>
    </thead>
    <tbody>
        <?php
        while($fila = $resultado->fetch_assoc()): 
            $cont++;
        ?>
            <tr>
                <td><?php echo $cont; ?></td>
                <td><?php echo $fila['nombre_usuario']; ?></td>
                <td><?php echo $fila['nombre_especialidad']; ?></td>
                <td><?php echo $fila['num_proyecto']; ?></td>
                <td><?php echo $fila['nombre_tarea']; ?></td>
                <td><?php echo $fila['horas_trabajadas']; ?></td>
            </tr>
        <?php endwhile; ?>
    </tbody>
</table>


<?php include "pie.php";?>
</body>
</html>
