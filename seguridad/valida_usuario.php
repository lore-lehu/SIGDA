<?php
session_start();
$usuario = htmlspecialchars(strip_tags($_POST['login']));
$clave = htmlspecialchars(strip_tags($_POST['password']));

$_SESSION['usuariolog'] = $usuario;

include("../seguridad/conex.php");

$sql = "SELECT u.idusuario, u.nombrecompletor, u.usuario, u.nivel, s.nombresede
FROM usuarios u 
LEFT JOIN sedes s on s.ids = u.idsede
WHERE u.usuario = '$usuario' and u.clave = '$clave'";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
	$existead = "si";

	$row_usu = $result->fetch_array(MYSQLI_ASSOC);
	$niv_usu = $row_usu['nivel'];
	$nom_usu = $row_usu['nombrecompletor'];
}else{
	$existead = "no";
}

//$existead = "si"; //Forzado

	//if ($existead == "si"){
	if ($existead == "si"){
		//header('Location: ../site/index.php');
		
		if ($niv_usu=="3"){
			$_SESSION['tipo_menu'] = "menu_vert.php";
			$_SESSION['nivel'] = $niv_usu;
		}else{
			$_SESSION['tipo_menu'] = "menu_operador.php";
			$_SESSION['nivel'] = $niv_usu;
		}
		
		$_SESSION['btnnuevo'] = "btn_nuevo";
		$_SESSION['btnguardar'] = "btn_guardar";
		$_SESSION['btnactualizar'] = "btn_actualizar";
		$_SESSION['btneliminar'] = "btn_eliminar";
		$_SESSION['btnconsultar'] = "btn btn-warning";
		$acceso = "si";
		$mensaje = "¡ ACCESO CORRECTO !";
		
		$_SESSION['idusuario'] = $usuario;
		
		$_SESSION['usuario'] = $usuario;
		$_SESSION['nombre'] = $nom_usu;
		$_SESSION['pag_titulo'] = "SIGDA";
	}else{
		//echo "No validado";
		//header('Location: verifica_usuario_valad.php');
		$acceso = "no";
		$mensaje = "Usuario y/o clave incorrecto.";
	}
	
	$data = array(
		"mensaje" => $mensaje,
		"acceso" => $acceso
	);
 
	echo json_encode($data);

?>