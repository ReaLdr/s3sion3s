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

$query = "SELECT acta_principal FROM sisesecd_sesiones WHERE id_distrito <> 40 and nosesion = $nosesion and desc_sesion = $descsesion and tipo_sesion = $tiposesion AND acta_principal IS NOT NULL";

$params = array();
$options =  array( "Scrollable" => SQLSRV_CURSOR_KEYSET );
$result = sqlsrv_query ($conn, $query, $params, $options);


if($result){
            
	$row_count = sqlsrv_num_rows($result);
	//exit;
	if($row_count > 0){
		$exe_query = sqlsrv_query($conn, $query);

        while($row = sqlsrv_fetch_array($exe_query)){
            /*echo "<script>
            	//window.location.href = '".URL_SISTEMA."actas/".$row['acta_principal']."';

            	var valFileDownloadPath = '".URL_SISTEMA.$row['acta_principal']."';
				window.open(valFileDownloadPath , '_blank');
            </script>";*/
            header('Content-Type: application/octet-stream');
            if(substr($row['acta_principal'], -3) != "zip"){
            	header('Content-Disposition: attachment; filename='.$row['acta_principal'].'.pdf');
            } else{
            	header('Content-Disposition: attachment; filename='.$row['acta_principal']);
            }
			readfile(URL_SISTEMA.$row['acta_principal']); 
            //echo "<script>alert('".$row['acta_principal']."');</script>";
        }
	}else{
		//NO trae resultados
	}
} else{
	//Error en la consulta
}

?>