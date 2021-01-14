<?php
session_start();
$usr= $_SESSION['k_idUser'];

include("conector.php");


$id=$_POST["idactividad"];
$iclave= $_POST["clave"];
$iclave2= $_POST["clave2"];
$iclave3= $_POST["clave3"];
$sClave = $iclave.'-'.$iclave2.'-'.$iclave3;
$sActividad =utf8_decode($_POST["actividad"]);
$stipo = $_POST["tipo"];
$fechaini= $_POST["fecha1a"];
$fechafin= $_POST["fecha2a"];
$fecha_modif= date("d/m/Y");


if ($sClave==0|$sActividad==NULL|$stipo==NULL|$fechaini==NULL|$fechafin==NULL)

{
		echo'	<SCRIPT LANGUAGE="javascript">';
		echo' 	alert("Por favor llene todos los campos.")';
		echo'	</SCRIPT>';	
				

		echo'    <SCRIPT LANGUAGE="javascript">';
		echo'	  history.back ()';
		echo'	</SCRIPT>';
}
else
{

$query="UPDATE sisecao_catactividad SET clave = '$sClave', actividad='$sActividad',periodoinicia='$fechaini',periodofin='$fechafin'
,tipo_actividad='$stipo',fecha_modifica='$fecha_modif', usr_modif=$usr, status=1 WHERE id_actividad=$id"; 



		ifx_query($query, $id_con);
		ifx_errormsg();
		ifx_close($id_con);
					
					echo'	<SCRIPT LANGUAGE="javascript">';
					echo' 	alert("El Registro se Actualizo Exitosamente")';
					echo'	</SCRIPT>';
					
					echo'<SCRIPT LANGUAGE="javascript">';
					echo'history.go(-1)
					history.back ()';
					//echo 'parent.jQuery.fancybox.close();';			
					//echo' location.href = "admin.php";';
					echo'	</SCRIPT>';

}

?>