<?php
include "conexion.php";

session_start();

if(!isset($_SESSION["id"])){
    header("Location: login.php");
    exit;
}

if(isset($_GET["id"])){

    $id=$_GET["id"];

    $sql="DELETE FROM tareas WHERE  id = ?";

    $stmt = $conn->prepare($sql);

    $stmt->bind_param("s",$id);


    if($stmt->execute()){

        echo "<script>alert('Se a borrado la tarea de forma correcta');</script>";
        header("Location:tareas.php");
        exit;
    }else{
        echo "<script>alert('hubo un error al borrar la tarea: " . $conn->error ."');</script>";
        header("Location: tarea.php");
        exit;
    }

    $stmt->close();
}else{
    echo "<script> alert('Error: No se esta enviando el valor id correctamente.');</script>";
    header("Location: tareas.php");
    exit;
}




