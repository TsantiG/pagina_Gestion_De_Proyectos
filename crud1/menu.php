<?php

session_start();

if(isset($_SESSION["id"]) && isset($_SESSION["nombre_u"])){
    $id = $_SESSION["id"];
    $nombre_u=$_SESSION["nombre_u"];
}else{
    echo "<script> alert('No has iniciado sesión.');</script>";
    header("Location: login.php");
    exit;
}

?>

<nav>
  <div class="left">
    <a href="index.php">Inicio</a>
    <a href="proyectos.php">Proyectos</a>
    <a href="miembros.php">Miembros de proyectos</a>
    <a href="usuarios.php">Trabajadores</a>
    <a href="tareas.php">Tareas</a>
    <a href="especializacion.php">Especialidades</a>
  </div>
  <div class="right">
    <a href="login_actualizar.php" class="user-info">
      <img src="./img/user.png" alt="Imagen" class="user-imageuser">
      <span class="welcome-text">Bienvenido: <span class="user-name"><?php echo $nombre_u; ?></span></span>
    </a>
    <a href="login_close.php" class="logout-button">Cerrar sesión</a>
  </div>
</nav>
