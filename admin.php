<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml"><head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>SIGDA -Acceso</title>

<style>
.alert-info {
   /* background-color: #d9edf7;
    color: #31708f;
    padding: 10px;
    border: 1px solid #31708f;
	border-radius:10px;
	border-radius: 6px;*/
	background-color: #274e73;
    color: #ffffff;
    padding: 10px;
    border: 1px solid #faffbd;
    border-radius: 10px;
    border-radius: 10px;
}
.alert-danger {
    /*background-color: #f2dede;
    color: #a94442;
	padding: 10px;
	border: 1px solid #a94442;
	border-radius:10px;
	border-radius: 6px;*/
	background-color: #4e0808;
    color: #fdfdfd;
    padding: 10px;
    border: 1px solid #a94442;
    border-radius: 10px;
    border-radius: 6px;
}
.login{
	padding: 5px 20px;
    border: 1px solid rgba(0,0,0,0.4);
    text-shadow: 0 -1px 0 rgba(0,0,0,0.4);
    box-shadow: inset 0 1px 0 rgba(255,255,255,0.3), inset 0 10px 10px rgba(255,255,255,0.1);
    border-radius: 0.3em;
    background: #0184ff;
    color: white;
    float: right;
    font-weight: bold;
    cursor: pointer;
    font-size: 13px;
	text-decoration:none;
}
.login:hover{
	padding: 5px 20px;
    border: 1px solid rgba(0,0,0,0.4);
    text-shadow: 0 -1px 0 rgba(0,0,0,0.4);
    box-shadow: inset 0 1px 0 rgba(255,255,255,0.3), inset 0 10px 10px rgba(255,255,255,0.1);
    border-radius: 0.3em;
    background: #0184ff;
    color: white;
    float: right;
    font-weight: bold;
    cursor: pointer;
    font-size: 14px !important;
	text-decoration:none;
}
a:link {
    color: #ffffff !important;
}


.formulario {
    background: #0F4257;
    width: 400px;
    margin: 30px auto;
    border-radius: 0.4em;
    border: 10px solid #191919;
    overflow: hidden;
    position: relative;
    box-shadow: 0 5px 10px 5px rgba(0,0,0,0.2);
}

a:link {
    color: #424244 !important;
}

.login {
    padding: 5px 20px;
    border: 1px solid rgba(0,0,0,0.4);
    box-shadow: inset 0 1px 0 rgba(255,255,255,0.3), inset 0 10px 10px rgba(255,255,255,0.1);
    border-radius: 0.3em;
    background: #efc23e;
    color: #a07878;
    float: right;
    font-weight: bold;
    cursor: pointer;
    font-size: 15px;
    text-decoration: none;
}


.myButton {
	-moz-box-shadow:inset 0px 0px 2px 0px #54a3f7;
	-webkit-box-shadow:inset 0px 0px 2px 0px #54a3f7;
	box-shadow:inset 0px 0px 2px 0px #54a3f7;
	background:-webkit-gradient(linear, left top, left bottom, color-stop(0.05, #007dc1), color-stop(1, #0061a7));
	background:-moz-linear-gradient(top, #007dc1 5%, #0061a7 100%);
	background:-webkit-linear-gradient(top, #007dc1 5%, #0061a7 100%);
	background:-o-linear-gradient(top, #007dc1 5%, #0061a7 100%);
	background:-ms-linear-gradient(top, #007dc1 5%, #0061a7 100%);
	background:linear-gradient(to bottom, #007dc1 5%, #0061a7 100%);
	filter:progid:DXImageTransform.Microsoft.gradient(startColorstr='#007dc1', endColorstr='#0061a7',GradientType=0);
	background-color:#007dc1;
	-moz-border-radius:7px;
	-webkit-border-radius:7px;
	border-radius:7px;
	border:1px solid #124d77;
	display:inline-block;
	cursor:pointer;
	color:#ffffff;
	font-family:Arial;
	font-size:14px;
	padding:12px 28px;
	text-decoration:none;
	text-shadow:0px 1px 0px #154682;
}
.myButton:hover {
	background:-webkit-gradient(linear, left top, left bottom, color-stop(0.05, #0061a7), color-stop(1, #007dc1));
	background:-moz-linear-gradient(top, #0061a7 5%, #007dc1 100%);
	background:-webkit-linear-gradient(top, #0061a7 5%, #007dc1 100%);
	background:-o-linear-gradient(top, #0061a7 5%, #007dc1 100%);
	background:-ms-linear-gradient(top, #0061a7 5%, #007dc1 100%);
	background:linear-gradient(to bottom, #0061a7 5%, #007dc1 100%);
	filter:progid:DXImageTransform.Microsoft.gradient(startColorstr='#0061a7', endColorstr='#007dc1',GradientType=0);
	background-color:#0061a7;
}
.myButton:active {
	position:relative;
	top:1px;
}
a:link {
    color: #ffffff !important;
}
</style>




<link rel="stylesheet" type="text/css" href="site/css/login.css">

<?php //include("site/areas/favicon.php"); ?>
<link rel="shortcut icon" href="site/images/favicon.png" type="image/vnd.microsoft.icon" />
    
	<script src="site/js/jquery-2.1.4.min.js"></script>

	<script>
		function redireccionarPagina() {
		  window.location = "site/index.php";
		}
	
		function validar(){
			//ENVIAR DATOS POR AJAX
				usu = $('#login').val();
				pas = $('#password').val();
				//alert(usu);
				//alert(pas);
				var parametros = {
						"login" : usu,
						"password" : pas
				};
				$.ajax({
					data:  parametros,	
					url:   'seguridad/valida_usuario.php',
					type:  'post',
					beforeSend: function () {
							//$("#resultado").html("Procesando, espere por favor...");
							$("#resultado").html("<center><img src='site/images/load.gif'></center>");
					},
					success:  function (response) {
						   // alert(response);
							response = JSON.parse(response);
							var mensaje = response["mensaje"];
							var acceso = response["acceso"];
							//console.log(mensaje);
							//console.log(acceso);
							//console.log(response);
							
						 
						$('#resultado').fadeOut(0).delay(500).fadeIn('slow');
						//$("#resultado").html(mensaje);	
						
						if (acceso=="si"){
							//console.log("Si tiene acceso---");
							//location.href ="site/index.php";
							$("#resultado").html("<p class='alert-info' align='center'><b>"+mensaje+"</b></p>");	
							setTimeout("redireccionarPagina()", 1000);
						}else{
							//console.log("No tiene acceso---");
							$("#resultado").html("<p class='alert-danger'  align='center'><b>"+mensaje+"</b></p>");	
						}
						
						
						
					}
				});	
		}
		
		
		$(document).keypress(function(e) {
			if(e.which == 13) {
				//alert('You pressed enter!');
				validar();
			}
		 });
	</script>

</head>

<body>

<form method="post" action="#" name="form1" id="form1" class="formulario">
  
  <h1>
  <img src="images/logo1.jpg" />
  </h1>
  <h1>
    ACCESO
  </h1>
  
  <div class="inset">
      <p>
        <label for="email"><b>USUARIO:</b></label>
        <input type="text" name="login" id="login">
      </p>
      <p>
        <label for="password"><b>CLAVE:</b></label>
        <input type="password" name="password" id="password">
      </p>
      <!--
      <p>
        <input type="checkbox" name="remember" id="remember">
        <label for="remember">Remember me for 14 days</label>
      </p>
      -->
      <p>
        <div id="resultado"></div>
      </p>
  </div>
  
  <p class="p-container">
    <span>
    <!--<a href="seguridad/recupera_pass.php">¿Olvid&oacute; su contrase&ntilde;a?</a>-->
    </span>
    <!--<input type="submit" name="go" id="go" value="Ingresar">-->
    <a href="javascript:validar();" id="btn_eliminar" class="myButton">INGRESAR</a>
    
    
  </p>
  
  <div class="inset">
  <!--
  <p>
  <b><u>AVISO:</u></b><br />
  Ingrese con su usuario y contraseña del correo institucional.
  </p>
  -->
  <center><font color="#CFCFCF">Sistema Integrado de Gestión Documental para Auditoría de Control de Aplicaciones</font></center>
  
  </div>
</form>
<!--
<center>
Otros accesos:
<br /><br />

<a href="http://www.senati.edu.pe">Web del SENATI</a> &nbsp;&nbsp;&nbsp; / &nbsp;&nbsp;&nbsp;
<a href="http://virtual.senati.edu.pe">SENATI VIRTUAL</a>
</center>
-->

</body>
</html>