<?php
session_start();
		if (isset ($_SESSION["usuario"])){
			$usuario = $_SESSION["usuario"];
			$nivel = $_SESSION['nivel'];
			$nombre = $_SESSION['nombre'];
		}else{
			unset ($_SESSION['usuario']);
			unset ($_SESSION['nivel']);
			session_destroy();
			header ('location: ../admin.php');
		}
?>