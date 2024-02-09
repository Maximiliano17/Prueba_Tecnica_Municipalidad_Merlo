<?php
session_start();
include "../ConexionDataBase/ConexionDataBase.php";

// Validar si se han enviado los datos del formulario
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Obtener datos del formulario
    $id_tarea = mysqli_real_escape_string($conexion, $_POST['id']);
    $nombre_tarea = mysqli_real_escape_string($conexion, $_POST['NombreDeLaTarea']);
    $descripcion_tarea = mysqli_real_escape_string($conexion, $_POST['DescripcionTarea']);
    $fecha_inicial = mysqli_real_escape_string($conexion, $_POST['fechaInicial']);
    $fecha_final = mysqli_real_escape_string($conexion, $_POST['fechaFinal']);
    $dni_empleado = mysqli_real_escape_string($conexion, $_POST['empleado']);

    $nombre_tarea_con_texto = $nombre_tarea . " (Esta tarea fue editada)"; 

    // Crear consulta UPDATE
    $consulta = "UPDATE tareas SET 
    NombreDeLaTarea = '$nombre_tarea_con_texto', 
    DescripcionTarea = '$descripcion_tarea', 
    fechaInicial = '$fecha_inicial', 
    fechaFinal = '$fecha_final', 
    empleado = '$dni_empleado' 
    WHERE id = $id_tarea";

    // Ejecutar consulta UPDATE
    if (mysqli_query($conexion, $consulta)) {
        echo '<script>
                alert("Los datos de la tarea se han actualizado correctamente."); 
                window.location = ("../views/TareasList.php");
              </script>';
    } else {
        echo '<script>
                alert("Hubo un error al actualizar los detalles de la tarea: ' . mysqli_error($conexion) . '"); 
                window.location = ("../views/TareasList.php");
              </script>';
    }

    // Cerrar la conexión a la base de datos
    mysqli_close($conexion);
} else {
    // Redireccionar si no se han recibido datos del formulario
    header("Location: ../views/TareasList.php");
    exit();
}
?>
