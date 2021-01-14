<?php
$hostname_myDBconn = "sisesecd2017@supernova";
$username_myDBconn = "sisesecd17_us"; 
$password_myDBconn = "53gu1M13"; 
$database_myDBconn = "sisesecd2017";

$conn = ifx_connect($hostname_myDBconn, $username_myDBconn, $password_myDBconn) or trigger_error(ifx_error(),E_USER_ERROR);

	$dirtyread="SET ISOLATION TO DIRTY READ;";
	if(ifx_query($dirtyread,$conn)==false)
	{
		echo "IMPOSIBLE REALIZAR DIRTY READ.";
	}
?>
