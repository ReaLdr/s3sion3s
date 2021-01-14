<?php
session_start();
header("Content-Type: text/html;charset=utf-8"); 
?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Documento sin título</title>
<style type=text/css>

.pequeno{
font:Arial, Helvetica, sans-serif;
font-size:11px;
font-weight:bold;

}

.normal{
font:Arial, Helvetica, sans-serif;
font-size:12px;
}

.titulo{
font:Arial, Helvetica, sans-serif;
font-size:15px;
font-weight:bold;
}


</style>



</head>

<body>
<div align="center">
<?php 

include ("conector.php");
$sclave=$_GET[clave];
$id_distrito=$_SESSION[k_idDistrito];


/*//////////////////
/ datos  cabecera
*///////////////////
$sql_actividad="SELECT clave,actividad FROM sisecao_catactividad  WHERE clave = '$sclave';";
//echo $sql_actividad;

$result_act=ifx_query($sql_actividad,$id_con);
$row_act= ifx_fetch_row ($result_act);
$claves = $row_act[clave];
$act = utf8_encode($row_act[actividad]);

/*//////////////////
/ FIN datos de la cabecera
*///////////////////

/*//////////////////
/ datos  formulario
*///////////////////


$sql_selec= "SELECT * FROM sisecao_actividades_trabajo WHERE clave='$sclave' and iddistrito=$id_distrito;";



$res=ifx_query($sql_selec,$id_con);

$rows = ifx_fetch_row ($res);


$tipo=$rows[tipo];
$numoficio=$rows[num_oficio];
$desc = utf8_encode($rows[descripcion]);
$realizo= $rows[realizo];
$fcumplio =$rows[fecha_cumplio];
$actividad = utf8_encode($rows[actividad]);



?>
<p class="titulo"><img src="images/iedf.PNG" /> Calendario Anual de Actividades para los Órganos Desconcentrados 2011																								
</p>
<p class="titulo">&nbsp;</p>
<table width="681" height="407" bgcolor="#FFFFFF" border="1">
<tr class="normal">
<td width="153" >Clave :</td>
<td colspan="3"><?php echo "$sclave"; ?></td>
</tr>

<tr class="normal">
<td height="86">Actividad : </td>
<td colspan="3"><?php echo "$act"; ?></td>
</tr>

<tr class="normal">
  <td height="42">Realizo la actividad :</td>
  <td colspan="3"><?php echo "$realizo"; ?></td>
  </tr>
<tr class="normal">
<td height="42">Soporte de Cumplimiento:</td>
<td width="263"><?php echo "$tipo"; ?></td>
<td width="134">Numero de cumplimiento :</td>
<td width="103"><?php echo "$numoficio"; ?></td>
</tr>
<?php
if($realizo =='SI')
{
echo'<tr class="normal">
  <td height="177">Resumen concreto :</td>
  <td colspan="3"> '.$desc.'</td>
  </tr>';
}
else
{
echo'<tr class="normal">
  <td height="177">Causa por la que no dio cumplimiento:</td>
  <td colspan="3"> '.$desc.' </td>
  </tr>';
}
  ?>
<tr class="normal">
<td>Fecha de cumplimiento : </td>
<td colspan="3"><?php echo "$fcumplio"; ?></td>
</tr>

</table>
</div>
<p>&nbsp;</p>

<div>
<p align="center"><input type="button" name = "imprimir" value="Imprimir" onClick="window.print()";/></p>
</div>


</body>
</html>