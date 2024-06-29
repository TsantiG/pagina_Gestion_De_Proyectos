<?php
include "conexion.php";

if(isset($_GET["nump"])){
    $num_proyecto_seleccionado = $_GET["nump"];

    // Consulta SQL para obtener el ID del proyecto basado en el número de proyecto seleccionado
    $sql_id_proyecto = "SELECT id FROM proyectos WHERE num_proyecto = ?";
    $stmt_id_proyecto = $conn->prepare($sql_id_proyecto);
    $stmt_id_proyecto->bind_param("s", $num_proyecto_seleccionado);
    $stmt_id_proyecto->execute();
    $resultado_id_proyecto = $stmt_id_proyecto->get_result();
    $row_id_proyecto = $resultado_id_proyecto->fetch_assoc();
    $id_proyecto_seleccionado = $row_id_proyecto["id"];
    $stmt_id_proyecto->close();

    // Consulta SQL para obtener la lista de miembros con el mismo número de proyecto asignado
    $sql_miembros = "SELECT m.*, u.nombre AS nombre_usuario, t.nombre AS nombre_tarea 
                    FROM miembros m 
                    LEFT JOIN usuarios u ON m.usuario_id = u.id 
                    LEFT JOIN tareas t ON m.tarea_id = t.id 
                    WHERE m.num_proyecto_asignado = ?";
    $stmt = $conn->prepare($sql_miembros);
    $stmt->bind_param("i", $id_proyecto_seleccionado);
    $stmt->execute();
    $resultado_miembros = $stmt->get_result();
    $stmt->close();
} else {
    echo "<script>alert('el id no se ha recibido');</script>";
}
?>


<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Lista de Miembros por Proyecto</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
<?php include "menu.php"; ?>


<h1>Lista de Miembros por Proyecto</h1>
<h2>Número de Proyecto: <?php echo $num_proyecto_seleccionado; ?></h2>
<table class="styled-table">
    <thead>
        <tr>
            <th>ID</th>
            <th>Nombre de Usuario</th>
            <th>Tarea Asignada</th>
            <th>Horas Trabajadas</th>
        </tr>
    </thead>
    <tbody>
        <?php
        $cont = 0;
        while ($row = $resultado_miembros->fetch_assoc()): 
            $cont++;
        ?>
            <tr>
                <td><?php echo $cont; ?></td>
                <td><?php echo $row['nombre_usuario']; ?></td>
                <td><?php echo $row['nombre_tarea']; ?></td>
                <td><?php echo $row['horas_trabajadas']; ?></td>
            </tr>
        <?php endwhile; ?>
    </tbody>
</table>


<?php include "pie.php";?>
</body>
</html>
