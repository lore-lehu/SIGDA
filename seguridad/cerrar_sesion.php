<?php
session_start();

if(isset($_SESSION['usuario'])){
session_destroy();
}


// Inicializar la sesión.
// Si está usando session_name("algo"), ¡no lo olvide ahora!
//session_start();

// Destruir todas las variables de sesión.

$_SESSION = array();

// Si se desea destruir la sesión completamente, borre también la cookie de sesión.

// Nota: ¡Esto destruirá la sesión, y no la información de la sesión!
if (ini_get("session.use_cookies")) {

    $params = session_get_cookie_params();
    setcookie(session_name(), '', time() - 42000,

        $params["path"], $params["domain"],
        $params["secure"], $params["httponly"]
    );
}

// Finalmente, destruir la sesión.
//session_destroy();
header('Location: ../admin.php');
?>

<style type="text/css">







<!--







body {

	background-image: url(imagenes/fondogeneral.jpg);

	background-color: #000000;

	background-repeat: no-repeat;

}

body p {

	font-family: "Arial Narrow";

}

.a {

	font-family: "Arial Narrow";

}







-->







</style><title>MRZSOLUCIONES</title>

<table width="595" height="377" border="0" align="center" bgcolor="#CCCCCC">







  <tr bgcolor="#003D79">

    <th height="20" align="left" valign="top" scope="col">&nbsp;</th>

  </tr>

  <tr bgcolor="#003366">







    <th width="589" height="43" align="left" valign="top" scope="col"><img src="imagenes/bannerope.jpg" width="591" height="52" /></th>







  </tr>







  <tr>







    <td height="225" valign="top"><table width="592" height="185" border="0" align="left" bgcolor="#FFFFFF">







      <tr>







        <td width="238" rowspan="5"><img src="imagenes/cerrar.jpg" alt="" width="253" height="214" /></td>







        <td width="10">&nbsp;</td>







        <td width="330">&nbsp;</td>







      </tr>







      <tr>







        <td>&nbsp;</td>







        <td align="center" valign="middle"><img src="imagenes/logpni.jpg" width="190" height="82" /></td>







      </tr>







      <tr>







        <td height="45">&nbsp;</td>







        <td class="a">Se acaba de desconectar correctamente.</td>







      </tr>







      <tr>







        <td height="21">&nbsp;</td>







        <td class="a">Gracias...</td>







      </tr>







      <tr>







        <td height="21">&nbsp;</td>







        <td align="center"><p><a href="index.php" target="_parent"><img src="imagenes/botonini.gif" width="68" height="64" border="0" /></a></p></td>







      </tr>







    </table></td>







  </tr>







  <tr bgcolor="#003366">

    <td height="44" align="right" valign="middle"><img src="imagenes/bannerope2.jpg" width="592" height="42" /></td>

  </tr>

  <tr bgcolor="#003D79">







    <td height="21" align="center" valign="middle">&nbsp;</td>







  </tr>







</table>

