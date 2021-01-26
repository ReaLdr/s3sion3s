<?php
session_start();
error_reporting(E_ERROR | E_PARSE);
$name= $_SESSION['transaccion'];
$grup=$_SESSION['grupo'];

$id_distrito=$_SESSION['id_distrito'];
//$id_admin=$_SESSION['id_admin'];
$nosesion=$_GET['nosesion'];

include 'arreglos.php';

?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<!--<link href="style.css" rel="stylesheet" type="text/css" />-->
<script type="text/javascript" src="js/jquery-1.4.3.min.js"></script>
<link href="css/stilacho.css" rel="stylesheet" type="text/css" />
<link href="css/animate.css" rel="stylesheet" type="text/css" />
<script src="js/bootstrap.min.js"></script>
<link rel="stylesheet" href="css/bootstrap.min.css">
<link rel="stylesheet" href="css/jquery-ui.css">
<title>.: SISESECD 2018 :.</title>


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
</head>

  <?php include("header.php");?>

<body class="sb-nav-fixed">
        <div id="layoutSidenav">
            <div id="layoutSidenav_content">
            <main>
                    <div class="container-fluid">
	            <h1 class="mt-4"><img src="images/logo-header.png"></h1>
	<p>&nbsp;</p>

<!--tabla para todos las pantallas -->
<div class="top-menu">
<table border="0" style="width: 90%;">
  <tr>
    <td width="185" height="25" align="left" class="well">Usuario: <?php echo $name; ?></td>
    <td width="233" align="left" class="well">Consejo Distrital: <?php echo $id_distrito; ?></td>

    <td width="124" align="right"><a href="logout.php"><p class="btn btn-default">Cerrar Sesion</p></a></td>
  </tr>
</table>
	  </div>
<!--fin tabla para todos las pantallas -->
<div align="center">
<?php
require('functions.php');
include 'config_open_db.php';

if(isset($_POST['submit'])){

	$id_orden = htmlspecialchars(trim($_POST['id_orden']));
	$id_sesion = htmlspecialchars(trim($_POST['id_sesion']));
	$punto = htmlspecialchars(trim($_POST['punto']));
	//$descpunto = htmlspecialchars(trim($_POST['descpunto']));
	$observapunto = htmlspecialchars(trim($_POST['observapunto']));

	$votocp = htmlspecialchars(trim($_POST['votocp']));
	if($votocp >=1){$vcp = 1;}else{$vcp=0;}
	$votoc1 = htmlspecialchars(trim($_POST['votoc1']));
	if($votoc1 >=1){$vc1 = 1;}else{$vc1=0;}
	$votoc2 = htmlspecialchars(trim($_POST['votoc2']));
	if($votoc2 >=1){$vc2 = 1;}else{$vc2=0;}
	$votoc3 = htmlspecialchars(trim($_POST['votoc3']));
	if($votoc3 >=1){$vc3 = 1;}else{$vc3=0;}
	$votoc4 = htmlspecialchars(trim($_POST['votoc4']));
	if($votoc4 >=1){$vc4 = 1;}else{$vc4=0;}
	$votoc5 = htmlspecialchars(trim($_POST['votoc5']));
	if($votoc5 >=1){$vc5 = 1;}else{$vc5=0;}
	$votoc6 = htmlspecialchars(trim($_POST['votoc6']));
	if($votoc6 >=1){$vc6= 1;}else{$vc6=0;}

	$asistp = htmlspecialchars(trim($_POST['asistp']));
	$asistc1 = htmlspecialchars(trim($_POST['asistc1']));
	$asistc2 = htmlspecialchars(trim($_POST['asistc2']));
	$asistc3 = htmlspecialchars(trim($_POST['asistc3']));
	$asistc4 = htmlspecialchars(trim($_POST['asistc4']));
	$asistc5 = htmlspecialchars(trim($_POST['asistc5']));
	$asistc6 = htmlspecialchars(trim($_POST['asistc6']));


	$page=htmlspecialchars(trim($_POST['page']));


	if($votocp==''){
	$votocp=0;
	}
	if($votoc1==''){
	$votoc1=0;
	}
	if($votoc2==''){
	$votoc2=0;
	}
	if($votoc3==''){
	$votoc3=0;
	}
	if($votoc4==''){
	$votoc4=0;
	}
	if($votoc5==''){
	$votoc5=0;
	}
	if($votoc6==''){
	$votoc6=0;
	}


 /// validacion de coincidencias entre inicio y votacion////

		if (($asistp != $vcp) || ($asistc1 != $vc1) || ($asistc2 != $vc2 )|| ($asistc3 != $vc3) || ($asistc4 != $vc4) ||($asistc5 != $vc5) || ($asistc6 != $vc6) )
		{
			echo'	<SCRIPT LANGUAGE="javascript">';
			echo' 	alert("No coinciden los VOTOS con la ASISTENCIA del Consejo ; Indicar el motivo en el campo de Observación")';
			echo'	</SCRIPT>';

			if ($observapunto == '')
			{
			echo'	<SCRIPT LANGUAGE="javascript">';
			echo' 	alert("Agregar una observación")';
			echo'	</SCRIPT>';
			echo'	<SCRIPT LANGUAGE="javascript">';
			echo' 	history.back()';
			echo'	</SCRIPT>';
			}

		}


	$sql_update="UPDATE sisesecd_ordendia SET observa_punto='".stripslashes($observapunto)."', voto_cp=".$votocp.", voto_c1=".$votoc1.", voto_c2=".$votoc2.", voto_c3=".$votoc3.", voto_c4=".$votoc4.", voto_c5=".$votoc5.", voto_c6=".$votoc6.", estatus=1 WHERE id_orden=".$id_orden." and id_sesion= ".$id_sesion.";";

	//echo $sql_update;

$sql_update=str_replace("\n","",$sql_update);
$sql_update=str_replace("\r","",$sql_update);


			if (sqlsrv_query($conn,$sql_update))
			{
				//echo 'Datos guardados';
				include("bitacora.php");
			$accion="Ingreso el voto del punto ".$punto;
			bitacora($accion);

				$update_voto="UPDATE sisesecd_sesiones SET con_votos=1 WHERE id_sesion=$id_sesion";
				//echo $update_voto;
				if (sqlsrv_query($conn,$update_voto))
				{
				echo'	<SCRIPT LANGUAGE="javascript">';
						echo' 	alert("La Votación se actualizó Exitosamente")';
							echo'	</SCRIPT>';
							echo'<SCRIPT LANGUAGE="javascript">';
							echo'history.go(-2)
							history.back (-2)';
							echo'	</SCRIPT>';
				}
				else{
					echo 'Se produjo un error al guardar historico. Intente nuevamente '.mysql_error();
				}
			}
			else
			{
				echo 'Se produjo un error. Intente nuevamente '.mysql_error();
			}


}// cierro  if  del submit
	else
	{
	if(isset($_REQUEST['id_orden'])){

		$sql_consulta="SELECT id_orden,id_sesion, punto, CAST(desc_punto as CHAR(2084)) as desc_punto, observa_punto, voto_cp, voto_c1,voto_c2,voto_c3,voto_c4,voto_c5,voto_c6  FROM sisesecd_ordendia WHERE id_orden=$_REQUEST[id_orden] and id_sesion=$_REQUEST[id_sesion];";

	//	echo $sql_consulta;
		$consulta = sqlsrv_query($conn,$sql_consulta);
		$cliente = sqlsrv_fetch_array($consulta);
		$descpunto=$cliente['desc_punto'];

		$srt=$descpunto;
		eval("\$srt = \"$srt\";");

		// inicio de la sesión
		$sql= "select  qi_cp, qi_c1, qi_c2, qi_c3,qi_c4,qi_c5, qi_c6 from sisesecd_inicio where id_sesion=$_REQUEST[id_sesion];";
	//echo $sql;
	$result= sqlsrv_query($conn,$sql);
	$row = sqlsrv_fetch_array($result);

	?>
		<br>
	<br>
<center>
		<div class="card mb-4">
	<div class="card-header">
     <b>Edici&oacute;n del punto <?php echo $cliente['punto']?> del orden del d&iacute;a <br> Descripci&oacute;n del punto: <?php echo utf8_encode($srt); ?></b>

    </div>

	<form id="frmClienteActualizar2"  name="frmClienteActualizar2" method="post" action="actualizar3.php">
    <input class="text" type="hidden" name="page" id="page" value="<?php echo $_REQUEST["page"];?>" />
    <input class="text" type="hidden" name="id_sesion" id="id_sesion" value="<?php echo $_REQUEST["id_sesion"];?>" />
    <input class="text" type="hidden" name="id_orden" id="id_orden" value="<?php echo $_REQUEST["id_orden"];?>" />
    <input class="text" type="hidden" name="punto" id="punto" value="<?php echo $cliente['punto'];?>" />

		<h5><strong>Sentido de la Votaci&oacute;n</strong></h5>

<p>&nbsp;</p>
<table style="width: 75%;">
<tr>
<td>
<input type= "hidden" id="asistp" name="asistp"   value="<?php echo $row[qi_cp]; ?>" />
<input type= "hidden" id="asistc1" name="asistc1" value="<?php echo $row[qi_c1]; ?>" />
<input type= "hidden" id="asistc2" name="asistc2" value="<?php echo $row[qi_c2]; ?>" />
<input type= "hidden" id="asistc3" name="asistc3" value="<?php echo $row[qi_c3]; ?>" />
<input type= "hidden" id="asistc4" name="asistc4" value="<?php echo $row[qi_c4]; ?>" />
<input type= "hidden" id="asistc5" name="asistc5" value="<?php echo $row[qi_c5]; ?>" />
<input type= "hidden" id="asistc6" name="asistc6" value="<?php echo $row[qi_c6]; ?>" />


</td>
</tr>
	<?php
	$sql_integra = "select * from sisesecd_cat_funcionarios where id_sesion=$_REQUEST[id_sesion] and id_integrante in (1,2,3,4,5,6,7,8) and id_distrito=$id_distrito";

//echo $sql_integra;

echo'<table style="width: 90%;" border="1">';
echo'<tr bgcolor="#CCCCFF">';
echo'<td colspan="10" align="center" ><strong>Asistencia a inicio de sesi&oacute;n de Consejo</strong></td>';
echo'</tr>';

	$exec_int = sqlsrv_query($conn, $sql_integra);

	$salta=0;
	while($row_int = sqlsrv_fetch_array($exec_int))
	{


	echo'<tr>';

		if($row_int['id_integrante']==1)
		{

		echo'<td><strong>Consejero Presidente:</strong> &nbsp;'.$row_int['nombre'].' '.$row_int['ap_paterno'].' '.$row_int['ap_materno'].'</td>';

		echo'<td>';

		if($cliente['voto_cp']=="1")
			{
			echo'<input type="radio" name="votocp" id="votocp" value="1" checked="checked">A favor';
			}
			else
			{
			echo'<input type="radio" name="votocp" value="1">A favor';

			}


		echo'</td>';


		echo'<td>';

	if($cliente['voto_cp']=="2")
			{
			echo'<input type="radio" name="votocp" id="votocp" value="2" checked="checked">En contra';
			}
			else
			{
			echo'<input type="radio" name="votocp" value="2" >En contra';

			}

		echo'</td>';

		echo'<td>';
	if($cliente['voto_cp']=="3")
			{
			echo'<input type="radio" name="votocp" id="votocp" value="3" checked="checked">Excusa';
			}
			else
			{
			echo'<input type="radio" name="votocp" value="3">Excusa';
			}

		echo'</td>';

		}



		if($row_int['id_integrante']==2)
		{
		echo '<td><strong>Secretario del Consejo:</strong>&nbsp;'.$row_int['nombre'].' '.$row_int['ap_paterno'].' '.$row_int['ap_materno'].'</td>';
		echo'<td>';
		echo'&nbsp;';
		echo'</td>';

		echo'<td>';
		echo'&nbsp;';
		echo'</td>';

		echo'<td>';
		echo'&nbsp;';
		echo'</td>';
		}
	//echo'</tr>';

	//echo'<tr>';
		if($row_int['id_integrante']==3)
		{
		echo'<td ><strong> Consejero 1:</strong>&nbsp;'.$row_int['nombre'].' '.$row_int['ap_paterno'].' '.$row_int['ap_materno'].'</td>';

		echo'<td>';
	if($cliente['voto_c1']=="1")
			{
			echo'<input type="radio" name="votoc1" id="votoc1" value="1" checked="checked">A favor';
			}
			else
			{
			echo'<input type="radio" name="votoc1" value="1" >A favor';
			}

		echo'</td>';

		echo'<td>';
    if($cliente['voto_c1']=="2")
			{
			echo'<input type="radio" name="votoc1" id="votoc1" value="2" checked="checked">En contra';
			}
			else
			{
			echo'<input type="radio" name="votoc1" value="2" >En contra';
			}
		echo'</td>';

		echo'<td>';
	if($cliente['voto_c1']=="3")
			{
			echo'<input type="radio" name="votoc1" id="votoc1" value="3" checked="checked">Excusa';
			}
			else
			{
			echo'<input type="radio" name="votoc1" value="3" >Excusa';
			}
		echo'</td>';
		}

		if($row_int['id_integrante']==4)
		{
		echo'<td ><strong> Consejero 2:</strong>&nbsp;'.$row_int['nombre'].' '.$row_int['ap_paterno'].' '.$row_int['ap_materno'].'</td>';
		echo'<td>';

		if($cliente['voto_c2']=="1")
			{
			echo'<input type="radio" name="votoc2" id="votoc2" value="1" checked="checked">A favor';
			}
			else
			{
			echo'<input type="radio" name="votoc2" value="1">A favor';
			}

		echo'</td>';

		echo'<td>';
		if($cliente['voto_c2']=="2")
			{
			echo'<input type="radio" name="votoc2" id="votoc2" value="2" checked="checked">En contra';
			}
			else
			{
			echo'<input type="radio" name="votoc2" value="2">En contra';
			}


		echo'</td>';

		echo'<td>';
		if($cliente['voto_c2']=="3")
			{
			echo'<input type="radio" name="votoc2" id="votoc2" value="3" checked="checked">Excusa';
			}
			else
			{
			echo'<input type="radio" name="votoc2" value="3">Excusa';
			}


		echo'</td>';
		}
		if($row_int['id_integrante']==5)
		{
		echo'<td ><strong> Consejero 3:</strong>&nbsp;'.$row_int['nombre'].' '.$row_int['ap_paterno'].' '.$row_int['ap_materno'].'</td>';
		echo'<td>';
		if($cliente['voto_c3']=="1")
			{
			echo'<input type="radio" name="votoc3" id="votoc3" value="1" checked="checked">A favor';
			}
			else
			{
			echo'<input type="radio" name="votoc3" value="1">A favor';
			}
		echo'</td>';

		echo'<td>';
		if($cliente['voto_c3']=="2")
			{
			echo'<input type="radio" name="votoc3" id="votoc3" value="2" checked="checked">En contra';
			}
			else
			{
			echo'<input type="radio" name="votoc3" value="2">En contra';
			}
		echo'</td>';

		echo'<td>';
		if($cliente['voto_c3']=="3")
			{
			echo'<input type="radio" name="votoc3" id="votoc3" value="3" checked="checked">Excusa';
			}
			else
			{
			echo'<input type="radio" name="votoc3" value="3">Excusa';
			}
		echo'</td>';
		}
	//echo'</tr>';
	//echo'<tr>';
		if($row_int['id_integrante']==6)
		{
		echo'<td ><strong> Consejero 4:</strong>&nbsp;'.$row_int['nombre'].' '.$row_int['ap_paterno'].' '.$row_int['ap_materno'].'</td>';
		echo'<td>';
		if($cliente['voto_c4']=="1")
			{
			echo'<input type="radio" name="votoc4" id="votoc4" value="1" checked="checked">A favor';
			}
			else
			{
			echo'<input type="radio" name="votoc4" value="1">A favor';
			}
		echo'</td>';

		echo'<td>';
			if($cliente['voto_c4']=="2")
			{
			echo'<input type="radio" name="votoc4" id="votoc4" value="2" checked="checked">En contra';
			}
			else
			{
			echo'<input type="radio" name="votoc4" value="2">En contra';
			}
		echo'</td>';

		echo'<td>';
		if($cliente['voto_c4']=="3")
			{
			echo'<input type="radio" name="votoc4" id="votoc4" value="3" checked="checked">Excusa';
			}
			else
			{
			echo'<input type="radio" name="votoc4" value="3">Excusa';
			}
		echo'</td>';
		}
		if($row_int['id_integrante']==7)
		{
		echo'<td ><strong> Consejero 5:</strong>&nbsp;'.$row_int['nombre'].' '.$row_int['ap_paterno'].' '.$row_int['ap_materno'].'</td>';
		echo'<td>';
	if($cliente['voto_c5']=="1")
			{
			echo'<input type="radio" name="votoc5" id="votoc5" value="1" checked="checked">A favor';
			}
			else
			{
			echo'<input type="radio" name="votoc5" value="1">A favor';
			}
		echo'</td>';

		echo'<td>';
	if($cliente['voto_c5']=="2")
			{
			echo'<input type="radio" name="votoc5" id="votoc5" value="2" checked="checked">En contra';
			}
			else
			{
			echo'<input type="radio" name="votoc5" value="2">En contra';
			}
		echo'</td>';

		echo'<td>';
	if($cliente['voto_c5']=="3")
			{
			echo'<input type="radio" name="votoc5" id="votoc5" value="3" checked="checked">Excusa';
			}
			else
			{
			echo'<input type="radio" name="votoc5" value="3">Excusa';
			}
		echo'</td>';
		}

		if($row_int['id_integrante']==8)
		{
		echo'<td ><strong> Consejero 6:</strong>&nbsp;'.$row_int['nombre'].' '.$row_int['ap_paterno'].' '.$row_int['ap_materno'].'</td>';
		echo'<td>';

	 if($cliente['voto_c6']=="1")
			{
			echo'<input type="radio" name="votoc6" id="votoc6" value="1" checked="checked">A favor';
			}
			else
			{
			echo'<input type="radio" name="votoc6" value="1">A favor';
			}
		echo'</td>';

		echo'<td>';
			if($cliente['voto_c6']=="2")
			{
			echo'<input type="radio" name="votoc6" id="votoc6" value="2" checked="checked">En contra';
			}
			else
			{
			echo'<input type="radio" name="votoc6" value="2">En contra';
			}
		echo'</td>';

		echo'<td>';
			if($cliente['voto_c6']=="3")
			{
			echo'<input type="radio" name="votoc6" id="votoc6" value="3" checked="checked">Excusa';
			}
			else
			{
			echo'<input type="radio" name="votoc6" value="3">Excusa';
			}
		echo'</td>';
		}
	//echo'</tr>';

	}// cierro while
echo'</table>';
  ?>
	<center>
	<p>&nbsp;</p>
   <label>Observaci&oacute;n al punto<br />
    <textarea type="text" rows="8" cols="75" name="observapunto" id="observapunto" onkeypress='return validar_texto(event)'><?php echo stripslashes($cliente['observa_punto']); ?></textarea>
  </label>
	</center>
 	<p>&nbsp;</p>
		<input type="submit" class="btn btn-primary" name="submit" id="button" value="Enviar" />
		<p>&nbsp;</p>
		<input type="button" class="btn btn-default" name="cancelar" id="cancelar" value="Cancelar" onclick="javascript:history.go(-1)" />
	  </p>

	<?php
	}
}
?>
</form>
				</center>
<footer class="py-4 bg-light mt-auto">
    <?php include('footer.php'); ?>
   </footer>

</div>
</div>
</div>


</body>
</html>
