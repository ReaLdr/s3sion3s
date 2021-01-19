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
<table  border="0" style="width: 90%;">
  <tr>
    <td width="16%" height="25" align="left" class="well">Usuario: <?php echo $name;?></td>
       <td width="16%" align="center"><?php echo"<a class='btn btn-primary' href='javascript:history.back(-2)'> Menu principal</a>";?></td>

    <td width="29%" align="right"><a class="btn btn-default" href="logout.php">Cerrar Sesion</a></td>
  </tr>
</table>
</div>

<p>&nbsp;</p>
<p>&nbsp;</p>
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />

<?php
$nosesion=$_GET[nosesion];
$tiposesion=$_REQUEST[tiposesion];
$desc=$_REQUEST[descsesion];
?>
<script language='javascript' src="popcalendar.js"></script>
<script type="text/javascript" src="jquery.js"></script>
<script type="text/javascript" src="jquery.validate.js"></script>
<script type="text/javascript" src="select_dependientes.js"></script>
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

	  <a href="reptodos_integrante.php" >Descargar los 33 integrantes del consejo</a>
	<br>
	  <br>
	  <br>
<div> <span class="titulo">SELECCIONE EL DISTRITO DEL CUAL DESEA SABER SUS INTEGRANTES DEL CONSEJO<BR>
	</span></center>

	<p>&nbsp;</p>
	<center>
<table width="450" border="1" cellspacing="0" cellpadding="0">
  <tr>    <form  id="form1" name="form1" method="post" action="rep07.php"/>
    <td width="58%" class="titulo" align="right">Distrito Electoral:</td>
    <td width="42%">

    <?php
	include 'arreglos.php';
	echo'<select name="distrito" id="distrito" >';

		for($i=1;$i<=33;$i++)
		{
		echo '<option value='.$i.'>'.$i.' </option>';
		}
	echo '</select>';

     ?>


	</td>
    </tr>
  <tr>
    <input type="hidden" name="nosesion" id="nosesion" value="<?php echo $nosesion ?>"/>
    <input type="hidden" name="tiposesion" id="tiposesion" value="<?php echo $tiposesion ?>"/>
    <input type="hidden" name="descsesion" id="descsesion" value="<?php echo $desc ?>"/>
    </tr>
  <tr>
    <td>&nbsp;</td>
    <td><input type="submit"  value="Generar reporte"/>	</td>
    </tr>
</table>
		</center>
	<p>&nbsp;</p>
	<p>&nbsp;</p>
</span></div>

<p>&nbsp;</p>
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
