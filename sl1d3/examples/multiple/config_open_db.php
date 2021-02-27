<?php
//$serverName = "145.0.40.72";
//$connectionInfo = array( "Database"=>"sesiones2020", "UID"=>"user1", "PWD"=>"u53r1", "ReturnDatesAsStrings" =>"true");
 $serverName = "145.0.40.70";
 $connectionInfo = array( "Database"=>"sesiones2020", "UID"=>"bds3s_vsr", "PWD"=>"s3s_202o", "ReturnDatesAsStrings" =>"true");
//$connectionInfo=array("UID"=>"user1", "PWD"=>"u53r1", "Database"=>"siscoi", "ReturnDatesAsStrings"=>"true", "CharacterSet"=>"UTF-8");

$conn = sqlsrv_connect( $serverName, $connectionInfo);

if( $conn ) {
   //  echo "Conexión establecida.<br />";
}else{
     echo "Conexión no se pudo establecer.<br />";
     die( print_r( sqlsrv_errors(), true));
}
?>
