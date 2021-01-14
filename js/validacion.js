	function validarCorreo(e, sCad) { 
	var Resultado, te, tecla;
	var sCadena="";

		tecla = (document.all) ? e.keyCode : e.which;
	    	if (tecla==8) return true; 
		te = String.fromCharCode(tecla);
		sCadena="" + sCad + te;
		largo=sCadena.length;
		if (largo==1 && te=="@") return false;
		if (largo>0 && te!="@") patron = /[a-zA-Z.-_]/;
		Resultado= patron.test(te);
	    	return Resultado; 
	} 


	function validaNumericos(e) { 
	var Resultado, te, tecla;

		tecla = (document.all) ? e.keyCode : e.which;
	    	if (tecla==8) return true; 
		te = String.fromCharCode(tecla);
		patron = /[0-9.]/;
		Resultado= patron.test(te);
	    	return Resultado; 
	} 

	

	function sololetrasNumeros(e) { 
	var Resultado, te, tecla;
		
		tecla = (document.all) ? e.keyCode : e.which;
	    	if (tecla==8) return true; 
		te = String.fromCharCode(tecla);
		patron = /[a-zñáéíóúÁÉÍÓÚ.,A-ZÑ0-9\s-_]/;
		Resultado= patron.test(te);
	    	return Resultado; 
	} 

	function sololetras(e) { 
	var Resultado, te, tecla;
		
		tecla = (document.all) ? e.keyCode : e.which;
	    	if (tecla==8) return true; 
		te = String.fromCharCode(tecla);
		patron = /[a-zñáéíóúÁÉÍÓÚ´.,A-ZÑ\s-_]/;
		Resultado= patron.test(te);
	    	return Resultado; 
	} 