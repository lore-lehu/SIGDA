<?php
//session_start();
include("../seguridad/verificasesion.php");
include("../seguridad/conex.php");

$idproyecto = $_GET["idproyecto"];

if ($_SESSION['nivel']==2){
    header ('location: archivos_q.php?idproyecto='.$idproyecto);
}else{
    
}



$sql = "SELECT codigo, nombre, activo FROM proyectos WHERE id = ".$idproyecto."";
$result = $conn->query($sql);

$row = $result->fetch_array(MYSQLI_ASSOC);
$codigo_proyecto = $row['codigo'];
$nombre_proyecto = $row['nombre'];
$activo = $row['activo'];

$sql = "select id, codigo, nombre, activo, uc, fc, notif from archivos WHERE idproyecto = ".$idproyecto." ORDER BY fc DESC";
$result = $conn->query($sql);
$nomtitulo = "archivos";
?>

<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!--<link rel="shortcut icon" href="images/favicon.ico" type="image/x-icon">-->
    
    <?php include("areas/favicon.php"); ?>
    
    <title><?php echo $_SESSION['pag_titulo']." - ".$nomtitulo; ?></title>
    <!-- Font-icon css-->
    <link rel="stylesheet" type="text/css" href="css/font-awesome.min.css">
 	<!-- CSS-->
    <link rel="stylesheet" type="text/css" href="css/main.css">

    
    <!-- Javascripts-->
	<?php include("js/config_js_general.php"); ?>

    <style>
        .aprobado {
            font-size: 12px;
            background-color: #3c952b;
        }
        .desaprobado {
            font-size: 12px;
            background-color: #d71010;
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

              
         <a class="btn_nuevo pull-left" href="<?php echo $nomtitulo; ?>_new.php?idproyecto=<?php echo $idproyecto; ?>" target="_parent" title="Agregar un nuevo registro.">
         	<center><i class="fa fa-plus-circle" style="font-size:18px;"></i> &nbsp;&nbsp;<b>NUEVO</b></center>
         </a>
         
         <br><br>
         
         <h3 class="titulo" style="background-color: #0F4157; color: #f1faff; padding: 10px; margin-top: -41px;">Proyecto: <?php echo strtoupper($nombre_proyecto." (".$codigo_proyecto.")"); ?></h3>
         
              <hr class="hr_linea">
              
              	  <div class="col-md-10"><b><u>LISTA DE ARCHIVOS</u></b>
                    <a href="proyectos.php" target="_parent" title="Regresar a la ventana anterior" class="voler pull-right"><i class="fa fa-mail-reply"></i> Volver</a><hr><br>
                      <table id="example" class="table table-hover" cellspacing="0" width="100%" border="1" bordercolor="#C7C7C7">
                                <thead>
                                    <tr class="fila_cabecera">
                                        <td><font size="-3">Operaciones</font></td>
                                        <th>#</th>
                                        <th>CÓDIGO</th>
                                        <th>NOMBRE</th>
                                        <th>APROBADO</th>
                                        <th>UC</th>
                                        <th>FC</th>
                                        <th>OBSERVACION_GERENTE</th>
                                    </tr>
                                </thead>
                                		
                                <tfoot class="fila_pie">
                                        <td><font size="-3">Operaciones</font></td>
                                		<th>#</th>
                                        <th>CÓDIGO</th>
                                        <th>NOMBRE</th>
                                        <th>APROBADO</th>
                                        <th>UC</th>
                                        <th>FC</th>
                                        <th>OBSERVACION_GERENTE</th>
                                </tfoot>

                                <tbody>
                                    <?php
									$n = 0;
                                    if ($result->num_rows > 0) {
                                        
                                        while($row = $result->fetch_assoc()) {
                                            $n = $n + 1;
											if (($n % 2)>0) { $color='white'; }else{ $color='#E8E8E8'; }
											$operaciones = "<div class='btn-group'>
																<button class='btn-desplegable dropdown-toggle' data-toggle='dropdown'><span class='caret'></span>&nbsp;&nbsp;Ver</button>
																<ul class='dropdown-menu'>
                                                                    <li><a href='documentos.php?id=".$row["id"]."&idproyecto=".$idproyecto."')>
																			<i class='fa fa-file'></i>&nbsp; Documentos</a></li>
                                                                    <li class='divider'></li>
																	<li><a href='".strtolower($nomtitulo)."_edit.php?id=".$row["id"]."&idproyecto=".$idproyecto."')>
																			<i class='fa fa-edit'></i>&nbsp;Ver / Editar</a></li>
                                                                    <li class='divider'></li>
																	<li><a href='".strtolower($nomtitulo)."_elim.php?id=".$row["id"]."&idproyecto=".$idproyecto."')>
																			<i class='fa fa-trash-o'></i>&nbsp;Eliminar</a></li>
																</ul>
															</div>";

                                            echo "<tr>";
											
											
											if ($row["activo"]=="No"){
												$cl_act = "badge bg-danger desaprobado";
											}else{
												$cl_act = "badge bg-success aprobado";	
											}

                                            if ($row["notif"]=="g"){
												$comentger = "Tiene observaciones del gerente";

                                                if ($row["activo"]=="No"){
                                                    $cl = "badge bg-danger desaprobado";
                                                }else{
                                                    $cl = "badge bg-success aprobado";	
                                                }

											}else{
                                                if ($row["notif"]=="o"){
                                                    $comentger = "Esperando revisión del gerente";	
                                                    $cl = "badge bg-secondary";
                                                }else{
                                                    $comentger = "";	
                                                    $cl = "badge bg-success aprobado";
                                                }
													
											}
											
                                            printf("<td bgcolor='$color' width='1px'><center>$operaciones</center></td>
													<td bgcolor='$color' width='15px' align='right'><center>$n</center></td>
													<td bgcolor='$color' width='20px'><center>".$row["codigo"]."</center></td>
													<td bgcolor='$color'>".$row["nombre"]."</td>
													<td bgcolor='$color'><center><span class='".$cl_act."'>".$row["activo"]."</span></center></td>
                                                    <td bgcolor='$color'><center>".$row["uc"]."</center></td>
                                                    <td bgcolor='$color'><center>".$row["fc"]."</center></td>
                                                    <td bgcolor='$color'><center><span class='".$cl."'>".$comentger."</span></center></td>
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
                            <br><p class="alert-info"><i class="fa fa-check-circle" aria-hidden="true"></i> Total de Registros: <b><?php echo $n; ?></b></p>
                            <a class="voler pull-right" href="javascript:location.reload()" title="Dele clic aqu&iacute; para actualizar esta p&aacute;gina.">
                            <i class="fa fa-refresh" aria-hidden="true"></i> 
                            <u>Actualizar p&aacute;gina</u>
                            </a>
                    </div>
                </div>
            </div>

</div>


</body>
</html>