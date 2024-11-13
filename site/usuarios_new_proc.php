<?php 
include("../seguridad/verificasesion.php");

$id = $_POST['idusuario'];
$nombre = $_POST['nombre']; 
$usuario_new = $_POST['usuario']; 
$clave = $_POST['password']; 
$nivel = $_POST['nivel']; 
$sede = $_POST['sede']; 
$activo = $_POST['activo']; 

$fc = date("Y-m-d H:i:s",strtotime("-5 hour"));
$rpta = "";
if( isset($_POST['idusuario']) ){
	include("../seguridad/conex.php");

	$sql = "SELECT count(usuario) FROM usuarios WHERE usuario = '$usuario_new'";
	$result = $conn->query($sql);
	$row = $result->fetch_array(MYSQLI_NUM);
	$usuarioexist = $row[0]; 
	
	if ($usuarioexist > 0){
		$rpta = "<p class='alert-danger'><i class='fa fa-close' style='font-size:20px;'></i> El nombre de usuario ingresado ( <b>$usuario_new</b> ) ya esta siendo utilizado por otra persona!</p>";
	}else{	
		$sql = "INSERT INTO usuarios (idusuario, nombrecompletor, usuario, clave, nivel, fechagrab, usuariograb, idsede, estado)
		VALUES ('$id','$nombre' , '$usuario_new', '$clave', '$nivel', '$fc', '$usuario', '$sede', '$activo')";
		
		$_SESSION['id'] = $id;
		
			if ($conn->query($sql) === TRUE) {
				$rpta = "<p class='alert-info'><i class='fa fa-check' style='font-size:20px;'></i> ¡Registro guardado con exito!</p>";		
			} else {
				$rpta = "<p class='alert-error'><i class='fa fa-close'></i>"." - Error: " . $sql . "<br>" . $conn->error."<br>".$conn->character_set_name()."</p>";
			}

	}
}
echo $rpta;
$conn->close();
?>