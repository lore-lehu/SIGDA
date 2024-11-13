<?php
session_start();
include("../seguridad/conex.php");

$id = $_GET["id"];
$_SESSION['id'] = $id;


$sql = "SELECT u.idusuario, u.nombrecompletor, u.usuario, u.nivel, u.estado, u.clave, u.idsede, 
DATE_FORMAT(u.fechagrab,'%d/%m/%Y %H:%i') fc , u.usuariograb uc, u.um, DATE_FORMAT(u.fm,'%d/%m/%Y %H:%i') fm
FROM usuarios u 
WHERE u.idusuario = '$id'";
$result = $conn->query($sql);
$nomtitulo = "usuarios";

$row = $result->fetch_array(MYSQLI_ASSOC);

//$cod = $row["idusuario"];
$nombrecompleto = $row["nombrecompletor"]; 
$usu_select = $row["usuario"]; 
$clave = $row["clave"]; 
$nivel_select = $row["nivel"]; 
$idsede = $row["idsede"];

$uc = $row["uc"];
$fc = $row["fc"];
$um = $row["um"];
$fm = $row["fm"];

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
		
		$('#btn_guardar').prop('disabled',false);
		$("#resultado").html("");	
		$("#idusuario").focus();
	}
	
	function actualizar(){
		//VALIDACIONES ANTES DE GUARDAR
		if($("#idusuario").val() == ""){
			alert("El campo idusuario no puede estar vacío.");
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
		idusuario = $('#idusuario').val();
		nom = $('#nombre').val();
		usu = $('#usuario').val();
		pass = $('#password').val();
		nivel = $('#nivel').val();
		sede = $('#sede').val();
		activo = $('#activo').val();
		proceso = $('#proceso').val();
		//alert(cod)
			var parametros = {
					"idusuario" : idusuario,
					"nombre" : nom,
					"usuario" : usu,
					"password" : pass,
					"nivel" : nivel,
					"sede" : sede,
					"activo" : activo,
					"proceso" : proceso
			};
			$.ajax({
					data:  parametros,	
					url:   'usuarios_edit_proc.php',
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
                    	
                        <div class="container">
                        
                        <a href="<?php echo $nomtitulo; ?>.php" target="_parent" title="Regresar a la ventana anterior" class="voler pull-right"><i class="fa fa-mail-reply"></i> Volver</a>
                            
                            <h3 class="h3_titulos">Editar Usuario</h3>
                            
                            <hr class="hr_linea_titulo">
                            
                            <form role="form" data-toggle="validator">
                              <div class="form-group">
                                <label>DNI:</label>
                                <input type="text" class="form-control" id="idusuario" style="width:120px;" maxlength="12" value="<?php echo $id; ?>" readonly>
                              </div>
                              <div class="form-group">
                                <label>Nombre Completo:</label>
                                <input type="text" class="form-control" id="nombre" placeholder="Ingrese su nombre completo" 
                                maxlength="100" value="<?php echo $nombrecompleto; ?>">
                              </div>
                              
                              
                              <!--Usuario y clave-->
                              <div class="col-md-6">
                                  <div class="form-group">
                                    <label>Usuario:</label>
                                    <input type="text" class="form-control" id="usuario" placeholder="Ingrese su usuario" 
                                    style="width:150px;" value="<?php echo $usu_select; ?>" maxlength="30" readonly>
                                  </div>
                              </div>
                              <div class="col-md-6">
                                  <div class="form-group">
                                    <label>Password:</label>
                                    <input type="password" class="form-control" id="password" placeholder="Password" 
                                    style="width:150px;" maxlength="30" value="<?php echo $clave ?>">
                                  </div>
                              </div>
                              
                              
                              <!--Nivel y Activo-->
                              <div class="col-md-6">
                                  <div class="form-group">
                                    <label>Nivel:</label>
                                    <select class="form-control" id="nivel" style="width:150px;">
                                      <?php
                                        if ($nivel_select=="3") {
                                            echo "<option value='3' selected>Administrador</option>";
                                            echo "<option value='2'>Operador</option>";
                                        }else{
                                            echo "<option value='3'>Administrador</option>";
                                            echo "<option value='2' selected>Operador</option>";
                                        }
                                        //$conn->close();	
                                      ?> 
                                      
                                    </select>
                                  </div>
                              </div>
                              <div class="col-md-6">
                                  <div class="form-group">
                                    <label>Estado:</label>
                                    <select class="form-control" id="activo" style="width:150px;">
                                      <?php
                                        if ($estado=="1") {
                                            echo "<option value='1' selected>Activo</option>";
                                            echo "<option value='0'>Inactivo</option>";
                                        }else{
                                            echo "<option value='1'>Activo</option>";
                                            echo "<option value='0' selected>Inactivo</option>";
                                        }
                                      ?> 
                                    </select>
                                  </div>
                              </div>
                              
                              
                              <div class="form-group">
                                <label>Sede:</label>
                                <select class="form-control" id="sede">  
                                  <?php
								  	$sql_sedes = "SELECT ids, nombresede FROM sedes order by nombresede asc";
									$result_sedes = $conn->query($sql_sedes);
								        while($row_sedes = $result_sedes->fetch_assoc()) {
											if ($row_sedes['ids']==$idsede){
												$sel = 'selected';	
											}else{
												$sel = '';	
											}
                                            echo "<option value='".$row_sedes['ids']."' $sel>".$row_sedes['nombresede']."</option>";			
                                        }
                                    //$conn->close();	
								  ?>  
                                </select>
                              </div>

							 
                              
                              <br>
                              <div class="form-group">
                                  <a class="btn_nuevo pull-left" href="<?php echo $nomtitulo; ?>_new.php" target="_parent">
                                  <center><i class="fa fa-plus-circle" style="font-size:18px;"></i> &nbsp;&nbsp;<b>NUEVO</b></center></a>

                                  <a href="javascript:actualizar();" id="btn_actualizar" class="<?php echo $_SESSION['btnactualizar']; ?> pull-right">
                                    <center><i class="fa fa-wrench" style="font-size:18px;"></i> &nbsp;&nbsp;<b>ACTUALIZAR</b></center>
                                  </a>
                              </div>
                            </form>
                            
                           <br><br>
                            

                            
                            <div style="background-color:#E9E9E9; padding:10px;">
                            <p><b><u>AUDITOR&Iacute;A:</u></b></p>
                             <p>Usuario y fecha de registro:   <b><?php echo $uc."  -  ".$fc; ?></b></p>
                             <p>&Uacute;ltima actualizaci&oacute;n :   <b><?php echo $um."  -  ".$fm; ?></b></p>
                            </div>
                        </div><!--Fin del div centrado del formulario-->
                        
            </div><!--Fin del div row-->
            			
</div>


</body>
</html>