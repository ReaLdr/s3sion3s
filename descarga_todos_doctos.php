<?php
header("Content-Type: text/html; charset=utf-8");
error_reporting(E_ERROR | E_PARSE);
session_start();
//echo 'Bienvenido,';

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
<title>.: SISESECD 2018 :.</title>

</head>
	
<body>
<div id="container_blanco">

  <?php include('header.php');?>

<p>&nbsp;</p>

                    <h1 class="mt-4"><img src="images/logo-header.png"></h1>
<!--tabla para todos las pantallas -->
<div class="top-menu">
<table border="0" style="width: 90%;">
  <tr>
    <td width="16%" height="25" align="left" class="well">Usuario: <?php echo $name;?></td>
  	   <td width="16%" align="center"><?php echo"<a class='btn btn-primary' href='javascript:history.back(-2)'> Menu principal</a>"; ?></td>
   
    <td width="29%" align="right"><a class="btn btn-default" href="logout.php">Cerrar Sesion</a></td>
  </tr>
</table>
</div>

<p>&nbsp;</p>
<p>&nbsp;</p>




<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<style>
.titulo {
	font-family: Arial, Helvetica, sans-serif;
	font-size: 14px;
	font-style: normal;
	text-align : center;
	line-height: normal;
	font-weight: bold;
	font-variant: normal;
	text-transform: none;
	color: #2E213D;
}

.fechas{
	font-family: Arial, Helvetica, sans-serif;
	font-size: 12px;
	font-style: normal;
	text-align : right;
	line-height: normal;
	font-weight: bold;
	font-variant: normal;
	text-transform: none;
	color: #000000;
}
</style>
</head>
<body>

<div id="content">
  <CENTER>
<br>
<div> 
  <p>&nbsp;</p>
  <p><span class="titulo">Descarga de los Documentos que subieron los 33 Distritos Electorales<BR>
    </span></p>

	 
	  <p>&nbsp;</p>	  
	<center>
	<table class="table table-bordered table-responsive" border="1" align="center">
  <thead>
	  <tr>
	  <td> <p><span class="titulo">Todos los Documentos <BR>
    </span></p></td>
		  <td><a href="descarga33doctos.php" >descargar</a> </td>
	  </tr>
    <tr >
      <th width="29" scope="col">#</th>
      <th width="78" height="43" align="center" scope="col">Distrito</th>
      <th width="163"  align="center" scope="col">Documentos</th>	
      </tr>  
    <?php 
	error_reporting(E_ERROR | E_PARSE);
$nosesion=$_GET[nosesion];
$tiposesion=$_REQUEST[tiposesion];
$desc=$_REQUEST[descsesion];

	include ("config_open_db.php"); 
	
	$sqlSelec="SELECT * from sisesecd_sesiones where nosesion=$nosesion and tipo_sesion=$tiposesion 
and desc_sesion=$desc and id_distrito!=40 and estatus =1 order by id_distrito asc";
//echo $sqlSelec;

$res=sqlsrv_query($conn, $sqlSelec);
$i=0;

while($datos=sqlsrv_fetch_array ($res))
{
$i++;
echo '<tr>';
echo '<th scope="row">'.$i.'</td>';
echo '<td >'.$datos[id_distrito].'</td>';



$docto_principal=$datos[doctos_principal];
echo '<td>';

	if($docto_principal=='')
	{
		echo "No hay documento disponible";
	}
	else
	{
	echo'<a href="./'.$docto_principal.'" target="_blank">Ver Documentos</a>';
}

echo '</td>';
echo '</tr>';
}
?>
  </table> 
		</center>
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