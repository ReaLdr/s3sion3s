<?php
session_start();
//username and password sent from Form
$username=$_POST['sUsr']; 
$password=$_POST['sPass']; 
//echo "es la cotraseña:".$password;

error_reporting(E_ERROR | E_PARSE);	
include ('config_open_db.php');

include ("bitacora.php");
	


$query="SELECT * FROM sisesecd_usuarios WHERE usuario='".$username."' and contrasena='".$password."'";
//echo $sql;
$r= sqlsrv_query($conn,$query);
 if($rows= sqlsrv_fetch_array($r)){
//$rows=ifx_fetch_row($resultado);

			$r_usuario=$rows['usuario'];
			$r_contrasena=$rows['contrasena'];
			$r_perfil = $rows['perfil'];
}

	//echo "usuario bd:".$r_usuario."</br>";
	//echo "es el perfil:".$r_perfil;
	
		if($r_perfil == 1)
						
					{
							$_SESSION['user']=$rows['id_usuario']; //Storing user session value.
							$_SESSION['id_distrito']=$rows['id_distrito']; //area de adscripcion
							$_SESSION['grupo']=$rows['perfil']; 
							$_SESSION['transaccion']=$rows['usuario']; // nombre del usuario
							$accion= "ingreso al perfil DISTRITO";
							bitacora($accion);	
						
						echo 1;
						
					}
					elseif($r_perfil==2)
					{
							$_SESSION['user']=$rows['id_usuario']; //Storing user session value.
							$_SESSION['id_distrito']=$rows['id_distrito']; //area de adscripcion
							$_SESSION['grupo']=$rows['perfil']; 
							$_SESSION['transaccion']=$rows['usuario'];
							$accion= "ingreso al perfil DEOEYG";
							bitacora($accion);
						
							echo 2;

					}
					elseif($r_perfil==3)
					{
							$_SESSION['user']=$rows['id_usuario']; //Storing user session value.
							$_SESSION['id_distrito']=$rows['id_distrito']; //area de adscripcion
							$_SESSION['grupo']=$rows['perfil']; 
							$_SESSION['transaccion']=$rows['usuario']; //nombre de usuario
							
							$accion= "ingreso al perfil CONSEJO";
							bitacora($accion);
						
							echo 3;
					}
				
				else
				{
				echo 0;
				$accion="Intento ingresar usuario no permitido";
				bitacora($accion);	
				}

		
?>