<?php
error_reporting(E_ERROR | E_PARSE); 
session_start();
//$id_distrito="0";
if (isset($_SESSION['user'])) 
{

$name= $_SESSION['transaccion'];
$grup=$_SESSION['grupo'];
$id_distrito=$_SESSION['id_distrito'];	
	
}
else{
	echo '<b>PARA ACCEDER A ESTA OPCI&Oacute;N DEBE DE LOGUEARSE</b>.';
	return;
}

$variable= $_REQUEST["page"];

//-------------------- 12/01/2021 Variable para imprimir partido ELEGIR AL ULTIMO
	$integra18 = "";

//echo $id_distrito;

include('arreglos.php');
$nosesion=$_GET['nosesion'];
$id_sesion=$_GET['id_sesion'];
//$tipo_sesion=$_GET['tipo_sesion'];

?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<!--<link href="style.css" rel="stylesheet" type="text/css" />-->
<script type="text/javascript" src="js/jquery-1.4.3.min.js"></script>
<link href="css/animate.css" rel="stylesheet" type="text/css" />
<link href="css/stilacho.css" rel="stylesheet" type="text/css" />

<!--<script src="js/jquery-3.2.1.min.js"></script>-->
<script src="js/bootstrap.min.js"></script>
<link rel="stylesheet" href="css/bootstrap.min.css">
<link rel="stylesheet" href="css/jquery-ui.css">

<title>.: SISESECD 2018 :.</title>
<script>
function validar_texto(a) { 
    tecl = (document.all) ? a.keyCode : a.which; 
    if (tecl==8) return true; 
	patro =/[a-z A-Z áéíóúäëïöü0ñÑ\-\?\@\()\;\+&%\$#_]/;
    t = String.fromCharCode(tecl); 
    return patro.test(t); 
} 
	
	
	function escondeNuevo()
			 
{
	//alert("Espere un momento");
    frmClienteNuevo.button.style.visibility = "hidden";// para formuario nuevo
	mensaje = document.getElementById('errorMsg');
	mensaje.style.display='block';
	
}
	
	function escondeActualiza()
	{
		
	frmClienteActualizar.button.style.visibility= "hidden";
	mensaje = document.getElementById('errorMsg');
	mensaje.style.display='block';
	}
	
</script>

<style>
input[type="text"]{
		width:100%;
		margin-left: 2px;

}

</style>
</head>



<body>

<?php include('header.php')?>
	
<h1 class="mt-4"><img src="images/logo-header.png"></h1>
<!--tabla para todos las pantallas -->
<div class="top-menu">
<table border="0" style="width: 90%;">
  <tr>
    <td width="339" height="25" align="left" class="well" >Usuario: <?php echo $name; ?></td>
    <td width="453" align="left" class="well" >Consejo Distrital: <?php echo $id_distrito; ?></td>
    <td width="286" align="right" ><?php echo "<a class='btn btn-primary' href='javascript:history.back(-1)'>Menu Principal </a>" ?></td>
    <td width="307" align="right" ><a class='btn btn-default'  href="logout.php"><p class="titulo">Cerrar Sesión</p></a></td>
  </tr>
</table>
</div>
<?php

//echo "GET PAGE: ".$variable."...";
//echo "GET ID ".$_REQUEST['idsesion']."...";
$id_sesion = htmlspecialchars(trim($_REQUEST['id_sesion']));
$movimiento = htmlspecialchars(trim($_POST['movimiento']));

// Consigo datos a desplegar solo de muestra
$encabezado = "-ERROR DE LECTURA-";

//require('functions.php');

include 'config_open_db.php';
include 'arreglos.php';

$distrito=$d_romano[$_SESSION['id_distrito']];
$nosesion=$_REQUEST['nosesion'];
$tipo_sesion=$_REQUEST['tipo_sesion'];
$id_sesion=$_REQUEST['id_sesion'];
$desc_sesion=$_REQUEST['desc_sesion'];

		

		

if(isset($_REQUEST['id_sesion']))
{	
	$tmpSesion="Select * from sisesecd_sesiones where id_sesion=".$_REQUEST['id_sesion'];
	$consultaSesion = sqlsrv_query($conn,$tmpSesion);
	//echo $tmpSesion;
	
		$registro = sqlsrv_fetch_array($consultaSesion);
	
		$descripcion=$registro[desc_sesion];
		$nosesion=$registro[nosesion];
		$types=$registro[tipo_sesion];
	
	
	
		//$encabezado = "<b>".$nom_sesion[$nosesion]." Sesión de los Consejos Distritales".$types."0".$descripcion."</b>";
	$encabezado = "<b> De los Consejos Distritales".$types."0".$descripcion."</b>";
	
	
	$sql_count="Select count(*) as cuantos from sisesecd_sesiones where id_sesion=".$_REQUEST['id_sesion'];		
	$exec_count = sqlsrv_query($conn, $sql_count);
	$row_count1 = sqlsrv_fetch_array($exec_count);
	
	$cuantos1=$row_count1[cuantos];
	
	if ($cuantos1>0){
		// Aqui consigo datos a desplegar 

			
		//$encabezado = "<b>".$nom_sesion[$nosesion]." Sesión de los Consejos Distritales".$types."0".$descripcion."</b>";
		$encabezado = "<b> De los Consejos Distritales ".$tipo_ses[$types]." 0".$descripcion."</b>";
	

	}
	else{
		echo 'Se produjo un error. No se encontraron datos de la Sesion Distrital:  '.sqlsrv_errors();
		return;
	} 
}

if(isset($_POST['submit'])){
	
//	echo "entro al submit";
	
	$id_integra[1]=$_POST['id_integra1'];
	$id_funcionario[1]=$_POST['id_func1'];

	
	$nombre[1]=$_POST['txt_nombreCP'];
	$paterno[1]=$_POST['txt_paternoCP'];
	$materno[1]=$_POST['txt_maternoCP']; 
	$chek[1]='CP';
	
	$id_integra[2]=$_POST['id_integra2'];
	$id_funcionario[2]=$_POST['id_func2'];
	$nombre[2]=$_POST['txt_nombreSC'];
	$paterno[2]=$_POST['txt_paternoSC'];
	$materno[2]=$_POST['txt_maternoSC'];
	$chek[2]='SC';

	$id_integra[3]=$_POST['id_integra3'];
	$id_funcionario[3]=$_POST['id_func3'];
	$nombre[3]=$_POST['txt_nombreC1'];
	$paterno[3]=$_POST['txt_paternoC1'];
	$materno[3]=$_POST['txt_maternoC1'];
	$chek[3]='C1';
	
	$id_integra[4] = $_POST['id_integra4'];
	$id_funcionario[4]=$_POST['id_func4'];
	$nombre[4] =$_POST['txt_nombreC2'];
	$paterno[4] =$_POST['txt_paternoC2'];
	$materno[4] =$_POST['txt_maternoC2'];
	$chek[4] ='C2';
	
	$id_integra[5] = $_POST['id_integra5'];
	$id_funcionario[5]=$_POST['id_func5'];
	$nombre[5] =$_POST['txt_nombreC3'];
	$paterno[5] =$_POST['txt_paternoC3'];
	$materno[5] =$_POST['txt_maternoC3'];
	$chek[5] ='C3';
	
	$id_integra[6] = $_POST['id_integra6'];
	$id_funcionario[6]=$_POST['id_func6'];
	$nombre[6] =$_POST['txt_nombreC4'];
	$paterno[6] =$_POST['txt_paternoC4'];
	$materno[6] =$_POST['txt_maternoC4'];
	$chek[6]='C4';
	
	$id_integra[7] = $_POST['id_integra7'];
	$id_funcionario[7]=$_POST['id_func7'];
	$nombre[7] =$_POST['txt_nombreC5'];
	$paterno[7] =$_POST['txt_paternoC5'];
	$materno[7] =$_POST['txt_maternoC5'];
	$chek[7] ='C5';
	
	$id_integra[8] = $_POST['id_integra8'];
	$id_funcionario[8]=$_POST['id_func8'];
	$nombre[8] =$_POST['txt_nombreC6'];
	$paterno[8] =$_POST['txt_paternoC6'];
	$materno[8] =$_POST['txt_maternoC6'];
	$chek[8]='C6';
	
////////////////TABLA 2 PARTIDOS POLITICOS//////////////////	
	
	$id_integra[9] = $_POST['id_integra11'];
	$id_funcionario[9]=$_POST['id_func11P'];
	$nombre[9] =$_POST['txt_nombrePAN-P'];
	$paterno[9] =$_POST['txt_paternoPAN-P']; 
	$materno[9]=$_POST['txt_maternoPAN-P'];
	$chek[9]='P'; 
	
	$id_integra[10] = $_POST['id_integra11'];
	$id_funcionario[10]=$_POST['id_func11S'];
	$nombre[10] =$_POST['txt_nombrePAN-S'];
	$paterno[10] =$_POST['txt_paternoPAN-S']; 
	$materno[10]=$_POST['txt_maternoPAN-S']; 
	$chek[10]='S';
	
	$id_integra[11] = $_POST['id_integra12'];
	$id_funcionario[11]=$_POST['id_func12P'];
	$nombre[11] =$_POST['txt_nombrePRI-P'];
	$paterno[11] =$_POST['txt_paternoPRI-P']; 
	$materno[11]=$_POST['txt_maternoPRI-P'];
	$chek[11] ='P'; 
	
	$id_integra[12] = $_POST['id_integra12'];
	$id_funcionario[12]=$_POST['id_func12S'];
	$nombre[12] =$_POST['txt_nombrePRI-S'];
	$paterno[12] =$_POST['txt_paternoPRI-S']; 
	$materno[12]=$_POST['txt_maternoPRI-S']; 
	$chek[12]='S';
	
	$id_integra[13] = $_POST['id_integra13'];
	$id_funcionario[13]=$_POST['id_func13P'];
	$nombre[13] =$_POST['txt_nombrePRD-P'];
	$paterno[13] =$_POST['txt_paternoPRD-P']; 
	$materno[13]=$_POST['txt_maternoPRD-P'];
	$chek[13]='P'; 
	
	$id_integra[14] = $_POST['id_integra13'];
	$id_funcionario[14]=$_POST['id_func13S'];
	$nombre[14] =$_POST['txt_nombrePRD-S'];
	$paterno[14] =$_POST['txt_paternoPRD-S']; 
	$materno[14]=$_POST['txt_maternoPRD-S']; 
	$chek[14]='S';
	
	$id_integra[15] = $_POST['id_integra14'];
	$id_funcionario[15]=$_POST['id_func14P'];
	$nombre[15] =$_POST['txt_nombrePVEM-P'];
	$paterno[15] =$_POST['txt_paternoPVEM-P']; 
	$materno[15]=$_POST['txt_maternoPVEM-P'];
	$chek[15]='P'; 
	
	$id_integra[16] = $_POST['id_integra14'];
	$id_funcionario[16]=$_POST['id_func14S'];
	$nombre[16] =$_POST['txt_nombrePVEM-S'];
	$paterno[16] =$_POST['txt_paternoPVEM-S']; 
	$materno[16]=$_POST['txt_maternoPVEM-S']; 
	$chek[16]='S';
	
	$id_integra[17]=$_POST['id_integra15'];
	$id_funcionario[17]=$_POST['id_func15P'];
	$nombre[17]=$_POST['txt_nombrePT-P'];
	$paterno[17]=$_POST['txt_paternoPT-P']; 
	$materno[17]=$_POST['txt_maternoPT-P'];
	$chek[17]='P'; 
	
	$id_integra[18]=$_POST['id_integra15'];
	$id_funcionario[18]=$_POST['id_func15S'];
	$nombre[18]=$_POST['txt_nombrePT-S'];
	$paterno[18] =$_POST['txt_paternoPT-S']; 
	$materno[18]=$_POST['txt_maternoPT-S']; 
	$chek[18]='S';
	
	$id_integra[19]=$_POST['id_integra16'];
	$id_funcionario[19]=$_POST['id_func16P'];
	$nombre[19] =$_POST['txt_nombrePMC-P'];
	$paterno[19] =$_POST['txt_paternoPMC-P']; 
	$materno[19]=$_POST['txt_maternoPMC-P'];
	$chek[19]='P'; 
	
	$id_integra[20]=$_POST['id_integra16'];
	$id_funcionario[20]=$_POST['id_func16S'];
	$nombre[20] =$_POST['txt_nombrePMC-S'];
	$paterno[20] =$_POST['txt_paternoPMC-S']; 
	$materno[20]=$_POST['txt_maternoPMC-S']; 
	$chek[20]='S';
	
	$id_integra[21]=$_POST['id_integra17']; /// 
	$id_funcionario[21]=$_POST['id_func17P'];
	$nombre[21] =$_POST['txt_nombreMOR-P'];
	$paterno[21] =$_POST['txt_paternoMOR-P']; 
	$materno[21]=$_POST['txt_maternoMOR-P'];
	$chek[21]='P'; 
	
	$id_integra[22]=$_POST['id_integra17']; /// 
	$id_funcionario[22]=$_POST['id_func17S'];
	$nombre[22] =$_POST['txt_nombreMOR-S'];
	$paterno[22] =$_POST['txt_paternoMOR-S']; 
	$materno[22]=$_POST['txt_maternoMOR-S']; 
	$chek[22]='S';
	
	$id_integra[23]=$_POST['id_integra18']; /// GENERO Y LIBERTAD
	$id_funcionario[23]=$_POST['id_func18P'];
	$nombre[23] =$_POST['txt_nombrePNA-P'];
	$paterno[23] =$_POST['txt_paternoPNA-P']; 
	$materno[23]=$_POST['txt_maternoPNA-P'];
	$chek[23]='P'; 
	
	$id_integra[24]=$_POST['id_integra18'];
	$id_funcionario[24]=$_POST['id_func18S'];
	$nombre[24] =$_POST['txt_nombrePNA-S'];
	$paterno[24] =$_POST['txt_paternoPNA-S']; 
	$materno[24]=$_POST['txt_maternoPNA-S']; 
	$chek[24]='S';
	
	$id_integra[25]=$_POST['id_integra19']; /// 
	$id_funcionario[25]=$_POST['id_func19P'];
	$nombre[25] =$_POST['txt_nombrePES-P'];
	$paterno[25] =$_POST['txt_paternoPES-P']; 
	$materno[25]=$_POST['txt_maternoPES-P'];
	$chek[25]='P'; 
	
	$id_integra[26]=$_POST['id_integra19']; // 
	$id_funcionario[26]=$_POST['id_func19S'];
	$nombre[26] =$_POST['txt_nombrePES-S'];
	$paterno[26] =$_POST['txt_paternoPES-S']; 
	$materno[26]=$_POST['txt_maternoPES-S']; 
	$chek[26]='S';
	
	$id_integra[27]=$_POST['id_integra20']; /// PARTIDO PROGRESISTA
	$id_funcionario[27]=$_POST['id_func20P'];
	$nombre[27]=$_POST['txt_nombrePH-P'];
	$paterno[27]=$_POST['txt_paternoPH-P']; 
	$materno[27]=$_POST['txt_maternoPH-P'];
	$chek[27]='P'; 

	$id_integra[28]=$_POST['id_integra20'];
	$id_funcionario[28]=$_POST['id_func20S'];
	$nombre[28]=$_POST['txt_nombrePH-S'];
	$paterno[28]=$_POST['txt_paternoPH-S']; 
	$materno[28]=$_POST['txt_maternoPH-S']; 
	$chek[28]='S';
	
	///// nuevo partido PFSM ////
	
	$id_integra[29]=$_POST['id_integra21'];  // FUERZA SOCIAL
	$id_funcionario[29]=$_POST['id_func21P'];
	$nombre[29]=$_POST['txt_nombrePFSM-P'];
	$paterno[29]=$_POST['txt_paternoPFSM-P']; 
	$materno[29]=$_POST['txt_maternoPFSM-P'];
	$chek[29]='P'; 

	$id_integra[30]=$_POST['id_integra21'];
	$id_funcionario[30]=$_POST['id_func21S'];
	$nombre[30]=$_POST['txt_nombrePFSM-S'];
	$paterno[30]=$_POST['txt_paternoPFSM-S']; 
	$materno[30]=$_POST['txt_maternoPFSM-S']; 
	$chek[30]='S';
	
	
	
/////// CANDIDADATOS INDEPENDIENTES////31
	$id_integra[31]=$_POST['id_integra31'];
	$id_funcionario[31]=$_POST['id_func31P'];
	$nombre[31]=$_POST['txt_nombreCI1-P'];
	$paterno[31]=$_POST['txt_paternoCI1-P']; 
	$materno[31]=$_POST['txt_maternoCI1-P'];
	$chek[31]='P'; 
	
	//echo "cheketIndependiente P : ".$chek[29];
	
	$id_integra[32]=$_POST['id_integra31'];
	$id_funcionario[32]=$_POST['id_func31S'];
	$nombre[32]=$_POST['txt_nombreCI1-S'];
	$paterno[32]=$_POST['txt_paternoCI1-S']; 
	$materno[32]=$_POST['txt_maternoCI1-S']; 
	$chek[32]='S';
	
	//echo "cheketIndependiente S : ".$chek[30];
	
	$id_integra[33] = $_POST['id_integra32'];
	$id_funcionario[33]=$_POST['id_func32P'];
	$nombre[33] =$_POST['txt_nombreCI2-P'];
	$paterno[33] =$_POST['txt_paternoCI2-P']; 
	$materno[33]=$_POST['txt_maternoCI2-P'];
	$candidato[33]=$_POST["txt_namecandidatoDMR"];
	$puesto[33]=$_POST["txt_puestocandidatoDMR"];
	$chek[33]='P'; 
	
	$id_integra[34] = $_POST['id_integra32'];
	$id_funcionario[34]=$_POST['id_func32S'];
	$nombre[34] =$_POST['txt_nombreCI2-S'];
	$paterno[34] =$_POST['txt_paternoCI2-S']; 
	$materno[34]=$_POST['txt_maternoCI2-S']; 
	$chek[34]='S';
	
	$id_integra[35] = $_POST['id_integra33'];
	$id_funcionario[35]=$_POST['id_func33P'];
	$nombre[35] =$_POST['txt_nombreCI3-P'];
	$paterno[35] =$_POST['txt_paternoCI3-P']; 
	$materno[35]=$_POST['txt_maternoCI3-P'];
	$candidato[35]=$_POST["txt_namecandidatoALCALDE"];
	$puesto[35]=$_POST["txt_puestocandidatoALCALDE"];
	$chek[35]='P'; 
	
	$id_integra[36] = $_POST['id_integra33'];
	$id_funcionario[36]=$_POST['id_func33S'];
	$nombre[36]=$_POST['txt_nombreCI3-S'];
	$paterno[36]=$_POST['txt_paternoCI3-S']; 
	$materno[36]=$_POST['txt_maternoCI3-S']; 
	$chek[36]='S';
	
	$id_integra[37] = $_POST['id_integra34'];
	$id_funcionario[37]=$_POST['id_func34P'];
	$nombre[37] =$_POST['txt_nombreCI4-P'];
	$paterno[37] =$_POST['txt_paternoCI4-P']; 
	$materno[37]=$_POST['txt_maternoCI4-P'];
	$chek[37]='P'; 
	
	$id_integra[38] = $_POST['id_integra34'];
	$id_funcionario[38]=$_POST['id_func34S'];
	$nombre[38]=$_POST['txt_nombreCI4-S'];
	$paterno[38]=$_POST['txt_paternoCI4-S']; 
	$materno[38]=$_POST['txt_maternoCI4-S']; 
	$chek[38]='S';
	
	$fecha_alta=date('d-m-Y');
	$fecha_modif=date('d-m-Y');
	
		
	$movimiento=$_POST['movimiento']; 
	$tmpSQL="";
	$i=0;
	
	
	echo"tipo". $movimiento;
	
	if($movimiento=="EDITAR")
	{
			for($i=1;$i<=38;$i++)
				{	
				
$tmpSQL="UPDATE sisesecd_catfuncionarios_central SET id_distrito=$id_distrito, id_integrante =$id_integra[$i], nombre='$nombre[$i]', ap_paterno='$paterno[$i]', ap_materno='$materno[$i]', tipo_acredor ='$chek[$i]', fecha_modif='$fecha_modif', candidato='$candidato[$i]', puesto='$puesto[$i]' WHERE id_distrito=$id_distrito and id_integrante=$id_integra[$i]  and tipo_acredor='$chek[$i]';";
				
	 sqlsrv_query($conn, $tmpSQL);
					
$tmpSQLfun="UPDATE sisesecd_cat_funcionarios SET id_sesion= $id_sesion, id_distrito=$id_distrito, id_integrante =$id_integra[$i], nombre='$nombre[$i]', ap_paterno='$paterno[$i]', ap_materno='$materno[$i]', tipo_acredor ='$chek[$i]', fecha_modif='$fecha_modif',candidato='$candidato[$i]', puesto='$puesto[$i]' WHERE id_funcionario =$id_funcionario[$i] and id_integrante=$id_integra[$i] and id_sesion = $id_sesion and id_distrito=$id_distrito;";
				
			sqlsrv_query($conn, $tmpSQLfun);
					
				
					if ($i==38)
					{
					echo'<SCRIPT LANGUAGE="javascript">';
					echo' alert("Los Integrantes se Actualizaron Exitosamente")';
					echo'</SCRIPT>';
	
					echo'<SCRIPT LANGUAGE="javascript">';
					echo'location.href = "./grid_sesiones.php?desc_sesion='.$desc_sesion.'&nosesion='.$nosesion.'&tipo_sesion='.$tipo_sesion.'";';
					echo'	</SCRIPT>';
					}
			}// cierra for de update
	}
	else
	{

		for($i=1; $i<=38; $i++)
			{


			
$inserto2="INSERT INTO sisesecd_cat_funcionarios( id_sesion, id_distrito, id_integrante,nombre, ap_paterno,ap_materno, tipo_acredor,estatus,fecha_alta) values 
($id_sesion, $id_distrito,$id_integra[$i],'$nombre[$i]','$paterno[$i]','$materno[$i]','$chek[$i]',1,'$fecha_alta');";
			//echo $inserto2;
			//exit;

				sqlsrv_query($conn, $inserto2);
			
			/*$tmpSQL="INSERT INTO sisesecd_catfuncionarios_central( id_distrito, id_integrante,nombre, ap_paterno,ap_materno, tipo_acredor,estatus,fecha_alta) values ($id_distrito,$id_integra[$i],'$nombre[$i]','$paterno[$i]','$materno[$i]','$chek[$i]',1,'$fecha_alta');";
	
				sqlsrv_query($conn, $tmpSQL);*/

			//exit;
	
					if ($i==38)
					{
					echo'<SCRIPT LANGUAGE="javascript">';
					echo' alert("Los Integrantes se Guardaron Exitosamente")';
					echo'</SCRIPT>';
	
					echo'<SCRIPT LANGUAGE="javascript">';
					echo'location.href = "./grid_sesiones.php?desc_sesion='.$desc_sesion.'&nosesion='.$nosesion.'&tipo_sesion='.$tipo_sesion.'";';
					echo'	</SCRIPT>';
					}
					
			}// cierra for de insert
		
	}//cierra if movimiento
	
 }// cierra if de submit POST
else
{
	
$consulta ="";
$cliente ="";

	if(isset($id_sesion)){
		
	$sql_count2="SELECT count(*) as cuantos2 FROM sisesecd_cat_funcionarios WHERE id_sesion =$_REQUEST[id_sesion] "; /// CAMBIO A TABLA CAT_FUNCIONARIOS_CENTRAL
		//echo $sql_count2;
		
		$exec_count2 = sqlsrv_query($conn, $sql_count2);
		$row_count2 = sqlsrv_fetch_array($exec_count2);
		$cuantos2=0;
		$cuantos2=$row_count2[cuantos2];
		
	}
	if($cuantos2>0)
	{
		// ES ACUALIZACION
?>
</br> 
	</br> 
<center>
		<div class="card mb-4">
	<div class="card-header">
     <b>Actualiza Integración del Consejo Distrital<br> <?php echo $encabezado; ?></b>
	
    </div>
			</br>
			
	<form id="frmClienteActualizar" name="frmClienteActualizar" method="post" onSubmit="return escondeActualiza();">
	<input type="hidden" name="movimiento" id="movimiento" value="EDITAR" />
    <input type="hidden" name="id_sesion" id="id_sesion" value="<?php  echo $_REQUEST['id_sesion']; ?>" />

  <input class="text" type="hidden" name="id_distrito" id="id_distrito" value="<?php  echo $_SESSION['id_distrito']; ?>"/>
   <input class="text" type="hidden" name="id_funcionario" id="id_funcionario" value="<?php  echo $row['id_funcionario']; ?>"/>

  </p>

  </p>
  <table width="90%" height="60" border="0">
<tr bgcolor="#CCCCFF">
    <td width="26%" rowspan="2" align="center"><strong>Integracion del Consejo Distrital</strong></td>
    <td colspan="3" align="center"><strong>Nombres de los integrantes del Consejo Distrital</strong></td>
    <td width="16%" rowspan="2" align="center"><strong>Tipo de acreditacion</strong></td>

</tr>
<tr bgcolor="#CCCCFF">
    <td class="subtitulo">Nombre (s)</td>  
    <td width="22%" class="subtitulo">Apellido Paterno</td>
    <td width="21%" class="subtitulo">Apellido Materno</td>
</tr>

<?php 

$sql_select = "select * from sisesecd_cat_funcionarios where id_integrante<=8 and id_sesion=$id_sesion and id_distrito = $id_distrito order by id_integrante, tipo_acredor asc";
//echo $sql_select;
		
	$exec = sqlsrv_query($conn, $sql_select);
	//$row = ifx_fetch_row($exec);

while($row = sqlsrv_fetch_array ($exec))
{
	
	if($row[id_integrante]==1)
	{
	$id_funcionario=0;
	$id_funcionario=$row['id_funcionario'];
	echo'<tr>';
	echo'<td width="26%">Consejero Presidente:</td>';
	echo'<input type ="hidden" name="id_integra1" id="id_integra1" value ="'.$row['id_integrante'].'" />';
	echo'<input type ="hidden" name="id_func1" id="id_func1" value ="'.$row['id_funcionario'].'" />';
	
	echo'<td width="15%"><input type="text" name= "txt_nombreCP" id="txt_nombreCP" value ="'.$row['nombre'].'" onkeypress="return validar_texto(event)" /></td>';
	echo'<td width="22%"><input type="text" name= "txt_paternoCP" id="txt_paternoCP" value ="'.$row['ap_paterno'].'" onkeypress="return validar_texto(event)"/></td>';
	echo'<td width="21%"><input type="text" name= "txt_maternoCP" id="txt_maternoCP" value ="'.$row['ap_materno'].'" onkeypress="return validar_texto(event)"/></td>';
	echo'<td width="16%">';
	echo '<label> CP</label>';
if($row['tipo_acredor']=="CP")
{
	echo'<input type="checkbox" name="ck_CP" value="CP" checked="checked" >';
}
else
{
	echo'<input type="checkbox" name="ck_CP" value="CP" >';
}
echo'</td>';
echo'</tr>';
	}//en if


	if($row[id_integrante]==2)
	{
	echo'<tr>';
	echo'<td width="26%">Secretario del consejo:</td>';
	
	echo'<input type ="hidden" name="id_integra2" id="id_integra2" value ="'.$row['id_integrante'].'" />';
	echo'<input type ="hidden" name="id_func2" id="id_func2" value ="'.$row['id_funcionario'].'" />';
    echo'<td width="15%"><input type="text" name= "txt_nombreSC" id="txt_nombreSC"  value ="'.$row['nombre'].'" onkeypress="return validar_texto(event)"/></td>';
    echo'<td width="22%"><input type="text" name= "txt_paternoSC" id="txt_paternoSC" value ="'.$row['ap_paterno'].'" onkeypress="return validar_texto(event)"/></td>';
    echo'<td width="21%"><input type="text" name= "txt_maternoSC" id="txt_maternoSC" value ="'.$row['ap_materno'].'" onkeypress="return validar_texto(event)"/></td>';
    echo'<td width="16%">';
	echo '<label>SC</label>';
if($row['tipo_acredor']=="SC")
{
	echo'<input type="checkbox" name="ck_SC" value="SC" checked="checked" >';
}
else
{
	echo'<input type="checkbox" name="ck_SC" value="SC" >';
}
	echo'</td>';
	echo'</tr>';
	}//en if


	if($row[id_integrante]==3)
	{
	echo'<tr>';
	echo'<td width="26%">Consejero Electoral 1</td>';
	echo'<input type ="hidden" name="id_integra3" id="id_integra3" value ="'.$row['id_integrante'].'" />';
 	echo'<input type ="hidden" name="id_func3" id="id_func3" value ="'.$row['id_funcionario'].'" />';	
	echo'<td width="15%"><input type="text" name= "txt_nombreC1" id="txt_nombreC1" value ="'.$row['nombre'].'" onkeypress="return validar_texto(event)"/></td>';
    echo'<td width="22%"><input type="text" name= "txt_paternoC1" id="txt_paternoC1" value ="'.$row['ap_paterno'].'" onkeypress="return validar_texto(event)"/></td>';
    echo'<td width="21%"><input type="text" name= "txt_maternoC1" id="txt_maternoC1" value ="'.$row['ap_materno'].'" onkeypress="return validar_texto(event)"/></td>';
  	echo'<td width="16%">';
	echo '<label>C1</label>';
if($row['tipo_acredor']=="C1")
{
	echo'<input type="checkbox" name="ck_C1" value="C1" checked="checked" >';
}
else
{
	echo'<input type="checkbox" name="ck_C1" value="C1" >';
}
  
  
	echo'</tr>';

	}//en if

	if($row[id_integrante]==4)
	{
	echo'<tr>';
	echo'<td width="26%">Consejero Electoral 2</td>';
	echo'<input type ="hidden" name="id_integra4" id="id_integra4" value ="'.$row['id_integrante'].'" />';
 	echo'<input type ="hidden" name="id_func4" id="id_func4" value ="'.$row['id_funcionario'].'" />';
 	echo'<td width="15%"><input type="text" name= "txt_nombreC2" id="txt_nombreC2" value ="'.$row['nombre'].'" onkeypress="return validar_texto(event)"/></td>';
    echo' <td width="22%"><input type="text" name= "txt_paternoC2" id="txt_paternoC2" value ="'.$row['ap_paterno'].'" onkeypress="return validar_texto(event)"/></td>';
    echo' <td width="21%"><input type="text" name= "txt_maternoC2" id="txt_maternoC2" value ="'.$row['ap_materno'].'" onkeypress="return validar_texto(event)"/></td>';
	echo'<td width="16%">';
	echo '<label>C1</label>';
if($row['tipo_acredor']=="C2")
{
	echo'<input type="checkbox" name="ck_C2" value="C2" checked="checked" >';
}
else
{
	echo'<input type="checkbox" name="ck_C2" value="C2" >';
}
  
	echo'</tr>';
	}

	if($row[id_integrante]==5)
	{
	echo'<tr>';
	echo'<td width="26%">Consejero Electoral 3</td>';
 	echo'<input type ="hidden" name="id_func5" id="id_func5" value ="'.$row['id_funcionario'].'" />';
	echo'<input type ="hidden" name="id_integra5" id="id_integra5" value ="'.$row['id_integrante'].'" />';
   echo'<td width="15%"><input type="text" name= "txt_nombreC3" id="txt_nombreC3" value ="'.$row['nombre'].'" onkeypress="return validar_texto(event)"/></td>';
   echo'<td width="22%"><input type="text" name= "txt_paternoC3" id="txt_paternoC3" value ="'.$row['ap_paterno'].'" onkeypress="return validar_texto(event)"/></td>';
   echo'<td width="21%"><input type="text" name= "txt_maternoC3" id="txt_maternoC3" value ="'.$row['ap_materno'].'" onkeypress="return validar_texto(event)"/></td>';
   echo'<td width="16%">';
   echo '<label>C3</label>';
if($row['tipo_acredor']=="C3")
{
	echo'<input type="checkbox" name="ck_C3" value="C3" checked="checked" >';
}
else
{
	echo'<input type="checkbox" name="ck_C3" value="C3" >';
}

	echo'</tr>';
	}
	
	if($row[id_integrante]==6)
	{
	echo'<tr>';
	echo'<td width="26%">Consejero Electoral 4</td>';
 	echo'<input type ="hidden" name="id_func6" id="id_func6" value ="'.$row['id_funcionario'].'" />';
	echo'<input type ="hidden" name="id_integra6" id="id_integra6" value ="'.$row['id_integrante'].'" />';
  	echo'<td width="15%"><input type="text" name= "txt_nombreC4" id="txt_nombreC4" value ="'.$row['nombre'].'" onkeypress="return validar_texto(event)"/></td>';
   echo'<td width="22%"><input type="text" name= "txt_paternoC4" id="txt_paternoC4" value ="'.$row['ap_paterno'].'" onkeypress="return validar_texto(event)"/></td>';
    echo'<td width="21%"><input type="text" name= "txt_maternoC4" id="txt_maternoC4" value ="'.$row['ap_materno'].'" onkeypress="return validar_texto(event)"/></td>';
   
   echo'<td width="16%">';
   echo '<label>C4</label>';
if($row['tipo_acredor']=="C4")
{
	echo'<input type="checkbox" name="ck_C4" value="C4" checked="checked" >';
}
else
{
	echo'<input type="checkbox" name="ck_C4" value="C4" >';
}
   
	echo'</tr>';
	}

if($row[id_integrante]==7)
	{
	echo'<tr>';
	echo'<td width="26%">Consejero Electoral 5</td>';
	echo'<input type ="hidden" name="id_func7" id="id_func7" value ="'.$row['id_funcionario'].'" />';
	echo'<input type ="hidden" name="id_integra7" id="id_integra7" value ="'.$row['id_integrante'].'" />';
    echo'<td width="15%"><input type="text" name= "txt_nombreC5" id="txt_nombreC5" value ="'.$row['nombre'].'" onkeypress="return validar_texto(event)"/></td>';
    echo'<td width="22%"><input type="text" name= "txt_paternoC5" id="txt_paternoC5" value ="'.$row['ap_paterno'].'" onkeypress="return validar_texto(event)"/></td>';
    echo'<td width="21%"><input type="text" name= "txt_maternoC5" id="txt_maternoC5" value ="'.$row['ap_materno'].'" onkeypress="return validar_texto(event)"/></td>';
	
   echo'<td width="16%">';
   echo '<label>C5</label>';
if($row['tipo_acredor']=="C5")
{
	echo'<input type="checkbox" name="ck_C5" value="C5" checked="checked" >';
}
else
{
	echo'<input type="checkbox" name="ck_C5" value="C5" >';
}
	echo'</tr>';
	}

if($row[id_integrante]==8)
	{
	echo'<tr>';
	echo'<td width="26%">Consejero Electoral 6</td>';
	echo'<input type ="hidden" name="id_func8" id="id_func8" value ="'.$row['id_funcionario'].'" />';
	echo'<input type ="hidden" name="id_integra8" id="id_integra8" value ="'.$row['id_integrante'].'" />';
    echo' <td width="15%"><input type="text" name= "txt_nombreC6" id="txt_nombreC6" value ="'.$row['nombre'].'" onkeypress="return validar_texto(event)"/>
	</td>';
    echo' <td width="22%"><input type="text" name= "txt_paternoC6" id="txt_paternoC6" value ="'.$row['ap_paterno'].'" onkeypress="return validar_texto(event)"/></td>';
    echo' <td width="21%"><input type="text" name= "txt_maternoC6" id="txt_maternoC6" value ="'.$row['ap_materno'].'" onkeypress="return validar_texto(event)"/></td>';
   echo'<td width="16%">';
   echo '<label>C6</label>';
	
if($row['tipo_acredor']=="C6")
{
	echo'<input type="checkbox" name="ck_C6" value="C6" checked="checked" >';
}
else
{
	echo'<input type="checkbox" name="ck_C6" value="C6" >';
}
	echo'</tr>';
	echo'</table>';
	}// cierra if c6

}//while 1

echo'</br>';
echo'</br>';
// fin tabla uno

echo'<table width="91%" height="60" border="0">';
    echo'<tr bgcolor="#CCCCFF">';
     	echo'<td width="26%" rowspan="2" align="center"><strong>Integracion de los Partidos politicos</strong></td>';
     	echo'<td colspan="3" align="center"><strong>Nombres de los integrantes de Partido Politico </strong></td>';
     	echo'<td width="16%" rowspan="2" align="center"><strong>Tipo de acreditación</strong></td>';
    echo'</tr>';
        echo'<tr bgcolor="#CCCCFF">';
          echo'<td class="subtitulo"> Nombre (s)</td>';
          echo'<td width="22%" class="subtitulo">Apellido Paterno</td>';
          echo'<td width="21%" class="subtitulo">Apellido Materno</td>';
    echo'</tr>';
		
  $sql_select = "select * from sisesecd_cat_funcionarios where id_sesion=$id_sesion  and id_distrito = $id_distrito order by id_integrante, tipo_acredor asc";
   //echo $sql_select;
  $exec = sqlsrv_query($conn, $sql_select);
  //$row = ifx_fetch_row($exec);

while($row = sqlsrv_fetch_array ($exec))
{
  if($row[id_integrante]==11 && $row[tipo_acredor]=='P')
	{ 
    echo'<tr>';
    echo'<td width="26%" rowspan="2">Partido Accion Nacional (PAN)</td>';
    echo'<td width="15%">';
   	echo'<input type="hidden" name="id_integra11" id="id_integra11" value ="'.$row['id_integrante'].'" />';
	echo'<input type="hidden" name="id_func11P" id="id_func11P" value ="'.$row['id_funcionario'].'" />';
    echo'<input type="text" name= "txt_nombrePAN-P" id="txt_nombrePAN-P" value ="'.$row['nombre'].'" onkeypress="return validar_texto(event)"/></td>';
    echo'<td width="22%"><input type="text" name= "txt_paternoPAN-P" id="txt_paternoPAN-P" value ="'.$row['ap_paterno'].'" onkeypress="return validar_texto(event)"/></td>';
	 echo'<td width="21%"><input type="text" name= "txt_maternoPAN-P" id="txt_maternoPAN-P" value ="'.$row['ap_materno'].'" onkeypress="return validar_texto(event)"/></td>';
	 
    echo'<td width="16%">';
   	echo '<label>P</label>';
if($row['tipo_acredor']=="P")
{
	echo'<input type="checkbox" name="ck_PAN-P" value="P" checked="checked" >';
}
else
{
	echo'<input type="checkbox" name="ck_PAN-P" value="P" >';
}
    echo'</tr> ';
	}
	
	 
  if($row[id_integrante]==11 && $row[tipo_acredor]=='S')
	{ 
     echo'<tr>';
	 echo'<input type="hidden" name="id_func11S" id="id_func11S" value ="'.$row['id_funcionario'].'" />';
     echo'<td width="15%"><input type="text" name= "txt_nombrePAN-S" id="txt_nombrePAN-S" value ="'.$row['nombre'].'" onkeypress="return validar_texto(event)"/></td>';
     echo'<td width="22%"><input type="text" name= "txt_paternoPAN-S" id="txt_paternoPAN-S" value ="'.$row['ap_paterno'].'" onkeypress="return validar_texto(event)"/></td>';
     echo'<td width="21%"><input type="text" name= "txt_maternoPAN-S" id="txt_maternoPAN-S" value ="'.$row['ap_materno'].'" onkeypress="return validar_texto(event)"/> </td>';         
     echo'<td width="16%">';
   	 echo '<label>S</label>';
if($row['tipo_acredor']=="S")
{
	echo'<input type="checkbox" name="ck_PAN-S" value="S" checked="checked" >';
}
else
{
	echo'<input type="checkbox" name="ck_PAN-S" value="S" >';
}
    	echo'</tr>';
	}

  if($row[id_integrante]==12 && $row[tipo_acredor]=='P')
	{ 
   echo'<tr>';
   echo'<td width="26%" rowspan="2">Partido Revolucionario Institucional (PRI)</td>';
   echo'<td width="15%">';
   echo'<input type="hidden" name="id_integra12" id="id_integra12" value ="'.$row['id_integrante'].'"  />';
   echo'<input type="hidden" name="id_func12P" id="id_func12P" value ="'.$row['id_funcionario'].'" />';
   echo'<input type="text" name= "txt_nombrePRI-P" id="txt_nombrePRI-P" value ="'.$row['nombre'].'" onkeypress="return validar_texto(event)"/></td>';
   echo'<td width="22%"><input type="text" name= "txt_paternoPRI-P" id="txt_paternoPRI-P" value ="'.$row['ap_paterno'].'" onkeypress="return validar_texto(event)"/></td>';
   echo'<td width="21%"><input type="text" name= "txt_maternoPRI-P" id="txt_maternoPRI-P" value ="'.$row['ap_materno'].'" onkeypress="return validar_texto(event)"/></td>';
    echo'<td width="16%">';
   	echo '<label>P</label>';
if($row['tipo_acredor']=="P")
{
	echo'<input type="checkbox" name="ck_PRI-P" value="P" checked="checked" >';
}
else
{
	echo'<input type="checkbox" name="ck_PRI-P" value="P" >';
}
   echo' </tr>';
	}
	
	if($row[id_integrante]==12 && $row[tipo_acredor]=='S')
	{ 	
   echo' <tr>';
   echo'<input type="hidden" name="id_func12S" id="id_func12S" value ="'.$row['id_funcionario'].'" />';
   echo' <td width="15%"><input type="text" name= "txt_nombrePRI-S" id="txt_nombrePRI-S" value ="'.$row['nombre'].'" onkeypress="return validar_texto(event)"/></td>';
   echo' <td width="22%"><input type="text" name= "txt_paternoPRI-S" id="txt_paternoPRI-S" value ="'.$row['ap_paterno'].'" onkeypress="return validar_texto(event)"/></td>';
   echo' <td width="21%"><input type="text" name= "txt_maternoPRI-S" id="txt_maternoPRI-S" value ="'.$row['ap_materno'].'" onkeypress="return validar_texto(event)"/> </td>';  
    echo'<td width="16%">';
   	echo '<label>S</label>';       
  if($row['tipo_acredor']=="S")
{
	echo'<input type="checkbox" name="ck_PRI-S" value="S" checked="checked" >';
}
else
{
	echo'<input type="checkbox" name="ck_PRI-S" value="S" >';
}
  
   echo' </tr>';
	}

	/////////PRD////////////////
	if($row[id_integrante]==13 && $row[tipo_acredor]=='P')
	{ 
     
	echo'<tr>';
    echo'<td width="26%" rowspan="2">Partido de la Revolución Democrática (PRD)</td>';
    echo'<td width="15%">';
    echo'<input type="hidden" name="id_integra13" id="id_integra13" value ="'.$row['id_integrante'].'"  />';
    echo'<input type="hidden" name="id_func13P" id="id_func13P" value ="'.$row['id_funcionario'].'" />';
    echo'<input type="text" name= "txt_nombrePRD-P" id="txt_nombrePRD-P" value ="'.$row['nombre'].'" onkeypress="return validar_texto(event)"/></td>';
    echo'<td width="22%"><input type="text" name= "txt_paternoPRD-P" id="txt_paternoPRD-P" value ="'.$row['ap_paterno'].'" onkeypress="return validar_texto(event)"/></td>';
	echo'<td width="21%"><input type="text" name= "txt_maternoPRD-P" id="txt_maternoPRD-P" value ="'.$row['ap_materno'].'" onkeypress="return validar_texto(event)"/></td>';
  
	echo'<td width="16%">';
   	echo '<label>P</label>';
if($row['tipo_acredor']=="P")
{
	echo'<input type="checkbox" name="ck_PRD-P" value="P" checked="checked" >';
}
else
{
	echo'<input type="checkbox" name="ck_PRD-P" value="P" >';
}
	echo'</tr>';
	}
	
	if($row[id_integrante]==13 && $row[tipo_acredor]=='S')
	{
			
	echo'<tr>';
    echo'<input type="hidden" name="id_func13S" id="id_func13S" value ="'.$row['id_funcionario'].'" />';
    echo'<td width="15%"><input type="text" name= "txt_nombrePRD-S" id="txt_nombrePRD-S" value ="'.$row['nombre'].'" onkeypress="return validar_texto(event)"/></td>';
    echo'<td width="22%"><input type="text" name= "txt_paternoPRD-S" id="txt_paternoPRD-S" value ="'.$row['ap_paterno'].'" onkeypress="return validar_texto(event)"/></td>';
    echo'<td width="21%"><input type="text" name= "txt_maternoPRD-S" id="txt_maternoPRD-S" value ="'.$row['ap_materno'].'" onkeypress="return validar_texto(event)"/></td> ';        
   echo'<td width="16%">';
   echo '<label>S</label>';       
  if($row['tipo_acredor']=="S")
{
	echo'<input type="checkbox" name="ck_PRD-S" value="S" checked="checked" >';
}
else
{
	echo'<input type="checkbox" name="ck_PRD-S" value="S" >';
}
  
    echo'</tr>';
	}
	
	
////////PVEM/////////////	
	if($row[id_integrante]==14 && $row[tipo_acredor]=='P')
	{
    
	echo'<tr>';
    echo'<td width="26%" rowspan="2">Partido Verde Ecologista de Mexico (PVEM)</td>';
	echo'<td width="15%">';
    echo'<input type="hidden" name="id_integra15" id="id_integra15" value ="'.$row['id_integrante'].'"  />';
    echo'<input type="hidden" name="id_func15P" id="id_func15P" value ="'.$row['id_funcionario'].'" />';
    echo' <input type="text" name= "txt_nombrePVEM-P" id="txt_nombrePVEM-P" value ="'.$row['nombre'].'" onkeypress="return validar_texto(event)"/></td>';
    echo' <td width="22%"><input type="text" name= "txt_paternoPVEM-P" id="txt_paternoPVEM-P" value ="'.$row['ap_paterno'].'" onkeypress="return validar_texto(event)"/></td>';
	echo' <td width="21%"><input type="text" name= "txt_maternoPVEM-P" id="txt_maternoPVEM-P" value ="'.$row['ap_materno'].'" onkeypress="return validar_texto(event)"/></td>';

echo'<td width="16%">';
   	echo '<label>P</label>';
if($row['tipo_acredor']=="P")
{
	echo'<input type="checkbox" name="ck_PVEM-P" value="P" checked="checked" >';
}
else
{
	echo'<input type="checkbox" name="ck_PVEM-P" value="P" >';
}
    echo' </tr>';
	
	}
	
	if($row[id_integrante]==14 && $row[tipo_acredor]=='S')
	{
        echo'<tr>';
		echo'<input type="hidden" name="id_func15S" id="id_func15S" value ="'.$row['id_funcionario'].'" />';
        echo'<td width="15%"><input type="text" name= "txt_nombrePVEM-S" id="txt_nombrePVEM-S" value ="'.$row['nombre'].'" onkeypress="return validar_texto(event)"/></td>';
      	echo'<td width="22%"><input type="text" name= "txt_paternoPVEM-S" id="txt_paternoPVEM-S" value ="'.$row['ap_paterno'].'" onkeypress="return validar_texto(event)"/></td>';
      	echo'<td width="21%"><input type="text" name= "txt_maternoPVEM-S" id="txt_maternoPVEM-S" value ="'.$row['ap_materno'].'" onkeypress="return validar_texto(event)"/> </td>';         
       	
  echo'<td width="16%">';
   echo '<label>S</label>';       
  if($row['tipo_acredor']=="S")
{
	echo'<input type="checkbox" name="ck_PVEM-S" value="S" checked="checked" >';
}
else
{
	echo'<input type="checkbox" name="ck_PVEM-S" value="S" >';
}

      echo'</tr>';
	}
	
	if($row[id_integrante]==15 && $row[tipo_acredor]=='P')
	{	
    
	echo'<tr>';
    echo'<td width="26%" rowspan="2">Partido del Trabajo (PT)</td>';
    echo'<td width="15%">';
    echo'<input type="hidden" name="id_integra14" id="id_integra14" value ="'.$row['id_integrante'].'"  />';
    echo'<input type="hidden" name="id_func14P" id="id_func14P" value ="'.$row['id_funcionario'].'" />';
    echo' <input type="text" name="txt_nombrePT-P" id="txt_nombrePT-P" value ="'.$row['nombre'].'" onkeypress="return validar_texto(event)"/></td>';
    echo' <td width="22%"><input type="text" name= "txt_paternoPT-P" id="txt_paternoPT-P" value ="'.$row['ap_paterno'].'" onkeypress="return validar_texto(event)"/></td>';
	echo' <td width="21%"><input type="text" name= "txt_maternoPT-P" id="txt_maternoPT-P" value ="'.$row['ap_materno'].'" onkeypress="return validar_texto(event)"/></td>';
	
	echo'<td width="16%">';
   	echo '<label>P</label>';
if($row['tipo_acredor']=="P")
{
	echo'<input type="checkbox" name="ck_PT-P" value="P" checked="checked" >';
}
else
{
	echo'<input type="checkbox" name="ck_PT-P" value="P" >';
}
    echo' </tr>';
	}
	
	if($row[id_integrante]==15 && $row[tipo_acredor]=='S')
	{
	echo' <tr>';
    echo'<input type="hidden" name="id_func14S" id="id_func14S" value ="'.$row['id_funcionario'].'" />';
    echo'<td width="15%"><input type="text" name= "txt_nombrePT-S" id="txt_nombrePT-S" value ="'.$row['nombre'].'" onkeypress="return validar_texto(event)"/></td>';
    echo'<td width="22%"><input type="text" name= "txt_paternoPT-S" id="txt_paternoPT-S" value ="'.$row['ap_paterno'].'" onkeypress="return validar_texto(event)"/></td>';
    echo'<td width="21%"><input type="text" name= "txt_maternoPT-S" id="txt_maternoPT-S" value ="'.$row['ap_materno'].'" onkeypress="return validar_texto(event)"/> </td> ';        
   echo'<td width="16%">';
   echo '<label>S</label>';       
  if($row['tipo_acredor']=="S")
{
	echo'<input type="checkbox" name="ck_PT-S" value="S" checked="checked" >';
}
else
{
	echo'<input type="checkbox" name="ck_PT-S" value="S" >';
}
    echo'</tr>';
	}
	
	
	if($row[id_integrante]==16 && $row[tipo_acredor]=='P')
	{
    echo'<tr>';
    echo' <td width="26%" rowspan="2">Partido Movimiento Ciudadano (PMC)</td>';
    echo' <td width="15%">';
    echo'<input type="hidden" name="id_integra16" id="id_integra16" value ="'.$row['id_integrante'].'"  />';
    echo'<input type="hidden" name="id_func16P" id="id_func16P" value ="'.$row['id_funcionario'].'" />';
    echo' <input type="text" name= "txt_nombrePMC-P" id="txt_nombrePMC-P" value ="'.$row['nombre'].'" onkeypress="return validar_texto(event)"/></td>';
    echo' <td width="22%"><input type="text" name= "txt_paternoPMC-P" id="txt_paternoPMC-P" value ="'.$row['ap_paterno'].'" onkeypress="return validar_texto(event)"/></td>';
	echo' <td width="21%"><input type="text" name= "txt_maternoPMC-P" id="txt_maternoPMC-P" value ="'.$row['ap_materno'].'" onkeypress="return validar_texto(event)"/></td>';
	
	echo '<td width="16%">';
   	echo '<label>P</label>';
if($row['tipo_acredor']=="P")
{
	echo'<input type="checkbox" name="ck_PMC-P" value="P" checked="checked" >';
}
else
{
	echo'<input type="checkbox" name="ck_PMC-P" value="P" >';
}

    echo' </tr>';
	}
	
	if($row[id_integrante]==16 && $row[tipo_acredor]=='S')
	{
	echo'<tr>';
    echo'<input type="hidden" name="id_func16S" id="id_func16S" value ="'.$row['id_funcionario'].'" />';
    echo'<td width="15%"><input type="text" name= "txt_nombrePMC-S" id="txt_nombrePMC-S" value ="'.$row['nombre'].'" onkeypress="return validar_texto(event)"/></td>';
    echo'<td width="22%"><input type="text" name= "txt_paternoPMC-S" id="txt_paternoPMC-S" value ="'.$row['ap_paterno'].'" onkeypress="return validar_texto(event)"/></td>';
    echo'<td width="21%"><input type="text" name= "txt_maternoPMC-S" id="txt_maternoPMC-S" value ="'.$row['ap_materno'].'" onkeypress="return validar_texto(event)"/></td>';         
	echo'<td width="16%">';
   	echo '<label>S</label>';       
  if($row['tipo_acredor']=="S")
{
	echo'<input type="checkbox" name="ck_PMC-S" value="S" checked="checked" >';
}
else
{
	echo'<input type="checkbox" name="ck_PMC-S" value="S" >';
}

    echo'</tr>';
	}
	
	if($row[id_integrante]==17 && $row[tipo_acredor]=='P')
	{
    echo'<tr>';
    echo'<td width="26%" rowspan="2">artido Movimiento Regeneración Nacional (MORENA)</td>';
    echo'<td width="15%">';
    echo'<input type="hidden" name="id_integra17" id="id_integra17" value ="'.$row['id_integrante'].'"  />';
    echo'<input type="hidden" name="id_func17P" id="id_func17P" value ="'.$row['id_funcionario'].'" />';
    echo'<input type="text" name= "txt_nombreMOR-P" id="txt_nombreMOR-P" value ="'.$row['nombre'].'" onkeypress="return validar_texto(event)"/></td>';
    echo'<td width="22%"><input type="text" name= "txt_paternoMOR-P" id="txt_paternoMOR-P" value ="'.$row['ap_paterno'].'" onkeypress="return validar_texto(event)"/></td>';
	echo' <td width="21%"><input type="text" name= "txt_maternoMOR-P" id="txt_maternoMOR-P" value ="'.$row['ap_materno'].'" onkeypress="return validar_texto(event)"/></td>';
	echo'<td width="16%">';
   	echo '<label>P</label>';
if($row['tipo_acredor']=="P")
{
	echo'<input type="checkbox" name="ck_MOR-P" value="P" checked="checked" >';
}
else
{
	echo'<input type="checkbox" name="ck_MOR-P" value="P" >';
}
    echo'</tr>';
	}
	
	
	if($row[id_integrante]==17 && $row[tipo_acredor]=='S')
	{
    echo' <tr>';
    echo'<input type="hidden" name="id_func17S" id="id_func17S" value ="'.$row['id_funcionario'].'" />';
    echo' <td width="15%"><input type="text" name= "txt_nombreMOR-S" id="txt_nombreMOR-S" value ="'.$row['nombre'].'" onkeypress="return validar_texto(event)"/></td>';
    echo' <td width="22%"><input type="text" name= "txt_paternoMOR-S" id="txt_paternoMOR-S" value ="'.$row['ap_paterno'].'" onkeypress="return validar_texto(event)"/></td>';
    echo' <td width="21%"><input type="text" name= "txt_maternoMOR-S" id="txt_maternoMOR-S" value ="'.$row['ap_materno'].'" onkeypress="return validar_texto(event)"/> </td>';         
	
	echo'<td width="16%">';
   	echo '<label>S</label>';       
  if($row['tipo_acredor']=="S")
{
	echo'<input type="checkbox" name="ck_MOR-S" value="S" checked="checked" >';
}
else
{
	echo'<input type="checkbox" name="ck_MOR-S" value="S" >';
}
    echo' </tr>';
	}
	
	///// 
	if($row[id_integrante]==19 && $row[tipo_acredor]=='P')
	{
	
	echo' <tr>';
    echo' <td width="26%" rowspan="2">Partido Encuentro Solidario (PES)</td>';
    echo' <td width="15%">';
    echo'<input type="hidden" name="id_integra19" id="id_integra19" value ="'.$row['id_integrante'].'"  />';
    echo'<input type="hidden" name="id_func19P" id="id_func19P" value ="'.$row['id_funcionario'].'" />';
    echo' <input type="text" name= "txt_nombrePES-P" id="txt_nombrePES-P" value ="'.$row['nombre'].'" onkeypress="return validar_texto(event)"/></td>';
    echo' <td width="22%"><input type="text" name= "txt_paternoPES-P" id="txt_paternoPES-P" value ="'.$row['ap_paterno'].'" onkeypress="return validar_texto(event)"/></td>';
	echo' <td width="21%"><input type="text" name= "txt_maternoPES-P" id="txt_maternoPES-P" value ="'.$row['ap_materno'].'" onkeypress="return validar_texto(event)"/></td>';
	echo'<td width="16%">';
   	echo '<label>P</label>';
if($row['tipo_acredor']=="P")
{
	echo'<input type="checkbox" name="ck_PES-P" value="P" checked="checked" >';
}
else
{
	echo'<input type="checkbox" name="ck_PES-P" value="P" >';
}
     echo'</tr>';
	}
	
	if($row[id_integrante]==19 && $row[tipo_acredor]=='S')
	{
    echo' <tr>';
    echo'<input type="hidden" name="id_func19S" id="id_func19S" value ="'.$row['id_funcionario'].'" />';
    echo'<td width="15%"><input type="text" name= "txt_nombrePES-S" id="txt_nombrePES-S" value ="'.$row['nombre'].'" onkeypress="return validar_texto(event)"/></td>';
    echo' <td width="22%"><input type="text" name= "txt_paternoPES-S" id="txt_paternoPES-S" value ="'.$row['ap_paterno'].'" onkeypress="return validar_texto(event)"/></td>';
    echo' <td width="21%"><input type="text" name= "txt_maternoPES-S" id="txt_maternoPES-S" value ="'.$row['ap_materno'].'" onkeypress="return validar_texto(event)"/> </td> ';        
	
	echo'<td width="16%">';
   	echo '<label>S</label>';       
  if($row['tipo_acredor']=="S")
{
	echo'<input type="checkbox" name="ck_PES-S" value="S" checked="checked" >';
}
else
{
	echo'<input type="checkbox" name="ck_PES-S" value="S" >';
}

    echo' </tr>';
	}
	
///////
	
	if($row[id_integrante]==20 && $row[tipo_acredor]=='P')
	{
   echo' <tr>';
   echo' <td width="26%" rowspan="2">Partido Redes Sociales Progresistas (PRSP)</td>';
   echo' <td width="15%">';
   echo'<input type="hidden" name="id_integra20" id="id_integra20" value ="'.$row['id_integrante'].'"  />';
   echo'<input type="hidden" name="id_func20P" id="id_func20P" value ="'.$row['id_funcionario'].'" />';
   echo' <input type="text" name= "txt_nombrePH-P" id="txt_nombrePH-P" value ="'.$row['nombre'].'" onkeypress="return validar_texto(event)"/></td>';
   echo' <td width="22%"><input type="text" name= "txt_paternoPH-P" id="txt_paternoPH-P" value ="'.$row['ap_paterno'].'" onkeypress="return validar_texto(event)"/></td>';
   echo' <td width="21%"><input type="text" name= "txt_maternoPH-P" id="txt_maternoPH-P" value ="'.$row['ap_materno'].'" onkeypress="return validar_texto(event)"/></td>';
  
   echo'<td width="16%">';
   echo '<label>P</label>';
if($row['tipo_acredor']=="P")
{
	echo'<input type="checkbox" name="ck_PH-P" value="P" checked="checked" >';
}
else
{
	echo'<input type="checkbox" name="ck_PH-P" value="P" >';
}
    echo' </tr>';
	}
	
    if($row[id_integrante]==20 && $row[tipo_acredor]=='S')
	{  
	echo' <tr>';
    echo'<input type="hidden" name="id_func20S" id="id_func20S" value ="'.$row['id_funcionario'].'" />';
    echo' <td width="15%"><input type="text" name= "txt_nombrePH-S" id="txt_nombrePH-S" value ="'.$row['nombre'].'" onkeypress="return validar_texto(event)"/></td>';
    echo' <td width="22%"><input type="text" name= "txt_paternoPH-S" id="txt_paternoPH-S" value ="'.$row['ap_paterno'].'" onkeypress="return validar_texto(event)"/></td>';
    echo' <td width="21%"><input type="text" name= "txt_maternoPH-S" id="txt_maternoPH-S" value ="'.$row['ap_materno'].'" onkeypress="return validar_texto(event)"/> </td> ';        

	echo'<td width="16%">';
   	echo '<label>S</label>';       
  if($row['tipo_acredor']=="S")
{
	echo'<input type="checkbox" name="ck_PH-S" value="S" checked="checked" >';
}
else
{
	echo'<input type="checkbox" name="ck_PH-S" value="S" >';
}

    echo' </tr>';
	}
//////////////
	
	 if($row[id_integrante]==21 && $row[tipo_acredor]=='P')
	{
   echo' <tr>';
   echo' <td width="26%" rowspan="2">Fuerza Social por México (FSM)</td>';
   echo' <td width="15%">';
   echo'<input type="hidden" name="id_integra21" id="id_integra21" value ="'.$row['id_integrante'].'"  />';
   echo'<input type="hidden" name="id_func21P" id="id_func20P" value ="'.$row['id_funcionario'].'" />';
   echo' <input type="text" name= "txt_nombrePFSM-P" id="txt_nombrePFSM-P" value ="'.$row['nombre'].'" onkeypress="return validar_texto(event)"/></td>';
   echo' <td width="22%"><input type="text" name= "txt_paternoPFSM-P" id="txt_paternoPFSM-P" value ="'.$row['ap_paterno'].'" onkeypress="return validar_texto(event)"/></td>';
   echo' <td width="21%"><input type="text" name= "txt_maternoPFSM-P" id="txt_maternoPFSM-P" value ="'.$row['ap_materno'].'" onkeypress="return validar_texto(event)"/></td>';
  
   echo'<td width="16%">';
   echo '<label>P</label>';
if($row['tipo_acredor']=="P")
{
	echo'<input type="checkbox" name="ck_PFSM-P" value="P" checked="checked" >';
}
else
{
	echo'<input type="checkbox" name="ck_PFSM-P" value="P" >';
}
    echo' </tr>';
	}
	
    if($row[id_integrante]==21 && $row[tipo_acredor]=='S')
	{  
	echo' <tr>';
    echo'<input type="hidden" name="id_func21S" id="id_func21S" value ="'.$row['id_funcionario'].'" />';
    echo' <td width="15%"><input type="text" name= "txt_nombrePFSM-S" id="txt_nombrePFSM-S" value ="'.$row['nombre'].'" onkeypress="return validar_texto(event)"/></td>';
    echo' <td width="22%"><input type="text" name= "txt_paternoPFSM-S" id="txt_paternoPFSM-S" value ="'.$row['ap_paterno'].'" onkeypress="return validar_texto(event)"/></td>';
    echo' <td width="21%"><input type="text" name= "txt_maternoPFSM-S" id="txt_maternoPFSM-S" value ="'.$row['ap_materno'].'" onkeypress="return validar_texto(event)"/> </td> ';        

	echo'<td width="16%">';
   	echo '<label>S</label>';       
  if($row['tipo_acredor']=="S")
{
	echo'<input type="checkbox" name="ck_PFSM-S" value="S" checked="checked" >';
}
else
{
	echo'<input type="checkbox" name="ck_PFSM-S" value="S" >';
}

    echo' </tr>';
	} 
   	
	
	// ESTE VA AL ULTIMO:
	 if($row[id_integrante]==18 && $row[tipo_acredor]=='P')
	{ 
	// 12/01/2021 Variable para imprimir partido ELEGIR AL ULTIMO
	 $integra18 .= '<tr>';
     $integra18 .= ' <td width="26%" rowspan="2">Partido Equidad, Libertad y Genero  (ELIGE)</td>';
     $integra18 .=  ' <td width="15%">';
     $integra18 .=  '<input type="hidden" name="id_integra18" id="id_integra18" value ="'.$row['id_integrante'].'"  />';
     $integra18 .=  '<input type="hidden" name="id_func18P" id="id_func18P" value ="'.$row['id_funcionario'].'" />';
     $integra18 .= ' <input type="text" name="txt_nombrePNA-P" id="txt_nombrePNA-P" value ="'.$row['nombre'].'" onkeypress="return validar_texto(event)"/></td>';
     $integra18 .= ' <td width="22%"><input type="text" name= "txt_paternoPNA-P" id="txt_paternoPNA-P" value ="'.$row['ap_paterno'].'" onkeypress="return validar_texto(event)"/></td>';
	 $integra18 .= ' <td width="21%"><input type="text" name= "txt_maternoPNA-P" id="txt_maternoPNA-P" value ="'.$row['ap_materno'].'" onkeypress="return validar_texto(event)" /></td>';
	 
	$integra18 .= '<td width="16%">';
    $integra18 .=  '<label>P</label>';
	
	if($row['tipo_acredor']=="P")
	{
		$integra18 .= '<input type="checkbox" name="ck_PNA-P" value="P" checked="checked" >';
	}
	else
	{
		$integra18 .= '<input type="checkbox" name="ck_PNA-P" value="P" >';
	}

     $integra18 .= ' </tr>';
	}
	 
	 if($row[id_integrante]==18 && $row[tipo_acredor]=='S')
	{
     $integra18 .=  ' <tr>';
     $integra18 .=  '<input type="hidden" name="id_func18S" id="id_func18S" value ="'.$row['id_funcionario'].'" />';
     $integra18 .= ' <td width="15%"><input type="text" name= "txt_nombrePNA-S" id="txt_nombrePNA-S" value ="'.$row['nombre'].'" onkeypress="return validar_texto(event)"/></td>';
     $integra18 .= ' <td width="22%"><input type="text" name= "txt_paternoPNA-S" id="txt_paternoPNA-S" value ="'.$row['ap_paterno'].'" onkeypress="return validar_texto(event)"/></td>';
     $integra18 .= ' <td width="21%"><input type="text" name= "txt_maternoPNA-S" id="txt_maternoPNA-S" value ="'.$row['ap_materno'].'" onkeypress="return validar_texto(event)"/> </td>'; 

   
	$integra18 .=  '<td width="16%">';
   	$integra18 .=  '<label>S</label>';       
		if($row['tipo_acredor']=="S")
		{
			$integra18 .= '<input type="checkbox" name="ck_PNA-S" value="S" checked="checked" >';
		}
		else
		{
			$integra18 .= '<input type="checkbox" name="ck_PNA-S" value="S" >';
		}
     $integra18 .= '</tr>';
	}
	///  ---- FIN $integra18
	
	
		
 
}// ciera while 2partidos

// 12/01/2021:  Se pone prelación
echo $integra18;

		 echo'</table>';

 ?> 
<table width="91%" height="60" border="0">
    <tr bgcolor="#CCCCFF">
      <td width="26%" rowspan="2" align="center"><strong>Integracion de candidatos sin partidos</strong></td>
      <td colspan="3" align="center"><strong>Nombres de los integrantes de candidatos sin partidos</strong></td>
      <td width="10%" rowspan="2" align="center"><strong>Tipo de acreditación</strong></td>
    </tr>
    <tr bgcolor="#CCCCFF">
      <td class="subtitulo"> Nombre (s)</td>
      <td width="22%" class="subtitulo">Apellido Paterno</td>
      <td width="21%" class="subtitulo">Apellido Materno</td>
    </tr>

<?php
//iniciar sql

 $sql_select = "select * from sisesecd_cat_funcionarios where id_sesion=$id_sesion and id_distrito = $id_distrito order by id_integrante, tipo_acredor asc ";
// echo $sql_select;
		
	$exec = sqlsrv_query($conn, $sql_select);
	//$row = ifx_fetch_row($exec);

while($row = sqlsrv_fetch_array ($exec))
{

   	if($row[id_integrante]==31 && $row[tipo_acredor]=='P')
	{ 
 
     echo'<tr >';
	 echo'<input type="hidden" name="id_integra31" id="id_integra31" value ="'.$row['id_integrante'].'"  />';
     echo'<input type="hidden" name="id_func31P" id="id_func31P" value ="'.$row['id_funcionario'].'" />';
	 
     echo'<td width="26%" rowspan="2" align="center"><strong>Representante C1</strong></td>';
     echo'<td >';
	 echo'<input type="text" name= "txt_nombreCI1-P" id="txt_nombreCI1-P" value ="'.$row['nombre'].'" onkeypress="return validar_texto(event)"/>';
	 echo'</td>';
     
	 echo'<td>';
	 echo'<input type="text" name= "txt_paternoCI1-P" id="txt_paternoCI1-P" value ="'.$row['ap_paterno'].'" onkeypress="return validar_texto(event)"/>';
	 echo'</td>';
     
	 echo'<td >';
	 echo'<input type="text" name= "txt_maternoCI1-P" id="txt_maternoCI1-P" value ="'.$row['ap_materno'].'" onkeypress="return validar_texto(event)"/>';
	 echo'</td>';
	
	 echo'<td width="16%">';
     echo '<label>P</label>';
		
if($row['tipo_acredor']=="P")
{
	echo'<input type="checkbox" name="ck_CI1-P" value="P" checked="checked" >';
}
else
{
	echo'<input type="checkbox" name="ck_CI1-P" value="P" >';
}
    echo'</tr>';
	}
	
	 if($row[id_integrante]==31 && $row[tipo_acredor]=='S')
    {
		echo'<tr>';
      	echo'<td >';
       	echo'<input type="hidden" name="id_func31S" id="id_func31S" value ="'.$row['id_funcionario'].'" />';
	  	echo'<input type="text" name= "txt_nombreCI1-S" id="txt_nombreCI1-S" value ="'.$row['nombre'].'" onkeypress="return validar_texto(event)"/>';
	  	echo'</td>';
      	echo'<td >';
	  	echo'<input type="text" name= "txt_paternoCI1-S" id="txt_paternoCI1-S" value ="'.$row['ap_paterno'].'" onkeypress="return validar_texto(event)"/>';
	  	echo'</td>';
      	echo'<td >';
	  	echo'<input type="text" name= "txt_maternoCI1-S" id="txt_maternoCI1-S" value ="'.$row['ap_materno'].'" onkeypress="return validar_texto(event)"/>';
	  	echo'</td>';
      	echo'<td >';
   	  	echo '<label>S</label>';       
  if($row['tipo_acredor']=="S")
{
	echo'<input type="checkbox" name="ck_CI1-S" value="S" checked="checked" >';
}
else
{
	echo'<input type="checkbox" name="ck_CI1-S" value="S" disabled="disabled" >';
}
    echo'</tr>';
	}
	
//tabla 2 diputaciones 
if($row[id_integrante]==32 && $row[tipo_acredor]=='P')
  {
	echo'<tr>';
	echo'<td>Candidato Representante DMR:</td>';
       echo'<input type="hidden" name="id_integra32" id="id_integra32" value ="32" />';
		echo'<td colspan="4"> <input type="tex" name="txt_namecandidatoDMR" id ="txt_namecandidatoDMR" value="'.$row['candidato'].'" /></td>';
	echo'</tr>';
	echo'<tr>';
	echo'<td>Puesto Representante DMR:</td>';
	echo'<td colspan="4"> <input type="tex" name="txt_puestocandidatoDMR" id ="txt_puestocandidatoDMR" value="'.$row['puesto'].'"/></td>';
	echo'</tr>';
		
	 echo'<tr>';
	 echo'<input type="hidden" name="id_integra32" id="id_integra32" value ="'.$row['id_integrante'].'"  />';
     echo'<input type="hidden" name="id_func32P" id="id_func32P" value ="'.$row['id_funcionario'].'" />';
	
     echo'<td width="26%" rowspan="2" align="center"><strong>Representantes C- 2</strong></td>';
     
	 echo'<td >';
	 echo'<input type="text" name= "txt_nombreCI2-P" id="txt_nombreCI2-P" value ="'.$row['nombre'].'" onkeypress="return validar_texto(event)"/>';
	 echo'</td>';
	 
     echo'<td >';
	 echo'<input type="text" name= "txt_paternoCI2-P" id="txt_paternoCI2-P" value ="'.$row['ap_paterno'].'" onkeypress="return validar_texto(event)"/>';
	 echo'</td>';
	 
     echo'<td >';
	 echo'<input type="text" name= "txt_maternoCI2-P" id="txt_maternoCI2-P" value ="'.$row['ap_materno'].'" onkeypress="return validar_texto(event)"/>';
	 echo'</td>';
	 
	echo'<td>';
    echo '<label>P</label>';
	
if($row['tipo_acredor']=="P")
{
	echo'<input type="checkbox" name="ck_CI2-P" value="P" checked="checked" >';
}
else
{
	echo'<input type="checkbox" name="ck_CI2-P" value="P" >';
}
    echo'</td>';
	echo'</tr>';
	}
	
if($row[id_integrante]==32 && $row[tipo_acredor]=='S')
    {
		echo'<tr>';
      	echo'<td >';
       	echo'<input type="hidden" name="id_func32S" id="id_func32S" value ="'.$row['id_funcionario'].'" />';
	  	echo'<input type="text" name= "txt_nombreCI2-S" id="txt_nombreCI2-S" value ="'.$row['nombre'].'" onkeypress="return validar_texto(event)"/>';
	  	echo'</td>';
      	echo'<td>';
	  	echo'<input type="text" name= "txt_paternoCI2-S" id="txt_paternoCI2-S" value ="'.$row['ap_paterno'].'" onkeypress="return validar_texto(event)"/>';
	  	echo'</td>';
      	echo'<td >';
	  	echo'<input type="text" name= "txt_maternoCI2-S" id="txt_maternoCI2-S" value ="'.$row['ap_materno'].'" onkeypress="return validar_texto(event)"/>';
	  	echo'</td>';
      	echo'<td >';
   	  	echo '<label>S</label>';       
  if($row['tipo_acredor']=="S")
{
	echo'<input type="checkbox" name="ck_CI2-S" value="S" checked="checked" >';
}
else
{
	echo'<input type="checkbox" name="ck_CI2-S" value="S" >';
}
    echo'</tr>';
	}
	
//tabla3 alcaldes
if($row[id_integrante]==33 && $row[tipo_acredor]=='P')
  {
		echo'<tr>';
	echo'<td>Candidato Representante Alcalde:</td>';
       echo'<input type="hidden" name="id_integra32" id="id_integra32" value ="32" />';
		echo'<td colspan="4"> <input type="tex" name="txt_namecandidatoALCALDE" id ="txt_namecandidatoALCALDE" value="'.$row['candidato'].'" /></td>';
	echo'</tr>';
	echo'<tr>';
	echo'<td>Puesto Representante Alcalde:</td>';
	echo'<td colspan="4"> <input type="tex" name="txt_puestocandidatoALCALDE" id ="txt_puestocandidatoALCALDE" value="'.$row['puesto'].'"/></td>';
	echo'</tr>';
	 echo'<tr>';
	 echo'<input type="hidden" name="id_integra33" id="id_integra33" value ="'.$row['id_integrante'].'"/>';
     echo'<input type="hidden" name="id_func33P" id="id_func33P" value ="'.$row['id_funcionario'].'" />';
	
     echo'<td width="26%" rowspan="2" align="center"><strong>Reperesentantes C- 3</strong></td>';
     
	 echo'<td >';
	 echo'<input type="text" name= "txt_nombreCI3-P" id="txt_nombreCI3-P" value ="'.$row['nombre'].'" onkeypress="return validar_texto(event)"/>';
	 echo'</td>';
	 
     echo'<td >';
	 echo'<input type="text" name= "txt_paternoCI3-P" id="txt_paternoCI3-P" value ="'.$row['ap_paterno'].'" onkeypress="return validar_texto(event)"/>';
	 echo'</td>';
	 
     echo'<td >';
	 echo'<input type="text" name= "txt_maternoCI3-P" id="txt_maternoCI3-P" value ="'.$row['ap_materno'].'" onkeypress="return validar_texto(event)"/>';
	 echo'</td>';
	 
	echo'<td width="16%">';
    echo '<label>P</label>';
if($row['tipo_acredor']=="P")
{
	echo'<input type="checkbox" name="ck_CI3-P" value="P" checked="checked" >';
}
else
{
	echo'<input type="checkbox" name="ck_CI3-P" value="P" >';
}
    echo'</td>';
	echo'</tr>';
	}
	
if($row[id_integrante]==33 && $row[tipo_acredor]=='S')
    {
		echo'<tr>';
      	echo'<td >';
       	echo'<input type="hidden" name="id_func33S" id="id_func33S" value ="'.$row['id_funcionario'].'" />';
	  	echo'<input type="text" name= "txt_nombreCI3-S" id="txt_nombreCI3-S" value ="'.$row['nombre'].'" onkeypress="return validar_texto(event)"/>';
	  	echo'</td>';
      	echo'<td  >';
	  	echo'<input type="text" name= "txt_paternoCI3-S" id="txt_paternoCI3-S" value ="'.$row['ap_paterno'].'" onkeypress="return validar_texto(event)"/>';
	  	echo'</td>';
      	echo'<td  >';
	  	echo'<input type="text" name= "txt_maternoCI3-S" id="txt_maternoCI3-S" value ="'.$row['ap_materno'].'" onkeypress="return validar_texto(event)"/>';
	  	echo'</td>';
      	echo'<td >';
   	  	echo '<label>S</label>';       
  if($row['tipo_acredor']=="S")
{
	echo'<input type="checkbox" name="ck_CI3-S" value="S" checked="checked" >';
}
else
{
	echo'<input type="checkbox" name="ck_CI3-S" value="S" >';
}
    echo'</tr>';
	}
 
 //tabla4

if($row[id_integrante]==34 && $row[tipo_acredor]=='P')
  {
	 echo'<tr>';
	 echo'<input type="hidden" name="id_integra34" id="id_integra34" value ="'.$row['id_integrante'].'"  />';
     echo'<input type="hidden" name="id_func34P" id="id_func34P" value ="'.$row['id_funcionario'].'" />';
	
     echo'<td width="26%" rowspan="2" align="center"><strong>Candidato Sin Partido 4</strong></td>';
     
	 echo'<td >';
	 echo'<input type="text" name= "txt_nombreCI4-P" id="txt_nombreCI4-P" value ="'.$row['nombre'].'" onkeypress="return validar_texto(event)"/>';
	 echo'</td>';
	 
     echo'<td >';
	 echo'<input type="text" name= "txt_paternoCI4-P" id="txt_paternoCI4-P" value ="'.$row['ap_paterno'].'" onkeypress="return validar_texto(event)"/>';
	 echo'</td>';
	 
     echo'<td >';
	 echo'<input type="text" name= "txt_maternoCI4-P" id="txt_maternoCI4-P" value ="'.$row['ap_materno'].'" onkeypress="return validar_texto(event)"/>';
	 echo'</td>';
	 
	echo'<td width="16%">';
    echo '<label>P</label>';
if($row['tipo_acredor']=="P")
{
	echo'<input type="checkbox" name="ck_CI4-P" value="P" checked="checked" >';
}
else
{
	echo'<input type="checkbox" name="ck_CI4-P" value="P" >';
}
    echo'</td>';
	echo'</tr>';
	}
	
if($row[id_integrante]==34 && $row[tipo_acredor]=='S')
    {
		echo'<tr>';
      	echo'<td >';
       	echo'<input type="hidden" name="id_func34S" id="id_func34S" value ="'.$row['id_funcionario'].'" />';
	  	echo'<input type="text" name= "txt_nombreCI4-S" id="txt_nombreCI4-S" value ="'.$row['nombre'].'" onkeypress="return validar_texto(event)"/>';
	  	echo'</td>';
      	echo'<td >';
	  	echo'<input type="text" name= "txt_paternoCI4-S" id="txt_paternoCI4-S" value ="'.$row['ap_paterno'].'" onkeypress="return validar_texto(event)"/>';
	  	echo'</td>';
      	echo'<td >';
	  	echo'<input type="text" name= "txt_maternoCI4-S" id="txt_maternoCI4-S" value ="'.$row['ap_materno'].'" onkeypress="return validar_texto(event)"/>';
	  	echo'</td>';
      	echo'<td >';
   	  	echo '<label>S</label>';       
  if($row['tipo_acredor']=="S")
{
	echo'<input type="checkbox" name="ck_CI4-S" value="S" checked="checked" >';
}
else
{
	echo'<input type="checkbox" name="ck_CI4-S" value="S" >';
}
    echo'</tr>';
	}

 }// fin de while 4
 echo' </table>';
 ?> 
 	         <center>
             <div id="errorMsg" style="display:none">Favor de esperar un momento...</div> 
            </center>
    <br>
       <br>
        <input type="submit" name="submit" id="button" value="Enviar" class="btn btn-primary"/>
        <p></p>
        <input type="button" name="cancelar" id="cancelar" value="Cancelar" onclick="history.back ()" class="btn btn-default"/>
      
      </form>
	<?php
	}
	else
	{

?>
<br>
	  
 <center>
		<div class="card mb-4">
	<div class="card-header">
     <b>Nueva Integracion del Consejo Distrital</br><?php echo $encabezado ?> </b>
    </div>
			
	  
<form id="frmClienteNuevo" name="frmClienteNuevo" method="post" onsubmit="return escondeNuevo();">
   <label>
     <input class="text" type="hidden" name="id_distrito" id="id_distrito" value="<?php echo $_SESSION['id_distrito']; ?>"/>
   </label>
   </br>
 
  <input type="hidden" name="id_sesion" id="id_sesion" value="<?php  echo $_REQUEST['id_sesion'];?>" />
  <input type="hidden" name="movimiento" id="movimiento" value="NUEVO" />
   </label>
   </br>
   

 </p>
 <table width="89%" height="60" border="0">
   <tr >
     <td width="21%" rowspan="2" align="center"><strong>Integración del Consejo Distrital</strong></td>
     <td colspan="3" align="center"><strong>Nombres de los Integrantes del Consejo Distrital</strong></td>
     <td width="11%" rowspan="2" align="center"><strong>Tipo de acreditacion</strong></td>
   </tr>
   <tr bgcolor="#CCCCFF">
     <td class="subtitulo"> Nombre (s)</td>
     <td width="21%" class="subtitulo">Apellido Paterno</td>
     <td width="22%" class="subtitulo">Apellido Materno</td>
   </tr>
   <tr>
     <td width="21%">Consejero Presidente:</td>
     <input type="hidden"  name="id_integra1" id="id_integra1" value ="1" />
     
     <td width="25%"><input type="text" name= "txt_nombreCP" id="txt_nombreCP" onkeypress='return validar_texto(event)'/></td>
     <td width="21%"><input type="text" name= "txt_paternoCP" id="txt_paternoCP" onkeypress='return validar_texto(event)'/></td>
     <td width="22%"><input type="text" name= "txt_maternoCP" id="txt_maternoCP" onkeypress='return validar_texto(event)'/></td>
     <td width="11%"><input type="checkbox" name="ck_CP" value="CP" checked="checked" disabled="disabled" />
       CP </td>
   </tr>
   <tr>
     <td width="21%">Secretario del consejo:</td>
          <input type="hidden" name="id_integra2" id="id_integra2" value ="2" />
     <td width="25%"><input type="text" name= "txt_nombreSC" id="txt_nombreSC" onkeypress='return validar_texto(event)'/></td>
     <td width="21%"><input type="text" name= "txt_paternoSC" id="txt_paternoSC" onkeypress='return validar_texto(event)'/></td>
     <td width="22%"><input type="text" name= "txt_maternoSC" id="txt_maternoSC" onkeypress='return validar_texto(event)'/></td>
     <td width="11%"><input type="checkbox" name="ck_SC" value="SC" checked="checked" disabled="disabled"  />
       SC</td>
   </tr>
   <tr>
     <td width="21%">Consejero Electoral 1</td>
         <input type="hidden" name="id_integra3" id="id_integra3" value ="3" />
     <td width="25%"><input type="text" name= "txt_nombreC1" id="txt_nombreC1" onkeypress='return validar_texto(event)'/></td>
     <td width="21%"><input type="text" name= "txt_paternoC1" id="txt_paternoC1" onkeypress='return validar_texto(event)'/></td>
     <td width="22%"><input type="text" name= "txt_maternoC1" id="txt_maternoC1" onkeypress='return validar_texto(event)'/></td>
     <td width="11%"><input type="checkbox" name="ck_C1" value="C1" checked="checked" disabled="disabled" />
       C1</td>
   </tr>
   <tr>
     <td width="21%">Consejero Electoral 2</td>
         <input type="hidden" name="id_integra4" id="id_integra4" value ="4" />
     <td width="25%"><input type="text" name= "txt_nombreC2" id="txt_nombreC2" onkeypress='return validar_texto(event)'/></td>
     <td width="21%"><input type="text" name= "txt_paternoC2" id="txt_paternoC2" onkeypress='return validar_texto(event)'/></td>
     <td width="22%"><input type="text" name= "txt_maternoC2" id="txt_maternoC2" onkeypress='return validar_texto(event)'/></td>
     <td width="11%"><input type="checkbox" name="ck_C2" value="C2" checked="checked" disabled="disabled"/>
       C2</td>
   </tr>
   <tr>
     <td width="21%">Consejero Electoral 3</td>
         <input type="hidden" name="id_integra5" id="id_integra5" value ="5" />
     <td width="25%"><input type="text" name= "txt_nombreC3" id="txt_nombreC3" onkeypress='return validar_texto(event)'/></td>
     <td width="21%"><input type="text" name= "txt_paternoC3" id="txt_paternoC3" onkeypress='return validar_texto(event)'/></td>
     <td width="22%"><input type="text" name= "txt_maternoC3" id="txt_maternoC3" onkeypress='return validar_texto(event)'/></td>
     <td width="11%"><input type="checkbox" name="ck_C3" value="C3" checked="checked" disabled="disabled" />
       C3</td>
   </tr>
   <tr>
     <td width="21%">Consejero Electoral 4</td>
         <input type="hidden"  name="id_integra6" id="id_integra6" value ="6" />
     <td width="25%"><input type="text" name= "txt_nombreC4" id="txt_nombreC4" onkeypress='return validar_texto(event)'/></td>
     <td width="21%"><input type="text" name= "txt_paternoC4" id="txt_paternoC4" onkeypress='return validar_texto(event)'/></td>
     <td width="22%"><input type="text" name= "txt_maternoC4" id="txt_maternoC4" onkeypress='return validar_texto(event)'/></td>
     <td width="11%"><input type="checkbox" name="ck_C4" value="C4" checked="checked" disabled="disabled"  />
       C4</td>
   </tr>
   <tr>
     <td width="21%">Consejero Electoral 5</td>
            <input type="hidden"  name="id_integra7" id="id_integra7" value ="7" />
     <td width="25%"><input type="text" name= "txt_nombreC5" id="txt_nombreC5" onkeypress='return validar_texto(event)'/></td>
     <td width="21%"><input type="text" name= "txt_paternoC5" id="txt_paternoC5" onkeypress='return validar_texto(event)'/></td>
     <td width="22%"><input type="text" name= "txt_maternoC5" id="txt_maternoC5" onkeypress='return validar_texto(event)'/></td>
     <td width="11%"><input type="checkbox" name="ck_C5" value="C5" checked="checked" disabled="disabled" />
       C5</td>
   </tr>
   <tr>
     <td width="21%">Consejero Electoral 6</td>
     <input type="hidden" name="id_integra8" id="id_integra8" value ="8" />
     <td width="25%"><input type="text" name= "txt_nombreC6" id="txt_nombreC6" onkeypress='return validar_texto(event)'/></td>
     <td width="21%"><input type="text" name= "txt_paternoC6" id="txt_paternoC6" onkeypress='return validar_texto(event)'/></td>
     <td width="22%"><input type="text" name= "txt_maternoC6" id="txt_maternoC6" onkeypress='return validar_texto(event)'/></td>
     <td width="11%"><input type="checkbox" name="ck_C6" value="C6" checked="checked" disabled="disabled" />
       C6</td>
   </tr>
 </table>
 <p><br />
<table width="91%" height="887" border="0">
    <tr bgcolor="#CCCCFF">
      <td width="25%" rowspan="2" align="center"><strong>Integracion de los Partidos politicos</strong></td>
      <td colspan="3" align="center"><strong>Nombres de los integrantes de Partido Politico</strong></td>
      <td width="12%" rowspan="2" align="center"><strong>Tipo de acreditación</strong></td>
    </tr>
    <tr bgcolor="#CCCCFF">
      <td class="subtitulo"> Nombre (s)</td>
      <td width="21%" class="subtitulo">Apellido Paterno</td>
      <td width="22%" class="subtitulo">Apellido Materno</td>
      
    </tr>
    <tr>
      <td width="25%" height="87">Partido Accion Nacional (PAN)</td>
      <td width="20%"><p>
       <input type="hidden" name="id_integra11" id="id_integra11" value ="11" checked="checked" />
		  
        <input type="text" name= "txt_nombrePAN-P" id="txt_nombrePAN-P" onkeypress='return validar_texto(event)' tabindex="1" />
      </p>
        <p>
          <input type="text" name= "txt_nombrePAN-S" id="txt_nombrePAN-S" onkeypress='return validar_texto(event)' tabindex="4"/>          
          <br />
        </p></td>
      <td width="21%"><p>
        <input type="text" name= "txt_paternoPAN-P" id="txt_paternoPAN-P" onkeypress='return validar_texto(event)' tabindex="2"/>
      </p>
        <p>
          <input type="text" name= "txt_paternoPAN-S" id="txt_paternoPAN-S" onkeypress='return validar_texto(event)' tabindex="5"/>          
          <br />
        </p></td>
      <td width="22%"><p>
        <input type="text" name= "txt_maternoPAN-P" id="txt_maternoPAN-P" onkeypress='return validar_texto(event)' tabindex="3"/>
      </p>
        <p>
          <input type="text" name= "txt_maternoPAN-S" id="txt_maternoPAN-S" onkeypress='return validar_texto(event)' tabindex="6"/>          
          <br />
        </p></td>
      <td width="12%"><p>
        <input type="checkbox" name="ck_PAN-P" value="P" checked="checked" disabled="disabled"/>  
        P </p>
        <p>
          <input type="checkbox" name="ck_PAN-S" value="S" checked="checked" disabled="disabled"/>
          S 
        </p></td>
    </tr>
    <tr>
      <td width="25%" height="84">Partido Revolucionario Institucional (PRI)</td>
      <td width="20%"><p>
            <input type="hidden" name="id_integra12" id="id_integra12" value ="12" />
        <input type="text" name= "txt_nombrePRI-P" id="txt_nombrePRI-P" onkeypress='return validar_texto(event)' tabindex="7"/>
      </p>
        <p>
          <input type="text" name= "txt_nombrePRI-S" id="txt_nombrePRI-S" onkeypress='return validar_texto(event)' tabindex="10"/>          
          <br />
        </p></td>
      <td width="21%"><p>
        <input type="text" name= "txt_paternoPRI-P" id="txt_paternoPRI-P" onkeypress='return validar_texto(event)'tabindex="8"/>
      </p>
        <p>
          <input type="text" name= "txt_paternoPRI-S" id="txt_paternoPRI-S" onkeypress='return validar_texto(event)' tabindex="11"/>          
          <br />
        </p></td>
      <td width="22%"><p>
        <input type="text" name= "txt_maternoPRI-P" id="txt_maternoPRI-P" onkeypress='return validar_texto(event)' tabindex="9"/>
      </p>
        <p>
          <input type="text" name= "txt_maternoPRI-S" id="txt_maternoPRI-S" onkeypress='return validar_texto(event)' tabindex="12"/>          
          <br />
        </p></td>
      <td width="12%"><p>
        <input type="checkbox" name="ck_PRI-P" value="P" checked="checked" disabled="disabled"/> 
        P</p>
        <p>
          <input type="checkbox" name="ck_PRI-S" value="S" checked="checked" disabled="disabled"/>
          S </p></td>
    </tr>
    <tr>
      <td width="25%">Partido de la Revolución Democrática (PRD)</td>
      <td width="20%"><p>
                  <input type="hidden" name="id_integra13" id="id_integra13" value ="13" />
        <input type="text" name= "txt_nombrePRD-P" id="txt_nombrePRD-P" onkeypress='return validar_texto(event)' tabindex="13"/>
      </p>
        <p>
          <input type="text" name= "txt_nombrePRD-S" id="txt_nombrePRD-S" onkeypress='return validar_texto(event)' tabindex="16"/>          
          <br />
        </p></td>
      <td width="21%"><p>
        <input type="text" name= "txt_paternoPRD-P" id="txt_paternoPRD-P" onkeypress='return validar_texto(event)' tabindex="14"/>
      </p>
        <p>
          <input type="text" name= "txt_paternoPRD-S" id="txt_paternoPRD-S" onkeypress='return validar_texto(event)' tabindex="17"/>          
          <br />
        </p></td>
      <td width="22%"><p>
        <input type="text" name= "txt_maternoPRD-P" id="txt_maternoPRD-P" onkeypress='return validar_texto(event)' tabindex="15"/>
      </p>
        <p>
          <input type="text" name= "txt_maternoPRD-S" id="txt_maternoPRDP-S" onkeypress='return validar_texto(event)' tabindex="18"/>          
          <br />
        </p></td>
      <td width="12%"><p>
        <input type="checkbox" name="ck_PRD-P" value="P" checked="checked" disabled="disabled"/> 
        P </p>
        <p>
          <input type="checkbox" name="ck_PRD-S" value="S" checked="checked" disabled="disabled"/>
          S </p></td>
    </tr>
 
    <tr>
      <td width="25%">Partido Verde Ecologista de Mexico (PVEM)</td>
      <td width="20%"><p>
        <input type="hidden" name="id_integra15" id="id_integra14" value ="14" />
        <input type="text" name= "txt_nombrePVEM-P" id="txt_nombrePVEM-P" onkeypress='return validar_texto(event)' tabindex="19"/>
      </p>
        <p>
          <input type="text" name= "txt_nombrePVEM-S" id="txt_nombrePVEM-S" onkeypress='return validar_texto(event)' tabindex="22"/>
        </p></td>
      <td width="21%"><p>
        <input type="text" name= "txt_paternoPVEM-P" id="txt_paternoPVEM-P" onkeypress='return validar_texto(event)' tabindex="20"/>
      </p>
        <p>
       <input type="text" name= "txt_paternoPVEM-S" id="txt_paternoPVEM-S" onkeypress='return validar_texto(event)' tabindex="23"/>
        </p></td>
      <td width="22%"><p>
        <input type="text" name= "txt_maternoPVEM-P" id="txt_maternoPVEM-P" onkeypress='return validar_texto(event)' tabindex="21"/>
      </p>
        <p>
          <input type="text" name= "txt_maternoPVEM-S" id="txt_maternoPVEM-S" onkeypress='return validar_texto(event)' tabindex="24"/>
        </p></td>
      <td width="12%"><p>
        <input type="checkbox" name="ck_PVEM-P" value="P" checked="checked" disabled="disabled"/> 
        P </p>
        <p>
          <input type="checkbox" name="ck_PVEM-S" value="S" checked="checked" disabled="disabled"/>
          S </p></td>
    </tr>
       <tr>
      <td width="25%"><p>Partido del Trabajo (PT)</p></td>
      <td width="20%"><p>
	       <input type="hidden" name="id_integra14" id="id_integra15" value ="15" />
        <input type="text" name= "txt_nombrePT-P" id="txt_nombrePT-P" onkeypress='return validar_texto(event)' tabindex="25"/>
      </p>
        <p>
          <input type="text" name= "txt_nombrePT-S" id="txt_nombrePT-S" onkeypress='return validar_texto(event)' tabindex="28"/>          
          <br />
        </p></td>
      <td width="21%"><p>
        <input type="text" name= "txt_paternoPT-P" id="txt_paternoPT-P" onkeypress='return validar_texto(event)' tabindex="26"/>
      </p>
        <p>
          <input type="text" name= "txt_paternoPT-S" id="txt_paternoPT-S" onkeypress='return validar_texto(event)' tabindex="29"/>          
          <br />
        </p></td>
      <td width="22%"><p>
        <input type="text" name= "txt_maternoPT-P" id="txt_maternoPT-P" onkeypress='return validar_texto(event)' tabindex="27"/>
      </p>
        <p>
          <input type="text" name= "txt_maternoPT-S" id="txt_maternoPT-S" onkeypress='return validar_texto(event)' tabindex="30"/>          
          <br />
        </p></td>
      <td width="12%">
<p>
  <input type="checkbox" name="ck_PT-P" value="P" checked="checked" disabled="disabled"/>
  P </p>
<p>
  <input type="checkbox" name="ck_PT-S" value="S" checked="checked" disabled="disabled"/>
  S</p></p></td>
    </tr>
    <tr>
      <td width="25%">Partido Movimiento Ciudadano (PMC)</td>
      <td width="20%"><p>
       <input type="hidden" name="id_integra16" id="id_integra16" value ="16" />
        <input type="text" name= "txt_nombrePMC-P" id="txt_nombrePMC-P" onkeypress='return validar_texto(event)' tabindex="31"/>
     </p>
          <input type="text" name= "txt_nombrePMC-S" id="txt_nombrePMC-S" onkeypress='return validar_texto(event)' tabindex="34"/>
        </p></td>
      <td width="21%"><p>
        <input type="text" name= "txt_paternoPMC-P" id="txt_paternoPMC-P" onkeypress='return validar_texto(event)' tabindex="32"/>
      </p>
        <p>
          <input type="text" name= "txt_paternoPMC-S" id="txt_paternoPMC-S" onkeypress='return validar_texto(event)' tabindex="35"/>
        </p></td>
      <td width="22%"><p>
        <input type="text" name= "txt_maternoPMC-P" id="txt_maternoPMC-P" onkeypress='return validar_texto(event)' tabindex="33"/>
      </p>
        <p>
          <input type="text" name= "txt_maternoPMC-S" id="txt_maternoPMC-S" onkeypress='return validar_texto(event)' tabindex="36"/>
        </p></td>
      <td width="12%"><p>
        <input type="checkbox" name="ck_PMC-P" value="P" checked="checked" disabled="disabled"/>        
        P </p>
        <p>
          <input type="checkbox" name="ck_PMC-S" value="S" checked="checked" disabled="disabled"/>
          S </p></td>
    </tr>
    <tr>
     <td width="25%">Partido Movimiento Regeneración Nacional (MORENA)</td>
      <td width="20%"><p>
        <input type="hidden" name="id_integra17" id="id_integra17" value ="17" />
        <input type="text" name="txt_nombreMOR-P" id="txt_nombreMOR-P" onkeypress='return validar_texto(event)' tabindex="43"/>
        </p>
        <p>
        <input type="text" name="txt_nombreMOR-S" id="txt_nombreMOR-S" onkeypress='return validar_texto(event)' tabindex="46"/>
        </p></td>
      <td width="21%"><p>
        <input type="text" name="txt_paternoMOR-P" id="txt_paternoMOR-P" onkeypress='return validar_texto(event)' tabindex="44"/>
        </p>
        <p>
        <input type="text" name="txt_paternoMOR-S" id="txt_paternoMOR-S" onkeypress='return validar_texto(event)' tabindex="47"/>
       </p></td>
      <td width="22%">
        <input type="text" name="txt_maternoMOR-P" id="txt_maternoMOR-P" onkeypress='return validar_texto(event)' tabindex="45"/>
      </p>
      <p>
       <input type="text" name="txt_maternoMOR-S" id="txt_maternoMOR-S" onkeypress='return validar_texto(event)' tabindex="48"/>
      </p></td>
      <td width="12%"><p>
      <input type="checkbox" name="ck_MOR-P" value="P" checked="checked" disabled="disabled"/> 
      P </p>
        <p>
  <input type="checkbox" name="ck_MOR-S" value="S" checked="checked" disabled="disabled"/>
          S </p></td>
    </tr>
 
  <tr>
      <td width="25%">Partido Encuentro Solidario (PES)</td>
      <td width="20%"><p>
        <input type="hidden" name="id_integra19" id="id_integra19" value ="19" />
        <input type="text" name= "txt_nombrePES-P" id="txt_nombrePES-P" onkeypress='return validar_texto(event)' tabindex="49"/>
      </p>
        <p>
          <input type="text" name= "txt_nombrePES-S" id="txt_nombrePES-S" onkeypress='return validar_texto(event)' tabindex="52"/>
        </p></td>
      <td width="21%"><p>
        <input type="text" name= "txt_paternoPES-P" id="txt_paternoPES-P" onkeypress='return validar_texto(event)' tabindex="50"/>
      </p>
        <p>
          <input type="text" name= "txt_paternoPES-S" id="txt_paternoPES-S" onkeypress='return validar_texto(event)' tabindex="53"/>
        </p></td>
      <td width="22%"><p>
        <input type="text" name= "txt_maternoPES-P" id="txt_maternoPES-P" onkeypress='return validar_texto(event)' tabindex="51"/>
      </p>
        <p>
          <input type="text" name= "txt_maternoPES-S" id="txt_maternoPES-S" onkeypress='return validar_texto(event)' tabindex="54"/>
        </p></td>
      <td width="12%"><input type="checkbox" name="ck_PES-P" value="P" checked="checked" disabled="disabled"/>
P <br /> <br />
<input type="checkbox" name="ck_PES-S" value="S" checked="checked" disabled="disabled"/>
S </td>
    </tr>
     <tr>
      <td width="25%">Partido Redes Sociales Progresistas (RSP)</td> <!-- antes Partido humanista -->
      <td width="20%"><p>
        <input type="hidden" name="id_integra20" id="id_integra20" value ="20" />
        <input type="text" name= "txt_nombrePH-P" id="txt_nombrePH-P" onkeypress='return validar_texto(event)' tabindex="55"/>
      </p>
        <p>
          <input type="text" name= "txt_nombrePH-S" id="txt_nombrePH-S" onkeypress='return validar_texto(event)' tabindex="58"/>
        </p></td>
      <td width="21%"><p>
        <input type="text" name= "txt_paternoPH-P" id="txt_paternoPH-P" onkeypress='return validar_texto(event)' tabindex="56"/>
      </p>
        <p>
          <input type="text" name= "txt_paternoPH-S" id="txt_nombrePNA-S" onkeypress='return validar_texto(event)' tabindex="59"/>
        </p></td>
      <td width="22%"><p>
        <input type="text" name= "txt_maternoPH-P" id="txt_maternoPH-P" onkeypress='return validar_texto(event)' tabindex="57"/>
      </p>
        <p>
          <input type="text" name= "txt_maternoPH-S" id="txt_maternoPH-S" onkeypress='return validar_texto(event)' tabindex="60"/>
        </p></td>
      <td width="12%"><p>
       <input type="checkbox" name="ck_PH-P" value="P" checked="checked" disabled="disabled"/> 
        P</p>
        <p>
       <input type="checkbox" name="ck_PH-S" value="S" checked="checked" disabled="disabled"/>
        S </p></td>
    </tr>
   
     <tr>
      <td width="25%">Fuerza Social por México (FSM)</td> <!-- Nuevo partido  -->
      <td width="20%"><p>
        <input type="hidden" name="id_integra21" id="id_integra21" value ="21" />
        <input type="text" name= "txt_nombrePFSM-P" id="txt_nombrePFSM-P" onkeypress='return validar_texto(event)' tabindex="55"/>
      </p>
        <p>
          <input type="text" name= "txt_nombrePFSM-S" id="txt_nombrePFSM-S" onkeypress='return validar_texto(event)' tabindex="58"/>
        </p></td>
      <td width="21%"><p>
        <input type="text" name= "txt_paternoPFSM-P" id="txt_paternoPFSM-P" onkeypress='return validar_texto(event)' tabindex="56"/>
      </p>
        <p>
          <input type="text" name= "txt_paternoPFSM-S" id="txt_nombrePFSM-S" onkeypress='return validar_texto(event)' tabindex="59"/>
        </p></td>
      <td width="22%"><p>
        <input type="text" name= "txt_maternoPFSM-P" id="txt_maternoPFSM-P" onkeypress='return validar_texto(event)' tabindex="57"/>
      </p>
        <p>
          <input type="text" name= "txt_maternoPFSM-S" id="txt_maternoPFSM-S" onkeypress='return validar_texto(event)' tabindex="60"/>
        </p></td>
      <td width="12%"><p>
       <input type="checkbox" name="ck_PFSM-P" value="P" checked="checked" disabled="disabled"/> 
        P</p>
        <p>
       <input type="checkbox" name="ck_PFSM-S" value="S" checked="checked" disabled="disabled"/>
        S </p></td>
    </tr>
<tr>
      <td width="25%">Partido Equidad, Libertad y Genero (ELIGE)</td><!-- antes PNA -->
      <td width="20%"><p>
        <input type="hidden" name="id_integra18" id="id_integra18" value ="18" />
        <input type="text" name= "txt_nombrePNA-P" id="txt_nombrePNA-P" onkeypress='return validar_texto(event)' tabindex="37"/>
      </p>
        <p>
          <input type="text" name= "txt_nombrePNA-S" id="txt_nombrePNA-S" onkeypress='return validar_texto(event)' tabindex="40"/>
        </p></td>
      <td width="21%"><p>
        <input type="text" name= "txt_paternoPNA-P" id="txt_paternoPNA-P" onkeypress='return validar_texto(event)' tabindex="38"/>
      </p>
      <p>
          <input type="text" name= "txt_paternoPNA-S" id="txt_paternoPNA-S" onkeypress='return validar_texto(event)' tabindex="41"/>
      </p></td>
      <td width="22%"><p>
        <input type="text" name= "txt_maternoPNA-P" id="txt_maternoPNA-P" onkeypress='return validar_texto(event)' tabindex="39"/>
      </p>
      <p>
          <input type="text" name= "txt_maternoPNA-S" id="txt_maternoPNA-S" onkeypress='return validar_texto(event)' tabindex="42"/>
      </p></td>
      <td width="12%"><input type="checkbox" name="ck_PNA-P" value="P" checked="checked" disabled="disabled"/>
      P <br /> <br />
<input type="checkbox" name="ck_PNA-S" value="S" checked="checked" disabled="disabled"/>
      S </td>
    </tr>
	
  </table>
  <br />
<table width="91%" height="60" border="0">
    <tr bgcolor="#CCCCFF">
      <td width="25%" rowspan="2" align="center"><strong>Integracion de Candidatos Sin partido</strong></td>
      <td colspan="3" align="center"><strong>Nombres de los integrantes de Candidatos Independientes</strong></td>
      <td width="11%" rowspan="2" align="center"><strong>Tipo de acreditación</strong></td>
    </tr>
    <tr bgcolor="#CCCCFF">
      <td class="subtitulo"> Nombre (s)</td>
      <td width="21%" class="subtitulo">Apellido Paterno</td>
      <td width="24%" class="subtitulo">Apellido Materno</td>
    </tr>
    <tr>
      <td width="25%">Representante C1</td>
      <td width="19%"><p>
       <input type="hidden" name="id_integra31" id="id_integra31" value ="31" />
        <input type="text" name= "txt_nombreCI1-P" id="txt_nombreCI1-P" onkeypress='return validar_texto(event)' tabindex="61"/>
      </p>
        <p>
          <input type="text" name= "txt_nombreCI1-S" id="txt_nombreCI1-S" onkeypress='return validar_texto(event)' tabindex="64"/>
        </p></td>
      <td width="21%"><p>
        <input type="text" name= "txt_paternoCI1-P" id="txt_paternoCI1-P" onkeypress='return validar_texto(event)' tabindex="62"/>
      </p>
      <p>
      <input type="text" name= "txt_paternoCI1-S" id="txt_paternoCI1-S" onkeypress='return validar_texto(event)' tabindex="65"/>
      </p></td>
      <td width="24%"><p>
        <input type="text" name= "txt_maternoCI1-P" id="txt_paternoCI1-P" onkeypress='return validar_texto(event)' tabindex="63"/>
      </p>
      <p>
          <input type="text" name= "txt_maternoCI1-S" id="txt_maternoCI1-S" onkeypress='return validar_texto(event)' tabindex="66"/>
        </p></td>
     <td width="11%"><input type="checkbox" name="ck_CI1-P" value="P" checked="checked" disabled="disabled"/>        
      P <br />
     <input type="checkbox" name="ck_CI1-S" value="S" checked="checked" disabled="disabled"/>
      S </td>
    </tr>
	<tr>
	<td>Candidato  DMR:</td>
       <input type="hidden" name="id_integra32" id="id_integra32" value ="32" />
		<td colspan="4"> <input	type="tex" name="txt_namecandidatoDMR" id ="txt_namecandidatoDMR" onkeypress='return validar_texto(event)' /></td>		
	</tr>
	<tr>
	<td>&nbsp;</td>
		<td colspan="4"> <!--<input	type="tex" name="txt_puestocandidatoDMR" id ="txt_puestocandidatoDMR" onkeypress='return validar_texto(event)' /> --></td>		
	</tr>
    <tr>
      <td width="25%">Representantes C2</td>
      <td width="19%"><p>

       <input type="text" name="txt_nombreCI2-P" id="txt_nombreCI2-P" onkeypress='return validar_texto(event)' tabindex="67"/>
       </p>
        <p><input type="text" name="txt_nombreCI2-S" id="txt_nombreCI2-S" onkeypress='return validar_texto(event)' tabindex="70"/>
        </p></td>
       <td width="21%"><p>
       <input type="text" name="txt_paternoCI2-P" id="txt_paternoCI2-P" onkeypress='return validar_texto(event)' tabindex="68"/>
       </p>
       <p>
       <input type="text" name="txt_paternoCI2-S" id="txt_paternoCI2-S" onkeypress='return validar_texto(event)' tabindex="71"/>
       </p></td>
       <td width="24%"><p>
       <input type="text" name="txt_maternoCI2-P" id="txt_maternoCI2-P" onkeypress='return validar_texto(event)' tabindex="69"/>
       </p>
       <p>
       <input type="text" name="txt_maternoCI2-S" id="txt_maternoCI2-S" onkeypress='return validar_texto(event)' tabindex="72"/>
       </p></td>
      <td width="11%"><input type="checkbox" name="ck_CI2-P" value="P" checked="checked" disabled="disabled"/>        
       P <br />
       <input type="checkbox" name="ck_CI2-S" value="S" checked="checked" disabled="disabled"/>
       S </td>
    </tr>
	<tr>
	<td> Candidato Alcaldía 1:</td>
    <input type="hidden" name="id_integra33" id="id_integra33" value ="33" />
	<td colspan="4"> <input	type="tex" name="txt_namecandidatoALCALDE" id ="txt_namecandidatoALCALDE" onkeypress='return validar_texto(event)' /></td>		
	</tr>
	<tr>
	<td>&nbsp;</td>
	<td colspan="4">&nbsp;	</td>		
	</tr>
    <tr>
      <td width="25%">Reperesentantes C3</td>
      <td width="19%"><p>
       
       <input type="text" name="txt_nombreCI3-P" id="txt_nombreCI3-P" onkeypress='return validar_texto(event)' tabindex="73"/>
       </p>
       <p>
       <input type="text" name="txt_nombreCI3-S" id="txt_nombreCI3-S" onkeypress='return validar_texto(event)' tabindex="76"/>
       </p></td>
       <td width="21%"><p>
        <input type="text" name="txt_paternoCI3-P" id="txt_paternoCI3-P" onkeypress='return validar_texto(event)' tabindex="74"/>
       </p>
       <p>
       <input type="text" name="txt_paternoCI3-S" id="txt_paternoCI3-S" onkeypress='return validar_texto(event)' tabindex="76"/>
        </p></td>
      <td width="24%"><p>
        <input type="text" name="txt_maternoCI3-P" id="txt_maternoCI3-P" onkeypress='return validar_texto(event)' tabindex="75"/>
        </p>
        <p>
        <input type="text" name="txt_maternoCI3-S" id="txt_maternoCI3-S" onkeypress='return validar_texto(event)' tabindex="77"/>
        </p></td>
      <td width="11%"><input type="checkbox" name="ck_CI3-P" value="P" checked="checked" disabled="disabled"/>         
        P <br />
      <input type="checkbox" name="ck_CI3-S" value="S" checked="checked" disabled="disabled"/>  
		S </td>
    </tr>
	<tr>
	<td>Candidato Alcaldía 2:</td>
<input type="hidden" name="id_integra34" id="id_integra34" value ="34" />
    <input type="hidden" name="id_integra33" id="id_integra33" value ="33" />
	<td colspan="4"> <input	type="tex" name="txt_namecandidatoALCALDE" id ="txt_namecandidatoALCALDE" onkeypress='return validar_texto(event)' /></td>		
	</tr>
	<tr>
	<td>&nbsp;</td>
	<td colspan="4"><!--<input	type="tex" name="txt_puestocandidatoALCALDE" id ="txt_puestocandidatoALCALDE" onkeypress='return validar_texto(event)' />--></td>	
	</tr>
     <tr>
      <td width="25%">Reperesentantes C4</td>
      <td width="19%"><p>
     
       <input type="text" name="txt_nombreCI4-P" id="txt_nombreCI4-P" onkeypress='return validar_texto(event)' tabindex="78"/>
       </p>
       <p>
       <input type="text" name="txt_nombreCI4-S" id="txt_nombreCI4-S" onkeypress='return validar_texto(event)' tabindex="81"/>
       </p></td>
       <td width="21%"><p>
        <input type="text" name="txt_paternoCI4-P" id="txt_paternoCI4-P" onkeypress='return validar_texto(event)' tabindex="79"/>
       </p>
       <p>
       <input type="text" name="txt_paternoCI4-S" id="txt_paternoCI4-S" onkeypress='return validar_texto(event)' tabindex="82"/>
        </p></td>
      <td width="24%"><p>
        <input type="text" name="txt_maternoCI4-P" id="txt_maternoCI4-P" onkeypress='return validar_texto(event)' tabindex="80"/>
        </p>
        <p>
        <input type="text" name="txt_maternoCI4-S" id="txt_maternoCI4-S" onkeypress='return validar_texto(event)' tabindex="83"/>
        </p></td>
      <td width="11%"><input type="checkbox" name="ck_CI4-P" value="P" checked="checked" disabled="disabled"/>         
        P <br />
      <input type="checkbox" name="ck_CI4-S" value="S" checked="checked" disabled="disabled"/>  
		S </td>
    </tr>
  </table>
      	 <center>
         <div id="errorMsg" style="display:none">Favor de esperar un momento...</div> 
         </center>
 </br>
 </br>
  
   <input type="submit"  style = "cursor:pointer;" name="submit" id="button" value="Enviar" class="btn btn-primary"/>
   <p></p>
    <input type="button" style = "cursor:pointer;" name="cancelar" id="cancelar" value="Cancelar" onclick="history.back()" class="btn btn-default"/>
  
</form>
	
<?php	
	}
}
?>

</center>
<footer class="py-4 bg-light mt-auto">
        <?php include('footer.php'); ?>
	</footer>
</div>
</div>
</body>
</html>