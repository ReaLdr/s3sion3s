<?php
session_start();
 
$grup=$_SESSION['k_grupo'];

include("conector.php");

$iclave= $_POST["clave"];
$iclave2= $_POST["clave2"];
$iclave3= $_POST["clave3"];
$sClave = $iclave.'-'.$iclave2.'-'.$iclave3;
$sActividad = $_POST["actividad"];
$stipo = $_POST["tipo"];
$sdocto=$_POST["docto"];
$fechaini= $_POST["fecha1a"];
$fechafin= $_POST["fecha2a"];
$resp=$_POST["respo"];

$fecha_alta= date("d-m-Y");



if ($sClave==0|$sActividad==NULL|$stipo==NULL|$sdocto==NULL|$resp==NULL|$fechaini==NULL|$fechafin==NULL)
{
	echo'	<SCRIPT LANGUAGE="javascript">';
		echo' 	alert("Por favor llene todos los campos '.$resp.'.")';
		echo'	</SCRIPT>';	
				

		echo'    <SCRIPT LANGUAGE="javascript">';
		echo'	  history.back ()';
		echo'	</SCRIPT>';
}
else
{


	$query="INSERT INTO sisecao_catactividad 	(clave,actividad,periodoinicia,periodofin,tipo_actividad,soporte,responsable,fecha_alta,usr_alta, status) VALUES ('$sClave','$sActividad','$fechaini','$fechafin','$stipo','$sdocto','$resp','$fecha_alta',$grup,1)";

		//echo $query;
		ifx_query($query, $id_con);
		ifx_errormsg();
		
		
		/*$insert2="INSERT INTO sisecao_actividades_trabajo (id_actividad,realizo,fecha_alta,usr_alta, status) VALUES ('$sClave','NO','$fecha_alta',$grup,1)";
	
			ifx_query($insert2, $id_con);
			ifx_errormsg();*/
		
	
		
		ifx_close($id_con);
					
			echo'	<SCRIPT LANGUAGE="javascript">';
					echo' 	alert("El Registro se Ingreso Exitosamente")';
					echo'	</SCRIPT>';
					
					echo'<SCRIPT LANGUAGE="javascript">';
					echo'history.go(-1)
					history.back ()';
					//echo 'parent.jQuery.fancybox.close();';			
					//echo' location.href = "admin.php";';
					echo'	</SCRIPT>';

}	
	

?>