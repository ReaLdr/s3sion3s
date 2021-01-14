<?php 
//include 'arreglos.php';
session_start();
error_reporting(E_ERROR | E_PARSE);
if (isset($_SESSION['user'])) {

$name= $_SESSION['user'];
$grup=$_SESSION['grupo'];

$id_distrito=$_SESSION['id_distrito'];

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
	
	
<script type="text/javascript" src="epoch_classes.js"></script>
<script type="text/javascript">

	var dp_cal1,dp_cal2;  
	    
window.onload = function ()
{
	dp_cal1  = new Epoch('epoch_popup','popup',document.getElementById('fechainicioprog'));

	
};
</script>
<script>
function validacion(frmClienteNuevo) {
	
	
	
 	if(frmClienteNuevo.tiposesion.value=="")
    {    
        alert('Debe seleccionar un tipo de sesion.')   
        return false   
    	} 
	if(frmClienteNuevo.descsesion.value=="")
    {    
        alert('No ha seleccionado consecutivo de tipo de sesion.')   
        return false   
    	} 
	if(frmClienteNuevo.horainicioprog.value=="")
    {    
        alert('Debe seleccionar una hora de inicio es obligatorio.')   
        return false   
    	} 
	if(frmClienteNuevo.fechainicioprog.value=="")
    {    
        alert('Debe seleccionar una fecha de inicio es obligatorio.')   
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
	$descsesion = htmlspecialchars(trim($_POST['descsesion']));
	$descsesion=str_replace("'",'"',$descsesion);
	stripslashes($descsesion);
	$nosesion = $_POST['nosesion'];
	$tiposesion = htmlspecialchars(trim($_POST['tiposesion']));
	$fechainicioprog = htmlspecialchars(trim($_POST['fechainicioprog']));
	$horainicioprog = htmlspecialchars(trim($_POST['horainicioprog']));
	$domicilio = $_POST['domicilio'];
	
	$distritos_sesion = json_encode($_POST['checkbox_distrito']);
  //echo $distritos_sesion;
  //array_push($distritos_sesion);
  $corchetes = ['[', ']', '"'];
  $replace = ['', '', ''];
	
  $replace_array = str_replace($corchetes, $replace, $distritos_sesion);
  //echo $replace_array;
  //echo json_encode($_POST);
  //exit;

	
	include 'config_open_db.php';



$sql1="SELECT count(*)as cuantos FROM sisesecd_sesiones WHERE estatus=1 and nosesion=".$nosesion." and tipo_sesion=".$tiposesion." and desc_sesion=".$descsesion." ;";  

	

		$consult = sqlsrv_query($conn, $sql1);
		$cl = sqlsrv_fetch_array($consult);
		$cuantos=$cl[cuantos];
		//echo $sql1;
		

if($nosesion==0 ){
		echo'	<SCRIPT LANGUAGE="javascript">';
		echo' 	alert("Debe seleccionar un Numero de Sesión")';
		echo'	</SCRIPT>';
		echo'<SCRIPT LANGUAGE="javascript">';
		echo'	location.href = "./nuevo_central.php";';
		echo'	</SCRIPT>';
	
	}
	else{
		
		
		if($cuantos>0){
		//echo "estoy en el if";
		echo'	<SCRIPT LANGUAGE="javascript">';
		echo' 	alert(" Ya existe otra sesion con esas caracteristicas.\n Intente de nuevo")';
		echo'	</SCRIPT>';
		echo'<SCRIPT LANGUAGE="javascript">';
		echo'	location.href = "./grid_sesiones_central.php";';
		echo'	</SCRIPT>';
	
			}
			else{

			//echo "estoy en el else";
		 /*
	
  if(is_array($distritos_sesion)){
    echo "<pre>";
    var_dump($distritos_sesion);
    echo "</pre>";
  }
exit;*/
$sql_nuevo="INSERT INTO sisesecd_sesiones(id_distrito, nosesion,desc_sesion, tipo_sesion, fecha_inicio_prog, hora_inicio_prog,estatus,distritos_sesiones) values (".$id_distrito.",".$nosesion.",".$descsesion.", ".$tiposesion.",'".$fechainicioprog."','".$horainicioprog."',1, '$replace_array');";


	
				//echo $sql_nuevo;
        //exit;
			
$sql_nuevo=(string)$sql_nuevo;

$sql_nuevo=str_replace("\n","",$sql_nuevo);	
$sql_nuevo=str_replace("\r","",$sql_nuevo);

//echo $sql_nuevo;
					
if(sqlsrv_query($conn,$sql_nuevo)){



	//if (mysql_query("INSERT INTO sesiones(iddistrito, nosesion,descsesion, tiposesion, fechainicioprog, horainicioprog) values (".$iddistrito.",'".$nosesion."','".$descsesion."', ".$tiposesion.",'".$fechainicioprog."','".$horainicioprog."');") == true){
echo'<p>&nbsp;</p>';echo'<p>&nbsp;</p>';echo'<p>&nbsp;</p>';echo'<p>&nbsp;</p>';echo'<p>&nbsp;</p>';echo'<p>&nbsp;</p>';
echo '<div align="center">';
echo'<table width="166" border="0" cellpadding="0" cellspacing="0">
  <tr>
    <td width="156" align="center"><img src="images/ajax-loader.gif" width="160" height="24" /></td>
  </tr>
  <tr>
    <td align="center">CREANDO</td>
  </tr>
</table>';
echo'	<SCRIPT LANGUAGE="javascript">';
echo' 	alert("La Sesión se creó Exitosamente")';
echo'	</SCRIPT>';
echo'<SCRIPT LANGUAGE="javascript">';
echo'	location.href = "./grid_sesiones_central.php";';
//echo'history.go(-1)';
//history.back ()';
echo'	</SCRIPT>';
		}
		else
		{
echo 'Se produjo un error. Intente nuevamente ';
ifx_errormsg();
			}
		}
		
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
     <b>Nueva sesi&oacute;n de Consejo Distrital</b>
    </div>
	
	
<br><br>
<form id="frmClienteNuevo" name="frmClienteNuevo" method="post" action="nuevo_central.php" onsubmit="return validacion(this)" >

 
	 <div class="form-group row">
   
 <label class="col-sm-3 control-label"> N&uacute;mero de Sesi&oacute;n:</label>

<div class="col-sm-4" >
	 <select class="form-control"  name="nosesion" size="1" id="nosesion">
        <option value=0 selected="selected"> Seleccione una opción</option>
        <option value=1>Primera</option>
        <option value=2>Segunda</option>
        <option value=3>Tercera</option>
        <option value=4>Cuarta</option>
        <option value=5>Quinta</option>
        <option value=6>Sexta</option>
        <option value=7>Séptima</option>
        <option value=8>Octava</option>
        <option value=9>Novena</option>
        <option value=10>Décima</option>
        <option value=11>Décima Primera</option>
        <option value=12>Décima Segunda</option>
        <option value=13>Décima Tercera</option>
        <option value=14>Décima Cuarta</option>
	    <option value=15>Décima Quinta</option>
	    <option value=16>Décima Sexta</option>
	 	<option value=17>Décima Septima</option>
	 	<option value=18>Décima Octava</option>
	 	<option value=19>Décima Novena</option>
	 	 <option value=20>Vigesimo</option>
	 	 <option value=21>Vigesimo Primero</option>
	 	 <option value=22>Vigesimo Segundo</option>
	 	 <option value=23>Vigesimo Tercero</option>
	 	 <option value=24>Vigesimo Cuarto</option>
	 	<option value=25>Vigesimo Quinto</option>
	 <option value=26>Vigesimo Sexta </option>
	 <option value=27>Vigesimo Septima</option>
	 <option value=28>Vigesimo Octava</option>
	 <option value=29>Vigesimo Novena</option>
	 <option value=30>Trigesimo</option>
	 <option value=31>Trigesimo Primero</option>
	 <option value=32>Trigesimo Segundo</option>
	 <option value=33>Trigesimo Tercero</option>
	 <option value=34>Trigesimo Cuarta</option>
	 <option value=35>Trigesimo Quinta</option>
	 
    </select>
	</div>
 </div>
   
 <div class="form-group row">
 <label class="col-sm-3 control-label"> Consecutivo de Tipo de Sesión:</label>
 	<div class="col-sm-4">
    <?php 
	echo'<select class="form-control" name="descsesion" id="descsesion">';
	
		for($i=1;$i<=50;$i++)
		{
		echo '<option value='.$i.'>'.$i.' </option>'; 
		}
	echo '</select>';
	
     ?>
	 </div>
	</div>
	
     <div class="form-group row">
 <label class="col-sm-3 control-label"> Tipo de Sesión:</label>
 	<div class="col-sm-4">
    <input type="radio" name="tiposesion" id="normal" value="1" checked />
    Ordinaria
	</div>
	 	<div class="col-sm-4">
    <input type="radio" name="tiposesion" id="extraordinaria" value="2" />
    Extrordinaria
			</div>
</div>


     <div class="form-group row">
 <label class="col-sm-3 control-label"> Fecha de Inicio:</label>
<div class="col-sm-4">
 <input class="form-control input-small" name="fechainicioprog" type="date" id="fechainicioprog"  value="<?php echo date("Y-m-j"); ?>"  />  
	<input type="hidden">
</div>
</div>
	
	
 <div class="form-group row">

 <label class="col-sm-3 control-label"> Hora de inicio:</label>
<div class="col-sm-4">
<input class="form-control input-small" type="text" id="horainicioprog" name="horainicioprog" value="<?php echo date("H:i");?>" />

	
<input type="hidden" value="<?php  echo $_REQUEST["page"] ?>" id="page" name="page" />
</div>
</div>

	<div class="form-group row">
         <label class="col-sm-3 control-label"> Selecciona los distritos que tendran sesion:</label>
         <label class="col-sm-3 control-label" for="id_select_todos" style="cursor: pointer;"><span class="badge bg-success" style="color: #FFF;">Seleccionar todos</span> <input type="checkbox" name="select_todos" id="id_select_todos"></label>
        <div class="well">
	  </div>
   </div>
	 <div class="form-group row">
       <div class="checkbox col-sm-4">
          <label><input type="checkbox" class="CheckedAK" name="checkbox_distrito[]" id="1" value="1"> Dto 1</label>
            </div>
           <div class="checkbox col-sm-4">
         <label><input type="checkbox" class="CheckedAK" name="checkbox_distrito[]" id="2" value="2"> Dto 2</label>
           </div>
           <div class="checkbox col-sm-4">
            <label><input type="checkbox" class="CheckedAK" name="checkbox_distrito[]" id="3" value="3"> Dto 3</label>
                 </div>
             <div class="checkbox col-sm-4">
             <label><input type="checkbox" class="CheckedAK" name="checkbox_distrito[]" id="4" value="4"> Dto 4</label>
                </div>
             <div class="checkbox col-sm-4">
            <label><input type="checkbox" class="CheckedAK" name="checkbox_distrito[]" id="5" value="5"> Dto 5</label>
         </div>
		    <div class="checkbox col-sm-4">
          <label><input type="checkbox" class="CheckedAK" name="checkbox_distrito[]" id="6" value="6"> Dto 6</label>
            </div>
           <div class="checkbox col-sm-4">
         <label><input type="checkbox" class="CheckedAK" name="checkbox_distrito[]" id="7" value="7"> Dto 7</label>
           </div>
           <div class="checkbox col-sm-4">
            <label><input type="checkbox" class="CheckedAK" name="checkbox_distrito[]" id="8" value="8"> Dto 8</label>
                 </div>
             <div class="checkbox col-sm-4">
             <label><input type="checkbox" class="CheckedAK" name="checkbox_distrito[]" id="9" value="9"> Dto 9</label>
                </div>
             <div class="checkbox col-sm-4">
            <label><input type="checkbox" class="CheckedAK" name="checkbox_distrito[]" id="10" value="10"> Dto 10</label>
         </div>
		</div>
	
		 <div class="form-group row">
       <div class="checkbox col-sm-4">
          <label><input type="checkbox" class="CheckedAK" name="checkbox_distrito[]" id="11" value="11"> Dto 11</label>
            </div>
           <div class="checkbox col-sm-4">
         <label><input type="checkbox" class="CheckedAK" name="checkbox_distrito[]" id="12" value="12"> Dto 12</label>
           </div>
           <div class="checkbox col-sm-4">
            <label><input type="checkbox" class="CheckedAK" name="checkbox_distrito[]" id="13" value="13"> Dto 13</label>
                 </div>
             <div class="checkbox col-sm-4">
             <label><input type="checkbox" class="CheckedAK" name="checkbox_distrito[]" id="14" value="14"> Dto 14</label>
                </div>
             <div class="checkbox col-sm-4">
            <label><input type="checkbox" class="CheckedAK" name="checkbox_distrito[]" id="15" value="15"> Dto 15</label>
         </div>
		    <div class="checkbox col-sm-4">
          <label><input type="checkbox" class="CheckedAK" name="checkbox_distrito[]" id="16" value="16"> Dto 16</label>
            </div>
           <div class="checkbox col-sm-4">
         <label><input type="checkbox" class="CheckedAK" name="checkbox_distrito[]" id="17" value="17"> Dto 17</label>
           </div>
           <div class="checkbox col-sm-4">
            <label><input type="checkbox" class="CheckedAK" name="checkbox_distrito[]" id="18" value="18"> Dto 18</label>
                 </div>
             <div class="checkbox col-sm-4">
             <label><input type="checkbox" class="CheckedAK" name="checkbox_distrito[]" id="19" value="19"> Dto 19</label>
                </div>
             <div class="checkbox col-sm-4">
            <label><input type="checkbox" class="CheckedAK" name="checkbox_distrito[]" id="20" value="20"> Dto 20</label>
         </div>
		</div>
	
	<div class="form-group row">
       <div class="checkbox col-sm-4">
          <label><input type="checkbox" class="CheckedAK" name="checkbox_distrito[]" id="21" value="21"> Dto 21</label>
            </div>
           <div class="checkbox col-sm-4">
         <label><input type="checkbox" class="CheckedAK" name="checkbox_distrito[]" id="22" value="22"> Dto 22</label>
           </div>
           <div class="checkbox col-sm-4">
            <label><input type="checkbox" class="CheckedAK" name="checkbox_distrito[]" id="23" value="23"> Dto 23</label>
                 </div>
             <div class="checkbox col-sm-4">
             <label><input type="checkbox" class="CheckedAK" name="checkbox_distrito[]" id="24" value="24"> Dto 24</label>
                </div>
             <div class="checkbox col-sm-4">
            <label><input type="checkbox" class="CheckedAK" name="checkbox_distrito[]" id="25" value="25"> Dto 25</label>
         </div>
		    <div class="checkbox col-sm-4">
          <label><input type="checkbox" class="CheckedAK" name="checkbox_distrito[]" id="26" value="26"> Dto 26</label>
            </div>
           <div class="checkbox col-sm-4">
         <label><input type="checkbox" class="CheckedAK" name="checkbox_distrito[]" id="27" value="27"> Dto 27</label>
           </div>
           <div class="checkbox col-sm-4">
            <label><input type="checkbox" class="CheckedAK" name="checkbox_distrito[]" id="28" value="28"> Dto 28</label>
                 </div>
             <div class="checkbox col-sm-4">
             <label><input type="checkbox" class="CheckedAK" name="checkbox_distrito[]" id="29" value="29"> Dto 29</label>
                </div>
             <div class="checkbox col-sm-4">
            <label><input type="checkbox" class="CheckedAK" name="checkbox_distrito[]" id="30" value="30"> Dto 30</label>
         </div>
		  <div class="checkbox col-sm-4">
            <label><input type="checkbox" class="CheckedAK" name="checkbox_distrito[]" id="31" value="31"> Dto 31</label>
         </div>
		  <div class="checkbox col-sm-4">
            <label><input type="checkbox" class="CheckedAK" name="checkbox_distrito[]" id="32" value="32"> Dto 32</label>
         </div>
		  <div class="checkbox col-sm-4">
            <label><input type="checkbox" class="CheckedAK" name="checkbox_distrito[]" id="33" value="33"> Dto 33</label>
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

     <script type="text/javascript">
       if(document.getElementById('id_select_todos')){
          document.getElementById('id_select_todos').addEventListener('change', fn_todos);
       }

       function fn_todos(e){
          e.preventDefault();
          var check_todos = document.querySelector('input[name="select_todos"]:checked');
          var checkboxes = $(this).closest('form').find(':checkbox');
          if(check_todos){
              //Checamos todos los chec
              checkboxes.prop('checked', $(this).is(':checked'));
          } else{
            //Deschecamos
            //document.querySelector('input[name="checkbox_distrito[]"]').checked = false;
              checkboxes.prop('checked', $(this).is(':checked'));
          }
       }

      $(document).click(function() {
          setTimeout(() => {
              var checked = $(".CheckedAK:checked").length; //Creamos una Variable y Obtenemos el Numero de Checkbox que esten Seleccionados
              if(checked < 33){
                  document.getElementById('id_select_todos').checked = false;
                  //console.log("Menor que 33");
              } else{
                  document.getElementById('id_select_todos').checked = true;
                  //console.log("Igual a 33");
              }
            }, 400);
      });
     </script>
		
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