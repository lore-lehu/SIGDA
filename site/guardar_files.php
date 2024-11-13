<?php
include("../seguridad/verificasesion.php");
// Directorio donde se guardarán las imágenes subidas
$uploadDir = 'upload/';

if (!file_exists($uploadDir)) {
    mkdir($uploadDir, 0777, true);  // Crear directorio si no existe
}
$cargoimagen="no";
// Verificar si se recibieron imágenes y un prefijo
if (isset($_FILES['images']) && isset($_POST['prefix']) && isset($_POST['idproy'])) {
    $images = $_FILES['images'];
    $prefix = preg_replace('/[^a-zA-Z0-9_-]/', '', $_POST['prefix']);  // Limpiar el prefijo

    foreach ($images['name'] as $key => $imageName) {
        $imageTmpName = $images['tmp_name'][$key];
        $imageError = $images['error'][$key];

        // Verificar si no hay errores en la imagen
        if ($imageError === UPLOAD_ERR_OK) {
            $newImageName = $prefix . '_' . basename($imageName);  // Prefijo + nombre original
            $uploadPath = $uploadDir . $newImageName;

            // Mover la imagen al directorio de destino
            if (move_uploaded_file($imageTmpName, $uploadPath)) {
                $cargoimagen="si";
                echo "Imagen subida correctamente: $newImageName<br>";
            } else {
                echo "Error al subir la imagen: $imageName<br>";
            }
        } else {
            echo "Error en la imagen: $imageName<br>";
        }
    }


    if ($cargoimagen=="si"){
        $idproy = $_POST['idproy'];
        $idarchivo = $_POST['prefix'];
        $usuario = $_SESSION['usuario'];
        $fm = date("Y-m-d H:i:s",strtotime("-5 hour"));

        include("../seguridad/conex.php");
        $sql = "INSERT INTO historial (idproyecto, idarchivo, accion, usuario, fc) VALUES ('$idproy', '$idarchivo', 'Imagen cargada', '$usuario', '$fm')";
        if ($conn->query($sql) === TRUE) {
            echo "<p class='alert-success'><i class='fa fa-check' style='font-size:20px;'></i>¡Historial de edición generado!</p>";
        } else {
            echo "<p class='alert-error'><i class='fa fa-close'></i>"." - Error: " . $sql . "<br>" . $conn->error."<br>".$conn->character_set_name()."</p>";
        }
    }



} else {
    echo "No se recibieron imágenes o prefijo.";
}