<?php
include("../seguridad/verificasesion.php");
include("../seguridad/conex.php");

$sql = "SELECT ids, nombresede FROM sedes order by nombresede asc";
$result = $conn->query($sql);

/*$sql_proceso = "SELECT id, nombre FROM procesos ORDER BY nombre";
$result_proceso = $conn->query($sql_proceso);*/
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
	
	$(document).ready(function(){
	 $("#codigo").focus();	
	});
	
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
		$("#idusuario").val("");
		$("#nombre").val("");
		$("#usuario").val("");
		$("#password").val("");
		
		$('#idusuario').prop('disabled',false);
		$('#nombre').prop('disabled',false);
		$('#usuario').prop('disabled',false);
		$('#password').prop('disabled',false);
		$('#nivel').prop('disabled',false);
		$('#sede').prop('disabled',false);
		$('#activo').prop('disabled',false);
		
		$('#btn_guardar').prop('disabled',false);
		$("#resultado").html("");
		$("#idusuario").focus();	
		
		var url_blanco = "http://localhost/callcontacto/iframe_blanco.php"
		$('#frm_fotos').prop('src', url_blanco)
	}
	
	function guardar(){
		//VALIDACIONES ANTES DE GUARDAR
		if($("#idusuario").val() == ""){
			alert("El campo DNI no puede estar vacío.");
			$("#idusuario").focus();       // Esta función coloca el foco de escritura del usuario en el campo Nombre directamente.
			return false;
		}
		if($("#nombre").val() == ""){
			alert("El campo Nombre Completo no puede estar vacío.");
			$("#nombre").focus();
			return false;
		}
		if($("#usuario").val() == ""){
			alert("El campo Usuario no puede estar vacío.");
			$("#usuario").focus();
			return false;
		}
		if($("#password").val() == ""){
			alert("El campo Password no puede estar vacío.");
			$("#password").focus();
			return false;
		}
		if($("#sede").val() == "Seleccione"){
			alert("Seleccione una Sede por favor.");
			$("#sede").focus();
			return false;
		}
		
		//ENVIAR DATOS POR AJAX
		idusuario  = $('#idusuario').val();
		nom = $('#nombre').val();
		usu = $('#usuario').val();
		pass = $('#password').val();
		nivel = $('#nivel').val();
		sede = $('#sede').val();
		activo = $('#activo').val();
		//alert(cod)
			var parametros = {
					"idusuario" : idusuario ,
					"nombre" : nom,
					"usuario" : usu,
					"password" : pass,
					"nivel" : nivel,
					"sede" : sede,
					"activo" : activo
			};
			$.ajax({
					data:  parametros,	
					url:   'usuarios_new_proc.php',
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
								
								$('#idusuario').prop('disabled',true);
								$('#nombre').prop('disabled',true);
								$('#usuario').prop('disabled',true);
								$('#password').prop('disabled',true);
								$('#nivel').prop('disabled',true);
								$('#sede').prop('disabled',true);
								$('#activo').prop('disabled',true);
								
								$('#btn_guardar').unbind('click', false);
								
								//var url = "/callcontacto/site/files/usuarios/"+cod+"/index.php?id="+cod
								//$('#frm_fotos').prop('src', url)
								$("#enviarfoto").removeAttr('disabled');
								
							}
					}
			});
	}
	</script>
    
    
    <script src="js/script.js"></script>
    
    <style>
		#previewing {
			vertical-align: middle;
			width: 50%;
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
                        
                        <a href="usuarios.php" target="_parent" title="Regresar a la ventana anterior" class="voler pull-right"><i class="fa fa-mail-reply"></i> Volver</a>
                        
                        <h3 class="h3_titulos">Registrar Usuario</h3>
                        
                        <hr class="hr_linea_titulo">
                            
                            <form role="form" data-toggle="validator">
                              <div class="form-group">
                                <label>DNI:</label>
                                <input type="text" class="form-control" id="idusuario" style="width:120px;" maxlength="12" required>
                              </div>
                              <div class="form-group">
                                <label>Nombre Completo:</label>
                                <input type="text" class="form-control" id="nombre" placeholder="Ingrese su nombre completo" maxlength="100">
                              </div>
                              
                              
                              <!--Usuario y clave-->
                              <div class="col-md-6">
                                  <div class="form-group">
                                    <label>Usuario:</label>
                                    <input type="text" class="form-control" id="usuario" placeholder="Ingrese su usuario" style="width:150px;" maxlength="30">
                                  </div>
                              </div>
                              <div class="col-md-6">
                                  <div class="form-group">
                                    <label>Password:</label>
                                    <input type="password" class="form-control" id="password" placeholder="Password" style="width:150px;" maxlength="30">
                                  </div>
                              </div>
                              
                              
                              <!--Nivel y Activo-->
                              <div class="col-md-6">
                                  <div class="form-group">
                                    <label>Nivel:</label>
                                    <select class="form-control" id="nivel" style="width:150px;">
                                      <option value="3">Gerencia</option>
                                      <option value="2" selected>Staff</option>
                                    </select>
                                  </div>
                              </div>
                              <div class="col-md-6">
                                  <div class="form-group">
                                    <label>Estado:</label>
                                    <select class="form-control" id="activo" style="width:150px;">
                                      <option value="1" selected>Activo</option>
                                      <option value="0">Inactivo</option>
                                    </select>
                                  </div>
                              </div>
                              
                              
                              
                              <div class="form-group">
                                <label>Sede:</label>
                                <select class="form-control" id="sede">  
                                  <?php
								  	if ($result->num_rows > 0) {
										echo "<option value='Seleccione' selected>Seleccione</option>";
                                        while($row = $result->fetch_assoc()) {
                                            echo "<option value='".$row['ids']."'>".$row['nombresede']."</option>";			
                                        }
                                    }else{
                                            echo "<option value=''>No hay resultados</option>";
                                    }
                                    //$conn->close();	
								  ?>  
                                </select>
								
                              </div>

							               
                          
                          <br>
                          
                          <div class="form-group">
                            <!--<input type="button" id="btn_guardar" class="<?php //echo $_SESSION['btnnuevo']; ?> pull-right" onclick="guardar();" value="Guardar"/>--> 
                            <a href="javascript:nuevo();" id="btn_nuevo" class="<?php echo $_SESSION['btnnuevo']; ?> pull-left">
                            <center><i class="fa fa-plus-circle" style="font-size:18px;"></i> &nbsp;&nbsp;<b>NUEVO</b></center>
                            </a>
                            <a href="javascript:guardar();" id="btn_guardar" class="<?php echo $_SESSION['btnguardar']; ?> pull-right">
                            <center><i class="fa fa-floppy-o" style="font-size:18px;"></i> &nbsp;&nbsp;<b>GUARDAR</b></center>
                            </a>
                          </div>
                          
                            </form>
							
                        <br/><br/>
                        
                        <br/><br/>
                            <!--
                            <center>
                            <div class="main">
                                <h5>SUBIR FOTO DE USUARIO</h5>
                                <p class="pull-right"><img src="images/eliminar.png" onClick="eliminar_foto();" style="cursor:pointer;" title="Eliminar la foto actual."></p>
                                    <form id="uploadimage" action="" method="post" enctype="multipart/form-data">
                                        <div id="image_preview" style="border-radius: 10px; box-shadow: 1px 1px 1px 1px; padding:5px; width:70%;" >
                                            <img id="previewing" src="noimage.png" />
                                        </div><br>
                                            <div id="selectImage">
                                                <label>Selecciona tu imagen</label><br/><br/>
                                                <center>
                                                <input type="file" name="file" id="file" required class="btn-block"/><br>
                                                </center>
                                                <input type="submit" id="enviarfoto" value="Subir imágen" class="btn-primary" disabled />
                                            </div>
                                    </form>
                            </div>
                                <h4 id='loading' >Cargando..</h4>
                                <br><div id="message"></div>
                            </center>
								-->
                            
                            
                            
                            <!--<iframe id="frm_fotos" width="100%" height="280" frameborder="0"></iframe>-->

                        </div>
                        
                        
                        
                        
                        
            </div>
</div>


</body>
</html>