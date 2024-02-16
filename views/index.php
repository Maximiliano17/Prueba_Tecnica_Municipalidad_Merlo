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
if ($_SESSION["usuario"]["rol"] != "Admin") {
    // El usuario no es administrador, mostrar alerta y redirigirlo a otra página
    echo '<script>
           alert("¡Acceso denegado!"); 
           window.location = ("../views/TareasList.php");
          </script>';
    exit();
} 

// Obtener la ruta de la imagen del usuario
include "../ConexionDataBase/ConexionDataBase.php"; 

$queryImagen = "SELECT imagen FROM usuarios WHERE id = {$_SESSION['id_usuario']}";
$resultadoImagen = mysqli_query($conexion, $queryImagen);
$rutaImagen = null;
if ($resultadoImagen && mysqli_num_rows($resultadoImagen) > 0) {
    $filaImagen = mysqli_fetch_assoc($resultadoImagen);
    $rutaImagen = $filaImagen['imagen'];
}

// Obtener las opciones para el selector de empleados
$queryEmpleados = "SELECT dni, nombre_completo FROM usuarios";
$resultadoEmpleados = mysqli_query($conexion, $queryEmpleados);

// Cerrar la conexión a la base de datos (si es necesario)
mysqli_close($conexion);
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
        <form action="../php/CreateTarea.php" method="POST" class="formCrearTareas">
          <h1>Crear Tareas</h1>
          <input required type="text" name="NombreDeLaTarea" placeholder="Nombre De La Tarea" />
          <input required type="text" name="DescripcionTarea" placeholder="Describe Tu Tarea" />
          <span>Ponga una fecha de inicio</span>
          <input required type="date" name="fechaInicial" placeholder="Pon una fecha" />
          <span>Ponga una fecha de entrega</span>
          <input required type="date" name="fechaFinal" placeholder="Pon una fecha" />
          <select class="selectForm" name="empleado">
              <option value="" disabled selected>Empleado asignado</option>
              <?php
                // Verificar si la consulta fue exitosa
                if ($resultadoEmpleados) {
                    // Iterar sobre los resultados y mostrar el nombre completo como texto visible y el DNI como valor
                    while ($fila = mysqli_fetch_assoc($resultadoEmpleados)) {
                        echo '<option value="' . $fila['dni'] . '">' . $fila['nombre_completo'] . '</option>';
                    }
                } else {
                    // Si la consulta falla, mostrar un mensaje de error
                    echo '<option value="">Error al obtener los datos</option>';
                }
              ?>
          </select>
          <button id="miBoton" class="BtnCrearTareas">
            Crear Tarea
          </button>
        </form>  
      </section>
    </div>   

    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>   
</body>
</html>
