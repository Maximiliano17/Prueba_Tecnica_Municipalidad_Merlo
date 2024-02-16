<?php
session_start();

include "../ConexionDataBase/ConexionDataBase.php";

$dni = $_POST["dni"];

$validar_invitado = mysqli_query($conexion, "SELECT * FROM usuarios WHERE dni = '$dni' ");

if(mysqli_num_rows($validar_invitado) > 0){
    // El usuario fue encontrado, obtenemos sus datos
    $datos_usuario = mysqli_fetch_assoc($validar_invitado);
    
    // Guardamos todos los datos del usuario en la sesión
    $_SESSION["usuario"] = $datos_usuario;

    // Guardamos la ID del usuario en la sesión
    $_SESSION["id_usuario"] = $datos_usuario["id"];

    // Mostramos un alert con el DNI y el rol del usuario
    echo '
    <script> 
      alert("¡Usuario encontrado!\nDNI: ' . $datos_usuario["dni"] . '\nRol: ' . $datos_usuario["rol"] . '\nID: ' . $datos_usuario["id"] . '");
      window.location = "../views/index.php";
     </script>
    ';
}else{
    echo '<script>
            alert("No se encontró al usuario");
            window.location = "../views/Registro/Invitado.php";
         </script>';
}

?>
