<?php 
include("../seguridad/verificasesion.php");

$idproyecto = $_POST['idproyecto'];
$idarchivo = $_POST['idarchivo'];
$contenido_editar = $_POST['contenido_editar'];
$tipo = $_POST['tipo'];
$aprobado = $_POST['aprobado'];

$usuario = $_SESSION['usuario'];
$fm = date("Y-m-d H:i:s",strtotime("-5 hour"));

$hist = "Comentario ".$tipo." - ".$contenido_editar;

$rpta = "";
$rpta_hist = "";

if( isset($_POST['idproyecto']) ){
	include("../seguridad/conex.php");

    if ($tipo=="operador"){
        $sql = "UPDATE archivos 
        SET	coment_ope = '$contenido_editar',
            um = '$usuario',
            fm = '$fm',
            notif = 'o'
        WHERE idproyecto='$idproyecto' AND id = '$idarchivo'";
    }else{
        $sql = "UPDATE archivos 
        SET	coment_ger = '$contenido_editar',
            activo = '$aprobado',
            um = '$usuario',
            fm = '$fm',
            notif = 'g'
        WHERE idproyecto='$idproyecto' AND id = '$idarchivo'";
    }

	
	
	if ($conn->query($sql) === TRUE) {
		
        $sql = "INSERT INTO historial (idproyecto, idarchivo, accion, usuario, fc) VALUES ('$idproyecto', '$idarchivo', '$hist', '$usuario', '$fm')";
        if ($conn->query($sql) === TRUE) {
            $rpta_hist = "Historial de edición generado.";
        }

        $rpta = "<p class='alert-success'><i class='fa fa-check' style='font-size:20px;'></i> Comentario ingresado con exito! - <b>".$rpta_hist."</b></p>";

	} else {
		$rpta = "<p class='alert-error'><i class='fa fa-close'></i>"." - Error: " . $sql . "<br>" . $conn->error."<br>".$conn->character_set_name()."</p>";
	}
}

echo $rpta;

$conn->close();
?>