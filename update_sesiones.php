<?php
session_start();
$id_distrito=$_SESSION[id_distrito];
include 'config_open_db.php';
if (isset($_SESSION['k_username'])) {
	
}
else
{
echo' 	alert("Debe iniciar una sesion")';	
	echo'<SCRIPT LANGUAGE="javascript">';
	echo'	location.href = "index.php";';
	echo'	</SCRIPT>';
}

echo'<p>&nbsp;</p>';
echo '<div align="center">';
echo'<table width="166" border="0" cellpadding="0" cellspacing="0">
  <tr>
    <td width="156" align="center"><img src="images/ajax-loader.gif" width="160" height="24" /></td>
  </tr>
  <tr>
    <td align="center">ACTUALIZANDO</td>
  </tr>
</table>';




/////////////////////////////////////
$nosesion=$_POST[nosesion];
$descsesion=$_POST[descsesion];
$tiposesion=$_POST[tiposesion];
$fechainicioprog=$_POST[fechainicioprog];
$horainicioprog=$_POST[horainicioprog];
$id_distrito=$_POST[iddistrito];
$idsesion=$_POST[idsesion];

//echo $nombre_partido;
/*if($id_partido=='')
{
$id_partido=0;
}
	
$tipo_propaganda= $_POST["tipo_propaganda"];
if($tipopropaganda=='')
{
$tipopropaganda='-';
}
$medidas= $_POST["medidas"];
if($medidas=='')
{
$medidas='-';
}
$cantidad= $_POST["cantidad"];
if($cantidad=='')
{
$cantidad='-';
}

$contenido = $_POST["contenido"];
if($contenido=='')
{
$contenido='-';
}
$contenido=(string)$contenido;
$contenido = str_replace("'",'"',$contenido);

$domicilio = $_POST["domicilio"];
if($domicilio=='')
{
$domicilio='-';
}
$domicilio=(string)$domicilio;
$domicilio = str_replace("'",'"',$domicilio);
$partido = $_POST["partido"];
if($partido=='')
{
$partido=0;
}
$precandidato=$_POST["precandidato"];
if($precandidato=='')
{
$precandidato=0;
}
$servidor= $_POST["servidor"];
if($servidor=='')
{
$servidor=0;
}
$ciudadano= $_POST["ciudadano"];
if($ciudadano=='')
{
$ciudadano=0;
}


$rep_popular=$_POST["rep_popular"];
if($rep_popular=='')
{
$rep_popular=0;
}


$emblema=$_POST["emblema"];
if($emblema=='')
{
$emblema=0;
}
$emblema_no=$_POST["emblema_no"];
if($emblema_no=='')
{
$emblema_no=0;
}


$imagen=$_POST["imagen"];
if($imagen=='')
{
$imagen=0;
}
$imagen_no=$_POST["imagen_no"];
if($imagen_no=='')
{
$imagen_no=0;
}
$nom_persona=$_POST["nom_persona"];
//echo $nom_persona;


if($nom_persona=='')
{
$nom_persona='-';
}

$fecha_visto=$_POST["fecha_visto"];
if($fecha_visto=='')
{
$fecha_visto='-';
}

$hora_visto=$_POST["hora_visto"];
if($hora_visto=='')
{
$hora_visto='-';
}

$palabras=$_POST["palabras"];

//$textotro=$_POST["textotro"];

//echo $textotro;


$fecha_modif=date('Y-m-d');

///////////////////////////
// no le muevas nancy
$textotro=$_POST["textotro"];
if($textotro!='')
{
/*$insert_nueva="INSERT INTO rec_cat_palabras(id_palabra,palabra,fecha_alta,estatus) VALUES(0,'$textotro',current,1)";
//echo $insert_nueva;
ifx_query($insert_nueva, $id_con);*/
/*$palabra_insert=$textotro;

$palabra_insert.="-";
$palabra_insert.=$palabra_concat;

}
else
{
$palabra_insert=$palabra_concat;
}

//inserta  $palabra_insert;  / /
///////////////////////////////
// no le muevas nancy


*/


$update="UPDATE sesiones set iddistrito = ".$id_distrito.", nosesion=".$nosesion.",descsesion = '".$descsesion."', tiposesion = ".$tiposesion.", fechainicioprog = '".$fechainicioprog."', horainicioprog = '".$horainicioprog."' where idsesion=$idsesion;";
//echo $update;
$update=(string)$update;
$update=str_replace("\n","",$update);	
$update=str_replace("\r","",$update);
					if(ifx_query($update, $conn))
					{
					echo'	<SCRIPT LANGUAGE="javascript">';
					
					echo' 	alert("La Sesion se actualizo Exitosamente")';
					
					echo'	</SCRIPT>';
					echo'<SCRIPT LANGUAGE="javascript">';
					echo'history.go(-1)
					history.back ()';
					echo'	</SCRIPT>';
					}
					else
					{
					ifx_errormsg();
					}
					ifx_close($conn);	
?>