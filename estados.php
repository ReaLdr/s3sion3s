<?php 
session_start();
error_reporting(E_ERROR | E_PARSE);

if (isset($_SESSION['user'])) {

$nombre_area=$_SESSION['user'];
$perfil=$_SESSION['grupo'];

	
}
else
{
	
	echo'<SCRIPT LANGUAGE="javascript">';
	echo'	location.href = "index.php";';
	echo'	</SCRIPT>';
}

$name= $_SESSION['transaccion'];
$id_distrito=$_SESSION['id_distrito'];

$nosesion=$_GET['nosesion'];
//$idsesion=$_GET['id_sesion'];

//echo $idsesion;
include('arreglos.php');

?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<!--<link href="style.css" rel="stylesheet" type="text/css" />-->
<script type="text/javascript" src="js/jquery-1.4.3.min.js"></script>
<link href="css/stilacho.css" rel="stylesheet" type="text/css" />
<link href="css/animate.css" rel="stylesheet" type="text/css" />


<script type="text/javascript" src="fancybox/jquery.fancybox-1.3.4.js"></script>
<link rel="stylesheet" type="text/css" href="fancybox/jquery.fancybox-1.3.4.css" media="screen" />

<!--<script src="js/jquery-3.2.1.min.js"></script>-->
<script src="js/bootstrap.min.js"></script>
<link rel="stylesheet" href="//cdnjs.cloudflare.com/ajax/libs/timepicker/1.3.5/jquery.timepicker.min.css">
    
    <script src="//cdnjs.cloudflare.com/ajax/libs/timepicker/1.3.5/jquery.timepicker.min.js"></script>
<link rel="stylesheet" href="css/bootstrap.min.css">
<link rel="stylesheet" href="css/jquery-ui.css">
<title>.: SISESECD 2018 :.</title>

<script>
function validar_texto(a) { 
    tecl = (document.all) ? a.keyCode : a.which; 
    if (tecl==8) return true; 
//    patro =/[a-zA-Záéíóúäëïöü0ñÑ.-9\s]/; 
	patro =/[a-z A-Z áéíóúäëïöü0ñÑ 0-9\-\.\?\,\"\@\:\()\;\*\+&%\$#_]/;
    t = String.fromCharCode(tecl); 
    return patro.test(t); 
} 

</script>


</head>
<?php include('header.php');	?>
<!--tabla para todos las pantallas -->
    <body class="sb-nav-fixed">
        <div id="layoutSidenav">
            <div id="layoutSidenav_content">

                    <div class="container-fluid">
	            <h1 class="mt-4"><img src="images/logo-header.png"></h1>
	<p>&nbsp;</p>
							
			<div class="top-menu">		
				
<table border="0" style="width: 90%;">
  <tr>
    <td width="159" height="25" align="left" class="well">Usuario: <?php echo $name; ?></td>
    <td width="555" align="left" class="well">Consejo Distritital: <?php echo $id_distrito; ?></td>
    <td width="542" align="center"><?php echo"<a class='btn btn-primary' href='javascript:history.back(-2)'> Regresar </a>";?></td>
     
   <td width="169" align="right"><a class="btn btn-default"  href="logout.php">Cerrar Sesion</a></td>
  </tr>
</table>
	
						</div>	
<?php

$variable= $_REQUEST["page"];

$id_sesion = htmlspecialchars(trim($_REQUEST['id_sesion']));
$movimiento = htmlspecialchars(trim($_POST['movimiento']));

// Consigo datos a desplegar solo de muestra
//$encabezado = "-ERROR DE LECTURA-";

require('functions.php');
include 'config_open_db.php';

$distrito=$d_romano[$_SESSION['id_distrito']];

if(isset($_REQUEST['id_sesion']))
{
	//contar primero
	$sql_count="Select count(*) as cuantos from sisesecd_sesiones where id_sesion=".$_REQUEST['id_sesion'].";";		
	//echo $sql_count;
	$exec_count = sqlsrv_query($conn, $sql_count);
		
		$row_count1 = sqlsrv_fetch_array($exec_count);
		//$cuantos1=0;
		$cuantos1=$row_count1[cuantos];
			
	$tmpSesion="Select * from sisesecd_sesiones where id_sesion=".$_REQUEST['id_sesion'].";";
	//echo $tmpSesion;

	$consultaSesion = sqlsrv_query($conn, $tmpSesion);
	
	if ($cuantos1>0){
	
		//// Aqui consigo datos a desplegar 
		$registro = sqlsrv_fetch_array($consultaSesion);
		$descripcion=$registro['desc_sesion'];
		$typesess=$registro['tipo_sesion'];
		
		$encabezado = "".$nom_sesion[$registro['nosesion']]." Sesión ".$tipo_sesion[$registro['tipo_sesion']]." de los Consejos Distritales 0".$descripcion."";
		echo '<br/>';
		echo '<br/>';

	}
	else{
		echo 'Se produjo un error. No se encontraron datos de la Sesion Distrital:  '.sqlsrv_errors();
		return;
	} 
}

if(isset($_POST['submit'])){
	
	$idestado = htmlspecialchars(trim($_POST['idestado']));
	$descripcion = htmlspecialchars(trim($_POST['descripcion']));
	$horainicioreal = htmlspecialchars(trim($_POST['hora_inicio']));
	$horatermino = htmlspecialchars(trim($_POST['hora_fin']));
	$estado_sesion= htmlspecialchars(trim($_POST['estado_sesion']));
	$page =  htmlspecialchars(trim($_POST['page'])); 
	$fecha_alta=date('d-m-Y');

	
	$movimiento=htmlspecialchars(trim($_POST['movimiento'])); 
	$tmpSQL="";


		$tmpSQL="INSERT INTO sisesecd_estado_sesion values (".$id_sesion.", ".$id_distrito.",".$estado_sesion.",'".$descripcion."', '".$horainicioreal."', '".$horatermino."', '".$fecha_alta."');";
	
  //}

//echo $tmpSQL;
	//exit;

	if (sqlsrv_query($conn, $tmpSQL)== true ){
		echo 'Datos guardados';
		
				
		$sql_update="UPDATE sisesecd_sesiones SET con_inicio=1 WHERE id_sesion=$id_sesion";
		if (sqlsrv_query($conn, $sql_update))
				{
				
							
echo'<table width="166" border="0" cellpadding="0" cellspacing="0">
  <tr>
    <td width="156" align="center"><img src="images/ajax-loader.gif" width="160" height="24" /></td>
  </tr>
  <tr>
    <td align="center">ACTUALIZANDO</td>
  </tr>
</table>';
			echo'	<SCRIPT LANGUAGE="javascript">';
					
					echo' 	alert("La Sesion se actualizo Exitosamente")';
					
					echo'	</SCRIPT>';
					echo'<SCRIPT LANGUAGE="javascript">';
	
						
					echo'history.go(-2)
					history.back ()';
					echo'	</SCRIPT>';
					
		}
		else{
			echo 'Se produjo un error al guardar historico. Intente nuevamente '.sqlsrv_errors();
		} 
	}
	else{
		echo 'Se produjo un error. Intente nuevamente '.sqlsrv_errors();
	} 
	
}else{
	$consulta ="";
	$cliente ="";

	

	}
	
	//ES NUEVO
		//$consulta = mysql_query("SELECT * FROM iniciosesion WHERE idsesion =".$_REQUEST['idsesion']);
		//$cliente = mysql_fetch_array($consulta);
		
?>

						<p>&nbsp;</p>
						<center>
	<div class="card mb-4">
	<div class="card-header">
     <b><center>Estado de la <?php echo $encabezado ?></center></b>
	
    </div>
						
<form id="frmClienteNuevo" name="frmClienteNuevo" method="post"  >
  
  <input type="hidden" name="movimiento" id="movimiento" value="NUEVO" />
    
 <br />

  <p>
</p>
  <table width="485" border="0" align="center" class="form-group">
  
    <tr>
      <td colspan="6" align="center">Selecciona el estado de la sesion: </td>
    </tr>
    <tr>
      <td colspan="4" align="center">
         <select name="estado_sesion" id="estado_sesion" class="form-control">
          <option value="2">Sin Quorum</option>
          <option value="3">Segunda Convocatoria</option>
          <option value="5">En receso</option>
          <option value="6">Concluyo receso</option>
          <option value="7">Suspendida</option>
          <option value="8">Reanudada</option>
          <option value="9">Prolongada</option>

      </select></td>
    </tr>
    <tr>
      <td colspan="4" align="center">&nbsp;</td>
    </tr>
    <tr align="center">
      <td  colspan="6"><p>Hora  inicio:
        <input name="hora_inicio" type="text"  id="hora_inicio" size="5" class="form-control" placeholder="hh:mm" onkeypress="return numeros(event)"/>
        &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</p>
        <p> 
          Hora termino:
          <input name="hora_fin" type="text"  id="hora_fin" size="5" class="form-control" placeholder="hh:mm" onkeypress="return numeros(event)" maxlength="5"/>
        </p></td>
    </tr>
    <tr>
      <td colspan="4">&nbsp;</td>
    </tr>
    <tr>
      <td width="186"><br /></td>
      <td width="90">Descripci&oacute;n:</td>
      <td width="490"><textarea class="form-control" type="text" cols="35" rows="5" name="descripcion" id="descripcion" onkeypress='return validar_texto(event)'></textarea></td>
      <td width="143">&nbsp;</td>
    </tr>
  </table>

<p>
    <input type="submit"  style = "cursor:pointer;" name="submit" id="button" value="Enviar" class="btn btn-primary" />
</p>
<p><br>
  <input type="button" style = "cursor:pointer;" name="cancelar" id="cancelar" value="Cancelar" onclick="history.back ()" class="btn btn-default"/>
</p>
</form>
	</center>
		<div id="log">
		</div>

<script type="text/javascript">
	function numeros(e) {
    tecla = (document.all) ? e.keyCode : e.which;

    //Tecla de retroceso para borrar, siempre la permite
    if (tecla == 8) {
        return true;
    }

    // Patron de entrada, en este caso solo acepta numeros y letras
    patron = /[0-9:]/;
    //ä,ë,ï,ö,ü
    tecla_final = String.fromCharCode(tecla);
    return patron.test(tecla_final);
}
	$(function() {
            $('#hora_fin').timepicker({
                'timeFormat': 'HH:mm'
            });
        });
</script>
<footer class="py-4 bg-light mt-auto">
	<?php include('footer.php'); ?>
</footer>

</div>
</div>

</body>
</html>