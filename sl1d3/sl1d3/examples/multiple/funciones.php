<?php

// Pie de página
function Footer()
{
    $fechaimp=htmlspecialchars("Fecha de impresión ").date("d/m/Y H:s");
    // Posición: a 1,5 cm del final
    //$this->SetY(-15);
    // Arial italic 8
    //SetFont('Arial','I',8);
    // Número de página
    return $fechaimp;
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

function calcular_tiempo($hora1,$hora2){
    $separar[1]=explode(':',$hora1);
    $separar[2]=explode(':',$hora2);
	
$horainicio=mktime($separar[2][0],$separar[2][1],0,0,0,0);
$horafin=mktime($separar[2][0],$separar[2][1],0,0,0,0);
$time=abs(($horainicio-$horafin)/60/60);

$t[1]=explode('.',$time);
$minutos=round(($t[1][1]*60)/100);
$horas=	$t[1][0];
 return ($horas.":".substr($minutos,0,2)." ");
} 
?>