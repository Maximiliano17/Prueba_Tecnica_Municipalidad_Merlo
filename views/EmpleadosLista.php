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
    $query = "SELECT * FROM tareas";
    $resultado = mysqli_query($conexion, $query);
 } else {
    echo '<script>
          alert("Acceso Denegado.");
          window.location = ("../views/TareasList.php");
        </script>';
 }
 
?>

