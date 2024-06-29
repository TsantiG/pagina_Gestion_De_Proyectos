<?php
include "conexion.php";

session_start();

if(isset($_SESSION["id"])){
    $id= $_SESSION["id"];
}else{
    header("Location:login_crear.php");
    exit;
}

$sql="DELETE FROM usuarios WHERE  id = ?";

$stmt = $conn->prepare($sql);

$stmt->bind_param("s",$id);


if($stmt->execute()){
    session_unset(); // Elimina todas las variables de sesión
    session_destroy(); // Destruye la sesión
    echo "<script>alert('Se a borrado el Usuario de forma correcta');</script>";
    header("Location:login.php");
    exit;
}else{
    echo "<script>alert('hubo un error al cerrar sesion: " . $conn->error ."');</script>";
    header("Location:index.php");
    exit;
}

$stmt->close();
