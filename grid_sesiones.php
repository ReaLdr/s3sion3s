<?php
header("Content-Type: text/html; charset=utf-8");
//error_reporting(E_ERROR | E_PARSE);
session_start();

//echo 'Bienvenido,';

if (isset($_SESSION['user'])) {

$name= $_SESSION['transaccion'];
$grup=$_SESSION['grupo'];
$id_distrito=$_SESSION['id_distrito'];

}
else
{
	echo'<SCRIPT LANGUAGE="javascript">';
	echo' 	alert("Debe iniciar una sesion")';
	echo'	location.href = "index.php";';
	echo'	</SCRIPT>';
}


?>


<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<!--<link href="style.css" rel="stylesheet" type="text/css" />-->
<script type="text/javascript" src="js/jquery-1.4.3.min.js"></script>
<link href="css/stilacho.css" rel="stylesheet" type="text/css" />
<link href="css/animate.css" rel="stylesheet" type="text/css" />



<!--<script src="js/jquery-3.2.1.min.js"></script>-->
<script src="js/bootstrap.min.js"></script>
<link rel="stylesheet" href="css/bootstrap.min.css">
<link rel="stylesheet" href="css/jquery-ui.css">


<script type="text/javascript" src="fancybox/jquery.fancybox-1.3.4.js"></script>
<link rel="stylesheet" type="text/css" href="fancybox/jquery.fancybox-1.3.4.css" media="screen" />
<title>.: SISESECD 2021 :.</title>

</head>

<body>
<div id="container_blanco">

  <?php include('header.php');?>

<p>&nbsp;</p>

                    <h1 class="mt-4"><img src="images/logo-header.png"></h1>
<!--tabla para todos las pantallas -->
<div class="top-menu">
<table  border="0" style="width: 90%;">
  <tr>
    <td width="16%" height="25" align="left" class="well">Usuario: <?php echo $name;?></td>
    <td width="55%" align="left" class="well" style="background-color: #FFF;">Consejo Distrital: <?php echo $id_distrito; ?></td>
    <td width="29%" align="right"><a class="btn btn-default" href="logout.php">Cerrar Sesi&oacute;n</a></td>
  </tr>
</table>
</div>

<p>&nbsp;</p>
<p>&nbsp;</p>
<p>
  <?php
include ('config_open_db.php');
include ('arreglos.php');

$nosesion=$_GET['nosesion'];
//$id_sesion=$_GET['id_sesion'];
$tipo_sesion=$_GET['tipo_sesion'];
$desc_sesion=$_GET['desc_sesion'];

	/*include("bitacora.php");
	$accion="Ingresa Modulo Sesion ".$id_distrito;
	bitacora($accion);	*/


///// verifico si ya existe una sesion con el distrito
//////////////////////////////////////////////////////////////////
$sql_count="select count(*) as cuantos from sisesecd_sesiones where id_distrito=$id_distrito and nosesion=$nosesion  and tipo_sesion=$tipo_sesion and desc_sesion=$desc_sesion and estatus=1";

//echo "<br>sql_count " . $sql_count . "<br>";
$res_count=sqlsrv_query($conn,$sql_count);
$rows_count = sqlsrv_fetch_array($res_count);
$cuantos= $rows_count['cuantos'];
//echo "CUANTOS: " . $cuantos;

///si no existe la sesion la creo insertando los datos
if($cuantos <= 0){
	///para traer lo que necesito de la sesion y crear una para el distrito

	$sql_1 = "SELECT * FROM sisesecd_sesiones WHERE nosesion=$nosesion and tipo_sesion=$tipo_sesion and desc_sesion= '$desc_sesion' and id_distrito=40 and estatus=1";
	//echo "sql_1: " . $sql_1;
	//exit;
	$result=sqlsrv_query($conn,$sql_1);
	$rows = sqlsrv_fetch_array($result);
	//$idsesion= $rows['idsesion'];
	//echo $id_sesion;
	$nosesion= $rows['nosesion'];
	$desc_sesion= $rows['desc_sesion'];
	$tipo_sesion= $rows['tipo_sesion'];
	$fecha_inicio_prog= $rows['fecha_inicio_prog'];
	$hora_inicio_prog = $rows['hora_inicio_prog'];

	$sql_nuevo="INSERT INTO sisesecd_sesiones(id_distrito, nosesion,desc_sesion, tipo_sesion, fecha_inicio_prog, hora_inicio_prog,estatus) values (".$id_distrito.",".$nosesion.",".$desc_sesion.", ".$tipo_sesion.",'".$fecha_inicio_prog."','".$hora_inicio_prog."',1);";
	//echo $sql_nuevo;

	$res1=sqlsrv_query($conn,$sql_nuevo);
	if(!$res1){
		echo "<script>alert('Ocurrió un error al iniciar el proceso (INS)');</script>";
	}

}

////consulta solo para traerme la sesion ////
/*Comentado por Daniel Rea*/
// $sql = "SELECT * FROM sisesecd_sesiones WHERE id_distrito=$id_distrito and nosesion=$nosesion and desc_sesion=$desc_sesion and tipo_sesion=$tipo_sesion and estatus=1";
// echo "sql: " . $sql;
// //$result=sqlsrv_query($conn,$sql);
//
// $undato=sqlsrv_query($conn,$sql);
// $r_idsesion=sqlsrv_fetch_array($undato);
// $id_sesion=$r_idsesion['id_sesion'];
/**/
//$iddistrito=$r_idsesion['id_distrito'];
	//echo "nuevo ID".$id_sesion;

////////Genero consulta de catalogo de funcionarios ////////////////

/*$sql_catalogo="select * from sisesecd_catfuncionarios_central where id_distrito =$id_distrito order by id_integrante, tipo_acredor asc";
	//echo $sql_catalogo;

	$result_catalogo=sqlsrv_query($conn,$sql_catalogo);
	//$r_cat=ifx_fetch_row($result_catalogo);


while ($r_cat=sqlsrv_fetch_array($result_catalogo))
{

		//$i=0;
	//$id_sesion[$i]= $r_idsesion['id_sesion'];
	$id_integrante[$i]= $r_cat['id_integrante'];
	$nombre[$i]= $r_cat['nombre'];
	$ap_paterno[$i]= $r_cat['ap_paterno'];
	$ap_materno[$i]= $r_cat['ap_materno'];
	$tipo_acredor[$i]= $r_cat['tipo_acredor'];
	$estatus[$i]= $r_cat['estatus'];
	$fecha_alta= date('d/m/Y');


		//for($i=1;$i<=36;$i++)
		//		{
/////inserto el catalogo con la sesion actual por distrito //////////////
	$insert_catalogo="INSERT INTO sisesecd_cat_funcionarios(id_sesion, id_distrito, id_integrante,nombre, ap_paterno,ap_materno, tipo_acredor,estatus,fecha_alta) values ($id_sesion, $iddistrito,$id_integrante[$i],'$nombre[$i]','$ap_paterno[$i]','$ap_materno[$i]','$tipo_acredor[$i]',1,'$fecha_alta');";
	//echo $insert_catalogo;

	sqlsrv_query($conn,$insert_catalogo);
		//		}
	}*/   //cierrra while

//} //cierra el if del conteo
/////////////////////////////////////////////////////////////////


//Llena Grid de sesiones por distrito

$sql = "SELECT * FROM sisesecd_sesiones WHERE id_distrito=$id_distrito and nosesion=$nosesion and desc_sesion=$desc_sesion and tipo_sesion=$tipo_sesion and estatus=1";
//echo "<br>sql: " . $sql;
$result=sqlsrv_query($conn,$sql);

$undato=sqlsrv_query($conn,$sql);
$r_idsesion=sqlsrv_fetch_array($undato);
$id_sesion=$r_idsesion['id_sesion'];



////// Para que muestre El estado de la sesion en que se encuentra
$sql_estado= "select estado_sesion,id_estado from sisesecd_estado_sesion WHERE id_sesion=$id_sesion and id_distrito=$id_distrito group by id_estado, estado_sesion,id_sesion order by id_estado DESC";

//echo "<br>sql_estado: " . $sql_estado;

$result_est=sqlsrv_query($conn, $sql_estado);
$r_estado= sqlsrv_fetch_array ($result_est);

if($r_estado){
	//echo "Entro if";
	echo "<center><strong>El status de la sesion es: &nbsp;&nbsp;" .utf8_encode($edo_sesion[$r_estado['estado_sesion']]) . "</strong></center>";
} else{
	echo "<center><strong class='badge badge-pill badge-light' style='font-size: 1em;'>Sin status</center></strong>";
}

?>
  </br>
  </br>
  <!--fin tabla para todos las pantallas --></p>
<p>&nbsp;</p>
<div style="margin: 0 auto; max-width: 95%;">
<table class="table table-bordered table-responsive">
  <tr >
    <td style="background-color: #EEE;">Descripción</td>
    <td style="background-color: #EEE;">Fecha de Inicio</td>
    <td style="background-color: #EEE;" >Hora de Inicio</td>
    <td style="background-color: #EEE;" colspan="5" align="center">Acciones</td>
    <td style="background-color: #EEE;" colspan="11" align="center">Reportes</td>
    </tr>

<?php
$tipo_s[1]= "ORDINARIA";
$tipo_s[2]= "EXTRAORDINARIA";
$tipo_s[3]= "PERMANENTE";

while($datos = sqlsrv_fetch_array($result))
{

$tipo=$datos['tipo_sesion'];
//echo 'se pintaaaaa:'.$tipo_s[$tipo];

  echo'<tr>';
  echo'<td>'.$nom_sesion[$datos['nosesion']].' SESIÓN '.$tipo_s[$tipo].' 0'.$datos['desc_sesion'].'</td>';
  echo'<td>'.$datos['fecha_inicio_prog'].'</td>';
  echo'<td>'.$datos['hora_inicio_prog'].'</td>';
  if ($datos['con_inicio'] == 1)
  {
  echo'<td><a class="btn btn-default" href="grid_orden_dia.php?id_sesion='.$datos['id_sesion'].'&nosesion='.$datos['nosesion'].'&tipo_sesion='.$datos['tipo_sesion'].'&desc_sesion='.$datos['desc_sesion'].'"> Puntos orden día</a></td>';
  //<img src="images/orden_dia.png" title="Punto Orden Dia" alt="Ingresar nuevo punto"border="0" />
  }
  else
  {
  echo'<td><div class="alert alert-warning">Iniciar Sesión</div></td>';//<img src="images/application_key.png" title="Iniciar Sesión" alt="Iniciar Sesión" border="0" />
  }
  echo'<td><a class="btn btn-default" href="actualizarinicio.php?id_sesion='.$datos['id_sesion'].'&nosesion='.$datos['nosesion'].'&tipo_sesion='.$datos['tipo_sesion'].'&desc_sesion='.$datos['desc_sesion'].'"> Inicio de sesión</a></td>'; //<img src="images/inicio.png" title="Reporte de Inicio" alt="Reporte de Inicio" border="0" />
  if($datos['con_votos']==1)
  {
  echo'<td><a  class="btn btn-default" href="actualizarfin.php?id_sesion='.$datos['id_sesion'].'&nosesion='.$datos['nosesion'].'&tipo_sesion='.$datos['tipo_sesion'].'&desc_sesion='.$datos['desc_sesion'].'"> Fin de sesión</a></td>';//<img src="images/fin.png" title="Reporte de Termino" alt="Reporte de Termino" border="0" />
  }
  else
  {
    echo'<td> <div class="alert alert-warning">Debe de ingresar la sesión y los votos</div> </td>'; //<img src="images/application_key.png" title="Debe de ingresar primero la votación" alt="Debe de ingresar primero la votación border="0" />
  }
 echo'<td><a  class="btn btn-default" href="estados.php?id_sesion='.$datos['id_sesion'].'&nosesion='.$datos['nosesion'].'"> Estado de sesión</a></td>';//<img src="images/sesion_edit.png" title="Estado de la Sesión" alt="Editar Sesion" border="0" />

///nuevo catalogo personas
echo'<td><a class="btn btn-default" href="catpersonas.php?id_sesion='.$datos['id_sesion'].'&nosesion='.$datos['nosesion'].'&tipo_sesion='.$datos['tipo_sesion'].'&desc_sesion='.$datos['desc_sesion'].'"> Catálogo funcionarios</a></td>';//<img src="images/universal01.png" title="Catalogo de Personajes" alt="Editar Sesion" border="0" />

/// inicia php de reportes distritales///

  echo'<td><a  class="btn btn-primary" href="rep01.php?id_sesion='.$datos['id_sesion'].'" target="_new"> Inicio y Fin</a></td>';//<img src="images/rpt_asitencia.png" title="Reporte Inicio y Final de Sesion" alt="Reporte Inicio y Final de Sesion" border="0" />
  echo'<td><a  class="btn btn-primary" href="rep02.php?id_sesion='.$datos['id_sesion'].'" target="_new">Sentido Voto</a></td>';//<img src="images/rpt_sentido_vot.png" title="Reporte Sentido Voto" alt="Reporte Sentido Voto" border="0" />
  echo'<td><a  class="btn btn-primary" href="rep03.php?id_sesion='.$datos['id_sesion'].'&id_distrito='.$id_distrito.'" target="_new">Intervencion</a></td>';//<img src="images/rpt_intervenciones.png" title="Reporte Intervenciones" alt="Reporte Intervenciones" border="0" />
  echo'<td><a  class="btn btn-primary" href="rep04.php?id_sesion='.$datos['id_sesion'].'&id_distrito='.$id_distrito.'" target="_new">Incidente</a></td>';//<img src="images/rpt_incidentes.png" title="Reporte de Incidentes" alt="Reporte Incidentes" border="0" />
   echo'<td><a  class="btn btn-primary" href="rep07dto.php?id_sesion='.$datos['id_sesion'].'&id_distrito='.$id_distrito.'" target="_new">Integrantes Consejo</a></td>';

 	echo'<td><a  class="btn btn-primary" href="rep_acredita_dto.php?&id_distrito='.$id_distrito.'" target="_new">Representantes de Partido Politicos y CP</a></td>';

	echo'<td><a class="btn btn-primary" href="repestados.php?id_sesion='.$datos['id_sesion'].'&nosesion='.$datos['nosesion'].'&tipo_sesion='.$datos['tipo_sesion'].'&desc_sesion='.$datos['desc_sesion'].'&id_distrito='.$id_distrito.'" target="_new">Estados de la sesion</a></td>';

   echo'<td><a  class="btn btn-primary" id="nuevo" href="subir_acta.php?id_sesion='.$datos['id_sesion'].'&id_distrito='.$id_distrito.'" >Subir Acta</a></td>';//<img src="images/printer_add.png" title="Subir acta" alt="Subir Acta" border="0" />

$acta_principal=$datos['acta_principal'];
echo '<td>';
	if($acta_principal=='')
	{
		echo "<div class='alert alert-warning'>No hay Acta</div>";
	}
	else
	{
	echo'<a  class="btn btn-primary" href="./'.$acta_principal.'" target="_blank">Ver Acta</a>';
	}
echo '</td>';


	echo'<td><a  class="btn btn-primary" id="nuevo" href="subir_docto.php?id_sesion='.$datos['id_sesion'].'&id_distrito='.$id_distrito.'" >Subir Documentos de la sesión</a></td>';

	$doctos_principal=$datos['doctos_principal'];
echo '<td>';
	if($doctos_principal=='')
	{
		echo "<div class='alert alert-warning'>No hay documentos</div>";
	}
	else
	{
	echo'<a  class="btn btn-primary" href="./'.$doctos_principal.'" target="_blank">Ver Documentos</a>';
	}
echo '</td>';
echo'</tr>';

}

?>
</table>
</div>
<p><!--<a href="ManualUsuario.pdf">Descarga Manual de Usuario</a>-->
  </br>
</p>
<p>&nbsp;</p>
 <p>&nbsp;</p>
 <p>&nbsp;</p>
  </div>
</div>

<footer class="py-4 bg-light mt-auto">
                    <?php include('footer.php'); ?>
                </footer>
</body>
</html>
