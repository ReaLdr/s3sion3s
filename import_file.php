<?php 
require("conector.php"); 
$pdf="c:\\";
$pdf  .= $_FILES["pdf"]["name"];
echo $pdf;
$falta=date("d-m-Y");

$contador=0;
$row = 1; 
$fp = fopen ($pdf,"r"); 

while ($data = fgetcsv ($fp, ",")) 
{ 
$contador++;
//$num = count ($data); 
print " <br>"; 
$row++; 
$insertar="";
$insertar="INSERT INTO sisecao_actividades (id_actividad,realizo,fecha_alta,usr_alta,status) VALUES ('$data[0]','$data[4]','$falta',3,1)"; 

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