<?php
session_start();
header("Content-Type: text/html;charset=utf-8"); 
$sclave=$_GET["clave"];

?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<link rel="stylesheet" type="text/css" href="epoch_styles.css" />

<title>Nueva Actividad</title>
<script type="text/javascript" src="jquery.js"></script>
<script type="text/javascript" src="jquery.validate.js"></script>
<script type="text/javascript" src="epoch_classes.js"></script>


<script type="text/javascript">

	var dp_cal1,dp_cal2;  
	    
window.onload = function ()
{
	dp_cal1  = new Epoch('epoch_popup','popup',document.getElementById('fecha1a'));
	dp_cal2  = new Epoch('epoch_popup','popup',document.getElementById('fecha2a'));
	
};






</script>


<style type=text/css>

.pequeno{
font:Arial, Helvetica, sans-serif;
font-size:9px;
font-weight:bold;

}

.normal{
font:Arial, Helvetica, sans-serif;
font-size:11px;
}

.titulo{
font:Arial, Helvetica, sans-serif;
font-size:15px;
}


</style>


</head>

<body>

<div align="center">

<?php

include("conector.php");

$select="Select * from sisecao_catactividad where clave = '$sclave' ";



$result=ifx_query($select,$id_con);
$rows= ifx_fetch_row ($result);

$id_act = $rows[id_actividad];

$claves = $rows[clave];

list($a, $b, $c) = split ('[-]', $claves); 


$act =utf8_encode($rows[actividad]);

$finicia = $rows[periodoinicia];

$ftermino = $rows[periodofin];

$tipoact = $rows[tipo_actividad];
$soporte= $rows[soporte];

?>



<form name="frmnuevo" action="upadate.php"  method="post" >

<p align="center"><strong>Editar Actividad</strong>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<img src="images/edit.png"/></p>


<table bgcolor="#FFFFFF" border="1"  width="637" height="293" cellpadding="0" cellspacing="0" >


<tr>

<td height="25" colspan="2"><input type="hidden" name="idactividad" value= "<?php echo "$id_act";?>" /></td>
<td  align="center" class="pequeno"># organo desconcentrado</td>
<td width="85"  align="center" class="pequeno"># de area </td>
<td width="222"  align="center" class="pequeno"># consecutivo </td>
</tr>


<tr>
<td height="34" colspan="2" class="normal">Clave :</td>
<td colspan="3"> &nbsp;&nbsp;&nbsp;&nbsp;
  <input  name= "clave" type="text" size="3" maxlength="2"  value = "<?php echo "$a";?>"/>
  &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
  <input  name= "clave2" type="text" size="3" maxlength="2"  value = "<?php echo "$b";?>" />&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
  <input  name= "clave3" type="text" size="3" maxlength="2"  value = "<?php echo "$c";?>" />
</td>
<tr>
<td height="95" colspan="2" class="normal">Actividad :</td>
<td colspan="2"><textarea name="actividad" cols="30" rows="5"><?php echo "$act";?></textarea></td>
<td class="normal" > Tipo de actividad : 
  <label for="tipo"></label>
  <select name="tipo" size="1" id="tipo">
   <?php
   if($tipoact=="ORD")
		{
		echo '<option selected="selected" value="ORD">ordinaria</option>';
		echo '<option value="PE">proceso electoral</option>';
		echo '<option value="PC">participacion ciudadana</option>';
		echo '<option value="AD">Adicional</option>';
		}
		
		if($tipoact=="PE")
		{
		echo '<option selected="selected" value="PE">proceso electoral</option>';
		echo '<option value="ORD">ordinaria</option>';
		echo '<option value="PC">participacion ciudadana</option>';
		echo '<option value="AD">Adicional</option>';
		
		}
	
   if($tipoact=="PC")
		{
		echo '<option selected="selected" value="PC">participacion ciudadana</option>';
		echo '<option value="PE">proceso electoral</option>';
		echo '<option value="ORD">ordinaria</option>';
		echo '<option value="AD">Adicional</option>';
		}
		 if($tipoact=="AD")
		{
		echo '<option selected="selected" value="AD">Adicional</option>';
		echo '<option value="PE">Proceso electoral</option>';
		echo '<option value="ORD">Ordinaria</option>';
		echo '<option value="PC">Participacion ciudadana</option>';
		}
   
   ?>
   </select>
   </td>
</tr>

<tr>
<td width="86" height="34" colspan="2" class="normal">Soporte de cumplimiento :</td>
<td width="41"><span class="normal">
  <select name="soporte" size="1" id="soporte">
    <?php
   if($soporte=="CIR")
		{
		echo ' <option selected="selected" value="CIR">Circular</option>';
		echo '<option value="OF">Oficio</option>';
		echo '<option value="CE">Correo Electronico</option>';
		echo '<option value="TARJETA">Tarjeta</option>';
		echo '<option value="RT">Reunion trabajo</option>';
		echo '<option value="OTRO">Otro</option>';
        
 		}
		
		if($soporte=="OF")
		{
		echo '<option  selected="selected" value="OF">Oficio</option>';
		echo ' <option value="CIR">Circular</option>';
		echo '<option value="CE">Correo Electronico</option>'; 
		echo '<option value="TARJETA">Tarjeta</option>';
		echo '<option value="RT">Reunion Trabajo</option>';
		echo '<option value="OTRO">Otro</option>';
		
		}
	
   if($soporte=="CE")
		{
		echo '<option selected="selected" value="CE">Correo electronico</option>';
		echo ' <option value="CIR">Circular</option>';
		echo '<option value="OF">Oficio</option>';
		echo '<option value="TARJETA">Tarjeta</option>';
		echo '<option value="RT">Reunion Trabajo</option>';
		echo '<option value="OTRO">Otro</option>';
		}
    if($soporte=="TARJETA")
		{
	
		echo '<option selected="selected" value="TARJETA">Tarjeta</option>';
		echo ' <option value="CIR">Circular</option>';
		echo '<option value="OF">Oficio</option>';
		echo '<option value="CE">Correo Electronico</option>';
		echo '<option value="RT">Reunion Trabajo</option>';
		echo '<option value="OTRO">Otro</option>';
		}
		
 if($soporte=="RT")
		{
		echo '<option selected="selected" value="RT">Reunion Trabajo</option>';
		echo ' <option value="CIR">Circular</option>';
		echo '<option value="OF">Oficio</option>';
		echo '<option value="CE">Correo Electronico</option>';
		echo '<option value="TARJETA">Tarjeta</option>';
		echo '<option value="OTRO">Otro</option>';
		}		
 if($soporte=="OTRO")
		{
		echo '<option selected="selected" value="OTRO">Otro</option>';
		echo ' <option value="CIR">Circular</option>';
		echo '<option value="OF">Oficio</option>';
		echo '<option value="CE">Correo Electronico</option>';
		echo '<option value="TARJETA">Tarjeta</option>';
		echo '<option value="RT">Reunion Trabajo</option>';
			}
   ?>
  </select>
</span></td>

</tr>

<td height="58" colspan="2" class="normal">Fecha inicio :</td>
<td width="191"><input name="fecha1a" type="text" id="fecha1a"  value="<?php echo $finicia ?>" size="15" maxlength="20" readonly  />
<img src="images/date.png"/>
  
</td>
<td width="85" align="right" class="normal">Fecha termino :</td>
<td width="222"><input name="fecha2a" type="text" id="fecha2a"  value="<?php echo $ftermino ?>" size="15" maxlength="20" readonly /><img src="images/date.png"/>
</td>


</tr>


<tr>

<td colspan="5" align="center"><input type="submit" value="Guardar" /></td>
</tr>



</table>
</form>
</div>
</body>
</html>