<?php
session_start();
include("../seguridad/conex.php");

$id = $_GET["id"];

$sql = "SELECT u.idusuario, u.nombrecompletor, u.usuario, u.nivel, s.nombresede, u.estado
FROM usuarios u 
left join sedes s on s.ids = u.idsede
WHERE u.idusuario = '$id'";
$result = $conn->query($sql);
$nomtitulo = "usuarios";

//var_dump($sql);

$row = $result->fetch_array(MYSQLI_ASSOC);

//$cod = $row["idusuario"];
$idusuario = $row["idusuario"];
$nombrecompleto = $row["nombrecompletor"]; 
$usu_select = $row["usuario"]; 
$nivel_select = $row["nivel"]; 
$nombresede = $row["nombresede"];
$estado = $row["estado"]; 
?>

<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!--<link rel="shortcut icon" href="images/favicon.ico" type="image/x-icon">-->
     
    <?php include("areas/favicon.php"); ?>
    
    <title><?php echo $_SESSION['pag_titulo']; ?></title>
    
    <!-- Font-icon css-->
    <link rel="stylesheet" type="text/css" href="css/font-awesome.min.css">
	<!-- CSS-->
    <link rel="stylesheet" type="text/css" href="css/main.css">
     
    <!-- Javascripts-->
	<?php include("js/config_js_general.php"); ?>
    
    
    <script>
	
	function validar(){
		// Campos de texto
		// Checkbox
		/*if(!$("#mayor").is(":checked")){
			alert("Debe confirmar que es mayor de 18 años.");
			return false;
		}*/
		//return true; // Si todo está correcto
	}
	
	function nuevo(){
		$("#codigo").val("");
		
		$('#codigo').prop('disabled',false);
		
		$('#btn_guardar').prop('disabled',false);
		$("#resultado").html("");	
	}
	
	function eliminar(){
		
		
		var txt;
		var r = confirm("\u00bfSeguro de eliminar este registro?");
		if (r == true) {
			
				//VALIDACIONES ANTES DE ELIMINAR
				if($("#codigo").val() == ""){
					alert("El campo Codigo no puede estar vacío. El registro ya fue eliminado!");
					$('#codigo').prop('disabled',true);
					//$("#codigo").focus();       // Esta función coloca el foco de escritura del usuario en el campo Nombre directamente.
					return false;
				}
				//ENVIAR DATOS POR AJAX
				cod = $('#codigo').val();
				var parametros = {
						"codigo" : cod
				};
				$.ajax({
					data:  parametros,	
					url:   'usuarios_elim_proc.php',
					type:  'post',
					beforeSend: function () {
							//$("#resultado").html("Procesando, espere por favor...");
							$("#resultado").html("<center><img src='images/loading.gif'></center>");
					},
					success:  function (response) {
						//alert(response);
						//$("#resultado").delay(500).fadeIn("slow"); 
						$('#resultado').fadeOut(0).delay(500).fadeIn('slow');
						$("#resultado").html(response);	
						
						if (response=="<p class='alert-danger'><i class='fa fa-close' style='font-size:20px;'></i> ¡Error inesperado, intente de nuevo por favor!</p>"){
							$('#btn_eliminar').prop('disabled',false);
						}else{
							$('#btn_eliminar').prop('disabled',true);
							
							$('#codigo').prop('disabled',true);
							
							$("#codigo").val("");
						}
					}
				});
			
		} else {
				//alert("Cancelado");
		}
		
		
		
		
	}
	</script>

</head>

<body class="sidebar-mini fixed">

<div class="wrapper">
	
    <!-- Navbar-->
    <header class="main-header hidden-print">
        <?php include("areas/barra_superior.php"); ?>
    </header>
    
    <!-- Side-Nav-->
    <aside class="main-sidebar hidden-print">
        <?php include("areas/".$_SESSION['tipo_menu']); ?>
    </aside>
            
          <div class="content-wrapper">  
          	  <?php include("areas/cabecera.php"); ?>
              

              <div id="resultado"></div>
                    	
                        <div class="container">
                        
                        <a href="<?php echo $nomtitulo; ?>.php" target="_parent" title="Regresar a la ventana anterior" class="voler pull-right"><i class="fa fa-mail-reply"></i> Volver</a>
                            
                            <h3 class="h3_titulos">Eliminar Usuario</h3>
                            
                            <hr class="hr_linea_titulo">
                            
                            <form role="form" data-toggle="validator">
                              <div class="form-group">
                                <label>DNI:</label>
                                <input type="text" class="form-control" id="codigo" style="width:120px;" maxlength="12" value="<?php echo $idusuario; ?>" readonly>
                              </div>
                              <div class="form-group">
                                <label>Nombre Completo:</label><br>
                                <?php echo $nombrecompleto; ?>
                              </div>
                              
                              <div class="col-md-6">
                                  <div class="form-group">
                                    <label>Usuario:</label><br>
                                    <?php echo $usu_select; ?>
                                  </div>
                              </div>
                              <div class="col-md-6">
                                  <div class="form-group">
                                    <label>Password:</label><br>
                                    **********
                                  </div>
                              </div>
                              
                              
                              <div class="col-md-6">
                                  <div class="form-group">
                                    <label>Nivel:</label><br>
                                    <?php
                                        if ($nivel_select=="3") {
                                            echo "Administrador";
                                        }else{
                                            echo "Operador";
                                        }
                                      ?>
                                  </div>
                              </div>
                              <div class="col-md-6">
                                  <div class="form-group">
                                    <label>Estado:</label><br>
                                      <?php
                                        if ($estado=="1") {
                                            echo "Activo";
                                        }else{
                                            echo "Inactivo";
                                        }
                                      ?>
                                  </div>
                              </div>

                              <div class="form-group">
                                <label>Sede:</label><br>
                                  <?php
                                    echo utf8_encode($nombresede);			
								                  ?>
                              </div>

                              
                              <br>
                              <div class="form-group">
                              	  <a class="btn_nuevo pull-left" href="<?php echo $nomtitulo; ?>_new.php" target="_parent">
                                  <center><i class="fa fa-plus-circle" style="font-size:18px;"></i> &nbsp;&nbsp;<b>NUEVO</b></center></a>
                                  
                                  <a href="javascript:eliminar();" id="btn_eliminar" class="<?php echo $_SESSION['btneliminar']; ?> pull-right">
                                    <center><i class="fa fa-wrench" style="font-size:18px;"></i> &nbsp;&nbsp;<b>ELIMINAR</b></center>
                                  </a>
                              </div>
                            </form>
                        </div><!--Fin del div centrado del formulario-->
                        
            </div><!--Fin del div row-->
            			
</div>


</body>
</html>