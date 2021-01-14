<?php 
session_start();
error_reporting(E_ERROR | E_PARSE);	

$name= $_SESSION['user'];
$grup=$_SESSION['grupo'];
$id_distrito=$_SESSION['id_distrito'];

?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
	    <link href="css/bootstrap.min.css" rel="stylesheet">
      <link href="css/mycss.css" rel="stylesheet">
      <link rel="stylesheet" type="text/css" href="style001.css">
<link href="css/stilacho.css" rel="stylesheet" type="text/css" />
<link href="css/animate.css" rel="stylesheet" type="text/css" />
<title>.: SISECOD 2018 :.</title>
</head>

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
                                <a href="nuevo_central.php" class="btn btn-outline-dark btn-sm"><img src="images/nuevo.png" width="16" height="16" border="0" /> Nueva Sesion</a>
                                <div class="col-sm-1"></div>
                               
                            </li>
                        </ol>

</div>
<?php

echo'<p>&nbsp;</p>';echo'<p>&nbsp;</p>';echo'<p>&nbsp;</p>';echo'<p>&nbsp;</p>';echo'<p>&nbsp;</p>';echo'<p>&nbsp;</p>';
echo '<div align="center">';
echo'<table width="166" border="0" cellpadding="0" cellspacing="0">
  <tr>
    <td width="156" align="center"><img src="images/ajax-loader.gif" width="160" height="24" /></td>
  </tr>
  <tr>
    <td align="center">BORRANDO</td>
  </tr>
</table>';
echo '</div>';

$idsesion=$_GET['idsesion'];
$idorden=$_GET[idorden];
$id_distrito=$_SESSION[id_distrito];
include ("config_open_db.php");



$sql_delsesion="update sisesecd_sesiones set estatus=0 where id_sesion=$idsesion";
$sql_delete="update sisesecd_sesiones set estatus=0 where id_distrito between 1 and 33";
$sql_delete_ordenes="update sisesecd_ordendia estatus=0 where id_sesion in(select id_sesion from sisesecd_sesiones where id_distrito between 1 and 33);";
//echo $sql_delsesion;
sqlsrv_query ($conn, $sql_delsesion);
	
if(sqlsrv_query($conn, $sql_delete)==true)
	{
		$sql_delete_ordenes="update sisesecd_ordendia set estatus=0 WHERE id_sesion in(select id_sesion from sisesecd_sesiones where id_distrito between 1 and 33);";
			if(sqlsrv_query($conn, $sql_delete_ordenes)==true)
			{
			echo'	<SCRIPT LANGUAGE="javascript">';	
			echo' 	alert("La sesion ha sido cancelada exitosamente")';
			echo'	</SCRIPT>';
			echo'<SCRIPT LANGUAGE="javascript">';
			echo'history.go(-1)';
			echo'</SCRIPT>';
			}
			else
			{
				sqlsrv_errors();
			}
			
			
	echo' 	alert("La sesion ha sido cancelada exitosamente")';
			echo'	</SCRIPT>';
			echo'<SCRIPT LANGUAGE="javascript">';
			echo'history.go(-1)';
	
	}
	else
	{
	sqlsrv_errors();
	}


sqlsrv_close($conn);
	
?>
</div>

</body>
</html>