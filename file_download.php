<?php
$host= $_SERVER["HTTP_HOST"];
//echo $host . "<br>";
if($host == "aplicaciones.iecm.mx"){
    define("URL_SISTEMA", "https://aplicaciones.iecm.mx/sesiones2020/");
}

if($host == "145.0.40.76"){
    define("URL_SISTEMA", "http://145.0.40.76/sesiones2020/");
}
//echo URL_SISTEMA;
// echo json_encode($_GET);
// exit;
header('Content-Type: application/octet-stream');
header('Content-Disposition: attachment; filename='.$_GET['file']);
readfile(URL_SISTEMA.$_GET['file']);
//echo "<script>alert('".$row['file_principal']."');</script>";

?>
