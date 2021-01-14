<?php
session_start();
$usr= $_SESSION['k_idUser'];
$id_distrito=$_SESSION[k_idDistrito];
include("conector.php");
$sclave=$_POST["idcatalogo"];
$idactividad = $_POST["idact"];
$srealizo= $_POST["r_realizo"];
$stipo= $_POST["tipo"];
$snumero= $_POST["numero"];
$sDescripcion=utf8_decode($_POST["observacion"]);
$sDescripcion=str_replace("'",'"',$sDescripcion);
$fcumplio= $_POST["fechacump"];
$fecha_modif= date("d/m/Y");
$fecha_alta= date("d/m/Y");

if ($srealizo==NULL|$snumero==NULL|$sDescripcion==NULL|$fcumplio==NULL|$stipo==NULL)
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

/////////////////////////////////////////////////////////
//aqui hiba el update anterior, se cambia por un insert//
/////////////////////////////////////////////////////////

//////////////////////////////////////////////////////////////////////////////////////////////////////////////
//$query_update="UPDATE sisecao_actividades SET realizo='$srealizo', tipo='$stipo',							//	 id_actividad='$sclave',num_oficio='$snumero',fecha_cumplio='$fcumplio',										// descripcion='$sDescripcion',fecha_modif='$fecha_modif',usr_modif=$usr, status=1 WHERE id_mov=$idactividad"; //
//////////////////////////////////////////////////////////////////////////////////////////////////////////////
//$sql_inserta="UPDATE sisecao_actividades_trabajo SET realizo='$srealizo', tipo='$stipo', id_actividad='$sclave',num_oficio='$snumero',fecha_cumplio='$fcumplio', descripcion='$sDescripcion',fecha_modif='$fecha_modif',usr_modif=$usr, status=1 WHERE id_mov=$idactividad"; 


			/*
			SI ES CERO
			*/
			$sql_count="select count(clave) as cuantos from sisecao_actividades_trabajo  where clave = '$sclave' AND iddistrito = $id_distrito; ";
//echo $sql_count;

$result_count=ifx_query($sql_count,$id_con);
$row_count= ifx_fetch_row ($result_count);

$cuantos_reg = $row_count[cuantos];
			//echo "cuantos_reg:";
			//echo $cuantos_reg;
			if($cuantos_reg==0)
			{
			
			$sql_inserta = "INSERT INTO sisecao_actividades_trabajo(id_mov,clave,iddistrito,tipo,num_oficio,descripcion,realizo,fecha_cumplio,fecha_alta,usr_alta,status) VALUES (0,'$sclave',$id_distrito,'$stipo','$snumero','$sDescripcion','$srealizo','$fcumplio','$fecha_alta',$usr,1)";
			
					//echo $sql_inserta;
					ifx_query($sql_inserta, $id_con);
					ifx_errormsg();
					//*ifx_close($id_con);
					
					echo'	<SCRIPT LANGUAGE="javascript">';
					echo' 	alert("El Registro se Guardo Exitosamente")';
					echo'	</SCRIPT>';
					
					echo'<SCRIPT LANGUAGE="javascript">';
					echo'history.go(-1)
					history.back ()';
					//echo 'parent.jQuery.fancybox.close();';			
					//echo' location.href = "admin.php";';
					echo'	</SCRIPT>';
			}
			/*
			FIN SI ES CERO
			*/
			else
			{
			/*
			SI YA TINENE UPDATE
			*/
			
			$sql_update="UPDATE sisecao_actividades_trabajo SET tipo='$stipo',num_oficio='$snumero', descripcion='$sDescripcion', realizo='$srealizo',fecha_cumplio='$fcumplio',fecha_modif='$fecha_modif' WHERE clave='$sclave' AND iddistrito =$id_distrito;";
			
		//	echo $sql_update;
			ifx_query($sql_update, $id_con);
					ifx_errormsg();
					
					echo'	<SCRIPT LANGUAGE="javascript">';
					echo' 	alert("El Registro se Actualizó Exitosamente")';
					echo'	</SCRIPT>';
					
					echo'<SCRIPT LANGUAGE="javascript">';
					echo'history.go(-1)
					history.back ()';
					//echo 'parent.jQuery.fancybox.close();';			
					//echo' location.href = "admin.php";';
					echo'	</SCRIPT>';
					//ifx_close($id_con); //
			}
			
			ifx_close($id_con); //
}

?>