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


$sql_selec= "SELECT * FROM sisecao_catactividad WHERE clave='$sclave' and status=1";


$res=ifx_query($sql_selec,$id_con);

$rows = ifx_fetch_row ($res);

$inicio=$rows[periodoinicia];
$fin=$rows[periodofin];
$responsable=$rows[responsable];
$soporte=$rows[soporte];
//$desc = utf8_encode($rows[descripcion]);
$tipo= $rows[tipo_actividad];
//$fcumplio =$rows[fecha_cumplio];
$actividad = utf8_encode($rows[actividad]);

?>

<p class="titulo"><img src="images/iedf.PNG" /> Calendario Anual de Actividades para los Órganos Desconcentrados 2011																								
</p>
<p class="titulo">&nbsp;</p>
<table width="679" height="426" bgcolor="#FFFFFF" border="1">
<tr class="normal">
<td width="153" height="31" >Clave :</td>
<td><?php echo "$sclave"; ?></td>
</tr>

<tr class="normal">
<td height="138">Actividad :</td>
<td><?php echo "$actividad"; ?></td>
</tr>

<tr class="normal">
<td height="39">Tipo de actividad:</td>
<td><?php echo "$tipo"; ?></td>
</tr>

<tr class="normal">
  <td height="49">Soporte de cumplimiento :</td>
  <td><?php echo "$soporte"; ?></td>
  </tr>
<tr class="normal">
  <td height="47">Periodo de inicio:</td>
  <td><?php echo "$inicio"; ?></td>
</tr>
<tr class="normal">
  <td height="46">Periodo termina :</td>
  <td><?php echo "$fin"; ?></td>
</tr>
<tr class="normal">
<td height="58">Responsable : </td>
<td><?php echo "$responsable"; ?></td>
</tr>

</table>
<p>&nbsp;</p>
</div>
<p>&nbsp;</p>

<div>
<p align="center"><input type="button" name = "imprimir" value="Imprimir" onClick="window.print()";/></p>
</div>


</body>
</html>