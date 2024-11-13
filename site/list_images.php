<?php
$id = $_GET['id'];
$idproy = $_GET['idproy'];
    // Directorio donde están las imágenes
    $directory = 'upload/';

    // Prefijo específico de las imágenes
    $prefix = $id.'_imagen_';

    // Obtener los archivos del directorio
    $images = glob($directory . $prefix . '*.jpg');  // Cambia la extensión si es necesario

    // Si hay imágenes, las listamos
    if (!empty($images)) {
        foreach ($images as $image) {
            // Obtener solo el nombre del archivo (sin la ruta)
            $imageName = basename($image);

            // Mostrar la imagen y el botón de eliminar
            echo '<div style="margin-bottom: 20px;">';
            echo '<img src="' . $image . '" alt="' . $imageName . '" width="120" height="70">';
            echo '&nbsp;&nbsp;&nbsp;<button onclick="deleteImage(\'' . $imageName . '\', \'' . $id . '\', \'' . $idproy . '\')" class="btn btn-danger">Eliminar</button>';
            echo '</div>';
        }
    } else {
        echo 'No hay imágenes con el prefijo "' . $prefix . '"';
    }
?>