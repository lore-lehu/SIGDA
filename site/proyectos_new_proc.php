<?php 
include("../seguridad/verificasesion.php");

$uc = $_SESSION['usuario'];

$codigo = $_POST['codigo'];
$nombre = $_POST['nombre'];
$activo = $_POST['activo'];

//$persona = str_pad($persona, 9, "0", STR_PAD_LEFT);

$fc = date("Y-m-d H:i:s",strtotime("-5 hour"));

$rpta = "";

if( isset($_POST['codigo']) ){
	include("../seguridad/conex.php");
	$sql = "INSERT INTO proyectos (codigo, nombre, activo, uc, fc) VALUES ('$codigo', '$nombre', '$activo', '$uc', '$fc')";
	//var_dump($sql);
	if ($conn->query($sql) === TRUE) {
		$rpta = "<p class='alert-info'><i class='fa fa-check' style='font-size:20px;'></i> ¡Registro guardado con exito!</p>";
	} else {
		if ($usuario=="maicolm"){
			$rpta = "<p class='alert-error'><i class='fa fa-close'></i>"." - Error: " . $sql . "<br>" . $conn->error."<br>".$conn->character_set_name()."</p>";
		}else{
			$rpta = "<p class='alert-danger'><i class='fa fa-close' style='font-size:20px;'></i> ¡Error inesperado, intente de nuevo por favor!</p>";
		}
	}
}

echo $rpta;

$conn->close();
?>