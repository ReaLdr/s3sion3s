<?php
session_start();
error_reporting(E_ERROR | E_PARSE);

$id_distrito=$_SESSION[id_distrito];
include 'config_open_db.php';
if (isset($_SESSION['user'])) {

}
else
{
echo' 	alert("Debe iniciar una sesion")';
	echo'<SCRIPT LANGUAGE="javascript">';
	echo'	location.href = "index.php";';
	echo'	</SCRIPT>';
}

?>

<body>
<?php
/////////////////////////////////////
$nosesion=$_POST[nosesion];
$descsesion=$_POST[descsesion];
$tiposesion=$_POST[tiposesion];
$fechainicioprog=$_POST[fechainicioprog];
$horainicioprog=$_POST[horainicioprog];
$id_distrito=$_POST[id_distrito];
$id_sesion=$_POST[id_sesion];

$distritos_sesion = json_encode($_POST[checkbox_distrito]);
  //echo $distritos_sesion;
  //array_push($distritos_sesion);
  $corchetes = ['[', ']', '"'];
  $replace = ['', '', ''];

  $replace_array = str_replace($corchetes, $replace, $distritos_sesion);
//echo $replace_array;
  //echo json_encode($_POST);
  //exit;


$sql1="SELECT count(*)as cuantos FROM sisesecd_sesiones WHERE estatus=1 and nosesion=".$nosesion." and tipo_sesion=".$tiposesion." and desc_sesion=".$descsesion." ;";
		$consult = sqlsrv_query($conn,$sql1);
		$cl = sqlsrv_fetch_array($consult);
		$cuantos=$cl[cuantos];
$sql2="SELECT id_sesion FROM sisesecd_sesiones WHERE estatus=1 and nosesion=".$nosesion." and tipo_sesion=".$tiposesion." and desc_sesion=".$descsesion." ;";
		$consesion = sqlsrv_query($conn,$sql2);
		$c_sesion = sqlsrv_fetch_array($consesion);
		$idmark=$c_sesion[idsesion];
		if($cuantos>0 && $idsesion!=$idmark){
		//echo "estoy en el if";
		echo'	<SCRIPT LANGUAGE="javascript">';
		echo' 	alert("No se actualiz� la sesion.\n Ya existe otra sesion con esas caracteristicas.")';
		echo'	</SCRIPT>';
		echo'<SCRIPT LANGUAGE="javascript">';
		echo'	location.href = "./grid_sesiones_central.php";';
		echo'	</SCRIPT>';

			}
			else{

$update="UPDATE sisesecd_sesiones set id_distrito = ".$id_distrito.", nosesion=".$nosesion.",desc_sesion = '".$descsesion."',tipo_sesion = ".$tiposesion.", fecha_inicio_prog = '".$fechainicioprog."', hora_inicio_prog = '".$horainicioprog."', distritos_sesiones= '".$replace_array."' where id_sesion=$id_sesion;";

//echo $update;
$update=(string)$update;
$update=str_replace("\n","",$update);
$update=str_replace("\r","",$update);
		if(sqlsrv_query($conn, $update)){
			echo'<p>&nbsp;</p>';
			echo '<div align="center">';
			echo'<table width="166" border="0" cellpadding="0" cellspacing="0">';
  			echo "<tr>";
    		echo '<td width="156" align="center"><img src="images/ajax-loader.gif" width="160" height="24" /></td>';
  			echo "</tr>";
			echo  "<tr>";
    		echo '<td align="center">ACTUALIZANDO</td>';
  			echo "</tr>";
			echo "</table>";
			echo '</div>';
				echo'	<SCRIPT LANGUAGE="javascript">';
				echo' 	alert("La sesión se actualizó exitosamente")';
				echo'	</SCRIPT>';
				echo'<SCRIPT LANGUAGE="javascript">';
				echo'history.go(-1)';
				echo'	</SCRIPT>';
			}else{
				//ifx_errormsg();
			sqlsrv_error();
			}

	}
	//ifx_close($conn);
	sqlsrv_close($conn);


?>
</body>
