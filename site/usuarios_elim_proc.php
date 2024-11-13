<?php 
include("../seguridad/verificasesion.php");
//$usuario = $_SESSION['usuario'];

$id = $_POST['codigo'];
$fm = date("Y-m-d H:i:s",strtotime("-1 hour"));

$rpta = "";
if( isset($_POST['codigo']) ){
	include("../seguridad/conex.php");
	$sql = "DELETE FROM usuarios WHERE idusuario='$id'";
	
	if ($conn->query($sql) === TRUE) {
		$rpta = "<p class='alert-danger'><i class='fa fa-check' style='font-size:20px;'></i> ¡Registro eliminado con exito!</p>";
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