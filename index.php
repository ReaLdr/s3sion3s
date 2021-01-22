<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<link href="css/stilacho.css" rel="stylesheet" type="text/css" />
<link href="index.css" rel="stylesheet"  type="text/css" />
<link href="css/bootstrap.min.css" rel="stylesheet">
<title>.:SISESECD:.</title>
<!--<script type="text/javascript" src="reflection/reflection.js"></script>-->
	<meta name="viewport" content="width=device-width, initial-scale=1" charset="utf-8">

    <link rel="stylesheet" type="text/css" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" />
	<link href="https://fonts.googleapis.com/css?family=Raleway:100,100i,200,200i,300,300i,400,400i,500,500i,600,600i,700,700i,800,800i,900,900i" rel="stylesheet">


<script src="js/jquery-3.3.1.min.js"></script><!-- 1.11.1 -->
<script src="js/bootstrap.min.js"></script>



<script type="text/javascript">
$(document).ready(function(){
	$(".mybtn").click(function() {
		//consigue valores

	//	btn_g = document.getElementById('boton_ocu');
	//	btn_g.style.display='block';

		$("div#errorMsg").css("display", "block");
		$("div#errorMsg").html("<p style='color:#FB1D1D'></p>");



		var txtUsr = $("input#usr").val();
		if(txtUsr=="")
		{
	    alert('Contenido del Campo: "Usuario" es obligatorio.')
		$("div#errorMsg").css("display", "block");
		$("div#errorMsg").html("<p style='color:#FB1D1D'>El Contenido del Campo: Usuario es obligatorio</p>");
		return false
		}


		var txtPass = $("input#pass").val();
		if(txtPass=="")
		{
	    alert('Contenido del Campo: "Contraseña" es obligatorio.')
		$("div#errorMsg").css("display", "block");
		$("div#errorMsg").html("<p style='color:#FB1D1D'>El contenido del Campo:  Contrasea es obligatorio</p>");

		return false
		}

			// checa si los campos estan vacios
			if((txtUsr=="" ) || (txtPass== ""))
			{
				$("div#errorMsg").css("display", "block");
				$("div#errorMsg").html("<p style='color:#FB1D1D'>**Favor de capturar todos los campos</p>");

			}
			else
			{
			//	btn_g.style.display='none';
				$("div#errorMsg").css("display", "block");
				$("div#errorMsg").html("<img src='images/guardando.gif'></p>");

						//llama la funci? ajax para checar los usernames
				checkUser(txtUsr, txtPass);
			}

		}
		); //fin del evento click


		// Funci?n para checar si existe el usuario en la bd
function checkUser(txtUsr, txtPass){
	var dataString = 'sUsr=' + txtUsr + '&sPass=' + txtPass; // construye variable de parametro que se enviara por llamdo de ajax
		//alert("entro1");	// Llamado ajax para checar user/pwd
		$.ajax({
			type: "POST",
			url: "ajaxLogin.php",
			data: dataString,
			success: function(response) {

				//alert("ESTE ES EL QUERY: "+response);
				//document.write(response);

					if (response == 0)
					{
						//alert("Entraaa: "+response);
						$("div#errorMsg").css("display", "block");
						$("div#errorMsg").html("<p style='color:#FB1D1D'>Usuario o Contraseña Incorrecta.</p>");
						btn_g.style.display='block';
						//alert("Clave de Elector o Nmero OCR Incorrecto");
					}
					 else
					{
						if (response == 1)
						{

							window.location.replace("main.php");
								//window.location.replace("main.php");
						}

						if (response == 2)
							{
								window.location.replace("grid_sesiones_central.php");
							}
						if(response == 3)
							{
								window.location.replace("grid_sesiones_consejo.php");
							}

						else
						{
						$("div#errorMsg").html("<p style='color:#FB1D1D'>Validar Datos.</p>");
				//			btn_g.style.display='block';
							$("div#errorMsg").css("display", "block");

						//window.location.replace("index.php");
						}//response1
					}//rersponse 0

			}//response

			});
	}  //Fin de la funci?n checkUser()

 });//


</script>
</head>
<body>
<div id="container" align="center">
<!--  <img id="graph" src="images/logo02.png">-->

	     <header>
          <h1>Sistema de Seguimiento a las Sesiones de los Consejos Distritales<br>Proceso Electoral Local Ordinario 2020-2021 </h1>
        </header>
  <p><br>
  </p>
  <p><br>
  </p>
	    <section>
          <div id="container_demo" >
            <div id="wrapper">
              <div id="login" class="animate form">

						<form name="form" id="form" autocomplete="on" >
							 <h1><img src="images/logo-header.png"></h1>



						   <label for="username" class="uname" > Usuario </label>
						  <input maxlength="20" type="text" class="form-control" id="usr" name="usr" placeholder="Nombre de usuario" onkeypress='return validar_texto(event)' >

							<label for="password" class="youpasswd"> Contraseña </label>
								<input name="pass" type="password" class="form-control" id="pass" size="20" maxlength="20" onpaste="return false;" placeholder="Contraseña" onkeypress='return validar_texto(event)'/>

							<!--	<input type="submit" class="btn button button-primary" value="Enviar" id="login"/> -->
							<br>
								 <a href="#" class="mybtn"><img id="loginBtn" src="images/loginbtn.png" /></a>
							</fieldset>
							<span class='msg'></span>

								<div id="errorMsg">

								</div>
						</form></div></div></div>
	</section>
	</div>
	 <?php
                  include('footer.php');
                ?>
</body>
</html>
<strong></strong>
