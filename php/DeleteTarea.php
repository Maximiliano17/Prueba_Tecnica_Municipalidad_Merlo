<?php
session_start();
include "../ConexionDataBase/ConexionDataBase.php";

// Verifica si se ha proporcionado la ID de la tarea en la URL
if (isset($_GET['id'])) {
    // Obtiene la ID de la tarea de la URL
    $id_tarea = $_GET['id'];

    // Eliminar la tarea de la base de datos
    $deleteConsulta = "DELETE FROM tareas WHERE id = ?";

    // Preparar la consulta
    $stmt = mysqli_prepare($conexion, $deleteConsulta);

    if ($stmt) {
        // Vincular parámetros
        mysqli_stmt_bind_param($stmt, "i", $id_tarea);

        // Ejecutar la consulta
        if (mysqli_stmt_execute($stmt)) {
            // La tarea se eliminó correctamente
            echo '
                <script>
                    alert("La tarea se eliminó correctamente");
                    window.location = "../views/TareasList.php";
                </script>';
        } else {
            // Hubo un error al intentar eliminar la tarea
            echo '
                <script>
                    alert("Hubo un error al intentar eliminar la tarea");
                    window.location = "../views/TareasList.php";
                </script>';
        }
        
        // Cerrar la declaración
        mysqli_stmt_close($stmt);
    } else {
        // Hubo un error en la preparación de la consulta
        echo '
            <script>
                alert("Hubo un error al intentar eliminar la tarea");
                window.location = "../views/TareasList.php";
            </script>';
    }
} else {
    // No se proporcionó la ID de la tarea
    echo '
        <script>
            alert("No se proporcionó la ID de la tarea");
            window.location = "../views/TareasList.php";
        </script>';
}

// Cerrar la conexión a la base de datos
mysqli_close($conexion);
?>
