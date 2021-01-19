<?php
include 'config_open_db.php';

$host= $_SERVER["HTTP_HOST"];
//echo $host . "<br>";
if($host == "aplicaciones.iecm.mx"){
    define("URL_SISTEMA", "https://aplicaciones.iecm.mx/sesiones2020/");
}

if($host == "145.0.40.76"){
    define("URL_SISTEMA", "http://145.0.40.76/sesiones2020/");
}

$nosesion = $_GET['nosesion'];
$tiposesion = $_GET['tiposesion'];
$descsesion = $_GET['descsesion'];

$query = "SELECT doctos_principal from sisesecd_sesiones where nosesion=$nosesion and tipo_sesion=$tiposesion and desc_sesion=$descsesion and id_distrito!=40 and estatus =1 AND doctos_principal IS NOT NULL order by id_distrito asc";

$params = array();
$options =  array( "Scrollable" => SQLSRV_CURSOR_KEYSET );
$result = sqlsrv_query ($conn, $query, $params, $options);


if($result){

	$row_count = sqlsrv_num_rows($result);
	//exit;
	if($row_count > 0){
		$exe_query = sqlsrv_query($conn, $query);
$i = 0;
        while($row = sqlsrv_fetch_array($exe_query)){
            echo "<script>

            	var valFileDownloadPath = 'file_download.php?file=".$row['doctos_principal']."';
              window.open(valFileDownloadPath , '_blank');
            </script>";
            #ESTE CODIGO ES EL FUNCIONAL(HASTA 18 DE ENERO DE 2020)
            /*
            header('Content-Type: application/octet-stream');
            if(substr($row['doctos_principal'], -3) != "zip"){
            	header('Content-Disposition: attachment; filename='.$row['doctos_principal'].'.pdf');
            } else{
            	header('Content-Disposition: attachment; filename='.$row['doctos_principal']);
            }
            */
			         //readfile(URL_SISTEMA.$row['doctos_principal']);
            //echo "<script>alert('".$row['doctos_principal']."');</script>";
            $i++;
        }
        echo "<script>
        alert('Se descargaron ".$i." archivos.');
        setTimeout(function() {
        window.close();
      }, 3000);
</script>";
	}else{
		//NO trae resultados
    echo "No se encontraron documentos";
	}
} else{
	//Error en la consulta
  echo "Ocurrió un error durante la consulta. (SEL)";
}

?>
