<?php
include "conexion.php";
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Inicio</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
<?php include "menu.php";?>


<div class="centrado">
    <div class="video-container">
        <video class="video" width="560" height="315" controls autoplay loop>
            <source src="./img/video.mp4" type="video/mp4">
        </video>
    </div>
</div>
<!--
<div class="carrusel">
            <div class="imagenes" id="imagenes">
                <img src="./img/imagen3.jpg" alt="Imagen 1">
                <img src="./img/java.jpg" alt="Imagen otra">
                <img src="./img/nuevop.jpg" alt="Imagen 2">
                <img src="./img/imagen2.jpg" alt="Imagen 3">
                <img src="./img/imagen4.jpg" alt="Imagen 4">
                <img src="./img/fondonuevo.jpg" alt="Imagen 5">
            </div>
            <button class="btn prev" onclick="mover(-1)">❮</button>
            <button class="btn next" onclick="mover(1)">❯</button>
        </div>


-->
        
        <?php include "pie.php";?>
        <script src="script.js"></script>

</body>
</html>
