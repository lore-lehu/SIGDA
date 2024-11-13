<?php
include("../seguridad/verificasesion.php");

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
	<!-- CSS-->
    <link rel="stylesheet" type="text/css" href="css/main.css">
     
    <!-- Javascripts-->
	<?php include("js/config_js_general.php"); ?>
    
    
    <script>
	
	$(document).ready(function(){
	 $("#codigo").focus();	
	});
	
	
	function nuevo(){
		$("#codigo").val("");
		$("#nombre").val("");
		$("#activo").val("");
		
		$('#codigo').prop('disabled',false);
		$('#nombre').prop('disabled',false);
		$('#activo').prop('disabled',false);
		
		$('#btn_guardar').prop('disabled',false);
		$("#resultado").html("");
		$("#codigo").focus();	
	}
	
	function guardar(){
		//VALIDACIONES ANTES DE GUARDAR
		if($("#codigo").val() == ""){
			alert("El campo codigo no puede estar vacío.");
			$("#codigo").focus();       // Esta función coloca el foco de escritura del usuario en el campo Nombre directamente.
			return false;
		}
		if($("#nombre").val() == ""){
			alert("El campo nombre no puede estar vacío.");
			$("#nombre").focus();       // Esta función coloca el foco de escritura del usuario en el campo Nombre directamente.
			return false;
		}
		
		//ENVIAR DATOS POR AJAX
		codigo = $('#codigo').val();
		nombre = $('#nombre').val();
		activo = $('#activo').val();
		//alert(cod)
			var parametros = {
					"codigo" : codigo,
					"nombre" : nombre,
					"activo" : activo
			};
			$.ajax({
					data:  parametros,	
					url:   'proyectos_new_proc.php',
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
								$('#btn_guardar').prop('disabled',false);
							}else{
								$('#btn_guardar').prop('disabled',true);
								
								$('#codigo').prop('disabled',true);
								$('#nombre').prop('disabled',true);
								$('#activo').prop('disabled',true);
								
								$('#btn_guardar').unbind('click', false);
								
								//$('#divdoc').show();
							}
					}
			});
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
              <!--<a class="btn_nuevo pull-left" href="usuarios.php" target="_parent" title="Regresar a la ventana anterior"><i class="fa fa-mail-reply"></i></a>-->
              
                    	<div class="container">
                        
                        <a href="proyectos.php" target="_parent" title="Regresar a la ventana anterior" class="voler pull-right"><i class="fa fa-mail-reply"></i> Volver</a>
                        
                        <h3 class="h3_titulos">Registrar Proyecto</h3>
                        
                        <hr class="hr_linea_titulo">
                            
                            <form role="form" data-toggle="validator">  
                              
                                      <div class="form-group">
                                        <label>Código:</label>
                                        <input type="text" class="form-control" id="codigo" name="codigo" placeholder="# Código" maxlength="15" style="width:120px;">
                                      </div>

									  <div class="form-group">
                                        <label>Nombre:</label>
                                        <input type="text" class="form-control" id="nombre" name="nombre" placeholder="Nombre del proyecto" maxlength="15" style="width:100%;">
                                      </div>
                                      
                                      <div class="form-group">
                                      	<div id="resultado_nombre"></div>
                                      </div>
                                      
                                      <div class="form-group">
                                      	<div id="resultado_campus"></div>
                                      </div>
                                                                            
                                      <div class="form-group" style="display: none;">
                                            <label>Activo:</label>
                                            <select class="form-control" id="activo" style="width:100px;">
                                                <option value='Si' selected>Si</option>
                                                <option value='No'>No</option>
                                            </select>
                                      </div>
                                      
                                      
                                      
                                      <div class="form-group">
                                      	<a href="proyectos_new.php" id="btn_nuevo" class="<?php echo $_SESSION['btnnuevo']; ?> pull-left">
                                        <center><i class="fa fa-plus-circle" style="font-size:18px;"></i> &nbsp;&nbsp;<b>NUEVO</b></center>
                                        </a>
                                        <a href="javascript:guardar();" id="btn_guardar" class="<?php echo $_SESSION['btnguardar']; ?> pull-right">
                                        <center><i class="fa fa-floppy-o" style="font-size:18px;"></i> &nbsp;&nbsp;<b>GUARDAR</b></center>
                                        </a>
                                        
                                      </div>
                                      
                                      
  
                            </form>
							
                        </div>
                        <br>
                        <center><div id="notimesa"></div></center>
                        	
            </div>
</div>


</body>
</html>