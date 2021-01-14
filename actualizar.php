<?php 
session_start();

?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<link href="style.css" rel="stylesheet" type="text/css" />
<title>.: SISECOD 2012 :.</title>
</head>
<link rel="stylesheet" type="text/css" href="epoch_styles.css" />
<script type="text/javascript" src="jquery.js"></script>
<script type="text/javascript" src="jquery.validate.js"></script>
<script type="text/javascript" src="epoch_classes.js"></script>

<script type="text/javascript">

	var dp_cal1,dp_cal2;  
	    
window.onload = function ()
{
	dp_cal1  = new Epoch('epoch_popup','popup',document.getElementById('fechainicioprog'));

	
};
</script>
<script>
function validar_texto(a) { 
    tecl = (document.all) ? a.keyCode : a.which; 
    if (tecl==8) return true; 
//    patro =/[a-zA-Záéíóúäëïöü0ñÑ.-9\s]/; 
	patro =/[a-z A-Z áéíóúäëïöü0ñÑ 0-9\-\.\?\,\"\@\:\()\;\*\+&%\$#_]/;
    t = String.fromCharCode(tecl); 
    return patro.test(t); 
} 

</script>

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
	.tcAlert { color: orange; }
	.tcWarn { color: red; }
textarea{
	width:450px;
	height:120px;
	border:1px solid #ccc;
	padding:3px;
	color:black;
	font:12px Arial, sans-serif, Helvetica;
	}



</style>
<body>
<div id="container_blanco">
<div align="center">
<table width="597" border="0" cellpadding="1" cellspacing="1">
  <tr>
    <td width="115" rowspan="2"><img src="images/iedf.PNG" /></td>
    <td width="475" height="71" class="titulo_sistema">INSTITUTO ELECTORAL DEL DISTRITO FEDERAL</td>
  </tr>
  <tr>
    <td class="titulo_sistema"> SIstema de Seguimiento a las Sesiones de los Consejos Distritales<BR> 
    (SISESECD 2015)</td>
  </tr>
</table>
<!--tabla para todos las pantallas -->
<table width="580" border="0" cellpadding="1" cellspacing="1">
  <tr>
    <td width="222" height="25" align="left">Usuario: <?php echo $name; ?></td>
    <td width="223" align="left">Distrito: <?php echo $id_distrito; ?></td>
    <td width="446" align="left"><a href="grid_sesiones.php">Menú Principal</a></td>
    <td width="117" align="right"><a href="logout.php"><p class="titulo">Cerrar Sesion</p></a></td>
  </tr>
</table>
<!--fin tabla para todos las pantallas -->
<?php

$name= $_SESSION['k_username'];
$grup=$_SESSION['k_grupo'];
$grup=$_SESSION[transaccion];
$id_distrito=$_SESSION[id_distrito];
$id_admin=$_SESSION[id_admin];
$iddistrito="0";

//echo 'Bienvenido, ';
if (isset($_SESSION['k_username'])) {

		$iddistrito= $_SESSION["k_iddistrito"];
}
else
{
echo' 	alert("Debe iniciar una sesion")';	
	echo'<SCRIPT LANGUAGE="javascript">';
	echo'	location.href = "index.php";';
	echo'	</SCRIPT>';
}


$variable= $_REQUEST["page"];
//echo "GET PAGE: ".$variable."...";
//echo "GET ID ".$_REQUEST['idsesion']."...";
require('functions.php');
include 'config_open_db.php';
include 'arreglos.php';

//$consulta = mysql_query("SELECT * FROM sesiones WHERE idsesion =".$_REQUEST['idsesion']);
//$consulta = "SELECT * FROM sesiones WHERE idsesion =$_REQUEST[idsesion]";
		$sql_sesion="SELECT * FROM sisesecd_sesiones WHERE id_sesion =".$_REQUEST['id_sesion'];
		$consulta = ifx_query($sql_sesion,$conn);
		//$cliente = mysql_fetch_array($consulta);
		$cliente = ifx_fetch_row($consulta);
?>

   	<form id="frmClienteActualizar" name="frmClienteActualizar" method="post" action="update_sesiones.php">
    	<input type="hidden" name="idsesion" id="idsesion" value="<?php echo $cliente['idsesion']?>" />
  <p><label>Edici&oacute;n de sesi&oacute;n de Consejo para el Distrito  <b><?php echo $d_romano[$id_distrito] ?></b> <br><br>
  
  
  <input class="text" type="hidden" name="iddistrito" id="iddistrito" value="<?php echo $id_distrito; ?>"/>
  <input class="text" type="hidden" name="idsesion" id="idsesion" value="<?php echo $_REQUEST['idsesion']; ?>"/>
  
  </label>
  </p>
  <p>
  <label>N&uacute;mero de Sesi&oacute;n<br />
 <select name="nosesion" size="1" id="sesiones">
        <option value="<?php echo $cliente['nosesion'];?>" selected="selected"><?php echo $nom_sesion[$cliente['nosesion']];?></option>
        <option value=1>Seleccione una opción</option>
        <option value=1>PRIMERA</option>
        <option value=2>SEGUNDA</option>
        <option value=3>TERCERA</option>
        <option value=4>CUARTA</option>
        <option value=5>QUINTA</option>
        <option value=6>SEXTA</option>
        <option value=7>SÉPTIMA</option>
        <option value=8>OCTAVA</option>
        <option value=9>NOVENA</option>
        <option value=10>DÉCIMA</option>
        <option value=11>DÉCIMA PRIMERA</option>
    </select>
</label>
  </p>

  <p>
    <label>Descripci&oacute;n<br />
    <textarea type="text" name="descsesion" id="descsesion" width="300px" onkeypress='return validar_texto(event)' ><?php echo stripslashes($cliente['desc_sesion'])?></textarea>
	<span id="theCounter"> </span>
    </label>
  </p>

  <p>
    <label>
    <input type="radio" name="tiposesion" id="ordinaria" value="1" <?php if($cliente['tipo_sesion']=="1") echo "checked=\"checked\""?>  />
    Ordinaria</label>
    <label>
    <input type="radio" name="tiposesion" id="extraordinaria" value="2"  <?php if($cliente['tipo_sesion']=="2") echo "checked=\"checked\""?> />
    Extrordinaria</label>
    <label>
    <input type="radio" name="tiposesion" id="permanente" value="3" <?php if($cliente['tipo_sesion']=="3") echo "checked=\"checked\""?> />
    Permanente</label>
  <p>
<label>Fecha de Inicio<br /></label>

 <input name="fechainicioprog" type="text" id="fechainicioprog"  value="<?php echo $cliente['fecha_inicio_prog']?>" size="15" maxlength="20" readonly  />  

</p>


  <p>
    <label>Hora de inicion<br />     </label>
   <input type="text" maxlength=5 id="horainicioprog" name="horainicioprog" value="<?php echo $cliente['hora_inicio_prog']?>" />
  </p>


  <p>
	<input type="hidden" value="<?php  echo $_REQUEST["page"] ?>" id="page" name="page" />
  </p>
	  <p>
		<input type="submit" name="submit" id="button" value="Enviar" />
		<label></label>


		<input type="button" name="cancelar" id="cancelar" value="Cancelar" onclick="history.back ()" />
	  </p>
	</form>
	<?php
	//}
//}
?>

</div>
</div>
<div align="center">
<table width="706" height="62" border="0" cellpadding="0" cellspacing="0">
  <tr bgcolor="#231A31">
    <td width="650" align="center"><img src="images/footer.png" /></td>
  </tr>
  </table>
  </div>
</body>
</html>