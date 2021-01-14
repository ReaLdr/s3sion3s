<?php
session_start();
function bitacora($accion)
{
			include ("config_open_db.php"); 
			$id_urs= $_SESSION['user']; //nombre 
			//$user=$_SESSION['user'];
			//echo "$v_urs";
			$query= "SELECT * FROM sisesecd_usuarios WHERE id_usuario='$id_urs'";
			//echo $sql_usuario;
			//$result_1=ifx_query($sql_usuario,$conn);
			//$dato_usr = ifx_fetch_row ($result_1);

			$r= sqlsrv_query($conn,$query);
			 if($rows= sqlsrv_fetch_array($r)){
			//$rows=ifx_fetch_row($resultado);

				$nombre = $rows['nombre'];
				$apellido_pat = $rows['ap_paterno'];
				$apellido_mat = $rows['ap_materno'];
				$usuario =$rows['usuario'];
				$ip_v4=$_SERVER['REMOTE_ADDR']; //
			}
			
			
						
			
			$tmpRem = "INSERT INTO rec_bitacora(nombre,apellido_pat,apellido_mat,usuario,ipv4,accion,ingreso)		VALUES('$nombre','$apellido_pat','$apellido_mat','$usuario','$ip_v4','$accion','".date("Y-m-d h:i:sa")."');";	
	//echo $tmpRem;
	//exit;
	
			$row = sqlsrv_query($conn,$tmpRem);
         	
}
	//		ifx_close();
?>