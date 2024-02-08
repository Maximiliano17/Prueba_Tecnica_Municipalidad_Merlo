<?php 
 session_start();

 // Verificar si el usuario está autenticado
 if (!isset($_SESSION["usuario"])) {
     // El usuario no ha iniciado sesión, redirigirlo al inicio de sesión
     echo '<script>
            alert("El usuario no ha iniciado sesión");
            window.location = ("../views/Registro/Invitado.php");
           </script>';
     exit(); 
}
 
 // Verificar si el rol del usuario es de administrador (rol 1)
 if ($_SESSION["usuario"]["rol"] == "Admin") {
     // El usuario tiene el rol de administrador, permitir acceso
     /*
     echo '<script>
            alert("¡Acceso permitido!");
           </script>';
     */
} else {
     // El usuario no es administrador, mostrar alerta y redirigirlo a otra página
     echo '<script>
            alert("¡Acceso denegado!"); 
            window.location = ("../views/TareasList.php");
           </script>';
     exit();
} 
?>

<!DOCTYPE html>
<html lang="en"> 
<head>
    <!--Meta-->
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="icon" type="image/png" href="../../assets/logos/municipalidadMerloLogo.png">
    <!--Fonts-->
    <!--Css-->
    <link rel="stylesheet" href="../styles/Home.css">
    <!--Title-->
    <title>Prueba Tecnica Municipalidad</title>
</head>
<body>  
    <!--Home--> 
    <div id="HomeContainer"> 
      <header id="header">
        <div class="logoSistem">
          <img src="../assets/logos/municipalidadMerloLogo.png" alt="Logo Municipalidad"/>
        </div>
        <nav class="navBar">
            <a href="../views/index.php">Crear Tarea</a> 
            <a href="../views/TareasList.php">Tareas Lista</a>
            <a href="../views/RevisarTareas.php">Revisar Tareas</a> 
            <a href="../views/Registro/Registro.php">Crear usuario</a> 
        </nav>  
      </header> 
      <section id="containerTareas">
        <form action="../php/CreateTarea.php" method="POST" class="formCrearTareas">
          <h1>Crear Tareas</h1>
          <input required type="text" name="NombreDeLaTarea" placeholder="Nombre De La Tarea" />
          <input required type="text" name="DescripcionTarea" placeholder="Descrive Tu Tarea" />
          <span>Ponga una fecha de inicio</span>
          <input required type="date" name="fechaInicial" placeholder="Pon una fecha" />
          <span>Ponga una fecha de entrega</span>
          <input required type="date" name="fechaFinal" placeholder="Pon una fecha" />
          <input required type="number" name="empleado" placeholder="Ingresa el DNI del empleado asignado" />

          <button id="miBoton" class="BtnCrearTareas">
            Crear Tarea
          </button>
        </form>  
      </section>
    </div>   

    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>   
</body>
</html>