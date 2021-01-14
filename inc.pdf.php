<?php

require('fpdf.php');

class PDF extends FPDF
{
// Para rotacion de textos e imagenes
var $angle=0;
var $titlereport="----";

var $sinvalor=1;
var $typeHead=1;
var $distrito="S/D";
var $nosesion="S/N";
var $descripcion=" ";
var $numero="S/N";
var $fechainicioreal ="S/F";
var $tiposesion ="S/T";


function Rotate($angle,$x=-1,$y=-1)
{
    if($x==-1)
        $x=$this->x;
    if($y==-1)
        $y=$this->y;
    if($this->angle!=0)
        $this->_out('Q');
    $this->angle=$angle;
    if($angle!=0)
    {
        $angle*=M_PI/180;
        $c=cos($angle);
        $s=sin($angle);
        $cx=$x*$this->k;
        $cy=($this->h-$y)*$this->k;
        $this->_out(sprintf('q %.5F %.5F %.5F %.5F %.2F %.2F cm 1 0 0 1 %.2F %.2F cm',$c,$s,-$s,$c,$cx,$cy,-$cx,-$cy));
    }
}

function _endpage()
{
    if($this->angle!=0)
    {
        $this->angle=0;
        $this->_out('Q');
    }
    parent::_endpage();
}

function RotatedText($x,$y,$txt,$angle)
{
    //Text rotated around its origin
    $this->Rotate($angle,$x,$y);
    $this->Text($x,$y,$txt);
    $this->Rotate(0);
}

function RotatedImage($file,$x,$y,$w,$h,$angle)
{
    //Image rotated around its upper-left corner
    $this->Rotate($angle,$x,$y);
    $this->Image($file,$x,$y,$w,$h);
    $this->Rotate(0);
}
// ------- fin rotacion

// Funciones para tabla multicell
var $widths;
var $aligns;

function SetWidths($w)
{
    //Set the array of column widths
    $this->widths=$w;
}

function SetAligns($a)
{
    //Set the array of column alignments
    $this->aligns=$a;
}

function Row($data)
{
    //Calculate the height of the row
    $nb=0;
    for($i=0;$i<count($data);$i++)
        $nb=max($nb,$this->NbLines($this->widths[$i],$data[$i]));
    $h=5*$nb;
    //Issue a page break first if needed
    $this->CheckPageBreak($h);
    //Draw the cells of the row
    for($i=0;$i<count($data);$i++)
    {
        $w=$this->widths[$i];
        $a=isset($this->aligns[$i]) ? $this->aligns[$i] : 'L';
        //Save the current position
        $x=$this->GetX();
        $y=$this->GetY();
        //Draw the border
        $this->Rect($x,$y,$w,$h);
        //Print the text
        $this->MultiCell($w,5,$data[$i],0,$a);
        //Put the position to the right of the cell
        $this->SetXY($x+$w,$y);
    }
    //Go to the next line
    $this->Ln($h);
}

function CheckPageBreak($h)
{
    //If the height h would cause an overflow, add a new page immediately
    if($this->GetY()+$h>$this->PageBreakTrigger)
     	$this->AddPage($this->CurOrientation,"Letter");
}

function NbLines($w,$txt)
{
    //Computes the number of lines a MultiCell of width w will take
    $cw=&$this->CurrentFont['cw'];
    if($w==0)
        $w=$this->w-$this->rMargin-$this->x;
    $wmax=($w-2*$this->cMargin)*1000/$this->FontSize;
    $s=str_replace("\r",'',$txt);
    $nb=strlen($s);
    if($nb>0 and $s[$nb-1]=="\n")
        $nb--;
    $sep=-1;
    $i=0;
    $j=0;
    $l=0;
    $nl=1;
    while($i<$nb)
    {
        $c=$s[$i];
        if($c=="\n")
        {
            $i++;
            $sep=-1;
            $j=$i;
            $l=0;
            $nl++;
            continue;
        }
        if($c==' ')
            $sep=$i;
        $l+=$cw[$c];
        if($l>$wmax)
        {
            if($sep==-1)
            {
                if($i==$j)
                    $i++;
            }
            else
                $i=$sep+1;
            $sep=-1;
            $j=$i;
            $l=0;
            $nl++;
        }
        else
            $i++;
    }
    return $nl;
}

//  fin tabla multicell


// Cabecera de página
function Header()
{
 if($this->sinvalor==1) $this->temporal("Documento sin valor");
   $diareal=substr($this->fechainicioreal,8,2);
   $mesreal=substr($this->fechainicioreal,6,1);
   $mes = array(" ","Enero","Febrero", "Marzo","Abril","Mayo","Junio","Julio","Agosto","Septiembre","Octubre","Noviembre","Diciembre");
    $tiposes="S/T";
    if($this->tiposesion==1) $tiposes="Ordinaria";
    if($this->tiposesion==2) $tiposes="Extraordinaria";
   // if($this->tiposesion==3) $tiposes="Permanente";
	
    // Logo
    $this->Image('images/iedf.PNG',10,8,33);
    // Arial bold 15
    $this->SetFont('Arial','B',14);
    // Movernos a la derecha
    $this->Cell(120);
    // Título
    $this->Cell(30,10,'Secretaría Ejecutiva',0,0,'C');	
    // Movernos a la derecha
    $this->SetFont('Arial','B',10);
    // Salto de línea
    $this->Ln(5); 
    $this->Cell(120);
    $this->Cell(30,10,'Unidad Técnica de Archivo, Logística y Apoyo a Órganos Desconcentrados',0,0,'C');
     $this->Ln(5);
    // Arial bold 15
    $this->SetFont('Arial','B',14);
    // Movernos a la derecha
    $this->Cell(120);
    // Título
    $this->Cell(30,10,$this->titlereport,0,0,'C');	

    //Dist
     $this->Ln(5);
    // Arial bold 15
    $this->SetFont('Arial','B',14);
    // Movernos a la derecha
    $this->Cell(120);
    // Título
    $this->Cell(30,10,'Consejo Distrital '.$this->distrito,0,0,'C');

    //subtit 
     $this->Ln(5);
    // Arial bold 15
    $this->SetFont('Arial','B',12);
    // Movernos a la derecha
    $this->Cell(120);
    // Título
    $this->Cell(30,10,$title0,0,'C');	

    //subtit2 
     $this->Ln(5);
    // Arial bold 15
    $this->SetFont('Arial','B',12);
    // Movernos a la derecha
    $this->Cell(120);
    // Título
    $this->Cell(30,10,$this->nosesion.' Sesión '.$tiposes.' del '.$diareal.' de '.$mes[$mesreal].' de 2015',0,1,'C');
	$this->Cell(120);
	//$this->Cell(30,10,$this->descripcion,0,1,'C');
     if($this->typeHead==2)	$this->headerVotos();
    $this->Ln(5);
}



//Header Votación
function headerVotos()
{

 $this->Ln(5);
 $this->SetFont('Arial','',10);
$this->Cell(100,25,"Proyecto o punto de acuerdo",1,0,"C");  // HORA
//$this->Cell(68,8,"Sentido de la votación",1,0,"C");  // HORA
$this->Cell(0,25,"Observaciones",1,1,"C");  // HORA
$this->SetY(61);
$this->SetX(110); //columnas
//$this->Cell(17,8,"Unanime",1,0,"C");
$this->Cell(20,15,"A favor",1,0,"C");
$this->Cell(20,15,"En contra",1,0,"C");
//$this->Cell(17,8,"Abstención",1,0,"C"); 
 $this->SetFont('Arial','B',10);
    $this->Ln(10);
}


// Pie de página
function Footer()
{
    $fechaimp="Fecha de impresión ".date("d/m/Y H:s");
    // Posición: a 1,5 cm del final
    $this->SetY(-15);
    // Arial italic 8
    $this->SetFont('Arial','I',8);
    // Número de página
    $this->Cell(0,10,$fechaimp.'. Página '.$this->PageNo().'/{nb}',0,0,'C');
}

// private functions
function RoundedRect($x, $y, $w, $h, $r, $style = '')
{
    $k = $this->k;
    $hp = $this->h;
    if($style=='F')
        $op='f';
    elseif($style=='FD' || $style=='DF')
        $op='B';
    else
        $op='S';
    $MyArc = 4/3 * (sqrt(2) - 1);
    $this->_out(sprintf('%.2F %.2F m',($x+$r)*$k,($hp-$y)*$k ));
    $xc = $x+$w-$r ;
    $yc = $y+$r;
    $this->_out(sprintf('%.2F %.2F l', $xc*$k,($hp-$y)*$k ));

    $this->_Arc($xc + $r*$MyArc, $yc - $r, $xc + $r, $yc - $r*$MyArc, $xc + $r, $yc);
    $xc = $x+$w-$r ;
    $yc = $y+$h-$r;
    $this->_out(sprintf('%.2F %.2F l',($x+$w)*$k,($hp-$yc)*$k));
    $this->_Arc($xc + $r, $yc + $r*$MyArc, $xc + $r*$MyArc, $yc + $r, $xc, $yc + $r);
    $xc = $x+$r ;
    $yc = $y+$h-$r;
    $this->_out(sprintf('%.2F %.2F l',$xc*$k,($hp-($y+$h))*$k));
    $this->_Arc($xc - $r*$MyArc, $yc + $r, $xc - $r, $yc + $r*$MyArc, $xc - $r, $yc);
    $xc = $x+$r ;
    $yc = $y+$r;
    $this->_out(sprintf('%.2F %.2F l',($x)*$k,($hp-$yc)*$k ));
    $this->_Arc($xc - $r, $yc - $r*$MyArc, $xc - $r*$MyArc, $yc - $r, $xc, $yc - $r);
    $this->_out($op);
}

function _Arc($x1, $y1, $x2, $y2, $x3, $y3)
{
    $h = $this->h;
    $this->_out(sprintf('%.2F %.2F %.2F %.2F %.2F %.2F c ', $x1*$this->k, ($h-$y1)*$this->k,
                        $x2*$this->k, ($h-$y2)*$this->k, $x3*$this->k, ($h-$y3)*$this->k));
}

function temporal($msg)
{
	$this->SetFont('Arial','B',60);
	$this->SetTextColor(203,203,203);
	$this->RotatedText(65,185,$msg,45);
	$this->SetTextColor(0,0,0);

}
}
?>