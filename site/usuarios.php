<?php
//session_start();
include("../seguridad/verificasesion.php");
include("../seguridad/conex.php");

$sql = "SELECT u.idusuario, u.nombrecompletor, u.usuario, u.nivel, s.nombresede, DATE_FORMAT(u.fechagrab,'%Y-%m-%d %H:%i') fc,
(CASE WHEN u.estado = 0 THEN 'Inactivo' ELSE 'Activo' END) estado
FROM usuarios u 
LEFT JOIN sedes s on s.ids = u.idsede
order by u.fechagrab desc;";
$result = $conn->query($sql);
$nomtitulo = "usuarios";
?>

<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    
    <?php include("areas/favicon.php"); ?>
    
    <title><?php echo $_SESSION['pag_titulo']." - ".$nomtitulo; ?></title>

	<!-- CSS-->
    <link rel="stylesheet" type="text/css" href="css/main.css">

    
    <!-- Javascripts-->
	<?php include("js/config_js_general.php"); ?>
        
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

              
         <a class="btn_nuevo pull-left" href="<?php echo $nomtitulo; ?>_new.php" target="_parent" title="Agregar un nuevo registro.">
         	<center><i class="fa fa-plus-circle" style="font-size:18px;"></i> &nbsp;&nbsp;<b>NUEVO</b></center></a>
         
         <br><br>
         
         <h3 class="titulo">LISTA DE <?php echo strtoupper($nomtitulo); ?></h3>
              
              <hr class="hr_linea">
              
              	  <div class="col-md-12">
                      <table id="example" class="table table-hover" cellspacing="0" width="100%" border="1" bordercolor="#C7C7C7">
                                <thead>
                                    <tr class="fila_cabecera">
                                        <td><font size="-3">Operaciones</font></td>
                                        <th>N°</th>
                                        <th>ID</th>
                                        <th>NOMBRE</th>
                                        <th>USUARIO</th>
                                        <th>SEDE</th>
                                        <th>NIVEL</th>
                                        <th>ESTADO</th>
                                        <th>FECHA REGISTRO</th>
                                    </tr>
                                </thead>
                                		
                                <tfoot class="fila_pie">
                                        <td><font size="-3">Operaciones</font></td>
                                		<th>N°</th>
                                        <th>ID</th>
                                        <th>NOMBRE</th>
                                        <th>USUARIO</th>
                                        <th>SEDE</th>
                                        <th>NIVEL</th>
                                        <th>ESTADO</th>
                                        <th>FECHA REGISTRO</th>
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
																	<li><a href='".strtolower($nomtitulo)."_edit.php?id=".$row["idusuario"]."')>
																			<i class='fa fa-edit'></i>&nbsp;Ver / Editar</a></li>
																	<li class='divider'></li>
																	<li><a href='".strtolower($nomtitulo)."_elim.php?id=".$row["idusuario"]."')>
																			<i class='fa fa-trash-o'></i>&nbsp;Eliminar</a></li>
																</ul>
															</div>";

                                            echo "<tr>";
											
											if ($row["estado"]=="Inactivo"){
												$cl = "alert-danger";	
											}else{
												$cl = "";	
											}
											
											if ($row["nivel"]=="3"){
												$nivel = "Administrador";	
											}else{
												$nivel = "Operador";	
											}
											
                                            printf("<td bgcolor='$color' width='1px'><center>$operaciones</center></td>
													<td bgcolor='$color' width='15px' align='right'>$n</td>
													<td bgcolor='$color' width='20px'><center>".$row["idusuario"]."</center></td>
													<td bgcolor='$color' width='300px'>".strtoupper($row["nombrecompletor"])."</td>
													<td bgcolor='$color' width='40px'>".$row["usuario"]."</td>
													<td bgcolor='$color'>".$row["nombresede"]."</td>
													<td bgcolor='$color' width='60px'>".$nivel."</td>
													<td bgcolor='$color' width='60px' class='$cl'><center>".$row["estado"]."</center></td>
													<td bgcolor='$color' width='160px'><center>".$row["fc"]."</center></td>
												  ");
                                            echo "</tr>";
                                        }
                                    }else{
                                        echo "No hay resultados";
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