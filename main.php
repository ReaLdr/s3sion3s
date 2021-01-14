<?php 
session_start();
error_reporting(E_ERROR | E_PARSE);
include ('config_open_db.php');

if (isset($_SESSION['user'])) {
	
$id_distrito = $_SESSION['id_distrito'];
$name= $_SESSION['transaccion'];
$grup=$_SESSION['grupo'];
	
}
else
{
echo' 	alert("Debe iniciar una sesion")';	
	echo'<SCRIPT LANGUAGE="javascript">';
	echo'	location.href = "index.php";';
	echo'	</SCRIPT>';
}
$tipo_ses[1]="ORDINARIA";
$tipo_ses[2]="EXTRAORDINARIA";
$tipo_ses[3]="PERMANENTE";
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<!--<link href="style.css" rel="stylesheet" type="text/css" />-->

<link href="css/stilacho.css" rel="stylesheet" type="text/css" />
<link href="css/animate.css" rel="stylesheet" type="text/css" />

<script src="js/jquery-3.2.1.min.js"></script>
<script src="js/bootstrap.min.js"></script>
<link rel="stylesheet" href="css/bootstrap.min.css">
<link rel="stylesheet" href="css/jquery-ui.css">

<title>.:SISESECD:.</title>
</head>

<script language="javascript">
function detalle(codigophp){
			if (confirm('¿Desea borrar la sesión?'))
				{
	document.location.href ="eliminar_sesion.php?idsesion=" + codigophp;
    
			}
			}
	</script>

<body>
<div id="container_blanco">

  <?php include('header.php');?>
</div>

<h1 class="mt-4"><img src="images/logo-header.png"></h1>
<br />
	


<br />

<form id="frmsesion" name="frmsesion" method="post" action="puente.php" class="form-group">

<table border="0" cellpadding="0" class="">

<tr>
	<td colspan="2">	<p align="center" ><h5>Selecciona la sesión a celebrar:</h5></p></td>
</tr>
	</br>
	
	</br>
	</br>
	<tr>
<td width="73%"  height="25" align="left">
<?php

	
$sql2="SELECT * FROM (SELECT value distritos, nosesion, tipo_sesion, desc_sesion, id_sesion FROM sisesecd_sesiones CROSS APPLY STRING_SPLIT(distritos_sesiones, ',')  WHERE id_distrito= 40 and estatus= 1) AS pru WHERE distritos = $id_distrito"; 
//$sql2="SELECT * FROM sisesecd_sesiones where id_distrito= 40 and estatus= 1"; 
//$resultado2 = sqlsrv_query($conn,$sql2);
/**/
$params = array();
$options =  array( "Scrollable" => SQLSRV_CURSOR_KEYSET );
$resultado2 = sqlsrv_query ($conn, $sql2, $params, $options);
$row_count = sqlsrv_num_rows($resultado2);
/**/
if($row_count){

	echo'<select name="id_sesion" id="id_sesion" class="form-control">';	
	while($row2 = sqlsrv_fetch_array($resultado2))
	 


	{
	//echo '<option value='.$row[id_sesion].'>'.$nom_sesion[$row[nosesion]].' SESIÓN '.$tipo_ses[$row[tipo_sesion]].' 0'.$row[desc_sesion].'  </option>';
	echo '<option value='.$row2[id_sesion].'>'.$tipo_ses[$row2[tipo_sesion]].' 0'.$row2[desc_sesion].'  </option>';
		 
	  }	 
	
	  echo '</select>
	
	  <td>   &nbsp;&nbsp; &nbsp; &nbsp; &nbsp; &nbsp; <input  class="btn btn-default" type="submit" value="Ir" />   &nbsp;&nbsp; &nbsp; &nbsp; &nbsp; &nbsp; </td>';
	
	 
} else{
	
	echo "<p algin='center'><h2>No cuenta con una sesión a celebrar</h2> </p>";
}
	
	
		
  ?>
  

</td>

</tr>
<tr><td>&nbsp;</td>
<td>&nbsp;</td>
<td>&nbsp;</td></tr>

<tr><td>&nbsp;</td>
<td>&nbsp;</td>
<td>&nbsp;</td></tr>

<tr><td>&nbsp;</td>
<td>&nbsp;</td>
<td>&nbsp;</td></tr>

<tr>
<td><a href="aredita.php" class='btn btn-primary'>Acreditación de los Representantes de los Partidos Politico y Candidaturas sin Partido</a>
	</div></td>
<td> </td></tr>
</table>
</form>
<br />
<br />


</div>
</div>
<p>&nbsp;</p>
</br>
</br>
</br>
	</br>
</br>
<footer class="py-4 bg-light mt-auto">
	<?php include('footer.php'); ?>
</footer>
</body>
</html>