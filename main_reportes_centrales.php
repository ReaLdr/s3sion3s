<?php 
session_start();
$name= $_SESSION['user'];
$grup=$_SESSION['grupo'];
//$grup=$_SESSION[transaccion];
$id_distrito=$_SESSION['id_distrito'];
$grup=$_SESSION['grupo'];

include 'arreglos.php';
	include("bitacora.php");
	$accion="Ingresa Reportes Centrales";
	bitacora($accion);	
//echo 'Bienvenido, ';
if (isset($_SESSION['user'])) {

	
}
else
{
echo' 	alert("Debe iniciar una sesion")';	
	echo'<SCRIPT LANGUAGE="javascript">';
	echo'	location.href = "index.php";';
	echo'	</SCRIPT>';
}
?>


<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<!--<link href="style.css" rel="stylesheet" type="text/css" />-->
<link href="css/stilacho.css" rel="stylesheet" type="text/css" />
<link href="css/animate.css" rel="stylesheet" type="text/css" />
<script type="text/javascript" src="js/jquery-1.4.3.min.js"></script>

<title>.: SISESECD 2018 :.</title>
</head>
<style>
.titulo{

font - family: Arial, Helvetica, sans-serif;
	font-size: 14px;
}
.blanco_tablas {
	font-family: Arial, Helvetica, sans-serif;
	font-size: 12px;
	font-style: normal;
	text-align : center;
	line-height: normal;
	font-weight: bold;
	font-variant: normal;
	text-transform: none;
	color: #FFFFFF;
}
</style>


<body>
<div id="container_blanco">
<div align="center">
  <div class="header animated fadeIn">
      <div id="titulo" class="animated bounceIn" >
        <p>Instituto Electoral del Distrito Federal</p>
      <p>Sistema de Seguimiento a los Consejos de Distritales 2018</p>
    </div>  
	  <div id="iedf"><img src="images/logo_blanco600.png" width="227" height="127"> </div>
	</div>
  <p>&nbsp;</p>

  <table width="580" border="0" cellpadding="1" cellspacing="1">
    <tr>
    <td width="123" height="25" align="left">Usuario: <?php echo $name; ?></td>
    <td width="330" align="center"><a href="../index.php">Men&uacute; Principal</a></td>
    <td width="117" align="right"><a href="logout.php"><p class="titulo">Cerrar Sesion</p></a></td>
  </tr>
</table>

<p>&nbsp;</p>
<p>
  <!--fin tabla para todos las pantallas -->
  <span class="titulo_sistema">Reportes para oficinas centrales</span></p>
<p>&nbsp;</p><form id="form1" name="form1" method="post" action="reportes.php">
  
  <table width="598" border="0" cellpadding="1" cellspacing="1">
  <tr>
    <td width="14" height="25" align="left">&nbsp;</td>
    <td width="232" align="left">SELECCIONE LA SESIÓN A CONSULTAR:</td>
    <td width="218" align="right">
	
   <?php
   include ("config_open_db.php"); 
   include ("arreglos.php"); 
  
    $sql_sesiones= "SELECT sesiones.nosesion , sesiones.tiposesion FROM sesiones WHERE estatus=1 GROUP BY sesiones.nosesion , sesiones.tiposesion ORDER BY sesiones.tiposesion , sesiones.nosesion  ";
	//echo $sql_propaganda;
	$res=ifx_query($sql_sesiones,$conn);
	
	
     	echo'<select name="sesiones" id="sesiones" onchange="fun()"  >';
		$i=0;
 	while($sesion = ifx_fetch_row ($res)){
	
	echo '<option value='.$i .'>' .utf8_encode(htmlspecialchars($nom_sesion[$sesion[nosesion]])).' ' .$tipo_sesion[$sesion[tiposesion]].' </option>';   
	$i++;
	}
	?>
     </td>
      <td width="56">&nbsp;</td>
      <td><input type="submit" name="ir" id="ir" value="Consultar" /> </td>  
  
</table>

<br />

   </form>

</div>


<div class="footer">
		  <p>Instituto Electoral del Distrito Federal &copy; 2017</p>  
  <p>Huizaches 25 &bull; Colonia Rancho Los Colorines &bull; Delegaci&oacute;n Tlalpan &bull; C.P. 14386 &bull; Ciudad de M&eacute;xico. &bull; Conmutador: (55) 5483 3800 </p>
</div>

</body>
</html>