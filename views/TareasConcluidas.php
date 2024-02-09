<?php 
 session_start();
 include "../ConexionDataBase/ConexionDataBase.php";

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
     $query = "SELECT * FROM tareas WHERE completado = true"; 
     $resultado = mysqli_query($conexion, $query);
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
            <a href="../views/TareasConcluidas.php">Tareas Concluidas</a>
            <a href="../views/SearchUsuarios.php">Buscar Usuarios</a> 
            <a href="../views/Registro/Registro.php">Crear usuario</a> 
        </nav>  
      </header> 
      <section id="containerTareas">
      <div class="listTareas">
          <?php
            while ($fila = mysqli_fetch_assoc($resultado)) {
              echo "
              <div class='cardTareas'>
              <h1>{$fila['NombreDeLaTarea']}</h1>
              <span>{$fila['DescripcionTarea']}</span>
              <p>Fecha De Inicio: {$fila['fechaInicial']}</p>
              <p>Fecha De Finalizacion: {$fila['fechaFinal']}</p>
              <p>Responsable: {$fila['empleado']}</p>";
          
              if ($_SESSION['usuario']['rol'] == 'Admin') {
                  // Mostrar botón solo para administradores
                  echo "<div class='containerBtn'>
                            <a class='Btn' href='../php/confirmarDelete.php?id={$fila['id']}'>Eliminar Tarea</a>
                          </div>";
              } else {
                  
              }
          
              echo "</div>";
          }

          ?>
         </div>
      </section>
    </div>   

    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>   
</body>
</html>