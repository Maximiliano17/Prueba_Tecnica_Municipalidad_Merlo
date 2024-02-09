<?php
  include "../ConexionDataBase/ConexionDataBase.php";
 
  $NombreDeLaTarea = $_POST["NombreDeLaTarea"];
  $DescripcionTarea = $_POST["DescripcionTarea"];
  $fechaInicial = $_POST["fechaInicial"]; 
  $fechaFinal = $_POST["fechaFinal"];
  $empleado = $_POST["empleado"];
  $completado = false;

  $query = "INSERT INTO Tareas(NombreDeLaTarea, DescripcionTarea, fechaInicial, fechaFinal, empleado, completado) 
  VALUES ('$NombreDeLaTarea', '$DescripcionTarea', '$fechaInicial', '$fechaFinal', '$empleado', '$completado')"; 

  $ejecutar = mysqli_query($conexion, $query);

  if ($ejecutar) {
      echo '
        <script>
         alert("Se Creó La Tarea Correctamente"); 
         window.location = "../views/TareasList.php";
        </script>
       ';
  } else {
        echo '
          <script>
            alert("La Tarea No Se Creó"); 
          </script>
    ';
  }

  mysqli_close($conexion);
?>
