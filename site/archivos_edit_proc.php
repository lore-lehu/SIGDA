<?php 
include("../seguridad/verificasesion.php");
$usuario = $_SESSION['usuario'];

$idproyecto = $_POST['idproyecto'];
$id = $_POST['id'];
$codigo = $_POST['codigo'];
$nombre = $_POST['nombre'];
$activo = $_POST['activo'];

$fm = date("Y-m-d H:i:s",strtotime("-5 hour"));

/*
UPDATE mesas 
				SET	idper = '$persona',
					campus = '$campus',
					activo = '$activo',
					um = '$usuario',
					fm = '$fm'
			WHERE id='$id'
*/

$rpta = "";
if( isset($_POST['codigo']) ){
	include("../seguridad/conex.php");
	$sql = "UPDATE archivos 
				SET	codigo = '$codigo',
					nombre = '$nombre',
					um = '$usuario',
					fm = '$fm'
			WHERE id='$id' and idproyecto='$idproyecto'";
	
	if ($conn->query($sql) === TRUE) {
		$rpta = "<p class='alert-success'><i class='fa fa-check' style='font-size:20px;'></i> ¡Registro actualizado con exito!</p>";
	} else {
		//if ($usuario=="maicolm"){
			$rpta = "<p class='alert-error'><i class='fa fa-close'></i>"." - Error: " . $sql . "<br>" . $conn->error."<br>".$conn->character_set_name()."</p>";
		//}else{
			//$rpta = "<p class='alert-danger'><i class='fa fa-close' style='font-size:20px;'></i> ¡Error inesperado, intente de nuevo por favor!</p>";
		//}
	}
}

echo $rpta;

$conn->close();
?>