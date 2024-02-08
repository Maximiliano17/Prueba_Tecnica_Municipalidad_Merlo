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
