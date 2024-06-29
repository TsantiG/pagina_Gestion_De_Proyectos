<?php
include "conexion.php";

session_start();

if(!isset($_SESSION["id"])){
    header("Location: login.php");
    exit;
}

if(isset($_GET["id"])){

    $id=$_GET["id"];

    $sql="DELETE FROM proyectos WHERE  id = ?";

    $stmt = $conn->prepare($sql);

    $stmt->bind_param("s",$id);


    if($stmt->execute()){

        echo "<script>alert('Se a borrado el proyecto de forma correcta');</script>";
        header("Location:proyectos.php");
        exit;
    }else{
        echo "<script>alert('hubo un error al borrar la tarea: " . $conn->error ."');</script>";
        header("Location: tarea.php");
        exit;
    }

    $stmt->close();
}else{
    echo "<script> alert('Error: No se esta enviando el valor id correctamente.');</script>";
    header("Location: proyectos.php");
    exit;
}



