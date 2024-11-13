<?php
$file_foto = '../site/files/usuarios/'.$_SESSION['usuario']."/".$_SESSION['usuario'].".jpg";
if (file_exists($file_foto)){
    //echo "El fichero $file_foto existe";
	$foto_personal = $file_foto;
}else{
    //echo "El fichero $file_foto no existe";
	$foto_personal = '../site/images/fotos/user.png';
}
?>

<style>
	.finmenu {
		margin-top: 20px;
		margin-bottom: 20px;
		border: 0;
		border-top: 1px solid #515e67;
	}
</style>
        <section class="sidebar">
          <div class="user-panel">
            <div class="pull-left image"><img class="img-circle" src="<?php echo $foto_personal; ?>" alt="User Image"></div>
            <div class="pull-left info">
              <p><?php echo $_SESSION['nombre']; ?></p>
            </div>
          </div>
          <!-- Sidebar Menu-->
          <ul class="sidebar-menu">
            <li class="active"><a href="../site/index.php"><i class="fa fa-home custom"></i><span>Inicio</span></a></li>     
            <li class="treeview"><a href="#"><i class="fa fa-tags custom"></i><span>Consultas / Reportes</span><i class="fa fa-angle-right"></i></a>
              <ul class="treeview-menu">
                <li><a href="proyectos_q.php"><i class="fa fa-bar-chart" aria-hidden="true"></i> Lista de Proyectos</a></li>
              </ul>
            </li>
            <li><hr class="finmenu"></li>
            <li><a href="../seguridad/cerrar_sesion.php"><i class="fa fa-sign-out fa-lg"></i><span>Salir</span></a></li>
          </ul>
        </section>