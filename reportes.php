<?php
session_start();
$grup=$_SESSION['k_grupo'];
header("Content-Type: text/html;charset=utf-8"); 
if (isset($_SESSION['k_username'])) {
	
}
else
{
	
	echo'<SCRIPT LANGUAGE="javascript">';
	echo'	location.href = "index.php";';
	echo'	</SCRIPT>';


}
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />

<script type="text/javascript" src="js/jquery-1.4.3.min.js"></script>
<script type="text/javascript" src="fancybox/jquery.fancybox-1.3.4.js"></script>
<link rel="stylesheet" type="text/css" href="fancybox/jquery.fancybox-1.3.4.css" media="screen" />
<link href="style.css" rel="stylesheet" type="text/css" />
<title>Sistema de Seguimiento al Calendario Anual de Actividades</title>
<script type="text/javascript">

</script>

	<script type="text/javascript">
		$(document).ready(function() {
			$("#rpt_num_act").fancybox({
				
				'autoDimensions'	: false,
				'width'				: 600,
				'height'			:  550,
				'overlayColor'		: '#1D1724',
				'overlayOpacity'	: '0.94',
				'transitionIn'		: 'elastic',
				'transitionOut'		: 'elastic',
				'type'				: 'iframe'
				
			
			});
						
			
	
		});

</script>

<style>
table {font: 10px "Arial", sans-serif;padding: 0; margin: 0; border-collapse: collapse; color: #333; background: #F3F5F7;}
 
table a {color: #3A4856; text-decoration: none; border-bottom: 1px solid #C6C8CB;}  
 
table a:visited {color: #777;}
 
table a:hover {color: #000;}  
 
table caption {background-color: transparent;
	color: #000000;
	font-family: Arial, Helvetica, sans-serif;
	font-size: 24px;
	padding-bottom: 13px;
	padding-left: 8px;
	text-align: left;}
 
table thead th {background:#333333; padding: 2px 10px; color: #ffffff; text-align: left; font-weight: bold;}
 
table tbody, table thead {border-left: 1px solid #EAECEE; border-right: 1px solid #EAECEE;}
 
table tbody {border-bottom: 1px solid #EAECEE;}
                      
table tbody td, table tbody th {padding: 10px; background: url("images/td_back.gif") repeat-x; text-align: left;}
 
table tbody tr {background: #F3F5F7;}
 
table tbody tr.odd {background: #F0F2F4;}
 
table tbody  tr:hover {background: #C1DAD7; color: #111; cursor:pointer;}
 
table tfoot td, table tfoot th, table tfoot tr {text-align: left; font: 1px  "Arial", sans-serif; text-transform: uppercase; background: #fff; padding: 10px;}



</style>
</head>
<body>
<div id="container">
<div align="center">
	<div>
  <p><img src="images/header.png" width="600" height="85" />
  </p>
  </div>
  <p>&nbsp;</p>
    <p> <a href="main.php" >
<img src="images/Home.png"/>menu principal</a>
</p>
  <p>&nbsp;</p>
   <table width="419" height="49" summary="Submitted table designs">
  <caption> Reportes </caption>
<p>
<thead>
 <tr >
  	<th width="297" scope="col">Reporte a Generar </th>
    <th width="110" height="43" align="center" scope="col">Descargar</th>
         </tr>
</thead>

<?php
if($grup ==1 || $grup ==3 )
{
echo'<tr>
<td>Reporte de los 40 organos desconcentrados</td>
<td><a href="rpt_central.php" ><img src="images/Excel Document.png"/></a></td>
</tr>';

echo'<tr>
<td>N&uacute;mero de actividades realizadas por distrito</td>
<td>
<a id="rpt_num_act" href="rpt_numero_actividades.php"><img src="images/Excel Document.png"/></a>
</td>
</tr>';
echo'<tr>
<td> Actividades realizadas </td>
<td>
<a id="rpt_num_act" href="rpt_poractivida.php"><img src="images/Excel Document.png"/></a>
</td>
</tr>';

}

if($grup == 2)
{
	$n=1;
echo'<tr>
<td>Reporte Mensual de Actividades Desarrolladas </td>
<td>';
//<a id="liga" href="rpt_dto.php" ><img src="images/Excel Document.png"/></a>
echo'<a id="liga2'.$n.'"href="rpt_dto.php" title="Editar Actividad"><img src="images/Excels.png"/></a>';
echo'</td>
</tr>';
}
?>


</table>

<p>&nbsp;</p>
<p>&nbsp;</p>
<p>&nbsp;</p>

<div>    
<img src="images/footer.png" width="450" height="50" />
</div>
</div>
</div>
</body>
</html>
