<?php 
header("Content-Type: text/html; charset=utf-8");
error_reporting(E_ERROR | E_PARSE);
session_start();

//echo 'Bienvenido, ';
if (isset($_SESSION['user'])) {

$name= $_SESSION['transaccion'];
$grup=$_SESSION['grupo'];
$id_distrito=$_SESSION['id_distrito'];	
	
}
else
{
echo' 	alert("Debe iniciar una sesion")';	
	echo'<SCRIPT LANGUAGE="javascript">';
	echo'	location.href = "index.php";';
	echo'	</SCRIPT>';
}

include 'arreglos.php';
?>


<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<!--<link href="style.css" rel="stylesheet" type="text/css" />-->

<script type="text/javascript" src="js/jquery-1.4.3.min.js"></script>


<title>.: SISESECD  :.</title>
   <!-- Bootstrap core CSS -->
      <link href="css/bootstrap.min.css" rel="stylesheet">
      <link href="css/mycss.css" rel="stylesheet">
      <link rel="stylesheet" type="text/css" href="style001.css">
	  <!-- Bootstrap core JavaScript
      ================================================== -->
      <script src="js/jquery-3.3.1.min.js"></script>
      <script src="js/popper.min.js"></script>
      <script src="js/bootstrap.min.js"></script>
      <!--<script src="js/holder.min.js"></script>-->
      <script src="js/funcionesajax.js"></script>
      <link rel="stylesheet" href="css/all.css">
	
<link href="css/stilacho.css" rel="stylesheet" type="text/css" />
<link href="css/animate.css" rel="stylesheet" type="text/css" />
      <style>
      .derecha{float:right;}
      .tableCenter{text-align: center;}
      </style>


<script language="javascript">
function detalle(codigophp){
			if (confirm('¿Desea borrar la sesión?'))
				{
	document.location.href ="eliminar_sesion_central.php?idsesion=" + codigophp;
    
			}
			}
	</script>
<body>
<div id="container_blanco">

  <?php include('header.php');?>
	

    <body class="sb-nav-fixed">
        <div id="layoutSidenav">
            <div id="layoutSidenav_content">
            <main>
                    <div class="container-fluid">

                    <h1 class="mt-4"><img src="images/logo-header.png"></h1>
						
						  <ol class="breadcrumb mb-4">
                            <li class="breadcrumb-item active">
                                <a href="nuevo_central.php" class="btn btn-outline-dark btn-sm"><img src="images/nuevo.png" width="16" height="16" border="0" /> Nueva Sesión</a>
                                <div class="col-sm-1"></div>
                               
                            </li>
                        </ol>
						
                    <div class="card mb-4">
                            <div class="card-header">
                                <i class="fas fa-table mr-1"></i>
                                Información de las Sesiones Distritales 
                                <p id="abrevia">Usuario:<strong><?php echo $name; ?></strong>
                            </div>
						
                            <div class="card-body">
                            <div class="center">  
                           

	<table class="table table-bordered table-responsive">
   <tr  class="blanco_tablas">

    <td class="fondogris-tabla" >Descripción</td>
    
    <td class="fondogris-tabla">Fecha de Inicio Programada</td>
    <td class="fondogris-tabla" >Hora de Inicio Programada</td>
    <td class="fondogris-tabla" colspan="3">Acciones</td>
    <td class="fondogris-tabla" colspan="11">Reportes</td>
    </tr>


	<?php
include ("config_open_db.php"); 
	
	include("bitacora.php");
	$accion="Ingresa Modulo Central";
	bitacora($accion);

$sql_count= "SELECT count(*) AS cuantos FROM sisesecd_sesiones WHERE id_distrito =$id_distrito and estatus=1;";
$exe_sql_count=sqlsrv_query($conn,$sql_count);
$row_cuantos = sqlsrv_fetch_array ($exe_sql_count);
$cuantos=$row_cuantos[cuantos];
//echo $cuantos;
$n_pages= $cuantos/15;
//echo $n_pages;
$n_pages=ceil($n_pages);
//echo "pages";
//echo $n_pages;
$page=1;
$skip[1]=0;
$skip[2]=15;
$skip[3]=30;
$skip[4]=45;
$skip[5]=60;
$skip[6]=75;
$skip[7]=90;
$skip[8]=105;

	$sql = "SELECT top 35 * FROM sisesecd_sesiones WHERE id_distrito='$id_distrito' and estatus=1 order by nosesion ASC";
//echo $sql;
	

	$result=sqlsrv_query($conn,$sql);
$i=0;
while($datos = sqlsrv_fetch_array ($result))
{
	
$i++;
  echo'<tr>';
  //echo'<td>'.$i.'</td>';
  //echo'<td>'.$datos[nosesion].'</td>';
 // echo'<td></td>';
  echo'<td>'.$nom_sesion[$datos[nosesion]]." SESION (".$tipo_ses[$datos[tipo_sesion]]." 0".$datos[desc_sesion]." )".'</td>';
  //echo'<td>'.$datos[tiposesion].'</td>';
  echo'<td>'.$datos[fecha_inicio_prog].'</td>';
  echo'<td>'.$datos[hora_inicio_prog].'</td>';
  echo'<td><a class="btn btn-default" href="actualizar_central.php?id_sesion='.$datos[id_sesion].'"><img src="images/sesion_edit.png" title="Editar Sesion" alt="Editar Sesion" border="0" /></a></td>';
  echo'<td><a class="btn btn-default" href="grid_orden_dia_central.php?id_sesion='.$datos[id_sesion].'"><img src="images/orden_dia.png" title="Punto Orden Dia" alt="Ingresar nuevo punto"border="0" /></a></td>';
  
  echo'<td>';
  ?>
  <a class="btn btn-default" href="<?php print("javascript:detalle('".$datos[id_sesion]."');");?>"><img src="images/borrar.png" title="Eliminar" alt="Eliminar" border="0" /></a>

<?php

  	echo'<td><a class="btn btn-outline-dark btn-sm" href="nuevorep.php?nosesion='.$datos[nosesion].'&tiposesion='.$datos[tipo_sesion].'&descsesion='.$datos[desc_sesion].'" target="_new">Reporte Inicio de Sesion</a></td>'; 
  	echo'<td><a  class="btn btn-outline-dark btn-sm" href="repofincen.php?nosesion='.$datos[nosesion].'&tiposesion='.$datos[tipo_sesion].'&descsesion='.$datos[desc_sesion].'" target="_new">Reporte Final de Sesion</a></td>';
	echo'<td><a class="btn btn-outline-dark btn-sm" id="nuevo'.$i.'" href="menu_filtro_voto.php?nosesion='.$datos[nosesion].'&tiposesion='.$datos[tipo_sesion].'&descsesion='.$datos[desc_sesion].'" >Reporte Sentido Voto</a></td>'; ////<img src="images/folderblue.png" title="Reporte Sentido Voto" alt="Reporte Sentido Voto" border="0" />
  	echo'<td><a class="btn btn-outline-dark btn-sm" href="rep05.php?nosesion='.$datos[nosesion].'&tiposesion='.$datos[tipo_sesion].'&descsesion='.$datos[desc_sesion].'" target="_new">Reporte Intervenciones</a></td>';////<img src="images/foldered.png" title="Reporte Intervenciones" alt="Reporte Intervenciones" border="0" />
  
  	echo'<td><a class="btn btn-outline-dark btn-sm" href="rep06.php?nosesion='.$datos[nosesion].'&tiposesion='.$datos[tipo_sesion].'&descsesion='.$datos[desc_sesion].'" target="_new">Reporte de Incidentes</a></td>';////<img src="images/foldergrey.png" title="Reporte de Incidentes" alt="Reporte Incidentes" border="0" />
  
    echo'<td><a class="btn btn-outline-dark btn-sm" id="integra'.$i.'" href="menu_filtro_dto.php?nosesion='.$datos[nosesion].'&tiposesion='.$datos[tipo_sesion].'&descsesion='.$datos[desc_sesion].'" >Reporte de Integrantes del Consejo</a></td>';///<img src="images/folderviolet.png" title="Reporte de Integrantes del Consejo" alt="Reporte de Integrantes del CD" border="0" />
	echo'<td><a class="btn btn-outline-dark btn-sm" href="repestados_central.php?nosesion='.$datos[nosesion].'&tiposesion='.$datos[tipo_sesion].'&descsesion='.$datos[desc_sesion].'" target="_new">Estados de la sesion</a></td>';
	
	echo'<td><a class="btn btn-outline-dark btn-sm"  href="rep_acredita.php" target="_new">Representantes de Partido Politicos y CP</a></td>';
	
	
	echo'<td><a class="btn btn-outline-dark btn-sm" id="descarga'.$i.'" href="descargas.php?nosesion='.$datos[nosesion].'&tiposesion='.$datos[tipo_sesion].'&descsesion='.$datos[desc_sesion].'" >Descargar Actas 33 Dtos</a></td>';////<img src="images/printer_empty.png" title="Descargar Actas 40Dtos" alt="Reporte Concentrado" border="0" />
	
  	echo'<td><a class="btn btn-outline-dark btn-sm" href="sl1d3/examples/multiple/reporte_animado.php?nosesion='.$datos[nosesion].'&tiposesion='.$datos[tipo_sesion].'&descsesion='.$datos[desc_sesion].'" target="_blank">Reporte Seguimiento 1</a></td>';////<img src="images/rpt_incidentes.png" title="Reporte Animado 1" alt="Reporte Concentrado" border="0" />
  
  	echo'<td><a class="btn btn-outline-dark btn-sm"href="sl1d3/examples/multiple/reporte_animado2.php?nosesion='.$datos[nosesion].'&tiposesion='.$datos[tipo_sesion].'&descsesion='.$datos[desc_sesion].'" target="_blank">Reporte Seguimiento 2</a></td>';////<img src="images/rpt_intervenciones.png" title="Reporte Animado 2" alt="Reporte Concentrado" border="0" />
  echo'</tr>';
}
?>
</table>
 </div>
      </div>
              </div>
              </div>
            </main>
				
				
				
<br>
<p>&nbsp;</p>
<p>&nbsp;</p>
				<footer class="py-4 bg-light mt-auto">
                    <?php include('footer.php'); ?>
                </footer>
<!--fin tabla para todos las pantallas -->

<!-- numero de paginas -->
    <script src="js/jquery-3.5.1.min.js" crossorigin="anonymous"></script>
        <script src="js/bootstrap.bundle.min.js" crossorigin="anonymous"></script>
        <script src="js/scripts.js"></script>
        <script src="js/jquery.dataTables.min.js" crossorigin="anonymous"></script>
        <script src="js/dataTables.bootstrap4.min.js" crossorigin="anonymous"></script>
        <script src="js/datatables-demo.js"></script>
</body>
</html>