<?php
//session_start();
include("../seguridad/verificasesion.php");
include("../seguridad/conex.php");

$id = $_GET["id"];
$idproyecto = $_GET["idproyecto"];

$sql_archivo = "SELECT nombre, coment_ope, coment_ger, activo FROM archivos WHERE id = '$id'";
$result_archivo = $conn->query($sql_archivo);
$row_archivo = $result_archivo->fetch_array(MYSQLI_ASSOC);
$nombre_archivo = $row_archivo['nombre'];
$coment_ope = $row_archivo['coment_ope'];
$coment_ger = $row_archivo['coment_ger'];
$activo_archivo = $row_archivo['activo'];

$sql_proyecto = "SELECT nombre FROM proyectos WHERE id = '$idproyecto'";
$result_proyecto = $conn->query($sql_proyecto);
$row_proyecto = $result_proyecto->fetch_array(MYSQLI_ASSOC);
$nombre_proyecto = $row_proyecto['nombre'];


$sql_doc = "SELECT contenido FROM documentos WHERE idproyecto = '".$idproyecto."' AND idarchivo = '".$id."'";
$result_doc = $conn->query($sql_doc);

if ($result_doc->num_rows > 0) {
	$row_doc = $result_doc->fetch_array(MYSQLI_ASSOC);
    $contenido_documento = $row_doc['contenido'];
}else{
	$contenido_documento = "";
}

$sql_historial = "SELECT id, accion, usuario, DATE_FORMAT(fc, '%d/%m/%Y %h:%i %p') fc FROM historial WHERE idproyecto = '$idproyecto' AND idarchivo = '$id' ORDER BY id DESC";
$result_historial = $conn->query($sql_historial);

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
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <!-- CSS-->
    <link rel="stylesheet" type="text/css" href="css/main.css">
    <link rel="stylesheet" type="text/css" href="css/mis_estilos.css">
    <!-- Font-icon css-->
    <link rel="stylesheet" type="text/css" href="css/font-awesome.min.css">
    <!--https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css-->
    <title><?php echo $_SESSION['pag_titulo']; ?></title>
    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries-->
    <!--if lt IE 9
    script(src='https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js')
    script(src='https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js')
    -->
    
    <script src="https://cdnjs.cloudflare.com/ajax/libs/html2pdf.js/0.10.1/html2pdf.bundle.min.js"></script>

    <style>
        .alert-info {
            background-color: #d9edf7;
            color: #31708f;
            padding: 5px;
            border: none;
            border-radius: inherit;
            border-radius: 6px;
        }
        .table {
            font-size: small;
        }

        .aprobado {
            font-size: 12px;
            background-color: #3c952b;
        }
        .desaprobado {
            font-size: 12px;
            background-color: #d71010;
        }
    </style>

    <script>
        function guardar(){
            //VALIDACIONES ANTES DE GUARDAR
            if($("#contenido").val() == ""){
                alert("El campo contenido no puede estar vacío.");
                $("#contenido").focus();
                return false;
            }
            //ENVIAR DATOS POR AJAX
            idproyecto = $('#idproyecto').val();
            idarchivo = $('#idarchivo').val();
            contenido = $('#contenido').val();
            
            //alert(cod)
			var parametros = {
					"idproyecto" : idproyecto,
                    "idarchivo" : idarchivo,
                    "contenido" : contenido
			};
			$.ajax({
					data:  parametros,	
					url:   'documentos_new_proc.php',
					type:  'post',
					beforeSend: function () {
							$("#resultado").html("Procesando, espere por favor...");
					},
					success:  function (response) {
							//alert(response); 
							$('#resultado').fadeOut(0).delay(500).fadeIn('slow');
							$("#resultado").html(response);	
							
							if (response=="<p class='alert-danger'><i class='fa fa-close' style='font-size:20px;'></i> ¡Error inesperado, intente de nuevo por favor!</p>"){
								$('#btn_guardar').prop('disabled',false);
							}else{
								$('#btn_guardar').prop('disabled',true);
								$('#contenido').prop('disabled',true);	
								$('#btn_guardar').unbind('click', false);
                                $('html, body').animate({scrollTop: 0}, 200);
							}
					}
			});
	    }

        function actualizar(){
            //VALIDACIONES ANTES DE GUARDAR
            if($("#contenido_editar").val() == ""){
                alert("El campo contenido no puede estar vacío.");
                $("#contenido_editar").focus();
                return false;
            }
            //ENVIAR DATOS POR AJAX
            idproyecto = $('#idproyecto').val();
            idarchivo = $('#idarchivo').val();
            contenido_editar = $('#contenido_editar').val();
            
            //alert(cod)
			var parametros = {
					"idproyecto" : idproyecto,
                    "idarchivo" : idarchivo,
                    "contenido_editar" : contenido_editar
			};
			$.ajax({
					data:  parametros,	
					url:   'documentos_edit_proc.php',
					type:  'post',
					beforeSend: function () {
							$("#resultado").html("Procesando, espere por favor...");
					},
					success:  function (response) {
							//alert(response); 
							$('#resultado').fadeOut(0).delay(500).fadeIn('slow');
							$("#resultado").html(response);	
							
							if (response=="<p class='alert-danger'><i class='fa fa-close' style='font-size:20px;'></i> ¡Error inesperado, intente de nuevo por favor!</p>"){
								$('#btn_guardar').prop('disabled',false);
							}else{
								$('#btn_guardar').prop('disabled',true);
								$('#contenido').prop('disabled',true);	
								$('#btn_guardar').unbind('click', false);
                                $('html, body').animate({scrollTop: 0}, 200);
							}
					}
			});
	    }



        function guardar_coment(tipo){
            //tipo = "operador";
            //VALIDACIONES ANTES DE GUARDAR
            
            //ENVIAR DATOS POR AJAX
            idproyecto = $('#idproyecto').val();
            idarchivo = $('#idarchivo').val();
            aprobado = $('#aprobado').val();
            
            if (tipo == "operador"){
                if($("#comentario_ope").val() == ""){
                    alert("El campo comentario operador no puede estar vacío.");
                    $("#comentario_ope").focus();
                    return false;
                }
                contenido_editar = $('#comentario_ope').val();
            }else{
                if($("#comentario_ger").val() == ""){
                    alert("El campo comentario gerente no puede estar vacío.");
                    $("#comentario_ger").focus();
                    return false;
                }
                contenido_editar = $('#comentario_ger').val();
            }
            
            //alert(cod)
			var parametros = {
					"idproyecto" : idproyecto,
                    "idarchivo" : idarchivo,
                    "contenido_editar" : contenido_editar,
                    "tipo" : tipo,
                    "aprobado" : aprobado
			};
			$.ajax({
					data:  parametros,	
					url:   'archivos_edit_coment.php',
					type:  'post',
					beforeSend: function () {
							$("#resultado").html("Procesando, espere por favor...");
					},
					success:  function (response) {
							//alert(response); 
							$('#resultado').fadeOut(0).delay(500).fadeIn('slow');
							$("#resultado").html(response);	
							$('#comentario_ope').prop('disabled',true);	
                            $('#comentario_ger').prop('disabled',true);	
							if (response=="<p class='alert-danger'><i class='fa fa-close' style='font-size:20px;'></i> ¡Error inesperado, intente de nuevo por favor!</p>"){
								//$('#btn_guardar').prop('disabled',false);
							}else{
                                $('html, body').animate({scrollTop: 0}, 200);
							}
					}
			});
        }


        function uploadImages() {
            var formData = new FormData(document.getElementById('uploadForm'));
            
            $.ajax({
                url: 'guardar_files.php',  // Archivo PHP que manejará la subida
                type: 'POST',
                data: formData,
                contentType: false,
                processData: false,
                success: function(response) {
                    document.getElementById('status').innerHTML = response;  // Mostrar respuesta
                    loadImages(); 
                },
                error: function() {
                    document.getElementById('status').innerHTML = 'Error al subir las imágenes.';
                }
            });
        }

        // Función para cargar la lista de imágenes
        function loadImages() {
            prefix = $('#prefix').val();
            idproy = $('#idproy').val();
            //alert(prefix);
            $.ajax({
                url: 'list_images.php?id='+prefix+'&idproy='+idproy,  // Archivo PHP que lista las imágenes
                type: 'GET',
                success: function(data) {
                    $('#image-list').html(data);  // Mostrar las imágenes
                }
            });
        }

        // Función para eliminar una imagen
        function deleteImage(imageName, iddocumento, idproyecto) {
            if (confirm('¿Estás seguro de que deseas eliminar esta imagen?')) {
                $.ajax({
                    url: 'delete_image.php?iddocumento='+iddocumento+'&idproyecto='+idproyecto,  // Archivo PHP que elimina la imagen
                    type: 'POST',
                    data: { image: imageName },
                    success: function(response) {
                        //alert(response);  // Mostrar respuesta
                        loadImages();  // Recargar la lista de imágenes
                    }
                });
            }
        }

        // Cargar la lista de imágenes al cargar la página
        $(document).ready(function() {
            loadImages();

            document.getElementById('generate-pdf').addEventListener('click', generatePDF);

            function generatePDF() {
                prefix = $('#prefix').val();
                idproy = $('#idproy').val();

                const element = document.getElementById('contenido_export'); // Obtener el contenido HTML

                // Configuración del PDF
                const opt = {
                    margin:       1,
                    filename:     'Documento_PRY'+idproy+'_DOC'+prefix+'.pdf',
                    image:        { type: 'jpeg', quality: 0.98 },
                    html2canvas:  { scale: 2 },
                    jsPDF:        { unit: 'in', format: 'legal', orientation: 'portrait', autoPaging: 'true' }
                };

                // Generar el PDF
                html2pdf()
                    .from(element)   // El elemento que quieres convertir
                    .set(opt)       // Configuraciones
                    .save();        // Descargar el PDF
            }
        });



        // Función para cargar la lista de imágenes
        function apiRedactar() {
            frases = $('#frases').val();
            titulo = $('#titulo').val();
			var parametros = {
					"frases" : frases,
                    "titulo" : titulo
			};
			$.ajax({
					data:  parametros,	
					url:   'apiredactar.php',
					type:  'post',
					beforeSend: function () {
							$("#contenido").html("Procesando, espere por favor...");
					},
					success:  function (response) {
                            const textoConSaltos = response.replace(/<br\s*\/?>/gi, "\n");
							//$('#result_texto').fadeOut(0).delay(500).fadeIn('slow');	
                            $('#contenido').val(textoConSaltos);
							
							if (response=="<p class='alert-danger'><i class='fa fa-close' style='font-size:20px;'></i> ¡Error inesperado, intente de nuevo por favor!</p>"){
								$('#btn_guardar').prop('disabled',false);
							}else{
                                //$('html, body').animate({scrollTop: 0}, 200);
							}
					}
			});
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
                   <!-- <div class="row">-->
                        <div class="col-md-12"><!--ANCHO 9 PARA EL AREA CENTRAL-->

                        <a href="archivos.php?idproyecto=<?php echo $idproyecto; ?>" target="_parent" title="Regresar a la ventana anterior" class="voler pull-right"><i class="fa fa-mail-reply"></i> Volver</a><br>
                        <div class="alert-info">

                        <?php
                            if ($activo_archivo=="No"){
                                $cl_act = "badge bg-danger desaprobado";
                                $est = "DESAPROPBADO";
                            }else{
                                $cl_act = "badge bg-success aprobado";	
                                $est = "APROBADO";
                            }
                        ?>

                            <p>Proyecto: <b><?php echo $nombre_proyecto;  ?>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<span class="badge bg-danger"><span class='<?php echo $cl_act; ?>'><?php echo $est; ?></span></span></b></p>
                            <p>Archivo: <b><?php echo $nombre_archivo; ?></b></p>
                        </div>

                                <!--Inicio de Card-->
                                <div class="card">
                                    <a class="voler pull-right" href="javascript:location.reload()" title="Dele clic aqu&iacute; para actualizar esta p&aacute;gina.">
                                    <i class="fa fa-refresh" aria-hidden="true"></i> 
                                    <u>Actualizar</u>&nbsp;&nbsp;
                                    </a>
                                        <!--<h3 class="card-title">Publicaciones</h3>-->
                                        <!--Inicio de Panel-Info-->
                                        <div class="panel panel-info">
                                                <!--Inicio de Panel-Body-->
                                                <div class="panel-body">
                                                    <!--Inicio de bs-component-->
                                                    <div class="bs-component" style="background-color:#FFF;">
                                                        
                                                        <!--Nombres de las fichas de las areas-->
                                                        <ul class="nav nav-tabs">
                                                            <li class="active"><a href="#vistaprevia" data-toggle="tab" aria-expanded="true">Vista Previa</a></li>
                                                            <li class=""><a href="#documentar" data-toggle="tab" aria-expanded="true">Documentar</a></li>
                                                            <li class=""><a href="#galeria" data-toggle="tab" aria-expanded="false">Galería</a></li>
                                                            <li class=""><a href="#historial" data-toggle="tab" aria-expanded="false">Historial</a></li>
                                                            <li class=""><a href="#editar" data-toggle="tab" aria-expanded="false">Editar</a></li>
                                                            <li class=""><a href="#exportar" data-toggle="tab" aria-expanded="false">Observaciones</a></li>
                                                            <!--
                                                            
                                                            <li class=""><a href="#finanzas" data-toggle="tab" aria-expanded="false">FINANZAS</a></li>
                                                            <li class=""><a href="#logistica" data-toggle="tab" aria-expanded="false">LOG&Iacute;STICA</a></li>
                                                            -->
                                                        </ul>
                                                        <!--Fin de los nombres de las fichas de las areas-->
                                                
                                                        <!--Inicio de tab-content-->
                                                        <div class="tab-content" id="myTabContent">
                                                            
                                                                <!--Contenido de la ficha Vista Previa-->
                                                                <br><div class="tab-pane fade active in" id="vistaprevia">

                                                                    <div class="panel panel-info">
                                                                        <div class="panel-heading">
                                                                            <h3 class="panel-title">
                                                                                Contenido de la Vista previa
                                                                                &nbsp;&nbsp;&nbsp;<button id="generate-pdf">Generar PDF</button>
                                                                            </h3>
                                                                        </div>
                                                                        <div class="panel-body">
                                                                            <div id="contenido_export">
                                                                                <!--    
                                                                                <textarea readonly id="content_vistaprevia" name="content_vistaprevia" class="form-control" rows="5" style="height: 150px !important;"><?php echo $contenido_documento; ?></textarea>
                                                                                -->
                                                                                <?php echo nl2br($contenido_documento); ?>
                                                                               
                                                                                <h5>IMÁGENES DEL DOCUMENTO:</h5>
                                                                                
                                                                                <?php
                                                                                    // Directorio donde están almacenadas las imágenes
                                                                                    $directory = 'upload/';

                                                                                    // Bucle para 10 iteraciones
                                                                                    for ($i = 1; $i <= 10; $i++) {
                                                                                        // Generar el nombre de la imagen con el prefijo 'img_' seguido del número de iteración
                                                                                        $imageName = $id.'_imagen_' . $i . '.jpg';
                                                                                        $imagePath = $directory . $imageName;  // Ruta completa de la imagen
                                                                                        //var_dump($imagePath);

                                                                                        // Verificar si la imagen existe
                                                                                        if (file_exists($imagePath)) {
                                                                                            // Mostrar la imagen si existe
                                                                                            echo "<br><p><b>Imagen ".$i."</b></p><br>";
                                                                                            echo '<img src="' . $imagePath . '" alt="Imagen ' . $i . '"  width=50%><br>';
                                                                                        }else{
                                                                                            //echo "No existe";
                                                                                        }
                                                                                    }
                                                                                ?>

                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                                <!-- Fin de ficha Vista Previa-->
                                                                
                                                                
                                                                <!--Contenido de la ficha Documentar-->
                                                                <div class="tab-pane fade" id="documentar">
                                                                    <!--<p style="padding:20px;">Contenido de la documentación...</p>-->
                                                                    <br>
                                                                    <div class="panel panel-info">
                                                                        <div class="panel-heading">
                                                                            <h3 class="panel-title">Documentar Control de Aplicación</h3>
                                                                        </div>
                                                                        <div class="panel-body">
                                                                              
                                                                              <form role="form" data-toggle="validator"> 
                                                                              <div class="form-group">
                                                                                    <h6>Título del Documento</h6>
                                                                                    <input type="text" id="titulo" name="titulo" class="form-control" value="<?php echo "PROYECTO ".$nombre_proyecto." - ".$nombre_archivo; ?>"/>
                                                                                </div>
                                                                              <div class="form-group">
                                                                                <label>Ingresa frases cortas separadas por saltos de línea:</label>
                                                                                <textarea id="frases" name="frases" class="form-control" rows="5" style="height: 150px !important;"></textarea>
                                                                              </div>

                                                                              <div class="form-group">
                                                                                <a href="javascript:apiRedactar();" id="btn_guardar" class="btn btn-success pull-left">
                                                                                    <center><i class="fa fa-pencil-square-o" style="font-size:18px;"></i> &nbsp;&nbsp;<b>Redactar</b></center>
                                                                                </a>
                                                                              </div>

                                                                              </form>
                                                                        </div>


                                                                        <div class="panel-heading">
                                                                            <h3 class="panel-title">Resultado</h3>
                                                                        </div>
                                                                        <div class="panel-body">
                                                                              
                                                                              <form role="form" data-toggle="validator" method="post"> 
                                                                                <div class="form-group">
                                                                                    <input type="hidden" id="idarchivo" value="<?php echo $id; ?>" readonly>
                                                                                    <input type="hidden" id="idproyecto" value="<?php echo $idproyecto; ?>" readonly>
                                                                                    <textarea id="contenido" name="contenido" class="form-control" rows="10" style="height: 250px !important;"></textarea>
                                                                                </div>

                                                                                <div class="form-group">
                                                                                    <a href="javascript:guardar();" id="btn_guardar" class="<?php echo $_SESSION['btnguardar']; ?> pull-left">
                                                                                        <center><i class="fa fa-floppy-o" style="font-size:18px;"></i> &nbsp;&nbsp;<b>Guardar</b></center>
                                                                                    </a>
                                                                                </div>
                                                                              </form>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                                <!-- Fin de ficha Documentar-->


                                                                <!--Contenido de la ficha Galería-->
                                                                <div class="tab-pane fade" id="galeria">

                                                                    <div class="panel panel-info">
                                                                        <div class="panel-heading">
                                                                            <h3 class="panel-title">Contenido de la galería</h3>
                                                                        </div>
                                                                        <div class="panel-body">
                                                                              
                                                                            <div class="container mt-5">
                                                                                <div class="row">
                                                                                    <div class="col-md-12">
                                                                                        <h4 class="text-center">Subir imágenes de este documento</h4>
                                                                                        
                                                                                        <form id="uploadForm" enctype="multipart/form-data">
                                                                                            <div class="mb-3">
                                                                                                <input type="hidden" id="prefix" name="prefix" required value="<?php echo $id; ?>">
                                                                                                <input type="hidden" id="idproy" name="idproy" required value="<?php echo $idproyecto; ?>">
                                                                                            </div>
                                                                                            <br>
                                                                                            <div class="mb-3">
                                                                                                <label for="images" class="form-label">Selecciona imágenes:</label>
                                                                                                <input class="form-control" type="file" id="images" name="images[]" multiple accept="image/*" required>
                                                                                            </div>
                                                                                            <hr>Las imagenes deben tener el siguiente formato de nombre "imagen_N.jpg", donde "N" es un número correlativo que inicia en 1. <hr>
                                                                                            <button type="button" class="btn btn-primary w-100" onclick="uploadImages()">Subir Imágenes</button>
                                                                                        </form>
                                                                                        <hr>
                                                                                        <div id="status" class="mt-3"></div>
                                                                                    </div>
                                                                                </div>
                                                                            </div>

                                                                            <hr>
                                                                            <center><h5>Lista de imágenes anexadas a este documento</h5></center>
                                                                            <div class="container mt-5">
                                                                                
                                                                                <div class="row">
                                                                                    <div class="col-md-12" style="padding: 10px;">
                                                                                        <div id="image-list"></div>
                                                                                    </div>
                                                                                </div>
                                                                            </div>

                                                                            

                                                                        </div>
                                                                    </div>
                                                                </div>
                                                                <!-- Fin de ficha Galería-->


                                                                <!--Contenido de la ficha Historial-->
                                                                <div class="tab-pane fade" id="historial">
                                                                
                                                                    <div class="panel panel-info">
                                                                        <div class="panel-heading">
                                                                            <h3 class="panel-title">Contenido del historial</h3>
                                                                        </div>
                                                                        <div class="panel-body">
                                                                        <table id="example" class="table table-hover" cellspacing="0" width="100%" border="1" bordercolor="#C7C7C7">
                                                                        <thead>
                                                                            <tr class="fila_cabecera">
                                                                                <th>ID</th>
                                                                                <th>ACCIÓN</th>
                                                                                <th>USUARIO</th>
                                                                                <th>FECHA-HORA</th>
                                                                            </tr>
                                                                        </thead>

                                                                        <tbody>
                                                                        <?php
                                                                            $n = 0;
                                                                            if ($result_historial->num_rows > 0) {
                                                                                
                                                                                while($row_hist = $result_historial->fetch_assoc()) {
                                                                                    $n = $n + 1;
                                                                                    if (($n % 2)>0) { $color='white'; }else{ $color='#E8E8E8'; }
                                                                                    
                                                                                    printf("<td bgcolor='$color' width='20px'><center>".$row_hist["id"]."</center></td>
                                                                                            <td bgcolor='$color'>".$row_hist["accion"]."</td>
                                                                                            <td bgcolor='$color'><center>".$row_hist["usuario"]."</center></td>
                                                                                            <td bgcolor='$color'><center>".$row_hist["fc"]."</center></td>
                                                                                        ");
                                                                                    echo "</tr>";
                                                                                }
                                                                            }else{
                                                                                //echo "No hay resultados";
                                                                            }
                                                                            $conn->close();			
                                                                            ?>
                                                                            </tbody>
                                                                            </table>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                                <!-- Fin de ficha Galería-->


                                                                <!--Contenido de la ficha Editar-->
                                                                <div class="tab-pane fade" id="editar">
                                                                
                                                                    <div class="panel panel-info">
                                                                        <div class="panel-heading">
                                                                            <h3 class="panel-title">Contenido del Documento Actual</h3>
                                                                        </div>
                                                                        <div class="panel-body">
                                                                            <form role="form" data-toggle="validator"> 
                                                                                <div class="form-group">
                                                                                    <input type="hidden" id="idarchivo" value="<?php echo $id; ?>" readonly>
                                                                                    <input type="hidden" id="idproyecto" value="<?php echo $idproyecto; ?>" readonly>
                                                                                    <textarea id="contenido_editar" name="contenido_editar" class="form-control" rows="5" style="height: 150px !important;"><?php echo $contenido_documento; ?></textarea>
                                                                                </div>

                                                                                <div class="form-group">
                                                                                    <a href="javascript:actualizar();" id="btn_guardar" class="<?php echo $_SESSION['btnguardar']; ?> pull-left">
                                                                                        <center><i class="fa fa-floppy-o" style="font-size:18px;"></i> &nbsp;&nbsp;<b>Guardar</b></center>
                                                                                    </a>
                                                                                </div>
                                                                              </form>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                                <!-- Fin de ficha Editar-->


                                                                <!--Contenido de la ficha Exportar-->
                                                                <div class="tab-pane fade" id="exportar">
                                                                                                                                    
                                                                    <div class="panel panel-info">
                                                                    <div class="panel-heading">
                                                                            <h3 class="panel-title">Operador</h3>
                                                                        </div>
                                                                        <div class="panel-body">
                                                                              
                                                                              <form action="export.php" method="POST">
                                                                                
                                                                                <div class="form-group">
                                                                                    <textarea id="comentario_ope" name="comentario_ope" class="form-control" rows="5" style="height: 100px !important;"><?php echo $coment_ope; ?></textarea>
                                                                                </div>

                                                                                <?php
                                                                                    if ($_SESSION['nivel']=="3"){
                                                                                        $ver_btn = "none";
                                                                                    }else{
                                                                                        $ver_btn = "visible";
                                                                                    }
                                                                                ?>

                                                                                <div class="form-group" style="display: <?php echo $ver_btn; ?>;">
                                                                                    <a href="javascript:guardar_coment('operador');" id="btn_guardar" class="<?php echo $_SESSION['btnguardar']; ?> pull-left">
                                                                                        <center><i class="fa fa-floppy-o" style="font-size:18px;"></i> &nbsp;&nbsp;<b>Guardar comentario operador</b></center>
                                                                                    </a>
                                                                                </div>
                                                                              </form>
                                                                        </div>
                                                                    </div>

                                                                    <?php
                                                                        if ($_SESSION['nivel']=="3"){
                                                                            $ver = "visible";
                                                                        }else{
                                                                            $ver = "none";
                                                                            echo "<h3 class='panel-title'>ÚLTIMO COMENTARIO DEL GERENTE:</h3><br>";
                                                                            echo $coment_ger;
                                                                        }
                                                                    ?>

                                                                    <div class="panel panel-info" style="display: <?php echo $ver; ?>;">
                                                                    <div class="panel-heading">
                                                                            <h3 class="panel-title">Gerente</h3>
                                                                        </div>
                                                                        <div class="panel-body">
                                                                              
                                                                              <form action="export.php" method="POST">

                                                                              <div class="form-group">
                                                                                    <label>Aprobar:</label>
                                                                                    <select class="form-control" id="aprobado" name="aprobado" style="width:100px;">
                                                                                        <?php
                                                                                            if ($activo_archivo=="Si") {
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
                                                                                    <textarea id="comentario_ger" name="comentario_ger" class="form-control" rows="5" style="height: 100px !important;"><?php echo $coment_ger; ?></textarea>
                                                                                </div>

                                                                                <div class="form-group">
                                                                                    <a href="javascript:guardar_coment('gerente');" id="btn_guardar" class="<?php echo $_SESSION['btnguardar']; ?> pull-left">
                                                                                        <center><i class="fa fa-floppy-o" style="font-size:18px;"></i> &nbsp;&nbsp;<b>Guardar comentario gerente</b></center>
                                                                                    </a>
                                                                                </div>
                                                                              </form>
                                                                        </div>
                                                                    </div>
                                                                    
                                                                </div>
                                                                <!-- Fin de ficha Exportar-->
                                                                
                                                                
                                                                
                                                                <!--
                                                                <div class="tab-pane fade" id="rrhh">
                                                                <p style="padding:20px;">En este bloque irán todas las publicaciones  referentes al área de recursos humanos...</p>
                                                                </div>
                                                                <div class="tab-pane fade" id="finanzas">
                                                                <p style="padding:20px;">En este bloque irán todas las publicaciones  referentes al área de finanzas...</p>
                                                                </div>
                                                                <div class="tab-pane fade" id="logistica">
                                                                <p style="padding:20px;">En este bloque irán todas las publicaciones  referentes al área de logistica...</p>
                                                                </div>
                                                                -->
                                                                
                                                        </div>
                                                        <!--Fin de tab-content-->
                                                    </div>
                                                    <!--Fin de bs-component-->
                                            </div>
                                            <!--Fin de Panel-Body-->
                                        </div>
                                        <!--Fin de Panel-Info-->
                                </div>  
                                <!--Fin de Card-->        
          




                        </div>
                        
                        <!--<div class="col-md-3">--><!--ANCHO 9 PARA EL AREA DERECHA-->
                            <?php //include("areas/derecha.php"); ?>
                        <!--</div> --> 
                   <!-- </div>  -->
              </div>
        </div>

        
        <!-- Javascripts-->
        <script src="js/jquery-2.1.4.min.js"></script>
        <script src="js/bootstrap.min.js"></script>
        <script src="js/main.js"></script>
  </body>
</html>