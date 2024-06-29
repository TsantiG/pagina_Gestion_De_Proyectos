<?php

$servername = "localhost";
$username = "root";
$password ="";
$dbname = "dbcrud";

$conn = new mysqli($servername, $username, $password, $dbname);

if($conn -> connect_error){
    die ("<img src='./img/sinconexion.png' alt='Imagen' class='user-image1'>" . "Error al intentar hacer la connexion de la base de datos: ". $conn->connect_error);
}else {
    echo "<img src='./img/conexion.png' alt='Imagen' class='user-image' style='  width: 25px; 
    height: 25px; 
    border-radius: 50%;
    margin-right: 10px;
    margin-bottom: 8px;>'";
}


?>