<?php
include "conexion.php";
if(isset($_POST["n_usuario"]) && isset($_POST["email"]) && isset($_POST["telefono"]) && isset($_POST["contraseña"]) && isset($_POST["especialidad"])) {
    $nombre = $_POST["n_usuario"];
    $email = $_POST["email"];
    $telefono = $_POST["telefono"];
    $especialidad_id = $_POST["especialidad"];
    $contraseña = $_POST["contraseña"];

  
    $sql = "INSERT INTO usuarios (nombre, email, telefono, especialidad_id, contraseña) VALUES (?, ?, ?, ?, ?)";
    $stmt = $conn->prepare($sql);


    $stmt->bind_param("sssis", $nombre, $email, $telefono, $especialidad_id, $contraseña);


    if($stmt->execute()){
        header("Location: login.php");
    } else {
        echo "Error al ingresar datos: " . $stmt->error;
    }


    $stmt->close();
}

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registro</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>

<h1>Crea tu usuario</h1>
<form action="login_crear.php" method="POST">
    <div class="form-group">
        <label for="n_usuario">Nombre de Usuario</label>
        <input id="n_usuario" name="n_usuario" type="text" placeholder="Usuario">
    </div>
    <div class="form-group">
        <label for="email">Correo Electrónico</label>
        <input id="email" name="email" type="text" placeholder="Email">
    </div>
    <div class="form-group">
        <label for="telefono">Número de Teléfono</label>
        <input id="telefono" name="telefono" type="text" placeholder="Telefono">
    </div>
    <div class="form-group">
        <label for="especialidad">Especialidad</label>
        <select id="especialidad" name="especialidad">
            <?php
            $sql = "SELECT id, nombre FROM especialidades";
            $result = $conn->query($sql);

            if ($result->num_rows > 0) {
                while($row = $result->fetch_assoc()) {
                    echo "<option value='" . $row["id"] . "'>" . $row["nombre"] . "</option>";
                }
            } else {
                echo "<option value=''>No hay especialidades disponibles</option>";
            }
            ?>
        </select>
    </div>
    <div class="form-group">
        <label for="contraseña">Contraseña</label>
        <input type="password" id="contraseña" name="contraseña" placeholder="Password">
    </div>
    <button type="submit" class="submit-button">Ingresar</button>
</form>

</body>
</html>