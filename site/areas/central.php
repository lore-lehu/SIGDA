<?php
include("../seguridad/conex.php");



?>

<!--Inicio de Card-->
<div class="card">
        <!--<h3 class="card-title">Publicaciones</h3>-->
        <!--Inicio de Panel-Info-->
        <div class="panel panel-info">
        		<!--Inicio de Panel-Body-->
                <div class="panel-body">
                	<!--Inicio de bs-component-->
                    <div class="bs-component" style="background-color:#FFF;">
                          
                          
                  
                  		  <!--Inicio de tab-content-->
                          <div>
                            
                                <!--Contenido de la ficha General-->
                                <div class="tab-pane fade active in" id="general">
                                      <p style="padding:20px;" align="center">
                                      <b>
                                      	<font color="#00468C" size="+1">
                                        	<?php
                                            if ($_SESSION['nivel']=="3"){
                                              echo "<i class='fa fa-wrench' aria-hidden='true'></i> &nbsp; <u>ADMINISTRADOR</u> DEL SISTEMA SIGDA";	
                                            }else{
                                              echo "<i class='fa fa-id-card-o' aria-hidden='true'></i> &nbsp; <u>OPERADOR</u> DEL SISTEMA SIGDA";	
                                            }
                                          ?>
                                      	</font>
                                      </b>
                                  <div>
                                  <center><img src="../images/fondo.jpg" width="80%" style="-webkit-box-shadow: 3px 4px 5px 0px rgba(0,0,0,0.75);
-moz-box-shadow: 3px 4px 5px 0px rgba(0,0,0,0.75);
box-shadow: 3px 4px 5px 0px rgba(0,0,0,0.75);"/> </p></center>
                                  </div>
                             	
                                  
                                </div>
                                
                                
                                
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
          