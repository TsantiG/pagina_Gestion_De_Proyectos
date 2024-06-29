<?php
include "conexion.php";
session_start();
if(isset($_SESSION["id"])){
    $id=$_SESSION["id"];
}else{
    header("Location:login.php");
    exit;
}


$sql = "SELECT u.*, e.nombre AS especialidad_nombre FROM usuarios u LEFT JOIN especialidades e ON u.especialidad_id = e.id WHERE u.id = ?";

$stmt = $conn->prepare($sql);
$stmt->bind_param("i", $id);
$stmt->execute();
$busqueda = $stmt->get_result();

if($busqueda->num_rows > 0){
    $row = $busqueda->fetch_assoc();
    $nombre_1= $row["nombre"];
    $email_1=$row["email"];
    $telefono_1=$row["telefono"];
    $contraseña_1=$row["contraseña"];
    $especialidad_id = $row["especialidad_id"];
    $especialidad_nombre = $row["especialidad_nombre"];
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
<h1>Actualizar datos</h1>
<form action="login_actualizar_2.php" method="POST">
    <div class="form-group">
        <label for="n_usuario">Nombre de Usuario</label>
        <input id="n_usuario" name="n_usuario" type="text" placeholder="Usuario" value="<?php echo $nombre_1?>">
    </div>
    <div class="form-group">
        <label for="email">Correo Electrónico</label>
        <input id="email" name="email" type="text" placeholder="Email" value="<?php echo $email_1?>">
    </div>
    <div class="form-group">
        <label for="telefono">Número de Teléfono</label>
        <input id="telefono" name="telefono" type="text" placeholder="Telefono" value="<?php echo $telefono_1?>">
    </div>
    <div class="form-group">
        <label for="contraseña">Contraseña</label>
        <input type="text" id="contraseña" name="contraseña" placeholder="Password" value="<?php echo $contraseña_1?>">
    </div>
    <div class="form-group">
        <label for="especialidad">Especialidad</label>
        <select id="especialidad" name="especialidad">
            <?php
            // Consulta SQL para obtener las especialidades disponibles
            $sql_especialidades = "SELECT id, nombre FROM especialidades";
            $result_especialidades = $conn->query($sql_especialidades);

            // Verificar si hay resultados
            if ($result_especialidades->num_rows > 0) {
                // Mostrar cada especialidad como opción en el campo de selección
                while($row_especialidad = $result_especialidades->fetch_assoc()) {
                    $selected = ($row_especialidad["id"] == $especialidad_id) ? "selected" : "";
                    echo "<option value='" . $row_especialidad["id"] . "' $selected>" . $row_especialidad["nombre"] . "</option>";
                }
            } else {
                echo "<option value=''>No hay especialidades disponibles</option>";
            }
            ?>
        </select>
    </div>
    <button type="submit" class="submit-button">Actualizar</button>
</form>

<a href="login_eliminar.php" class="delete-link" style="margin-right: 35%; margin-left: 35%;">Eliminar</a>

</body>
</html>
