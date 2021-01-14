<?php 
header("Content-Type: text/html; charset=utf-8");
error_reporting(E_ERROR | E_PARSE);
session_start();

if (isset($_SESSION['user'])) {
$name= $_SESSION['transaccion'];
$grup=$_SESSION['grupo'];
//$grup=$_SESSION[transaccion];
$id_distrito=$_SESSION[id_distrito];
	
$id_admin=$_SESSION[id_admin];
$id_sesion = $_REQUEST[id_sesion];

//echo "si pasaaaaaaaaaaaaaaa".$id_sesion;

include 'arreglos.php';
}
else
{
echo' 	alert("Debe iniciar una sesion")';	
	echo'<SCRIPT LANGUAGE="javascript">';
	echo'	location.href = "index.php";';
	echo'	</SCRIPT>';
}

?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<!--<link href="style.css" rel="stylesheet" type="text/css" />-->

<script type="text/javascript" src="js/jquery-1.4.3.min.js"></script>


<title>.: SISESECD  :.</title>
   <!-- Bootstrap core CSS -->
      <link href="css/bootstrap.min.css" rel="stylesheet">
      <link href="css/mycss.css" rel="stylesheet">
      <link rel="stylesheet" type="text/css" href="style001.css">
	  <!-- Bootstrap core JavaScript
      ================================================== -->
      <script src="js/jquery-3.3.1.min.js"></script>
      <script src="js/popper.min.js"></script>
      <script src="js/bootstrap.min.js"></script>
      <!--<script src="js/holder.min.js"></script>-->
      <script src="js/funcionesajax.js"></script>
      <link rel="stylesheet" href="css/all.css">
      <style>
      .derecha{float:right;}
      .tableCenter{text-align: center;}
      </style>


  <body class="sb-nav-fixed">
        <nav class="sb-topnav navbar navbar-expand navbar-dark bg-dark">
            <a class="navbar-brand" href="grid_sesiones_central.php">Sistema de Seguimiento a las Sesiones de los Consejos Distritales - <b>SISESECD</b><br>
            Proceso Electoral Local Ordinario 2020-2021</a>
            <div class="col-md-6"></div>
            <ul class="navbar-nav ml-auto ml-md-0">
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" id="userDropdown" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><i class="fas fa-user fa-fw"></i></a>
                    <div class="dropdown-menu dropdown-menu-right" aria-labelledby="userDropdown">
                        <div class="dropdown-divider"></div>
                        <a class="dropdown-item" href="logout.php">Cerrar sesi&oacute;n</a>
                    </div>
                </li>
            </ul>
        </nav>
    </body>

	
	
    <body class="sb-nav-fixed">
        <div id="layoutSidenav">
            <div id="layoutSidenav_content">
            <main>
                    <div class="container-fluid">

                    <h1 class="mt-4"><img src="images/logo-header.png"></h1>
						
						  <ol class="breadcrumb mb-4">
                            <li class="breadcrumb-item active">
                               <?php echo "<a href='nuevo2_central.php?id_sesion=".$id_sesion."' class='btn btn-outline-dark btn-sm'><img src='images/nuevo.png' width='16' height='16' border='0' /> Nueva punto del Orden </a>" ?>
                                <div class="col-sm-1"></div>
                               
                            </li>
							     <li class="breadcrumb-item active">
                                <a href="grid_sesiones_central.php" class="btn btn-outline-dark btn-sm"> Menu Principal </a>
                                <div class="col-sm-1"></div>
                               
                            </li>
                        </ol>
	
 <div class="card mb-4">
                            <div class="card-header">
                                <i class="fas fa-table mr-1"></i>
                                Información de los Puntos del Orden del Día 
                                <p id="abrevia">Usuario:<strong><?php echo $name; ?></strong>
                            </div>

<table class="table table-bordered table-responsive">
  <tr >
    <td width="44">Punto</td>
    <td width="1261">Descripción</td>
    <td width="229" colspan="2">Acciones</td>
    </tr>
<!-- entra ciclo -->

<!-- paginador -->

<?php
include ("config_open_db.php"); 
$sql_count= "SELECT count(*) AS cuantos FROM sisesecd_sesiones WHERE id_distrito=$id_distrito and estatus=1;";
$exe_sql_count=sqlsrv_query($conn,$sql_count);
$row_cuantos = sqlsrv_fetch_array ($exe_sql_count);
$cuantos=$row_cuantos[cuantos];
//echo $cuantos;
$n_pages= $cuantos/15;
//echo $n_pages;
$n_pages=ceil($n_pages);
//echo "pages";
//echo $n_pages;
$page=1;
$skip[1]=0;
$skip[2]=15;
$skip[3]=30;
$skip[4]=45;
$skip[5]=60;
$skip[6]=75;
$skip[7]=90;
$skip[8]=105;

$sql = "select id_orden,id_sesion,punto,
CAST(desc_punto as CHAR(2048)) as desc_punto,estatus,voto_cp,voto_c1,voto_c2,voto_c3,voto_c4,voto_c5,voto_c6,observa_punto from sisesecd_ordendia where id_sesion=".$_REQUEST['id_sesion']."  and estatus=1 order by id_orden asc;";
//$sql = "SELECT  * FROM sesiones WHERE iddistrito='$id_distrito' order by fechainicioprog ASC";
//$sql = "SELECT id_delegacion, clave_colonia, nombre_colonia from simro_seguimientocap WHERE id_distrito='$id_distrito' order by nombre_colonia";
//echo $sql;
$result=sqlsrv_query($conn,$sql);
$i=0;
while($row = sqlsrv_fetch_array ($result))
{
$i++;
  echo'<tr>';
//  echo'<td>'.$datos[idsesion].'</td>';
  echo'<td>'.$row[punto].'</td>';
  echo'<td>'.utf8_encode($row[desc_punto]).'</td>';
  echo"<td><span class='modi3'>";
  echo"<a class='btn btn-default' href='actualizar2_central.php?id_sesion=".$row['id_sesion']."&id_orden=".$row['id_orden']."'><img src='images/sesion_edit.png' title='Editar' alt='Editar' border='0' /></a></span></td>";
echo "<td><span class='dele'><a class='btn btn-default' href='eliminar_orden_central.php?id_sesion=".$row['id_sesion']."&id_orden=".$row['id_orden']."'><img src='images/borrar.png' title='Eliminar' border='0' alt='Eliminar' /></a></span></td>";
		
		echo "</tr>";
		
		}
?>
</table>

							</div>
                            </div>
                    </div>
                    </div>
            </main>
				
				
				
<br>
<p>&nbsp;</p>
<p>&nbsp;</p>
<!-- numero de paginas -->
				<footer class="py-4 bg-light mt-auto">
                    <?php include('footer.php'); ?>
                </footer>
<!--fin tabla para todos las pantallas -->

<!-- numero de paginas -->
    <script src="js/jquery-3.5.1.min.js" crossorigin="anonymous"></script>
        <script src="js/bootstrap.bundle.min.js" crossorigin="anonymous"></script>
        <script src="js/scripts.js"></script>
        <script src="js/jquery.dataTables.min.js" crossorigin="anonymous"></script>
        <script src="js/dataTables.bootstrap4.min.js" crossorigin="anonymous"></script>
        <script src="js/datatables-demo.js"></script>
</body>
</html>
