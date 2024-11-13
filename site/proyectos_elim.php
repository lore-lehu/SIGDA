<?php
//session_start();
include("../seguridad/verificasesion.php");
include("../seguridad/conex.php");

$id = $_GET["id"];

$sql = "SELECT id, codigo, nombre, activo FROM proyectos WHERE id = '$id'";
$result = $conn->query($sql);
$nomtitulo = "proyectos";

$row = $result->fetch_array(MYSQLI_ASSOC);

$id = $row['id'];
$codigo = $row['codigo'];
$nombre = $row['nombre'];
$activo = $row['activo'];
?>

<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
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
	
	
	
	function eliminar(){

		var txt;
		var r = confirm("\u00bfSeguro de eliminar este registro?");
		if (r == true) {
			
				//VALIDACIONES ANTES DE ELIMINAR
				if($("#id").val() == ""){
					alert("El campo Id no puede estar vacío. El registro ya fue eliminado!");
					$('#codigo').prop('disabled',true);
					//$("#codigo").focus();       // Esta función coloca el foco de escritura del usuario en el campo Nombre directamente.
					return false;
				}
				//ENVIAR DATOS POR AJAX
				cod = $('#id').val();
				var parametros = {
						"id" : cod
				};
				$.ajax({
					data:  parametros,	
					url:   'proyectos_elim_proc.php',
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
							
							$('#id').prop('disabled',true);
							
							$("#id").val("");
						}
					}
				});
			
		} else {
				//alert("Cancelado");
		}
		
		
		
		
	}
	</script>
    
    <style>
        /* *************** Desktops and laptops *************** */
		@media only screen 
		and (min-width : 1224px) {
			.container {
				width: 400px;
			}
		}
		 
		/* *************** Pantallas mas largas *************** */
		@media only screen 
		and (min-width : 1824px) {
			.container {
				width: 600px;
			}
		}
    </style>

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
                            
                            <h3 class="h3_titulos">Eliminar Proyecto</h3>
                            
                            <hr class="hr_linea_titulo">
                            
                            <form role="form" data-toggle="validator">
                              <div class="form-group">
                                <label>Id:</label>
                                <input type="text" class="form-control" id="id" style="width:60px;" value="<?php echo $id; ?>" readonly>
                              </div>
                              
                             <div class="form-group">
                                        <label>Código:</label>
                                        <input type="text" class="form-control" id="codigo" maxlength="15" style="width:120px;" value="<?php echo $codigo; ?>" disabled>
                              </div>
                              
                              <div class="form-group">
                                  <label>Nombre:</label>
                                  <input type="text" class="form-control" id="nombre" maxlength="12" style="width:100%;" value="<?php echo $nombre; ?>" disabled>
                              </div>
                              
                              <div class="form-group">
                                    <label>Proyecto Activo:</label>
                                    <select class="form-control" id="activo" style="width:100px;" disabled>
                                          <?php
                                            echo "<option value='".$activo."' selected>".$activo."</option>";
                                          ?> 
                                    </select>
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