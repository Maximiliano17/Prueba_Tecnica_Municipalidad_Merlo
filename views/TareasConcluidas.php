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
 
$queryImagen = "SELECT imagen FROM usuarios WHERE id = {$_SESSION['id_usuario']}";
 
// Ejecutar la consulta
$resultadoImagen = mysqli_query($conexion, $queryImagen);
 
// Obtener la ruta de la imagen si existe
$rutaImagen = null;
if ($resultadoImagen && mysqli_num_rows($resultadoImagen) > 0) {
    $filaImagen = mysqli_fetch_assoc($resultadoImagen);
    $rutaImagen = $filaImagen['imagen'];
}
 
 // Verificar si el rol del usuario es de administrador (rol 1)
 if ($_SESSION["usuario"]["rol"] == "Admin") {
     // El usuario tiene el rol de administrador, permitir acceso
     $queryTareas = "SELECT * FROM tareas WHERE completado = true"; 
     $resultadoTareas = mysqli_query($conexion, $queryTareas);
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
      <div id="imagenProfile">
        <?php if ($rutaImagen) { ?>
              <!-- Mostrar la imagen si existe --> 
              <img class="imagenProfile" src="<?php echo $rutaImagen; ?>" alt="Imagen de perfil">
              <form class="editarImg" action="../php/EditarImgProfile.php" method="POST" class="logoSistem" enctype="multipart/form-data">
                <input type="file" id="inputImgProfile" name="inputImgProfile" accept="image/*" style="display: none;">
                <label for="inputImgProfile">
                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-pen-fill" viewBox="0 0 16 16">
                     <path d="m13.498.795.149-.149a1.207 1.207 0 1 1 1.707 1.708l-.149.148a1.5 1.5 0 0 1-.059 2.059L4.854 14.854a.5.5 0 0 1-.233.131l-4 1a.5.5 0 0 1-.606-.606l1-4a.5.5 0 0 1 .131-.232l9.642-9.642a.5.5 0 0 0-.642.056L6.854 4.854a.5.5 0 1 1-.708-.708L9.44.854A1.5 1.5 0 0 1 11.5.796a1.5 1.5 0 0 1 1.998-.001"/>
                    </svg>
                </label>
                <!-- Campo oculto para enviar la ID del usuario -->
                <input type="hidden" name="usuario_id" value="<?php echo $_SESSION['id_usuario']; ?>"> 
                <button type="submit">Enviar</button> 
            </form>
          <?php } else { ?>
              <!-- Mostrar el formulario para subir una nueva imagen -->
              <form action="../php/AddImgProfile.php" method="POST" class="logoSistem" enctype="multipart/form-data">
                  <input type="file" id="inputImgProfile" name="inputImgProfile" accept="image/*" style="display: none;">
                  <label for="inputImgProfile">Agregar foto</label>
                  <!-- Campo oculto para enviar la ID del usuario -->
                  <input type="hidden" name="usuario_id" value="<?php echo $_SESSION['id_usuario']; ?>"> 
                  <button type="submit">Enviar</button>
              </form>
          <?php } ?>
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
            while ($fila = mysqli_fetch_assoc($resultadoTareas)) {
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
