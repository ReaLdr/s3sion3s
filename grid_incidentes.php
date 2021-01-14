<?php 
error_reporting(E_ERROR | E_PARSE);
session_start();
	 $id_distrito=$_SESSION['id_distrito'];	

include ('config_open_db.php');
include ('arreglos.php');

$nosesion=$_GET['nosesion'];
$id_sesion=$_GET['id_sesion'];
$id_orden=$_GET['id_orden'];
$punto=$_GET['punto'];
?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<script type="text/javascript" src="js/jquery-1.4.3.min.js"></script>
<link href="css/stilacho.css" rel="stylesheet" type="text/css" />
<link href="css/animate.css" rel="stylesheet" type="text/css" />
<script src="js/bootstrap.min.js"></script>
<link rel="stylesheet" href="css/bootstrap.min.css">
<link rel="stylesheet" href="css/jquery-ui.css">
	
<title>.: SISESECD:.</title>
</head>

<?php include('header.php');	?>
<!--tabla para todos las pantallas -->
    <body class="sb-nav-fixed">
        <div id="layoutSidenav">
            <div id="layoutSidenav_content">
            <main>
                    <div class="container-fluid">
	            <h1 class="mt-4"><img src="images/logo-header.png"></h1>
	<p>&nbsp;</p>
			<div class="top-menu">			
			<table border="0" style="width: 90%;">
  <tr>
    <td width="159" height="25" align="left" class="well">Usuario: <?php echo $name; ?></td>
    <td width="555" align="left" class="well">Consejo Distritital: <?php echo $id_distrito; ?></td>
    <td width="542" align="center"><?php echo"<a class='btn btn-primary' href='javascript:history.back(-2)'> Regresar </a>";?></td>
     
   <td width="169" align="right"><a class="btn btn-default"  href="logout.php">Cerrar Sesion</a></td>
  </tr>
</table>
						</div>

<?php 

//$tipo_sesion=$_REQUEST['tipo_sesion'];
//$desc_sesion=$_REQUEST['desc_sesion'];

//echo "desc".$descsesion;
/*echo "no".$nosesion;
echo "orden".$id_orden;
echo "id".$id_sesion;*/

//echo $id_sesion;
////////////////////////////
//Llena Grid de sesiones por distrito

$sql = "SELECT id_incidentes, id_sesion, id_orden, CAST(incidente as CHAR(300)) AS incidente, CAST(replica as CHAR(300)) AS replica FROM sisesecd_incidentes WHERE id_distrito=$id_distrito and id_orden=$id_orden and id_sesion=$id_sesion";
//echo $sql;
$result=sqlsrv_query($conn, $sql);

$undato=sqlsrv_query($conn, $sql);
$r_idsesion=sqlsrv_fetch_array($undato);
$id_sesion=$r_idsesion['id_sesion'];



////// Para que muestre El estado de la sesion en que se encuentra

?>
</br>
 </br>
<p>&nbsp;</p>
<div class="card mb-4">
	<div class="card-header">
     <b>INCIDENTES DEL PUNTO <?php echo $punto ?></b>
	
    </div>
  <!--fin tabla para todos las pantallas --></p>
<table  border="1" cellpadding="0" cellspacing="0" class="table table-bordered table-responsive">
  <tr >
    <td width="2%">No.</td>
    <td width="23%" >Incidentes</td>
    <td width="56%" >R&eacute;plica</td>
    <td width="19%" align="center">Acciones</td>
  </tr>

<?php


while($datos = sqlsrv_fetch_array($result))
{
	

//echo 'se pintaaaaa:'.$tipo_s[$tipo];
// $i=0;
	$i++;
	
  echo'<tr>';
  echo'<td>'.$i.'</td>';
  echo'<td>'.$datos[incidente].'</td>';
  echo'<td>'.$datos[replica].'</td>';
  
 
 echo'<td><a href="actualizarincidente.php?id_sesion='.$datos[id_sesion].'&id_orden='.$datos[id_orden].'&id_incidente='.$datos[id_incidentes].'"><img src="images/sesion_edit.png" title="Edita incidente" alt="Edita Incidente" border="0" /> Editar incidente</a></td>';

//nuevo catalogo personas

echo'</tr>';
  
}

?>
</table>
<!--<a href="ManualUsuario.pdf">Descarga Manual de Usuario</a>-->
</br>
</div>
</div>
<footer class="py-4 bg-light mt-auto">
	<?php include('footer.php'); ?>
</footer>

</body>
</html>