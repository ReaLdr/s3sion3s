<?php




// Pie de página
function Footer()
{
   // $fechaimp=htmlspecialchars("Fecha de impresión ").date("d/m/Y H:s");
  //  return $fechaimp;
	
	
	$sql_fecha="select current as fecha from systables where tabid=1";
$r_fecha=sqlsrv_query($conn, $sql_fecha);
$d_date=sqlsrv_fetch_array ($r_fecha);
	
$fecha_act=$d_date[fecha];
	return $fecha_act;

}

function calcular_tiempo_trasnc($hora1,$hora2){
    $separar[1]=explode(':',$hora1);
    $separar[2]=explode(':',$hora2);

	$total_minutos_trasncurridos[1] = ($separar[1][0]*60)+$separar[1][1];
	$total_minutos_trasncurridos[2] = ($separar[2][0]*60)+$separar[2][1];
	$total_minutos_trasncurridos = $total_minutos_trasncurridos[1]-$total_minutos_trasncurridos[2];
	
	// Si la resta da negativo multiplico por -1

	if($total_minutos_trasncurridos<0) $total_minutos_trasncurridos*=-1;

	if($total_minutos_trasncurridos<=59) return($total_minutos_trasncurridos.'min');
	elseif($total_minutos_trasncurridos>59){
	$HORA_TRANSCURRIDA = round($total_minutos_trasncurridos/60);
	if($HORA_TRANSCURRIDA<=9) $HORA_TRANSCURRIDA='0'.$HORA_TRANSCURRIDA;
	$MINUITOS_TRANSCURRIDOS = $total_minutos_trasncurridos%60;
	if($MINUITOS_TRANSCURRIDOS<=9) $MINUITOS_TRANSCURRIDOS='0'.$MINUITOS_TRANSCURRIDOS;
	return ($HORA_TRANSCURRIDA.':'.$MINUITOS_TRANSCURRIDOS.'');
} } 
?>