<?php 
include("../seguridad/verificasesion.php");
$idproyecto = $_POST['idproyecto'];
$idarchivo = $_POST['idarchivo'];
$contenido = $_POST['contenido'];

$uc = $_SESSION['usuario'];
$fc = date("Y-m-d H:i:s",strtotime("-5 hour"));

$rpta = "";

if( isset($_POST['idproyecto']) ){
	include("../seguridad/conex.php");
	$sql = "INSERT INTO documentos (idproyecto, idarchivo, contenido, uc, fc) VALUES ('$idproyecto', '$idarchivo', '$contenido', '$uc', '$fc')";
	//var_dump($sql);
	if ($conn->query($sql) === TRUE) {
		$rpta = "<p class='alert-success'><i class='fa fa-check' style='font-size:20px;'></i> ¡Registro guardado con exito!</p>";
	} else {
		$rpta = "<p class='alert-error'><i class='fa fa-close'></i>"." - Error: " . $sql . "<br>" . $conn->error."<br>".$conn->character_set_name()."</p>";
	}
}

echo $rpta;
$conn->close();
?>