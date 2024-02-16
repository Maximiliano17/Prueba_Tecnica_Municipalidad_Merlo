<?php
// Iniciar la sesión
session_start();

include "../ConexionDataBase/ConexionDataBase.php";

// Verificar si se ha enviado una imagen
if(isset($_FILES['inputImgProfile'])) {
    // Obtener detalles del archivo
    $nombreArchivo = $_FILES['inputImgProfile']['name'];
    $tipoArchivo = $_FILES['inputImgProfile']['type'];
    $tamanioArchivo = $_FILES['inputImgProfile']['size'];
    $rutaTemporal = $_FILES['inputImgProfile']['tmp_name'];

    // Ruta donde deseas guardar la imagen
    $rutaDestino = "../imagenesProfile/" . $nombreArchivo;

    // Mover la imagen al directorio deseado
    if(move_uploaded_file($rutaTemporal, $rutaDestino)) {
        // Obtener el ID del usuario de la sesión
        $usuario_id = $_SESSION['id_usuario']; // Asegúrate de que $_SESSION['id_usuario'] esté definida y tenga el valor correcto

        // Actualizar la fila en la tabla de usuarios con la ruta de la nueva imagen
        $actualizarImagen = "UPDATE usuarios SET imagen = ? WHERE id = ?";
        $stmt = mysqli_prepare($conexion, $actualizarImagen);

        // Vincular los parámetros
        mysqli_stmt_bind_param($stmt, "si", $rutaDestino, $usuario_id);

        // Ejecutar la consulta
        if(mysqli_stmt_execute($stmt)) {
            echo '
                <script>
                    alert("La imagen se asoció correctamente al usuario.");
                    window.location = "../views/index.php";
                </script>';    
        } else {
            echo '<script>alert("Error al asociar la imagen al usuario: ' . mysqli_error($conexion) . '");</script>';
        }

        // Cerrar la sentencia
        mysqli_stmt_close($stmt);
    } else {
        echo "Error al mover la imagen al directorio deseado.";
    }
} else {
    // No se envió ninguna imagen
    echo "Error: No se envió ninguna imagen.";
}

// Cerrar la conexión a la base de datos
mysqli_close($conexion);
?>
