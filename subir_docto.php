<?php
header("Content-Type: text/html; charset=utf-8");
error_reporting(E_ERROR | E_PARSE);
set_time_limit(0);
session_start();
//echo 'Bienvenido,';

if (isset($_SESSION['user'])) {

$name= $_SESSION['transaccion'];
$grup=$_SESSION['grupo'];
$id_distrito=$_SESSION['id_distrito'];

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
<link href="css/stilacho.css" rel="stylesheet" type="text/css" />
<link href="css/animate.css" rel="stylesheet" type="text/css" />



<!--<script src="js/jquery-3.2.1.min.js"></script>-->
<script src="js/bootstrap.min.js"></script>
<link rel="stylesheet" href="css/bootstrap.min.css">
<link rel="stylesheet" href="css/jquery-ui.css">


<script type="text/javascript" src="fancybox/jquery.fancybox-1.3.4.js"></script>
<link rel="stylesheet" type="text/css" href="fancybox/jquery.fancybox-1.3.4.css" media="screen" />
<title>.: SISESECD 2018 :.</title>

</head>

<body>
	<script type="text/javascript">
		function escondeActualiza(){
			document.getElementById('enviar').disabled = true;
			document.getElementById('loading').style.display= 'block';
		}
	</script>
<div id="container_blanco">

  <?php include('header.php');?>

<p>&nbsp;</p>

                    <h1 class="mt-4"><img src="images/logo-header.png"></h1>
<!--tabla para todos las pantallas -->
<div class="top-menu">
<table  border="0" style="width: 90%;">
  <tr>
    <td width="16%" height="25" align="left" class="well">Usuario: <?php echo $name;?></td>
    <td width="55%" align="left" class="well" style="background-color: #FFF;">Consejo Distrital: <?php echo $id_distrito; ?></td>
	   <td width="16%" align="center"><?php echo"<a class='btn btn-primary' href='javascript:history.back(-2)'> Menu principal</a>";?></td>

    <td width="29%" align="right"><a class="btn btn-default" href="logout.php">Cerrar Sesi&oacute;n</a></td>
  </tr>
</table>
</div>

<p>&nbsp;</p>
<p>&nbsp;</p>

<?php

$status = "";
$id_distrito=$_SESSION[id_distrito];
if ($_POST["action"] == "upload")
{

	//echo "entroooo";
	//exit;
	// obtenemos los datos del archivo
	$tamano = $_FILES["archivo"]['size'];
	$upload_max=50000000;
	//$upload_max=4000000;
	//echo $tamano;
	$tipo = $_FILES["archivo"]['type'];
	//echo 	$tipo;

	$var = $_FILES['archivo'];
	$var2 = $var['name'];
	$parts = pathinfo($var2);
	$extension = $parts['extension'];

	if ($tamano < $upload_max)
		{

		//if ($tipo == "application/pdf")
			//{

						$id_distrito=$_SESSION[id_distrito];

						$archivo = $_FILES["archivo"]['name'];

						$archivo_tmp=$_FILES["archivo"]["tmp_name"];

						$today = date("YmdH-m-s");                           // 20010310

						//echo "nombre del archivo". $archivo;
							//	exit;



						$alea =substr(md5(uniqid(rand())),0,6);
						$id_sesion=$_POST[id_sesion];

						$prefijo =$id_distrito."-".$id_sesion."-".$alea.$today.".".$extension;

						//$prefijo.='.pdf';

						switch ($extension) {
							case 'pdf':
								$msg_tipo_archivo = "PDF";
								break;
							case 'zip':
								$msg_tipo_archivo = "ZIP";
								break;
							case 'rar':
								$msg_tipo_archivo = "RAR";
								break;
						}


						if ($archivo != "")
						 {
							// guardamos el archivo a la carpeta files
							$destino =  "documentos/".$prefijo;


									if (move_uploaded_file($archivo_tmp,$destino))
									{

										$nombre_imagen=$destino;
										$id_sesion=$_POST[id_sesion];
										$id_distrito=$_SESSION[id_distrito];

										$update_imagen="UPDATE sisesecd_sesiones SET doctos_principal='$nombre_imagen' WHERE id_sesion=$id_sesion and id_distrito=$id_distrito";

									//echo $update_imagen;
									//exit;


									include ("config_open_db.php");



									if(sqlsrv_query($conn, $update_imagen));

									$status = "Archivo subido: <b>".$archivo."</b>";


								include("bitacora.php");
								$accion="Se subio el Documento";
								bitacora($accion);

									echo '<SCRIPT LANGUAGE="javascript">';

									echo 'alert("El archivo '.$msg_tipo_archivo.' se ha guardado exitosamente")';

									echo '</SCRIPT>';
									echo '<SCRIPT LANGUAGE="javascript">';
									echo 'history.go(-2)';
									echo '</SCRIPT>';

									}
									else
									{
									echo '<SCRIPT LANGUAGE="javascript">';
									echo 'alert("Error al subir el archivo verifique el tamaño y la extension .PDF, .RAR o .ZIP")';
									echo '</SCRIPT>';
									}



					}
					else
					{
			     	echo '<SCRIPT LANGUAGE="javascript">';
					echo 'alert("Solo se Permiten subir Archivos con extension .PDF, .RAR o .ZIP")';
					echo '</SCRIPT>';
					}

			}
	        else
			{
			echo '<SCRIPT LANGUAGE="javascript">';
			echo 'alert("Error al subir el archivo, El tamaño del .PDF, .RAR o .ZIP excede el tamaño a 4MB)';
			echo '</SCRIPT>';
			}

}

?>

<body>
<div align="center">
<!-- <strong>SELECCIONE EL ARCHIVO EN PDF o ZIP  QUE DESEA INCLUIR</strong> -->
<!-- <p>Por favor seleccione el archivo a subir, NO mayores a 50 MB:</p> -->
  	<?php
    $id_sesion=$_GET[id_sesion];
	?>

  <form action="subir_docto.php" class="form" method="post" enctype="multipart/form-data" onSubmit="return escondeActualiza();">

      <!-- <input name="archivo" type="file" class="casilla" id="archivo" size="35" accept=".pdf, .rar, .zip" /> -->


		<!-- <div class="mb-3 alert alert-warning" role="alert" id="loading">
			    Cargando
			  </div> -->
			  <div class="card" style="font-size: 14px;">
		  	  <div class="card-header">
		  	    SELECCIONE EL ARCHIVO EN PDF o ZIP  QUE DESEA INCLUIR
		  	  </div>
		  	  <div class="card-body">

				  <div class="mb-3">
					  <label for="formFile" class="form-label">Por favor seleccione el archivo a subir, NO mayores a 50 MB:</label>
					  <input class="form-control" name="archivo" type="file" class="casilla" id="archivo" size="35" accept=".pdf, .rar, .zip" id="formFile">
					  <input name="id_sesion" id="id_sesion" type="hidden" value="<?php echo "$id_sesion"; ?>">
					  <input name="action" type="hidden" value="upload" />
					  <div id="loading" style="display: none; background-color: #f8d7da;">
					  	Favor de esperar un momento...
					  </div>
					  <input name="enviar" class="btn btn-primary btn-sm" type="submit" class="boton" id="enviar" value="Subir Documento" />
				  </div>
		  	  </div>
		  	</div>
	</form>

	<br>
	<div class=" mb-3alert alert-danger" role="alert" style="max-width: 50%; text-align: justify;">
	  <p><strong>&bull;Recuerde que los documentos que ingrese al sistema deberan estar escaneadas en blanco y negro <br>&bull;Puede ingresar un archivo en formato PDF o varios en un ZIP</strong></p>
	</div>



<p>&nbsp;</p>
 <p>&nbsp;</p>
 <p>&nbsp;</p>
  </div>
</div>

<footer class="py-4 bg-light mt-auto">
         <?php include('footer.php'); ?>
                </footer>
</body>
</html>
