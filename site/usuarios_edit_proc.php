<?php 
include("../seguridad/verificasesion.php");
//$usuario = $_SESSION['usuario'];

$id = $_POST['idusuario'];
$nombre = $_POST['nombre']; 
//$usuario_new = $_POST['usuario']; 
$clave = $_POST['password']; 
$nivel = $_POST['nivel']; 
$sede = $_POST['sede']; 
$activo = $_POST['activo']; 

$fm = date("Y-m-d H:i:s",strtotime("-5 hour"));
//var_dump($password);

if ($nivel=="3"){
	$cargo = "Administrador";
}else{
	$cargo = "Operador";
}

$rpta = "";
if( isset($_POST['idusuario']) ){
	include("../seguridad/conex.php");
	$sql = "UPDATE usuarios 
			SET nombrecompletor='$nombre',
				clave='$clave',
				nivel='$nivel',
				idsede='$sede',
				um = '$usuario',
				fm = '$fm',
				cargo = '$cargo',
				estado = '$activo'
			WHERE idusuario='$id'";
	
	if ($conn->query($sql) === TRUE) {
		$rpta = "<p class='alert-success'><i class='fa fa-check' style='font-size:20px;'></i> ¡Registro actualizado con exito!</p>";
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