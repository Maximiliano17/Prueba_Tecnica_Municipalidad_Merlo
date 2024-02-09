<?php
if (isset($_GET['id'])) {
    $id_tarea = $_GET['id'];

    include "../ConexionDataBase/ConexionDataBase.php";

    $sql = "UPDATE tareas SET completado = true WHERE id = '$id_tarea'";

    if (mysqli_query($conexion, $sql)) {
        echo '<script>
                alert("Tarea completada.");
                window.location = "../views/TareasList.php";
              </script>';
    } else {
        echo '<script>
                alert("Hubo un error al actualizar el campo completado.");
                window.location = "../views/TareasList.php";
              </script>';
    }

    mysqli_close($conexion);

} else {
    echo '<script>
            alert("No se proporcionó la ID de la tarea");
            window.location = "../views/TareasList.php";
          </script>';
}
?>
