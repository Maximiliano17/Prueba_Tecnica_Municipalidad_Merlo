<?php

if (isset($_GET['id'])) {
    $id_tarea = $_GET['id'];
 
    echo '
        <script> 
        if (window.confirm("¿Quieres dar esta tarea por concluida? esto sera notificado al jefe de la sala.")) {
            alert("El usuario aceptó.");
            window.location = "../php/CompletarTarea.php?id=' . $id_tarea . '";
        } else {
                alert("El usuario canceló.");
                window.location = "../views/TareasList.php";
        }
        </script>
    ';
}else{ 
    echo '
            <script>
                alert("No se proporcionó la ID de la tarea");
                window.location = "../views/TareasList.php";
            </script>';    
}

?>