<?php
 session_start();

 // Verificar si el usuario está autenticado
 if (!isset($_SESSION["usuario"])) {
     // El usuario no ha iniciado sesión, redirigirlo al inicio de sesión
     echo '<script>
            alert("El usuario no ha iniciado sesión");
            window.location = ("../Registro/Invitado.php");
           </script>';
     exit(); 
 }
 
 // Verificar si el rol del usuario es de administrador (rol 1)
 if ($_SESSION["usuario"]["rol"] == "Admin") {
     // El usuario tiene el rol de administrador, permitir acceso
     echo '<script>
            alert("¡Acceso permitido!");
           </script>';
     // Aquí va el contenido de la página admin.php
 } else {
     // El usuario no es administrador, mostrar alerta y redirigirlo a otra página
     echo '<script>
            alert("¡Acceso denegado!");
            window.location = ("../Registro/Invitado.php");
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
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Roboto:wght@400;500;700&display=swap">
    <!--Css-->
    <link rel="stylesheet" href="../../styles/Register.css">
    <!--Title-->
    <title>Registro</title>
</head>  
<body>
     <!--Home--> 
     <div id="containerRegister">   
          <form action="../../php/registroUsuariosDataBase.php" method="POST" id="formRegister">
            <h1>Registro</h1>
            <section class="formInputsSection">
                <input required type="text" name="username" placeholder="¿Cuál es tu nombre completo?">
                <input required type="email" name="email" placeholder="¿Cuál es tu mail?">
                <input required type="text" name="dni" placeholder="¿Cuál es tu dni?">
                <select name="rol" id="rol">
                    <option disabled selected>Rol</option>
                    <option name="rol" value="Admin">Administrador</option>
                    <option name="rol" value="Empleado">Empleado</option>
                </select>
            </section> 
            <section class="formSubmitSection">
                <button type="submit" class="btnRegistro">
                    Crear Usuario
                 </button> 

                <a href="./Invitado.php" class="btnInvitado">
                    Soy Invitado
                </a>
            </section> 
       </form>
       <articulo id="containerInformation">
       </articulo>
     </div>   

     <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>    
     <script src="../js/sweetAlerts.js"></script>
</body>
</html>