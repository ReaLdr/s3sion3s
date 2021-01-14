<?php 
header("Content-Type: text/html; charset=utf-8");
error_reporting(E_ERROR | E_PARSE);
session_start();

$name= $_SESSION['user'];
$grup=$_SESSION['grupo'];
//$grup=$_SESSION[transaccion];
$id_distrito=$_SESSION['id_distrito'];

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
function validacion(frmClienteActualizar2) {
	
	var period="<?php echo $p ?>";
	if(frmClienteActualizar2.punto.value==period)
    {    
        alert('Ya existe un punto con ese numero.')   
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

	
	<body class="sb-nav-fixed">
        <div id="layoutSidenav">
            <div id="layoutSidenav_content">
            <main>
                    <div class="container-fluid">
						
                    <h1 class="mt-4"><img src="images/logo-header.png"></h1>

<div align="center">



<?php
require('functions.php');
include 'config_open_db.php';
include 'arreglos.php';

	
if(isset($_POST['submit'])){
	
//if(isset($_REQUEST['submit'])){
	
	//echo"entrooooo submit";
	
	//$page=htmlspecialchars(trim($_POST['page']));
	$id_orden = htmlspecialchars(trim($_POST['id_orden']));
	$id_sesion = htmlspecialchars(trim($_POST['id_sesion']));
	$punto = htmlspecialchars(trim($_POST['punto']));
	$descpunto = utf8_decode(htmlspecialchars(trim($_POST['descpunto'])));
	$obligatorio=$_POST['obligatorio'];
	$avotar=$_POST['avotar'];

$sql_orden="select id_orden,punto from sisesecd_ordendia where punto='$punto' and id_sesion=$id_sesion and estatus=1;";
	//echo $sql_orden;
	
	$r_orden=sqlsrv_query($conn, $sql_orden);
		$d_orden = sqlsrv_fetch_array ($r_orden);
	
	$idor=$d_orden[id_orden];
	$pt=$d_orden[punto];
	
	

		
		$sql_update="UPDATE sisesecd_ordendia SET punto= '".$punto."', desc_punto= ' ".$descpunto."', obligatorios=".$obligatorio.", para_votar=".$avotar."
			where  id_orden=".$idor."";
		
		$sql_update=str_replace("\n","",$sql_update);
		$sql_update=str_replace("\r","",$sql_update);
 
 		//echo $sql_update;
	
		if(sqlsrv_query($conn,$sql_update))

		{
			
			
			//echo'Datos guardados estoy en un if ';
			echo'<SCRIPT LANGUAGE="javascript">';
			echo'alert("El orden del día se actualizo Exitosamente")';
			echo'</SCRIPT>';
	
			echo'<SCRIPT LANGUAGE="javascript">';
			echo'history.go(-2)';
			echo'</SCRIPT>';
			
			
			
		}
		else 
		{
			echo 'Se produjo un error. Intente nuevamente'.sqlsrv_errors();
		}
	
		
	//if($punto!=$pt){
		
//echo "estoy en el else";		

	//}else{	
		//echo "estoy en el if";
		/*echo'	<SCRIPT LANGUAGE="javascript">';
		echo' alert("Ese punto del orden del dia ya existe.\n ");';
		echo'	</SCRIPT>';
			
		echo'<SCRIPT LANGUAGE="javascript">';
		echo'	location.href = "./grid_orden_dia_central.php?id_sesion='.$_REQUEST['id_sesion'].'";';
		echo'	</SCRIPT>';*/
	
	//	}
}
else
{
$sql_sesion="select * from sisesecd_sesiones where id_sesion=$_REQUEST[id_sesion]";
$consulta_sesion = sqlsrv_query($conn,$sql_sesion);
//		$cliente = mysql_fetch_array($consulta);
		$cliente_sesion = sqlsrv_fetch_array($consulta_sesion);
		$nosesion=$cliente_sesion['nosesion'];
		$desc=$cliente_sesion['desc_sesion'];
		$tiposesion=$cliente_sesion['tipo_sesion'];

		
	if(isset($_REQUEST['id_orden'])){
		
		$sql_consul="SELECT id_orden,id_sesion,punto,
CAST(desc_punto as CHAR(2048))as desc_punto,estatus,obligatorios,para_votar FROM sisesecd_ordendia WHERE id_orden=$_REQUEST[id_orden] and id_sesion=$_REQUEST[id_sesion]";

//echo $sql_consul;
		$consulta = sqlsrv_query($conn,$sql_consul);
		$cliente = sqlsrv_fetch_array($consulta);

	}
	

	?>
<br>

		    <div class="card mb-4">
	<div class="card-header">
     <b>Edici&oacute;n del punto <?php echo $cliente['punto']?> del orden del d&iacute;a<br>
    de la <?php echo $nom_sesion[$nosesion]?> sesi&oacute;n <?php echo $tipo_ses[$tiposesion]?> 0<?php echo $desc ?>
		 
		 
		 </b>
    </div>
				
				
	<form id="frmClienteActualizar2" name="frmClienteActualizar2" method="post" action="actualizar2_central.php" onsubmit="return validacion(this); return false">
		
   <input class="text" type="hidden" name="page" id="page" value="<?php echo $_REQUEST["page"]; ?>" />
  <input class="text" type="hidden" name="id_sesion" id="id_sesion" value="<?php echo $_REQUEST["id_sesion"];?>" />
  <input class="text" type="hidden" name="id_orden" id="id_orden" value="<?php echo $_REQUEST["id_orden"]; ?>" />
 
<div class="form-group row">
 <label class="col-sm-3 control-label">Punto</label>


<div class="col-sm-4" >
    <?php 
	 
	echo'<select name="punto" id="punto">';
		echo '<option value='.$cliente[punto].' selected="selected">'.$cliente[punto].' </option>';
		for($i=1;$i<=100;$i++)
		{
		echo '<option value='.$i.'>'.$i.' </option>'; 
		}
	echo '</select>';
	
     ?>
     </div>
     </div>
		
		
<div class="form-group row">
 <label class="col-sm-3 control-label">Descripci&oacute;n</label>
  <div class="col-sm-4" >
    <textarea type="text" cols="45" rows="5" name="descpunto" id="descpunto" width="300px"><?php echo utf8_encode(stripslashes($cliente['desc_punto']))?></textarea>
	<span id="theCounter"></span>
    </div>
    </div>
		
		
		
<div class="form-group row">
 <label class="col-sm-3 control-label"> Punto Obligatorio:</label>
		
<div class="col-sm-4">
 <label class="col-sm-3 control-label"> Sí</label>

<input type="radio" name="obligatorio" id="obligatorio" value="1" <?php if($cliente['obligatorios']=="1") echo "checked=\"checked\""?>/>
</div>
<div class="col-sm-4">
<label class="col-sm-3 control-label"> No</label>
<input type="radio" name="obligatorio" id="obligatorio" value="0" <?php if($cliente['obligatorios']=="0") echo "checked=\"checked\""?>/>
</div>
</div>
		
		
		
<div class="form-group row">
 <label class="col-sm-3 control-label"> Punto para Votar:</label>

<div class="col-sm-4">
 <label class="col-sm-3 control-label"> Sí</label>

<input type="radio" name="avotar" id="avotar" value="1" <?php if($cliente['para_votar']=="1") echo "checked=\"checked\""?>/>
	</div>
	
	

<div class="col-sm-4">
<label class="col-sm-3 control-label"> No</label>

<input type="radio" name="avotar" id="avotar" value="0" <?php if($cliente['para_votar']=="0") echo "checked=\"checked\""?>/>
</div>
	</div>
		
		
<div class="form-group row">
	
 <div class="col-sm-4">
		<input class="btn btn-info btn-block" type="submit" name="submit" id="boton" value="Enviar" />
	</div>
	  <div class="col-sm-4">
        <input class="btn btn-info btn-block" type="button" name="cancelar" id="cancelar" value="Cancelar" onclick="history.back ()" />
	  </div>
      </div>
		
</form>
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