<?php
$dias = array("Domingo","Lunes","Martes","Miercoles","Jueves","Viernes","Sábado");
$meses = array("Enero","Febrero","Marzo","Abril","Mayo","Junio","Julio","Agosto","Septiembre","Octubre","Noviembre","Diciembre");
$factual = $dias[date('w')]." ".date('d')." de ".$meses[date('n')-1]. " del ".date('Y');
?>

      <a class="logo" href="#">
   	  <img src="../site/images/logo_blanco_sinfondo.png">
      </a>
        
        <nav class="navbar navbar-static-top">
          
              <!-- Sidebar toggle button-->
              <a class="sidebar-toggle" href="#" data-toggle="offcanvas"></a>
              
              <font color="#FCFCFC">
                  <span style="padding-left:12px;">
                  
                  </span>
                  
                  <br /> 
				  
				  <span style="padding-left:12px;">
                  		<i class="fa fa-calendar" aria-hidden="true"></i> 
				  		<?php echo $factual; ?></font>
                  </span>
              </font>
                        
        </nav>
      
      
      