<?php 
include("../seguridad/verificasesion.php");

$idproyecto = $_POST['idproyecto'];
$idarchivo = $_POST['idarchivo'];
$contenido_editar = $_POST['contenido_editar'];

$usuario = $_SESSION['usuario'];
$fm = date("Y-m-d H:i:s",strtotime("-5 hour"));

$rpta = "";
$rpta_hist = "";
if( isset($_POST['idproyecto']) ){
	include("../seguridad/conex.php");
	$sql = "UPDATE documentos 
				SET	contenido = '$contenido_editar',
					um = '$usuario',
					fm = '$fm'
			WHERE idproyecto='$idproyecto' AND idarchivo = '$idarchivo'";
	
	if ($conn->query($sql) === TRUE) {
		
        $sql = "INSERT INTO historial (idproyecto, idarchivo, accion, usuario, fc) VALUES ('$idproyecto', '$idarchivo', 'Archivo editado', '$usuario', '$fm')";
        if ($conn->query($sql) === TRUE) {
            $rpta_hist = "Historial de edición generado.";
        }

        $rpta = "<p class='alert-success'><i class='fa fa-check' style='font-size:20px;'></i> ¡Registro actualizado con exito! - <b>".$rpta_hist."</b></p>";

	} else {
		$rpta = "<p class='alert-error'><i class='fa fa-close'></i>"." - Error: " . $sql . "<br>" . $conn->error."<br>".$conn->character_set_name()."</p>";
	}
}

echo $rpta;

$conn->close();
?>