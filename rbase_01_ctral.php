<?php
header('Content-type: application/vnd.ms-excel');
header("Content-Disposition: attachment; filename=Responsables_que _NO_ causaron_baja.xls");
header("Pragma: no-cache");
header("Expires: 0");
header("Content-Type: text/html;charset=utf-8"); 

session_start();

//echo 'Bienvenido, ';
if (isset($_SESSION['k_username'])) {
	
}
else
{
	
	echo'<SCRIPT LANGUAGE="javascript">';
	echo'	location.href = "index.php";';
	echo'	</SCRIPT>';
}


$v_urs= $_SESSION['k_username'];
$id_usuario = $_SESSION['transaccion'];
$id_distrito = $_SESSION['id_distrito'];
$id_admin = $_SESSION['id_admin'];

//Cabecera general
echo "<table border=0 style='font-family:Calibri, Arial, Helvetica, sans-serif;'> ";
echo "<tr>";
echo "<th colspan=6>";
//echo "<font style='font-size:14px;font-weight:bold;'>INSTITUTO ELECTORAL DEL DISTRITO FEDERAL<br></font><br>";
echo "</th>";
echo "</tr> ";
echo "<th colspan=2 padding: 10px; ></th>";
echo "<th colspan=6>";
echo "<font style='font-size:14px;font-weight:bold;'>INSTITUTO ELECTORAL DEL DISTRITO FEDERAL<br>";
echo "</th>";
echo "</tr> ";
echo "<tr>";
echo "<th colspan=2>";
echo "";
echo "</th>";
echo "<th colspan=6>";
echo "<font style='font-size:14px;font-weight:bold;'>LISTADO DE RESPONSABLES Y SUPLENTES QUE NO CAUSARON BAJA<br></font><br>";
echo "</th>";
echo "<tr>";
echo "</tr>";
echo '<tr border="1" bgcolor="#cccccc">';
echo "<th>#</th>";
echo "<th>Distrito</th>";
echo "<th>Delegacion</th>";
echo "<th>Clave de la Colonia</th>";
echo "<th>Nombre de la Colonia </th>";
echo "<th>Responsable 1</th>";
echo "<th>Responsable 2</th>";
echo "<th>Suplente 1</th>";
echo "<th>Suplente 2</th>";
echo "<th>Total Activos</th>";

echo "</tr>";
echo "</table>";

echo "<table border=1 style='font-family:Calibri, Arial, Helvetica, sans-serif;'> ";

$i=0;
require("file:///C|/Documents and Settings/curso/Escritorio/switch.php");



/// arreglos/////

$sexos["f"]="Femenino";
$sexos["m"]="Masculino";

$Baja[0]="-";
$Baja[1]="Activo";

$propuesta[0]="Mesa directiva";
$propuesta[1]="Coordinador interno";
require("file:///C|/Documents and Settings/curso/Escritorio/arreglos.php");

///////////////////


$suma=0;
echo '<br>';
//$sql_quer ="select id_distrito, id_delegacion, clave_colonia, nombre_colonia, prop1, prop2, suplente1, suplente2 from simro_seguimientocap where id_distrito=$id_distrito";


$sql_quer= "SELECT id_distrito, id_delegacion, clave_colonia, nombre_colonia,prop1, bajaprop1, prop2, bajaprop2, suplente1, bajasup1, suplente2, bajasup2 FROM simro_seguimientocap WHERE id_distrito=$id_distrito"; 

$suma_bajas=0;

$query_exe=ifx_query($sql_quer,$id_con);
while ($rows=ifx_fetch_row($query_exe))
		{
				$i++;
			echo '<tr>';
			echo '<td>'.$i.'</td>';
			echo '<td>'.$d_romano[$rows[id_distrito]].'</td>'; 
			echo '<td>'.$n_dele[$rows[id_delegacion]].'</td>'; 
			echo '<td>'.$rows[clave_colonia].'</td>'; 
			echo '<td>'.$rows[nombre_colonia].'</td>';
			
			$v_prop1=0;
			$v_prop1=$rows[prop1]-$rows[bajaprop1];
			echo '<td>'.$Baja[$v_prop1].'</td>'; //prop1
			
			$v_prop2=0;
			$v_prop2=$rows[prop2]-$rows[bajaprop2];
			echo '<td>'.$Baja[$v_prop2].'</td>'; //prop2
			
			$v_sup1=0;
			$v_sup1=$rows[suplente1]-$rows[bajasup1];
			echo '<td>'.$Baja[$v_sup1].'</td>'; //sup1
	
			$v_sup2=0;
			$v_sup2=$rows[suplente2]-$rows[bajasup2];
			echo '<td>'.$Baja[$v_sup2].'</td>'; //sup2
	
			$suma_bajas=$v_prop1+$v_prop2+$v_sup1+$v_sup2;
			//$rows[bajaprop1]+$rows[bajaprop2]+$rows[bajasup1]+$rows[bajasup2];
			//$integrantes=4-$suma_bajas;
			echo '<td>'.$suma_bajas.'</td>'; 
			echo '</tr>';
			$suma=0;
		
		}


echo '</table>';

?>