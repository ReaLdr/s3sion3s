<?php
session_start();

include ("config_open_db.php"); 

function quitar($mensaje)
{
	$nopermitidos = array("'",'\\','<','>',"\"");
	$mensaje = str_replace($nopermitidos, "", $mensaje);
	return $mensaje;
}

if(trim($_POST["usuario"]) != "" && trim($_POST["password"]) != "")
{
	$usuario = htmlentities($_POST["usuario"], ENT_QUOTES);
	$usuario=strtoupper($usuario);
	
	$password = $_POST["password"];
//	$password=md5($password);

	$sql = "SELECT * FROM sisesecd_usuarios WHERE usuario='$usuario'";
	echo $sql;
	$result=ifx_query($sql,$conn);
	 
	if($row = ifx_fetch_row ($result))
	{
	
			if($row['contrasena'] == $password)
			{
				$_SESSION[username] = $row[usuario];
				$_SESSION[k_grupo] = $row[perfil];
				$_SESSION[transaccion] = $row[id_usuario];
				$_SESSION[id_distrito] = $row[id_distrito];
				$_SESSION[id_admin] = $row[id_admin];
				
	
				$perfil_usr=$_SESSION[k_grupo];	
				//echo $perfil_usr;
						
				if($perfil_usr==2 )	
					{
					echo'	<SCRIPT LANGUAGE="javascript">';
					echo'	location.href = "grid_sesiones_central.php";';
					echo'	</SCRIPT>';
					}
	
				if($perfil_usr==3)	
					{
					echo'	<SCRIPT LANGUAGE="javascript">';
					echo'	location.href = "grid_sesiones_consejo.php";';
					echo'	</SCRIPT>';
					}
	
	
			echo'	<SCRIPT LANGUAGE="javascript">';
			echo'	location.href = "main.php";';
			//grid_sesiones.php
			echo'	</SCRIPT>';

				
			}
			else
			{
			echo'	<SCRIPT LANGUAGE="javascript">';
			echo' 	alert("¡¡¡Verificar Usuario y/o Contraseña  ¡¡¡")';
			echo'	</SCRIPT>';
			echo'	<SCRIPT LANGUAGE="javascript">';
			echo'	location.href = "index.php";';
			echo'	</SCRIPT>';

			}
	}
	else
	{
			echo'	<SCRIPT LANGUAGE="javascript">';
			echo' 	alert("¡¡¡ Verificar Usuario y/o Contraseña  ¡¡¡")';
			echo'	</SCRIPT>';
			echo'	<SCRIPT LANGUAGE="javascript">';
			echo'	location.href = "index.php";';
			echo'	</SCRIPT>';

	}

}
	else
	{
		echo'	<SCRIPT LANGUAGE="javascript">';
			echo' 	alert("¡¡¡ Verificar Usuario y/o Contraseña ¡¡¡")';
			echo'	</SCRIPT>';
			echo'	<SCRIPT LANGUAGE="javascript">';
			echo'	location.href = "index.php";';
			echo'	</SCRIPT>';

	}

ifx_close($id_con);

?>