<?php
include "conexion.php";

    if(isset($_POST["especialidad"]) && isset($_POST["id"])){
        $id2 = $_POST["id"];
        $nombre = $_POST["especialidad"];
        $sql = "UPDATE especialidades SET nombre= ? Where id = ?";

        $stmt = $conn->prepare($sql);

        $stmt->bind_param("ss",$nombre,$id2);

        if($stmt->execute()){
            echo "<script>alert('Se a Actualizado la especializacion de forma correcta');</script>";
            header("Location: especializacion.php");
            exit; // Terminar la ejecución del script después de redirigir
        } else {
            echo "<script>alert('hubo un error al actualizar: " . $conn->error ."');</script>";
            exit;
        }
    
    }
