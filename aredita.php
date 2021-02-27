<?php 
include 'arreglos.php';
session_start();
error_reporting(E_ERROR | E_PARSE);
if (isset($_SESSION['user'])) {

$name= $_SESSION['user'];
$grup=$_SESSION['grupo'];

$id_distrito=$_SESSION['id_distrito'];
$iduser= $_SESSION['transaccion']; 
	
	
}
else
{
	echo' 	alert("Debe iniciar una sesion")';	
	echo'	<SCRIPT LANGUAGE="javascript">';
	echo'	location.href = "index.php";';
	echo'	</SCRIPT>';
}



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


<script>
function validacion(frmNuevo) {
	

 	if(frmNuevo.partidos.value==0)
    {    
        alert('Debe seleccionar un tipo de partido.')   
        return false   
   	
	}
	
	if(frmNuevo.namerep.value=="")
    {    
        alert('Debe ingresar el nombre.')   
        return false   
    	} 
	if(frmNuevo.paterno.value=="")
    {    
        alert('Debe ingresar el apellido paterno.')   
        return false   
    	} 
	if(frmNuevo.materno.value=="")
    	{    
        alert('Debe ingresar el apellido materno.')   
        return false   
    	}
	
		if(frmNuevo.tipo.value==0)
    	{    
        alert('Debe seleccionar una Tipo de acreditacion.')   
        return false   
    	}
	
	if(frmNuevo.fecha_nombramiento.value=="")
    	{    
        alert('Debe seleccionar una Fecha de Nombramiento.')   
        return false   
    	}
	
	if(frmNuevo.oficio.value=="")
    	{    
        alert('Debe ingresar un numero de Oficio.')   
        return false   
    	}
		
	if(frmNuevo.presentado_notif.value==0)
    	{    
        alert('Debe seleccionar la opcion presentado en .')   
        return false   
    	}
	
	if(frmNuevo.fecha_concluye.value=="")
    	{    
        alert('Debe seleccionar una Fecha de Conclucion.')   
        return false   
    	}
	
	if(frmNuevo.oficio_concluye.value=="")
    	{    
        alert('Debe ingresar un numero de Oficio.')   
        return false   
    	}
		
	if(frmNuevo.presentado_concluye.value==0)
    	{    
        alert('Debe seleccionar la opcion presentado en .')   
        return false   
    	}
	
	
	}
	
	
</script>

</head>


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
<!--fin tabla para todos las pantallas -->
    <body class="sb-nav-fixed">
        <div id="layoutSidenav">
            <div id="layoutSidenav_content">
            <main>
                    <div class="container-fluid">
						
                    <h1 class="mt-4"><img src="images/logo-header.png"></h1>

<div align="center">
<?php
require('functions.php');
	
if(isset($_POST['submit'])){

	$id_distrito=$_SESSION[id_distrito];
	
	$partido = htmlspecialchars(trim($_POST['partidos']));
	$nombre 	= $_POST['namerep'];
	$paterno	 = $_POST['paterno'];
	$materno 	= $_POST['materno'];
	
	$tipo_acredita= htmlspecialchars(trim($_POST['tipo']));
	
	$fecha_notifica = htmlspecialchars(trim($_POST['fecha_nombramiento']));
	
	$oficio= htmlspecialchars(trim($_POST['oficio']));
	
	$presenta = htmlspecialchars(trim($_POST['presentado_notif']));
	
	
	
	$fecha_concluye = htmlspecialchars(trim($_POST['fecha_concluye']));
	
	$oficio_concluye= htmlspecialchars(trim($_POST['oficio_concluye']));
	
	$presenta_conlcuye = htmlspecialchars(trim($_POST['presentado_concluye']));
	
	//$domicilio = $_POST['domicilio'];
	
	$hoy= date('c');
  //exit;

	
	include 'config_open_db.php';

$sql_nuevo="INSERT INTO sisesecd_acreditarep(id_distrito, partido, nombre, paterno, materno, tipo_acredita, fecha_notifica, oficio, presenta,fecha_concluye, oficio_concluye,presenta_concluye, fecha_alta, usuario, fecha_modifica, estatus) values (".$id_distrito.",'".$partido."','".$nombre."','".$paterno."','".$materno."','".$tipo_acredita."','".$fecha_notifica."','".$oficio."','".$presenta."','".$fecha_concluye."','".$oficio_concluye."','".$presenta_conlcuye."','".$hoy. "',".$name.",'', 1);";


//echo $sql_nuevo;
//exit;
			

//echo $sql_nuevo;
					
if(sqlsrv_query($conn,$sql_nuevo)){
		
	include("bitacora.php");
		$accion="Ingreso Representante Acreditado".$id_distrito;
		bitacora($accion);	
	
echo'<p>&nbsp;</p>';echo'<p>&nbsp;</p>';echo'<p>&nbsp;</p>';echo'<p>&nbsp;</p>';echo'<p>&nbsp;</p>';echo'<p>&nbsp;</p>';
echo '<div align="center">';

echo'	<SCRIPT LANGUAGE="javascript">';
echo' 	alert("El registro se creo Exitosamente")';
echo'	</SCRIPT>';
echo'<SCRIPT LANGUAGE="javascript">';
echo'	location.href = "./main.php";';
//echo'history.go(-1)';
//history.back ()';
echo'	</SCRIPT>';
		}
		else
		{
echo 'Se produjo un error. Intente nuevamente ';
sqlsrv_errors();
			}

	
}	
else{
?>

<script src="js/jquery.textcount.js" type="text/javascript"></script>

<script>
$("#retrieved-data2").html="";
$("#retrieved-data2").hide();
	
</script>
<style>
	.tcAlert { color: orange; }
	.tcWarn { color: red; }
textarea{
	width:450px;
	height:120px;
	border:1px solid #ccc;
	padding:3px;
	color:black;
	font:12px Arial, sans-serif, Helvetica;
	}
</style>
	    <div class="card mb-4">
	<div class="card-header">
     <b>Ingrese los datos de los Representantes de Partido Político y Candidaturas sin Partido</b>
    </div>
	
	
<br><br>
<form id="frmNuevo" name="frmNuevo" method="post" action="aredita.php" onsubmit="return validacion(this)">

 
	 <div class="form-group row">
    <label class="col-sm-3 control-label">Nombre del Partido Politico: </label>
<div class="col-sm-4" >
	 <select name="partidos" id="partidos"  class="form-control" >
        <option value=0 selected="selected"> Seleccione una opción</option>
        <option value="PAN">PAN</option>
        <option value="PRI">PRI</option>
        <option value="PRD">PRD</option>
		<option value="PVM">PVEM</option>
        <option value="PT">PT</option>
        <option value="MC">MC</option>
		<option value="MORENA">MORENA</option>
		 <option value="PES">PES</option>
		 <option value="PRSP">PRSP</option>
		 <option value="FM">FM</option>
		 <option value="ELIGE">ELIGE</option>
       </select>
	</div>
 </div>
   
 <div class="form-group row">
 <label class="col-sm-3 control-label"> Nombre de la/el Representante: </label>
 	<div class="col-sm-4">

<input class="form-control input-small" type="text" id="namerep" name="namerep" value="<?php echo $namerep;?>" />

	 </div>
	</div>
	
     <div class="form-group row">
 <label class="col-sm-3 control-label"> Primer Apellido: </label>
 	<div class="col-sm-4">
    <input class="form-control input-small" type="text" id="paterno" name="paterno" value="<?php echo $paterno;?>" />

	 </div>
	</div>
	
	<div class="form-group row">
 <label class="col-sm-3 control-label"> Segundo Apellido: </label>
 	<div class="col-sm-4">
    <input class="form-control input-small" type="text" id="materno" name="materno" value="<?php echo $materno;?>" />

	 </div>
	</div>
	 	
	<div class="form-group row">
 <label class="col-sm-3 control-label"> Tipo de acreditacion: </label>
 	<div class="col-sm-4">
   <select class="form-control"  name="tipo" size="1" id="tipo">
        <option value=0 selected="selected"> Seleccione una opción</option>
        <option value="Propietario">Propietario</option>
        <option value="Suplente">Suplente</option>
       
    </select>
	 </div>
	</div>
	

     <div class="form-group row">
 <label class="col-sm-3 control-label"> Fecha de notificación del nombramiento:</label>
<div class="col-sm-4">
 <input class="form-control input-small" name="fecha_nombramiento" type="date" id="fecha_nombramiento"  value="<?php echo date("Y-m-j"); ?>"   />  
	<input type="hidden">
</div>
</div>
	
	
 <div class="form-group row">
 <label class="col-sm-3 control-label"> Oficio Nº:</label>
<div class="col-sm-4">
<input class="form-control input-small" type="text" id="oficio" name="oficio" value="<?php echo $oficio_num; ?>" />
</div>
</div>
	
	 	
	<div class="form-group row">
 <label class="col-sm-3 control-label">Presentado ante: </label>
 	<div class="col-sm-4">
   <select class="form-control"  name="presentado_notif" size="1" id="presentado_notif">
        <option value=0 selected="selected"> Seleccione una opción</option>
        <option value="SE">SE</option>
        <option value="CD">CD</option>
	   <option value="Presidencia del CG">Presidencia del CG</option>
       
    </select>
	 </div>
	</div>
	
	    <div class="form-group row">
 <label class="col-sm-3 control-label"> Fecha de conclusión de la función como representante:</label>
<div class="col-sm-4">
 <input class="form-control input-small" name="fecha_concluye" type="date" id="fecha_concluye"  value="<?php echo date("Y-m-j"); ?>"   />  
	<input type="hidden">
</div>
</div>
	
	
 <div class="form-group row">
 <label class="col-sm-3 control-label"> Oficio Nº:</label>
<div class="col-sm-4">
<input class="form-control input-small" type="text" id="oficio_concluye" name="oficio_concluye" value="<?php echo $oficio_concluye; ?>" />
</div>
</div>
	
	 	
	<div class="form-group row">
 <label class="col-sm-3 control-label">Presentado ante: </label>
 	<div class="col-sm-4">
   <select class="form-control"  name="presentado_concluye" size="1" id="presentado_concluye">
        <option value=0 selected="selected"> Seleccione una opción</option>
        <option value="SE">SE</option>
        <option value="CD">CD</option>
	   <option value="Presidencia del CG">Presidencia del CG</option>
       
    </select>
	 </div>
	</div>
	
	<div align="center">
 <div class="form-group row">
 <div class="checkbox col-sm-4">	 
<input class="btn btn-info btn-block" type="submit" name="submit" id="button" value="Enviar" />
	 </div>
 	<div class="checkbox col-sm-4">
<input  class="btn btn-info btn-block" type="button" name="cancelar" id="cancelar" value="Cancelar" onclick="javascript:history.back()" />
	</div>

</div>

	</div >	

</form>
 </table>
	   </div>
		
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