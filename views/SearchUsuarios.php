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
if ($_SESSION["usuario"]["rol"] != "Admin") {
    // El usuario no es administrador, mostrar alerta y redirigirlo a otra página
    echo '<script>
            alert("¡Acceso denegado!");
            window.location = ("../views/TareasList.php");
           </script>';
    exit();
}
 
$query = "SELECT imagen FROM usuarios WHERE id = {$_SESSION['id_usuario']}";
 
// Ejecutar la consulta
$resultado = mysqli_query($conexion, $query);
 
// Obtener la ruta de la imagen si existe
$rutaImagen = null;
if ($resultado && mysqli_num_rows($resultado) > 0) {
    $fila = mysqli_fetch_assoc($resultado);
    $rutaImagen = $fila['imagen'];
}

// Inicializar la consulta SQL para obtener todos los usuarios
$query = "SELECT * FROM usuarios";

// Verificar si se ha enviado el formulario de búsqueda 
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $codigo_busqueda = $_POST['Search'];
    
    // Agregar una cláusula WHERE a la consulta SQL para filtrar los resultados
    $query .= " WHERE nombre_completo LIKE '%$codigo_busqueda%' OR email LIKE '%$codigo_busqueda%' OR dni LIKE '%$codigo_busqueda%' OR rol LIKE '%$codigo_busqueda%'";
}

// Ejecutar la consulta SQL
$resultado = mysqli_query($conexion, $query);

// Verificar si se encontraron resultados
if (mysqli_num_rows($resultado) === 0) {
    echo '<script>alert("No se encontraron usuarios que coincidan con la búsqueda.");
      window.location = ("../views/RevisarTareas.php"); 
    </script>';
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
    <title>Revisar Tareas</title>
</head>
<body>
    <!--Revisar Tareas--> 
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
            <section id="containerSearchTareas">
                <form method="POST" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>">
                    <input required type="search" placeholder="Ingrese un código" name="Search" id="searchInput"/>
                    <button type="submit">Buscar</button>
                </form>

                <div class="listCompleteContainer">
                    <?php
                    while ($fila = mysqli_fetch_assoc($resultado)) {
                        echo "
                        <div class='empleadosList'>
                            <h1>Nombre:{$fila['nombre_completo']}</h1>
                            <p>Email:{$fila['email']}</p>
                            <p>Dni: {$fila['dni']}</p>
                            <p>Rol: {$fila['rol']}</p>
                        </div>";
                    }
                    ?>
                </div>
            </section>
        </section>
    </div>   
</body>
</html>
