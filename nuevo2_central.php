<?php 
session_start();
error_reporting(E_ERROR | E_PARSE);
$nombre_area=$_SESSION['user'];
$perfil=$_SESSION['grupo'];
$id_distrito = $_SESSION['id_distrito'];	

$name= $_SESSION['transaccion'];
$grup=$_SESSION['grupo'];


$id_distrito=$_SESSION[id_distrito];
$id_admin=$_SESSION[id_admin];



?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<!--<link href="style.css" rel="stylesheet" type="text/css" />-->

<script type="text/javascript" src="js/jquery-1.4.3.min.js"></script>


<title>.: SISESECD  :.</title>
   <!-- Bootstrap core CSS -->
      <link href="css/bootstrap.min.css" rel="stylesheet">
      <link href="css/mycss.css" rel="stylesheet">
      <link rel="stylesheet" type="text/css" href="style001.css">
	  <!-- Bootstrap core JavaScript
      ================================================== -->
      <script src="js/jquery-3.3.1.min.js"></script>
      <script src="js/popper.min.js"></script>
      <script src="js/bootstrap.min.js"></script>
      <!--<script src="js/holder.min.js"></script>-->
	<script src="js/bootstrap.bundle.min.js" crossorigin="anonymous"></script>
    <script src="js/scripts.js"></script>
      <script src="js/funcionesajax.js"></script>
      <link rel="stylesheet" href="css/all.css">
      <style>
      .derecha{float:right;}
      .tableCenter{text-align: center;}
      </style>
	
	
<script type="text/javascript" src="epoch_classes.js"></script>


 <body class="sb-nav-fixed">
        <nav class="sb-topnav navbar navbar-expand navbar-dark bg-dark">
            <a class="navbar-brand" href="grid_sesiones_central.php">Sistema de Seguimiento a las Sesiones de los Consejos Distritales - <b>SISESECD</b><br>
            Proceso Electoral Local Ordinario 2020-2021</a>
            <div class="col-md-6"></div>
            <ul class="navbar-nav ml-auto ml-md-0">
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" id="userDropdown" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><i class="fas fa-user fa-fw"></i></a>
                    <div class="dropdown-menu dropdown-menu-right" aria-labelledby="userDropdown">
                        <div class="dropdown-divider"></div>
                        <a class="dropdown-item" href="/logout.php">Cerrar sesión</a>
                    </div>
                </li>
            </ul>
        </nav>
    </body>

	
    <body class="sb-nav-fixed">
        <div id="layoutSidenav">
            <div id="layoutSidenav_content">
            <main>
                    <div class="container-fluid">
						
                    <h1 class="mt-4"><img src="images/logo-header.png"></h1>

<div align="center">

<script type="text/javascript">
function validacion(frmClienteNuevo2) {
	
	if(frmClienteNuevo2.punto.value=="")
    {    
        alert('Debe seleccionar un un numero de punto.')   
        return false;   
    }
	
	if(frmClienteNuevo2.descpunto.value=="")
		{
		alert('Debe ingresar la descripción del punto')
			return false;
		}
	
	
}
</script>
<?php

include 'config_open_db.php';
include 'arreglos.php';
	
$id_sesion=$_REQUEST['id_sesion'];
	
$sql_select = "select * from sisesecd_sesiones where id_sesion=$id_sesion; ";
//echo $sql_select;
$exec=sqlsrv_query($conn, $sql_select);
$row = sqlsrv_fetch_array ($exec);
	
$tiposesion=$row[tipo_sesion];
$nosesion=$row[nosesion];
$desc=$row[desc_sesion];

if(isset($_REQUEST['submit'])){
	//$idsesion = htmlspecialchars(trim($_REQUEST["idsesion"]));
	$obligatorio=$_POST['obligatorio'];
	$avotar=$_POST['avotar'];
	$punto = $_REQUEST['punto'];
	$descpunto = utf8_decode(htmlspecialchars(trim($_REQUEST['descpunto'])));

	//// validacion de punto repetido //////////////////
//$sqls_cuantos = "select count(*) as cuantos from sisesecd_ordendia where punto=$punto and id_sesion=$id_sesion and estatus=1; ";
//echo $select;
//$doit=ifx_query($sqls_cuantos, $conn);
//$fila = ifx_fetch_row ($doit);
//$point=$fila[cuantos];

//if($point==0){
	$sql_insert="";
	$sql_insert="INSERT INTO sisesecd_ordendia(id_sesion, punto, desc_punto,obligatorios,para_votar,estatus,estatus_noaplica) VALUES ($id_sesion, '$punto', '$descpunto',$obligatorio,$avotar,1,1);";	
	

//echo 	$sql_insert;

	if (sqlsrv_query($conn,$sql_insert) == true){
		//echo 'Datos guardados';
		
		$sql_update="UPDATE sisesecd_sesiones SET con_orden=1 WHERE id_sesion=$id_sesion";
		
		if (sqlsrv_query($conn,$sql_update)== true){
				echo'<p>&nbsp;</p>';
				echo '<div align="center">';
				echo'<table width="166" border="0" cellpadding="0" cellspacing="0">
				  <tr>
					<td width="156" align="center"><img src="images/ajax-loader.gif" width="160" height="24" /></td>
				  </tr>
				  <tr>
					<td align="center">CREANDO</td>
				  </tr>
				</table>';			
				echo'<SCRIPT LANGUAGE="javascript">';
				echo'alert("El Punto se creó Exitosamente")';
				echo'</SCRIPT>';
				echo'<SCRIPT LANGUAGE="javascript">';
				echo'history.go(-2)';
				echo'</SCRIPT>';
		}
		else{
			echo 'Se produjo un error al guardar historico. Intente nuevamente '.sqlsrv_errors();
		} 
	}
	else{
		echo 'Se produjo un error. Intente nuevamente '.sqlsrv_errors();
	}
		//}else{
			/*echo'	<SCRIPT LANGUAGE="javascript">';
			echo' alert("El punto del orden del dia ya existe.\n ");';
			echo'	</SCRIPT>';
			
			echo'<SCRIPT LANGUAGE="javascript">';
			echo'	location.href = "./grid_orden_dia_central.php?idsesion='.$_REQUEST['id_sesion'].'";';
			echo'	</SCRIPT>';	*/
		//}
}
else{

?>
		    <div class="card mb-4">
	<div class="card-header">
     <b>Nuevo Punto del Orden del día de la <?php echo $nom_sesion[$nosesion].' sesion de los Consejos Distritales '.$tipo_ses[$tiposesion].' 0'.$desc;  ?></b>
    </div>


<form id="frmClienteNuevo2" name="frmClienteNuevo2" method="post" action="nuevo2_central.php" onsubmit="validacion(this);"  >
<br>
	
 <div class="form-group row">
   
 <label class="col-sm-3 control-label">Punto</label>
	 
<input class="text" type="hidden" name="page" id="page" value="<?php echo $_REQUEST["page"]; ?>" />
<input class="text" type="hidden" name="id_sesion" id="id_sesion" value="<?php echo $_REQUEST["id_sesion"]; ?>" />

<div class="col-sm-4" >
<?php 
	echo'<select name="punto" id="punto">';
	echo'<option value= "PP1"> PP1</option>';
	echo'<option value= "PP2"> PP2</option>'; 
	 
		for($i=1;$i<=50;$i++)
		{
		echo '<option value='.$i.'>'.$i.' </option>'; 
		}
	echo '</select>';
	
     ?>
</div>
</div>
	
<div class="form-group row">
   
 <label class="col-sm-3 control-label"> Descripción</label>
 
<div class="col-sm-4" >
    <textarea name="descpunto" rows="10"  cols="100" id="descpunto" type="text" maxlength="500"></textarea>
</div>
</div>
	
<div class="form-group row">
   
 <label class="col-sm-3 control-label"> Punto Obligatorio:</label>
	
<div class="col-sm-4" >

<label class="col-sm-3 control-label">Sí</label>

<input type="radio" name="obligatorio" id="obligatoriosi" value="1" checked/>
</div>
	<div class="col-sm-4" >
<label class="col-sm-3 control-label">No</label>

<input type="radio" name="obligatorio" id="obligatoriono" value="0"/>
</div>
</div>
	
<div class="form-group row">
   
 <label class="col-sm-3 control-label"> Punto para Votar:</label>
<div class="col-sm-4" >
<label class="col-sm-3 control-label">Sí</label>

<input type="radio" name="avotar" id="avotarsi" value="1" checked/>
</div>
	
<div class="col-sm-4" >
<label class="col-sm-3 control-label">No</label>

<input type="radio" name="avotar" id="avotarno" value="0"/>
</div>
</div>

   <div class="form-group row">
 <div class="checkbox col-sm-4"> 

    <input class="btn btn-info btn-block" type="submit" name="submit" id="button" value="Enviar" />
	   </div>
 <div class="checkbox col-sm-4">
	<input class="btn btn-info btn-block" type="button" name="cancelar" id="cancelar" value="Cancelar" onclick="javascript:history.back()" />
	   </div>
	</div>
	
</form>
</table>
<?php
}
?>
</div>
	  </div>
                    </div>
                    </div>
            </main>
				
<footer class="py-4 bg-light mt-auto">
                    <?php include('footer.php'); ?>
                </footer>
</body>
</html>