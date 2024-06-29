<?php
include "conexion.php";
if(isset($_POST["id"]) && isset($_POST["num_proyecto"])  && isset($_POST["proyecto"]) && isset($_POST["f_i"]) && isset($_POST["f_f"])){
    $id2 = $_POST["id"];
    $num_proyecto=$_POST["num_proyecto"];
    $nombre = $_POST["proyecto"];
    $f_i = $_POST["f_i"];
    $f_f = $_POST["f_f"];

    $sql = "UPDATE proyectos SET num_proyecto=?, nombre = ?, fecha_inicio =?, fecha_fin =?  Where id = ?";

    $stmt = $conn->prepare($sql);

    $stmt->bind_param("sssss", $num_proyecto, $nombre, $f_i,$f_f, $id2);

    if($stmt->execute()){
        echo "<script>alert('Se a Actualizado el proyecto de forma correcta');</script>";
        header("Location: proyectos.php");
        exit; // Terminar la ejecución del script después de redirigir
    } else {
        echo "<script>alert('hubo un error al actualizar: " . $conn->error ."');</script>";
    }

}
