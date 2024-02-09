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
    
} else {
     // El usuario no es administrador, mostrar alerta y redirigirlo a otra página
     echo '<script>
            alert("¡Acceso denegado!"); 
            window.location = ("../views/TareasList.php");
           </script>';
     exit();
} 

//Obtener la id

if (!isset($_GET['id'])) {
  echo '<script>
          alert("No se ha proporcionado la ID de la tarea"); 
          window.location = ("../views/TareasList.php");
        </script>';
  exit();
}

$id_tarea = $_GET['id'];

// Consulta SQL para obtener los detalles de la tarea
$query = "SELECT * FROM tareas WHERE id = $id_tarea";
$resultado = mysqli_query($conexion, $query);

if (!$resultado) {
  echo '<script>
          alert("Hubo un error al obtener los detalles de la tarea"); 
          window.location = ("../views/TareasList.php");
        </script>';
  exit();
}

// Obtener los detalles de la tarea
$tarea = mysqli_fetch_assoc($resultado);

// Cerrar la conexión a la base de datos
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
    <title>Editar Tareas</title>
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
        <div class="containerEditarTareas">
         <h1>Editar Tareas</h1>  
         <section class="mostrarInformacion">
          <div class="informacionActual">
            <h2>Detalles de la Tarea</h2>
            <p>Nombre de la Tarea: <?php echo $tarea['NombreDeLaTarea']; ?></p>
            <span>Descripción de la Tarea: <?php echo $tarea['DescripcionTarea']; ?></span>
            <p>Fecha de Inicio: <?php echo $tarea['fechaInicial']; ?></p>
            <p>Fecha de Finalización: <?php echo $tarea['fechaFinal']; ?></p>
            <p>Responsable: <?php echo $tarea['empleado']; ?></p>
          </div>
          <div class="formularioEditar">
            <form method="POST" action="../php/EditarTareasFuncion.php" id="formEditarTareas">
                <input type="hidden" name="id" value="<?php echo $id_tarea; ?>">
                <input required type="text" name="NombreDeLaTarea" placeholder="Editar Nombre" />
                <input required type="text" name="DescripcionTarea" placeholder="Editar Descripcion" />
                <span>Editar fecha de inicio</span>
                <input required type="date" name="fechaInicial" placeholder="Editar la fecha" />
                <span>Editar fecha de entrega</span>
                <input required type="date" name="fechaFinal" placeholder="Editar la fecha" />
                <input required type="number" name="empleado" placeholder="Editar el DNI del empleado asignado" />

                <button id="miBoton" class="BtnCrearTareas">
                  Editar Tarea
                </button>
            </form>
          </div>
         </section>
        </div>
      </section>
    </div>   

    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script> 
   <!--   
    <script>
        // Obtener el parámetro de la URL (ID de la tarea)
        const urlParams = new URLSearchParams(window.location.search);
        const taskId = urlParams.get('id');

        // Mostrar un alert con la ID de la tarea
        alert("ID de la tarea: " + taskId);
    </script>
    -->

</body>
</html>