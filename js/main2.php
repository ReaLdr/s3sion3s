<?php
  include('sqlconnector.php');
  session_start();
  error_reporting(0);
  
    if(isset($_SESSION['id_usuario'])){
      $id_usuario=$_SESSION["id_usuario"];
      $my_user=$_SESSION["usr"];
      $my_pwd=$_SESSION["pwd"];
    
      $queryA="SELECT * FROM ".usuarios." WHERE id_usuario =".$id_usuario." and perfil=2";

      $resA=sqlsrv_query($conn,$queryA);
        if($rowA= sqlsrv_fetch_array($resA)){
           
        }else{
              session_destroy();
              header("location:login.php");         
        }  
        }else{
              session_destroy();
              header("location:login.php");
        }

 
?>
<HTML>
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>SISCOI</title>
      
      <!-- Bootstrap core CSS -->
      <link href="css/bootstrap.min.css" rel="stylesheet">
      <link href="css/mycss.css" rel="stylesheet">
      <!-- Bootstrap core JavaScript
      ================================================== -->
      <script src="js/jquery-3.3.1.min.js"></script>
      <script src="js/popper.min.js"></script>
      <script src="js/bootstrap.min.js"></script>
      <!--<script src="js/holder.min.js"></script>-->
      <script src="js/funcionesajax.js"></script>
      <link rel="stylesheet" href="css/all.css">
  
  </head>

  <body>

    <div class="container" id="topmenu">      
      <div class="row">           
      <div class="col-sm-8"></div>
      <div class="col-sm-2">
      <button class="btn" style="background-color: #FFF;">
        <?php echo "Usuario: ".$my_user ;?>
      </button>   
      </div>
      <div class="col-sm-1">
      <a href="login.php" class="btn btn-secondary">Cerrar sesión</a>
      </div>   
      </div>
    </div>

    <div class="container" id="main_container">     
      <div class="row" style="margin-bottom: 10px;">
      <div class="col-sm-5">
        <a href="/"><img src="img/bannerrr.jpg" alt="logotipoiecm"></a>
   
      </div>  

<div class="container" id="main_container">
    
    <div class="form-group row">  
    <label class="col-sm-3 control-label">Captura texto a buscar</label>
    <input type="text"  placeholder="buscar" >
    </div>
    <div id="div_errors"></div>
    <div class="row">
            <div class="col-sm-12">
                <table class="table table-hover table-condensed table-bordered">
                    <tr>
                        <td>No. de instrumento jurídico</td>
                        <td>Tipo de instrumento jurídico</td>
                        <td>Contraparte</td>
                        <td>Tipo de institución</td>
                        <td>Objeto</td>
                        <td>Fecha de suscripción</td>
                        <td>Vigencia</td>
                        <td>Area responsable operativa</td>
                        <td>Estatus</td>
                        <td>Acciones Realizadas</td>
                        <td>Observaciones</td>
                        <td>Documento</td>
                        <td>Editar</td>
                    </tr>
                    <tr>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td>
                        <button class="btn btn-warning"></button>
                        </td>
                    </tr>   
                </table>
            </div>
        </div><!--- row -->
  </div>

      </div>
      <div id="div_errors"></div>
      <div class="row"></div>
    </div> <!--- cierra  conteiner  -->
     <!--<?php //include('footer.php');?>-->
  </body>
</html>
