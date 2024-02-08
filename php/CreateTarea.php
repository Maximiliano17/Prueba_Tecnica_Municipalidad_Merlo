<?php
  include "../ConexionDataBase/ConexionDataBase.php";
 
  $NombreDeLaTarea = $_POST["NombreDeLaTarea"];
  $DescripcionTarea = $_POST["DescripcionTarea"];
  $fechaInicial = $_POST["fechaInicial"]; 
  $fechaFinal = $_POST["fechaFinal"];
  $empleado = $_POST["empleado"];

  $query = "INSERT INTO Tareas(NombreDeLaTarea, DescripcionTarea, fechaInicial, fechaFinal, empleado) 
  VALUES ('$NombreDeLaTarea', '$DescripcionTarea', '$fechaInicial', '$fechaFinal', '$empleado')"; 

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
