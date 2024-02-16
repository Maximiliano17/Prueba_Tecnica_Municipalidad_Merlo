<?php
  // Llamo a la conexión de la DataBase 
  include "../ConexionDataBase/ConexionDataBase.php";

  /* Recuperar variables del formulario */ 
  $userName = $_POST["username"];
  $email = $_POST["email"];
  $dni = $_POST["dni"];
  $rol = $_POST["rol"];

  // Asigno los valores de las variables a los campos de la tabla en la DataBase
  $query = "INSERT INTO usuarios(nombre_completo,email,dni,rol) 
  VALUES ('$userName','$email','$dni','$rol')";

  // Ejecutar la consulta y verificar si se realizó con éxito
  $ejecutar = mysqli_query($conexion, $query);

  if ($ejecutar) {
      echo '
       <script>
        alert("¡Registro exitoso!");
        window.location = "../views/Registro/Invitado.php";
        </script>
       ';
  } else {
      echo "Error al registrar usuario: " . mysqli_error($conexion);
  }

  mysqli_close($conexion);
?>
