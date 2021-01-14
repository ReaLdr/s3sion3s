<?php 
require("conector.php"); 
$pdf="c:\\";
$pdf  .= $_FILES["excel"]["name"];
//echo $pdf;
$falta=date("d/m/Y");

$contador=0;
$row = 1; 
$fp = fopen ($pdf,"r"); 
//$fp = fopen ("c:\\prueba2_seguimiento.csv","r"); 
while ($data = fgetcsv($fp, ",","	")) 
{ 
$contador++;

print " <br>"; 
$row++; 
$insertar="";

$insertar="INSERT INTO sisecao_catactividad (clave,actividad,periodoinicia,periodofin,responsable,soporte,tipo_actividad,fecha_alta,usr_alta,status) VALUES ('$data[0]','$data[1]','$data[2]','$data[3]','$data[4]','$data[5]','$data[6]','$falta',3,1)"; 

//echo $insertar;
ifx_query($insertar,$id_con);
ifx_error(); 
ifx_errormsg();
} 

fclose ($fp); 
ifx_close($id_con);

echo '<script language="javascript">';
//alert("valor:"+variable);
echo 'alert("total de registros insertados: "+'.$contador.');';
echo '	history.go(-1)';
echo '</script>';
	

?>