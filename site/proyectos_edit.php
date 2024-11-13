<?php
//session_start();
include("../seguridad/verificasesion.php");
include("../seguridad/conex.php");

$id = $_GET["id"];

$sql = "SELECT id, codigo, nombre, activo, uc, DATE_FORMAT(fc,'%d/%m/%Y %H:%i') fc, um, DATE_FORMAT(fm,'%d/%m/%Y %H:%i') fm FROM proyectos WHERE id = '$id'";
$result = $conn->query($sql);
$nomtitulo = "proyectos";

$row = $result->fetch_array(MYSQLI_ASSOC);

$id = $row['id'];
$codigo = $row['codigo'];
$nombre = $row['nombre'];
$activo = $row['activo'];
$uc = $row["uc"];
$fc = $row["fc"];
$um = $row["um"];
$fm = $row["fm"];
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


	function actualizar(){
		//VALIDACIONES ANTES DE GUARDAR
		if($("#codigo").val() == ""){
			alert("El campo codigo no puede estar vacío.");
			$("#codigo").focus();       // Esta función coloca el foco de escritura del usuario en el campo Nombre directamente.
			return false;
		}
		if($("#nombre").val() == ""){
			alert("El nombre no puede estar vacío.");
			$("#nombre").focus();
			return false;
		}
		
		//ENVIAR DATOS POR AJAX
		id = $('#id').val();
		codigo = $('#codigo').val();
		nombre = $('#nombre').val();
		activo = $('#activo').val();
		//alert(cod)
			var parametros = {
					"id" : id,
					"codigo" : codigo,
					"nombre" : nombre,
					"activo" : activo
			};
			$.ajax({
					data:  parametros,	
					url:   'proyectos_edit_proc.php',
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
								
								$('#id').prop('disabled',true);
								$('#codigo').prop('disabled',true);
								$('#nombre').prop('disabled',true);
								$('#activo').prop('disabled',true);
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
				width: 450px;
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
                            
                            <h3 class="h3_titulos">Editar Proyecto</h3>
                            
                            <hr class="hr_linea_titulo">
                            
                            <form role="form" data-toggle="validator">
                              
                                      <div class="form-group">
                                      <input type="text" class="form-control" id="id" style="width:60px;" value="<?php echo $id; ?>" readonly>
                                      </div>
                              
                              		  <div class="form-group">
                                        <label>Código:</label>
                                        <input type="text" class="form-control" id="codigo" placeholder="# Código" maxlength="15" style="width:120px;" value="<?php echo $codigo; ?>">
                                      </div>
                                      
                                      <div class="form-group">
                                        <label>Nombre:</label>
                                        <input type="text" class="form-control" id="nombre" placeholder="# Nombre del proyecto" maxlength="200" style="width:100%;" value="<?php echo $nombre; ?>">
                                      </div>
                                      
                                      <div class="form-group">
                                          <!--<label>Id Campus:</label>-->
                                          <!--<input type="text" class="form-control" id="campus" placeholder="# Id Campus" maxlength="12" style="width:120px;" value="<?php //echo $campus; ?>">-->
                                      </div>
                                      
                                      <div class="form-group" style="display: none;">
                                            <label>Activo:</label>
                                            <select class="form-control" id="activo" style="width:100px;">
                                                <?php
													if ($activo=="Si") {
														echo "<option value='Si' selected>Si</option>";
														echo "<option value='No'>No</option>";
													}else{
														echo "<option value='Si'>Si</option>";
														echo "<option value='No' selected>No</option>";
													}
												  ?> 
                                            </select>
                                      </div>
                              
                              
                              <div class="form-group">
                                  <a class="btn_nuevo pull-left" href="<?php echo $nomtitulo; ?>_new.php" target="_parent">
                                  <center><i class="fa fa-plus-circle" style="font-size:18px;"></i> &nbsp;&nbsp;<b>NUEVO</b></center></a>

                                  <a href="javascript:actualizar();" id="btn_actualizar" class="<?php echo $_SESSION['btnactualizar']; ?> pull-right">
                                    <center><i class="fa fa-wrench" style="font-size:18px;"></i> &nbsp;&nbsp;<b>ACTUALIZAR</b></center>
                                  </a>
                              </div>
                            </form>
                            <br/><br/>
                            <hr class="hr_auditoria">
                            

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