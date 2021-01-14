eventListeners();


function eventListeners(){
    if(document.getElementById('form_crear_convenio')){
        console.log("Estamos por validar");
        document.getElementById('form_crear_convenio').addEventListener('submit', crearconvenio);
    }
}

function crearconvenio(e){
    e.preventDefault();

    console.log("Listo, funciona");


    var tipo_instrumento=document.getElementById("tipo_instrumento").value;
	
	var contraparte=document.getElementById("contraparte").value;
	
	var institucion=document.getElementById("institucion").value;

    var objeto=document.getElementById("objeto").value;

    var fecha_suscripcion=document.getElementById("fecha_suscripcion").value

    var vigencia=document.getElementById("vigencia").value;

    var miArrayp3 = []; $("input[name='checkbox_areas[]']:checkbox:checked").each(function () {
        miArrayp3.push($(this).val());
    });

    //var area_operativa = ("input[name='checkbox_areas[]':checkbox:checked");
    //var area_operativa=document.getElementById("area_operativa").value;

    var estatus_instrumento=document.getElementById("estatus_instrumento").value;
    
    var acciones_realizadas=document.getElementById("acciones_realizadas").value;

    var observaciones=document.getElementById("observaciones").value;

    var documento=document.getElementById("file_docto").value;
    var error_string = "";
    var error = 0;

    $("#errormsg").html("");
    

        if (tipo_instrumento == '0')
        {
            error_string+="<p>El campo tipo de instrumento no puede estar vacío</p>";
            error++;
            
        } 
	
	
	    if (contraparte == 0)
        {
            error_string+="<p>Selecciona contraparte</p>";
            error++;
            
        } 
	
	
	    if (institucion == 0)
        {
           error_string+="<p>Selecciona institucion</p>";
        
            error++;
            
        }

        if (objeto == 0)
        {
            error_string+="<p>Selecciona la objeto</p>";
            error++;
            
        }

        if (fecha_suscripcion == 0)
        {
            error_string+="<p>Selecciona la fecha de suscripcion</p>";
            error++;
            
        }

        if (vigencia == 0)
        {
            error_string+="<p>El campo de vigencia no puede estar vacío</p>";
            error++;
            
        }

        /*if (area_operativa != true){
        //if (!area_operativa){
            error_string+="<p>El campo de area operativa no puede estar vacío</p>";
            error++;
            
        }*/

        if (estatus_instrumento == 0)
        {
            error_string+="<p>El campo de estatus no puede estar vacío</p>";
            error++;
            
        }

        if (acciones_realizadas == 0)
        {
            error_string+="<p>El campo de acciones realizadas no puede estar vacío</p>";
            error++;
            
        }

        if (observaciones == 0)
        {
            error_string+="<p>El campo de observaciones no puede estar vacío</p>";
            error++;
            
        }

        if (documento == null)
        {
            error_string+="<p>falta adjuntar documento</p>";
            error++;
            /* Código de preuba al leer file - verifica peso y tipo*/
            /**/
            
        }
        
        console.log(error);
        

        if(error>0){
            document.getElementById("btn_crearconvenio").disabled=false;
            document.getElementById("btn_crearconvenio").innerHTML="Crear nuevo convenio";
            document.getElementById("errormsg").innerHTML="<div class='alert alert-warning' >"+error_string+"</div>";
            document.getElementById("main_container").setAttribute("style", "pointer-events: auto;");
            return false;

        } else{
            var datos = new FormData();
              var file1 = document.getElementById('file_docto');
              alert(file1);
              //return false;

              datos.append('tipo_instrumento', tipo_instrumento);
              datos.append('contraparte', contraparte);
              datos.append('institucion', institucion);
              datos.append('objeto', objeto);
              datos.append('fecha_suscripcion', fecha_suscripcion);
              datos.append('vigencia', vigencia);
              datos.append('area_operativa',  miArrayp3);
              datos.append('estatus_instrumento', estatus_instrumento);
              datos.append('acciones_realizadas', acciones_realizadas);
              datos.append('observaciones', observaciones);
              datos.append('documento', file1);
                       
            var xhr = new XMLHttpRequest();
            xhr.open('POST', 'modelo_save_convenio.php', true);
            xhr.onload = function(){
                if(this.status == 200){
                    console.log(xhr.responseText);
                }
            };
            xhr.send(datos);
        }
      
/**/
}

function fnSelectInstrumento(){

    var instrumento = $('#instrumento').val();

    var seccion = $('#seccion').val();
    var alcaldia = $('#alcaldia').val();
   alert(instrumento);
    var nombre_instrumento = $('#instrumento option:selected').text();

    if (instrumento == 0) {
        $('#btn_siguiente1').prop('disabled', true);
    } else {
        $('#btn_siguiente1').prop('disabled', false);
    }


    /////////////////////////////////////////
    ///// Generar distrito

    var datos = "&instrumento=" + instrumento;
    datos += "&seccion=" + seccion + "&alcaldia=" + alcaldia;


    //document.getElementById("menu1").innerHTML = datos;
    //alert(datos);
    var xmlhttp = new XMLHttpRequest();
    xmlhttp.onreadystatechange = function () {
        if (this.readyState == 4 && this.status == 200) {
            document.getElementById("distrito").value = this.responseText;





        }
    };

    xmlhttp.open("POST", "getdistritoxseccion.php", true);
    xmlhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded; charset=UTF-8");
    xmlhttp.send(datos);

    //////////////////////////////////////


}
