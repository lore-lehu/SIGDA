<?php
include("../seguridad/verificasesion.php");
include("../seguridad/conex.php");

$id = $_GET["id"];
$idproyecto = $_GET["idproyecto"];

$sql_archivo = "SELECT nombre FROM archivos WHERE id = '$id'";
$result_archivo = $conn->query($sql_archivo);
$row_archivo = $result_archivo->fetch_array(MYSQLI_ASSOC);
$nombre_archivo = $row_archivo['nombre'];

$sql_proyecto = "SELECT nombre FROM proyectos WHERE id = '$idproyecto'";
$result_proyecto = $conn->query($sql_proyecto);
$row_proyecto = $result_proyecto->fetch_array(MYSQLI_ASSOC);
$nombre_proyecto = $row_proyecto['nombre'];


$sql_doc = "SELECT contenido FROM documentos WHERE idproyecto = '".$idproyecto."' AND idarchivo = '".$id."'";
$result_doc = $conn->query($sql_doc);

if ($result_doc->num_rows > 0) {
	$row_doc = $result_doc->fetch_array(MYSQLI_ASSOC);
    $contenido_documento = $row_doc['contenido'];
}else{
	$contenido_documento = "";
}


?>
<?php echo nl2br($contenido_documento); ?>

<?php
    // Directorio donde están almacenadas las imágenes
    $directory = 'upload/';

    // Bucle para 10 iteraciones
    for ($i = 1; $i <= 10; $i++) {
        // Generar el nombre de la imagen con el prefijo 'img_' seguido del número de iteración
        $imageName = $id.'_imagen_' . $i . '.jpg';
        $imagePath = $directory . $imageName;  // Ruta completa de la imagen
        //var_dump($imagePath);

        // Verificar si la imagen existe
        if (file_exists($imagePath)) {
            // Mostrar la imagen si existe
            echo "<br><p><b>Imagen ".$i."</b></p><br>";
            echo '<img src="' . $imagePath . '" alt="Imagen ' . $i . '"  width=50%><br>';
        }else{
            //echo "No existe";
        }
    }
?>