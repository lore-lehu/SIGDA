<?php
//session_start();
include("../seguridad/verificasesion.php");
//include("conexiones/conex_sql.php");

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
                   <!-- <div class="row">-->
                        <div class="col-md-12"><!--ANCHO 9 PARA EL AREA CENTRAL-->
                            <?php include("areas/central.php"); ?>
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