<?php
include "conexion.php";

$sql = "SELECT usuarios.*, especialidades.nombre AS especialidad_nombre FROM usuarios LEFT JOIN especialidades ON usuarios.especialidad_id = especialidades.id";
$resultado = $conn->query($sql);
$cont = 0;
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Lista de Usuarios</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
<?php include "menu.php" ?>


<h1>Lista de Usuarios</h1>
<a href="login_crear.php" class="action-link">Crear</a>
<table class="styled-table">
    <thead>
        <tr>
            <th>ID</th>
            <th>Nombre</th>
            <th>Email</th>
            <th>Telefono</th>
            <th>Especialidad</th>
        </tr>
    </thead>
    <tbody>
        <?php while($fila = $resultado->fetch_assoc()): 
            $cont++; ?>
            <tr>
                <td><?php echo $cont; ?></td>
                <td><?php echo $fila['nombre']; ?></td>
                <td><?php echo $fila['email']; ?></td>
                <td><?php echo $fila['telefono']; ?></td>
                <td><?php echo $fila['especialidad_nombre']; ?></td>
            </tr>
        <?php endwhile; ?>
    </tbody>
</table>

<?php include "pie.php";?>
</body>
</html>
