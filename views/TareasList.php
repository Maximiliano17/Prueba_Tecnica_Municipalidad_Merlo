<?php
 session_start();
 
 // Incluir el archivo de conexión a la base de datos
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
 
 $dni_usuario = $_SESSION["usuario"]["dni"];

 if ($_SESSION["usuario"]["rol"] == "Admin") {
    //Mostrar todas las tareas
    $query = "SELECT * FROM tareas WHERE completado = false";
    $resultado = mysqli_query($conexion, $query);
 } else {
 // Consulta SQL para seleccionar las tareas del usuario actual
  $query = "SELECT * FROM tareas WHERE empleado = '$dni_usuario' AND completado = false";
  $resultado = mysqli_query($conexion, $query);
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
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Roboto:wght@400;500;700&display=swap">
    <!--Css-->
    <link rel="stylesheet" href="../styles/Home.css">
    <!--Title--> 
    <title>Tareas List</title>
</head>
<body>
     <!--Tareas List--> 
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
                            <a class='Btn' href='../views/EditarTarea.php?id={$fila['id']}'>Editar Tarea</a>
                          </div>";
              } else {
                  // Mostrar otro botón para otros usuarios
                  echo "<div class='containerBtn'>
                          <a class='Btn' href='../php/confirmarTareaCompleta.php?id={$fila['id']}'>Tarea Completada</a>
                        </div>"; 
              }
          
              echo "</div>";
          }

          ?>
         </div>
        </section>
     </div>  
</body>
</html>

<?php
// Cerrar la conexión a la base de datos
 mysqli_close($conexion);
?>