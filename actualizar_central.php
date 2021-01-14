<?php 
header("Content-Type: text/html; charset=utf-8");
error_reporting(E_ERROR | E_PARSE);
session_start();

$name= $_SESSION['user'];
$grup=$_SESSION['grupo'];
//$grup=$_SESSION[transaccion];
$id_distrito=$_SESSION[id_distrito];

//$iddistrito="0";
$idsesion="";
$id_sesion=$_REQUEST['id_sesion'];
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
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
<script type="text/javascript">



	var dp_cal1,dp_cal2;  
	    
window.onload = function ()
{
	dp_cal1  = new Epoch('epoch_popup','popup',document.getElementById('fechainicioprog'));

	
};
</script>
<script>
function validacion(frmClienteActualizar) {
	
	
	
 	if(frmClienteActualizar.tiposesion.value=="")
    {    
        alert('Debe seleccionar un tipo de sesion.')   
        return false   
    	} 
	if(frmClienteActualizar.descsesion.value=="")
    {    
        alert('No ha seleccionado consecutivo de tipo de sesion.')   
        return false   
    	} 
	if(frmClienteActualizar.horainicioprog.value=="")
    {    
        alert('Debe seleccionar una hora de inicio es obligatorio.')   
        return false   
    	} 
	if(frmClienteActualizar.fechainicioprog.value=="")
    {    
        alert('Debe seleccionar una fecha de inicio es obligatorio.')   
        return false   
    	}
	}
	
	
</script>

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
                        <a class="dropdown-item" href="logout.php">Cerrar sesión</a>
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

<!--tabla para todos las pantallas -->

<!--fin tabla para todos las pantallas -->
<?php

//echo 'Bienvenido, ';
if (isset($_SESSION['user'])) {

		$id_distrito=$_SESSION[id_distrito];
}
else
{
echo' 	alert("Debe iniciar una sesion")';	
	echo'<SCRIPT LANGUAGE="javascript">';
	echo'	location.href = "index.php";';
	echo'	</SCRIPT>';
}


$variable= $_REQUEST["page"];

require('functions.php');
include 'config_open_db.php';
include 'arreglos.php';

$sql_sesion="SELECT * FROM sisesecd_sesiones WHERE id_sesion =".$_REQUEST['id_sesion'];
	//echo $sql_sesion;
						
$consulta = sqlsrv_query($conn,$sql_sesion);
						
$cliente = sqlsrv_fetch_array($consulta);
						
$distritos = $cliente['distritos_sesiones'];						
						
//echo "Aquiiii". $distritos;
						
$disBD = explode(",", $distritos);

list($dist1, $dist2, $dist3, $dist4, $dist5, $dist6, $dist7, $dist8, $dist9, $dist10, $dist11,$dist12,$dist13, $dist14, $dist15, $dist16, $dist17, $dist18, $dist19, $dist20, $dist21, $dist22, $dist23, $dist24, $dist25, $dist26, $dist27, $dist28, $dist29, $dist30, $dist31, $dist32, $dist33) = array("1", "2", "3", "4", "5", "6", "7", "8", "9","10","11","12","13","14","15","16","17","18","19","20","21","22","23","24","25","26","27","28","29","30","31","32","33");
						
if(in_array($dist1, $disBD)){
    $dist1 = "checked";
} else{
    $dist1 = "";
}
						
if(in_array($dist2, $disBD)){
    $dist2 = "checked";
} else{
    $dist2 = "";
}

if(in_array($dist3, $disBD)){
    $dist3 = "checked";
} else{
    $dist3 = "";
}

if(in_array($dist4, $disBD)){
    $dist4 = "checked";
} else{
    $dist4 = "";
}

if(in_array($dist5, $disBD)){
    $dist5 = "checked";
} else{
    $dist5 = "";
}

if(in_array($dist6, $disBD)){
    $dist6 = "checked";
} else{
    $dist6 = "";
}
						
if(in_array($dist7, $disBD)){
    $dist7 = "checked";
} else{
    $dist7 = "";
}

if(in_array($dist8, $disBD)){
    $dist8 = "checked";
} else{
    $dist8 = "";
}
if(in_array($dist9, $disBD)){
    $dist9 = "checked";
} else{
    $dist9 = "";
}
if(in_array($dist10, $disBD)){
    $dist10 = "checked";
} else{
    $dist10 = "";
}
if(in_array($dist11, $disBD)){
    $dist11 = "checked";
} else{
    $dist11 = "";
}
if(in_array($dist12, $disBD)){
    $dist12 = "checked";
} else{
    $dist12 = "";
}
if(in_array($dist13, $disBD)){
    $dist13 = "checked";
} else{
    $dist13 = "";
}
if(in_array($dist14, $disBD)){
    $dist14 = "checked";
} else{
    $dist14 = "";
}
if(in_array($dist15, $disBD)){
    $dist15 = "checked";
} else{
    $dist15 = "";
}
if(in_array($dist16, $disBD)){
    $dist16 = "checked";
} else{
    $dist16 = "";
}
if(in_array($dist17, $disBD)){
    $dist17 = "checked";
} else{
    $dist17 = "";
}
if(in_array($dist18, $disBD)){
    $dist18 = "checked";
} else{
    $dist18 = "";
}
if(in_array($dist19, $disBD)){
    $dist19 = "checked";
} else{
    $dist19 = "";
}

if(in_array($dist20, $disBD)){
    $dist20 = "checked";
} else{
    $dist20 = "";
}

if(in_array($dist21, $disBD)){
    $dist21 = "checked";
} else{
    $dist21 = "";
}
						
if(in_array($dist22, $disBD)){
    $dist22 = "checked";
} else{
    $dist22 = "";
}
if(in_array($dist23, $disBD)){
    $dist23 = "checked";
} else{
    $dist23 = "";
}
if(in_array($dist24, $disBD)){
    $dist24 = "checked";
} else{
    $dist24 = "";
}
if(in_array($dist25, $disBD)){
    $dist25 = "checked";
} else{
    $dist25 = "";
}
if(in_array($dist26, $disBD)){
    $dist26 = "checked";
} else{
    $dist26 = "";
}
if(in_array($dist27, $disBD)){
    $dist27 = "checked";
} else{
    $dist27 = "";
}
if(in_array($dist28, $disBD)){
    $dist28 = "checked";
} else{
    $dist28 = "";
}
if(in_array($dist29, $disBD)){
    $dist29 = "checked";
} else{
    $dist29 = "";
}
if(in_array($dist30, $disBD)){
    $dist30 = "checked";
} else{
    $dist30 = "";
}
if(in_array($dist31, $disBD)){
    $dist31 = "checked";
} else{
    $dist31 = "";
}
if(in_array($dist32, $disBD)){
    $dist32 = "checked";
} else{
    $dist32 = "";
	
}if(in_array($dist33, $disBD)){
    $dist33 = "checked";
} else{
    $dist33 = "";
}
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
	<div class="card-header" >
     <b>Edici&oacute;n de sesi&oacute;n de Consejo para el Distrito</b>
    </div>
	<br>			
   	<form id="frmClienteActualizar" name="frmClienteActualizar" method="post" action="update_sesiones_central.php" onsubmit="return validacion(this)" >

	<div class="form-group row">
   
 <label class="col-sm-3 control-label"> N&uacute;mero de Sesi&oacute;n: </label>
<div class="col-sm-4" >

    <select class="form-control"  name="nosesion" size="1" id="nosesion">
      <option value="<?php echo $cliente['nosesion'];?>" selected="selected"><?php echo $nom_sesion[$cliente['nosesion']];?></option>
      <option value=1>PRIMERA</option>
      <option value=2>SEGUNDA</option>
      <option value=3>TERCERA</option>
      <option value=4>CUARTA</option>
      <option value=5>QUINTA</option>
      <option value=6>SEXTA</option>
      <option value=7>SÉPTIMA</option>
      <option value=8>OCTAVA</option>
      <option value=9>NOVENA</option>
      <option value=10>DÉCIMA</option>
      <option value=11>DÉCIMA PRIMERA</option>
      <option value=12>DÉCIMA SEGUNDA</option>
      <option value=13>DÉCIMA TERCERA</option>
      <option value=14>DÉCIMA CUARTA</option>
    </select>
</div>
</div>
		
 <div class="form-group row">
    <label class="col-sm-3 control-label"> Consecutivo de la Sesi&oacute;n:</label>
 
   <div class="tablitas" colspan="2" align="left"> 
    <?php 
	echo'<select name="descsesion" id="descsesion">';
	
		for($i=1;$i<=50;$i++)
		{
		echo '<option value='.$i.'>'.$i.' </option>'; 
		}
	echo '</select>';
	
     ?>
	<span id="theCounter"> </span>
     </div>
		</div> 
		
   <div class="form-group row">
    <label class="col-sm-3 control-label"> Tipo de Sesión:</label>
    <div class="col-sm-4" >

	<input type="radio" name="tiposesion" id="ordinaria" value="1" <?php if($cliente['tipo_sesion']=="1") echo "checked=\"checked\""?>  />
    Ordinario
  

    <input type="radio" name="tiposesion" id="extraordinaria" value="2"  <?php if($cliente['tipo_sesion']=="2") echo "checked=\"checked\""?> />
    Extraordinaria
    
 </div>
	   </div>

   <div class="form-group row">
<label class="col-sm-3 control-label"> Fecha de Inicio: </label>
   <div class="col-sm-4" >
	
 <input name="fechainicioprog" type="date" id="fechainicioprog"  value="<?php echo $cliente['fecha_inicio_prog']?>" />  
	<input type="hidden">
</div>
</div>
				
  <div class="form-group row">
    <label class="col-sm-3 control-label"> Hora de inicio: </label>
       <div class="col-sm-4" >
   <input type="text" maxlength=5 id="horainicioprog" name="horainicioprog" value="<?php echo $cliente['hora_inicio_prog']?>" />
 </div>
</div>
		<div class="form-group row">
         <label class="col-sm-3 control-label"> Actualiza los distritos que tendran sesion:</label>
        <div class="well">
	  </div>
   </div>			

<div class="form-group row">
       <div class="checkbox col-sm-4">
          <label><input type="checkbox" name="checkbox_distrito[]" id="1" value="1" <?php echo $dist1; ?> > Dto 1</label>
            </div>
           <div class="checkbox col-sm-4">
         <label><input type="checkbox" name="checkbox_distrito[]" id="2" value="2" <?php echo $dist2; ?>> Dto 2</label>
           </div>
           <div class="checkbox col-sm-4">
            <label><input type="checkbox" name="checkbox_distrito[]" id="3" value="3" <?php echo $dist3; ?>> Dto 3</label>
                 </div>
             <div class="checkbox col-sm-4">
             <label><input type="checkbox" name="checkbox_distrito[]" id="4" value="4" <?php echo $dist4; ?>> Dto 4</label>
                </div>
             <div class="checkbox col-sm-4">
            <label><input type="checkbox" name="checkbox_distrito[]" id="5" value="5" <?php echo $dist5; ?>> Dto 5</label>
         </div>
		    <div class="checkbox col-sm-4">
          <label><input type="checkbox" name="checkbox_distrito[]" id="6" value="6" <?php echo $dist6; ?>> Dto 6</label>
            </div>
           <div class="checkbox col-sm-4">
         <label><input type="checkbox" name="checkbox_distrito[]" id="7" value="7" <?php echo $dist7; ?>> Dto 7</label>
           </div>
           <div class="checkbox col-sm-4">
            <label><input type="checkbox" name="checkbox_distrito[]" id="8" value="8" <?php echo $dist8; ?>> Dto 8</label>
                 </div>
             <div class="checkbox col-sm-4">
             <label><input type="checkbox" name="checkbox_distrito[]" id="9" value="9" <?php echo $dist9; ?>> Dto 9</label>
                </div>
             <div class="checkbox col-sm-4">
            <label><input type="checkbox" name="checkbox_distrito[]" id="10" value="10" <?php echo $dist10; ?>> Dto 10</label>
         </div>
</div>
	
		 <div class="form-group row">
       <div class="checkbox col-sm-4">
          <label><input type="checkbox" name="checkbox_distrito[]" id="11" value="11" <?php echo $dist11; ?>> Dto 11</label>
            </div>
           <div class="checkbox col-sm-4">
         <label><input type="checkbox" name="checkbox_distrito[]" id="12" value="12" <?php echo $dist12; ?>> Dto 12</label>
           </div>
           <div class="checkbox col-sm-4">
            <label><input type="checkbox" name="checkbox_distrito[]" id="13" value="13" <?php echo $dist13; ?>> Dto 13</label>
                 </div>
             <div class="checkbox col-sm-4">
             <label><input type="checkbox" name="checkbox_distrito[]" id="14" value="14" <?php echo $dist14; ?>> Dto 14</label>
                </div>
             <div class="checkbox col-sm-4">
            <label><input type="checkbox" name="checkbox_distrito[]" id="15" value="15" <?php echo $dist15;?>> Dto 15</label>
         </div>
		    <div class="checkbox col-sm-4">
          <label><input type="checkbox" name="checkbox_distrito[]" id="16" value="16" <?php echo $dist16; ?>> Dto 16</label>
            </div>
           <div class="checkbox col-sm-4">
         <label><input type="checkbox" name="checkbox_distrito[]" id="17" value="17" <?php echo $dist17; ?>> Dto 17</label>
           </div>
           <div class="checkbox col-sm-4">
            <label><input type="checkbox" name="checkbox_distrito[]" id="18" value="18" <?php echo $dist18; ?>> Dto 18</label>
                 </div>
             <div class="checkbox col-sm-4">
             <label><input type="checkbox" name="checkbox_distrito[]" id="19" value="19" <?php echo $dist19; ?>> Dto 19</label>
                </div>
             <div class="checkbox col-sm-4">
            <label><input type="checkbox" name="checkbox_distrito[]" id="20" value="20" <?php echo $dist20; ?>> Dto 20</label>
         </div>
		</div>
	
	<div class="form-group row">
       <div class="checkbox col-sm-4">
          <label><input type="checkbox" name="checkbox_distrito[]" id="21" value="21" <?php echo $dist21; ?>> Dto 21</label>
            </div>
           <div class="checkbox col-sm-4">
         <label><input type="checkbox" name="checkbox_distrito[]" id="22" value="22" <?php echo $dist22; ?>> Dto 22</label>
           </div>
           <div class="checkbox col-sm-4">
            <label><input type="checkbox" name="checkbox_distrito[]" id="23" value="23" <?php echo $dist23; ?>> Dto 23</label>
                 </div>
             <div class="checkbox col-sm-4">
             <label><input type="checkbox" name="checkbox_distrito[]" id="24" value="24" <?php echo $dist24; ?>> Dto 24</label>
                </div>
             <div class="checkbox col-sm-4">
            <label><input type="checkbox" name="checkbox_distrito[]" id="25" value="25" <?php echo $dist25; ?>> Dto 25</label>
         </div>
		    <div class="checkbox col-sm-4">
          <label><input type="checkbox" name="checkbox_distrito[]" id="26" value="26" <?php echo $dist26; ?>> Dto 26</label>
            </div>
           <div class="checkbox col-sm-4">
         <label><input type="checkbox" name="checkbox_distrito[]" id="27" value="27" <?php echo $dist27; ?>> Dto 27</label>
           </div>
           <div class="checkbox col-sm-4">
            <label><input type="checkbox" name="checkbox_distrito[]" id="28" value="28" <?php echo $dist28; ?>> Dto 28</label>
                 </div>
             <div class="checkbox col-sm-4">
             <label><input type="checkbox" name="checkbox_distrito[]" id="29" value="29" <?php echo $dist29; ?>> Dto 29</label>
                </div>
             <div class="checkbox col-sm-4">
            <label><input type="checkbox" name="checkbox_distrito[]" id="30" value="30" <?php echo $dist30; ?>> Dto 30</label>
         </div>
		  <div class="checkbox col-sm-4">
            <label><input type="checkbox" name="checkbox_distrito[]" id="31" value="31" <?php echo $dist31; ?>> Dto 31</label>
         </div>
		  <div class="checkbox col-sm-4">
            <label><input type="checkbox" name="checkbox_distrito[]" id="32" value="32" <?php echo $dist32; ?>> Dto 32</label>
         </div>
		  <div class="checkbox col-sm-4">
            <label><input type="checkbox" name="checkbox_distrito[]" id="33" value="33" <?php echo $dist33; ?>> Dto 33</label>
         </div>
		</div>
		
	<input type="hidden" value="<?php  echo $_REQUEST["page"] ?>" id="page" name="page" />
    <input type="hidden" name="id_sesion" id="id_sesion" value="<?php echo $cliente['id_sesion']?>" />
    <input class="text" type="hidden" name="id_distrito" id="id_distrito" value="<?php echo $id_distrito; ?>"/>

   
	
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

	  </div>
          </div>
              </div>
            </main>
				
<footer class="py-4 bg-light mt-auto">
<?php include('footer.php'); ?>
</footer>
</body>
</html>