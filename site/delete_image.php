<?php
include("../seguridad/verificasesion.php");
// Directorio donde están las imágenes
$directory = 'upload/';

if (isset($_POST['image'])) {

    $iddocumento = $_GET['iddocumento'];
    $idproy = $_GET['idproyecto'];

    $imageName = basename($_POST['image']);  // Asegurarse de que no se manipule la ruta
    $imagePath = $directory . $imageName;

    // Verificar si el archivo existe y eliminarlo
    if (file_exists($imagePath)) {
        if (unlink($imagePath)) {
            echo "La imagen $imageName ha sido eliminada.";

            $usuario = $_SESSION['usuario'];
            $fm = date("Y-m-d H:i:s",strtotime("-5 hour"));

            include("../seguridad/conex.php");
            $sql = "INSERT INTO historial (idproyecto, idarchivo, accion, usuario, fc) VALUES ('$idproy', '$iddocumento', 'El archivo $imageName fue eliminado', '$usuario', '$fm')";
            if ($conn->query($sql) === TRUE) {
                echo "<p class='alert-success'><i class='fa fa-check' style='font-size:20px;'></i>¡Historial de edición generado!</p>";
            } else {
                echo "<p class='alert-error'><i class='fa fa-close'></i>"." - Error: " . $sql . "<br>" . $conn->error."<br>".$conn->character_set_name()."</p>";
            }
            
        } else {
            echo "Error al intentar eliminar la imagen.";
        }
    } else {
        echo "La imagen no existe.";
    }
} else {
    echo "No se especificó ninguna imagen.";
}
?>