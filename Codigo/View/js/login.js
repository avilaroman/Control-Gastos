function llenarEstados(){
	var ajax = nuevoAjax();
	var url = window.location.pathname.split('/');
	if(url[3] == 'View')
		ajax.open('GET','../Utils/GetEstados.php',true);
	else
		ajax.open('GET','../Codigo/Utils/GetEstados.php',true);
	
	
	
	ajax.onreadystatechange = function()
	{
		if(ajax.readyState == 4)
		{
			var estados = document.getElementById('selectEstados');
			var response = eval(ajax.responseText);
			
			var defauult = document.createElement('option');
			var texto = document.createTextNode('Selecciona un estado...');
			defauult.appendChild(texto);
			defauult.setAttribute('value', -1);
			
			estados.appendChild(defauult);
			
			for (estado in response){
				var option = document.createElement('option');
				var text = document.createTextNode(response[estado].estado);
				option.appendChild(text);
				option.setAttribute('value',response[estado].id_estado);
				
				estados.appendChild(option);
			}
		}
	}
	
	ajax.send(null);
}

function obtenerMunicipios(select)
{
	var seleccion = select.selectedIndex;
	
	var municipios = document.getElementById('selectMunicipios');
    municipios.options.length = 0;
    
    var defauult = document.createElement('option');
	var texto = document.createTextNode('Selecciona un municipio...');
	defauult.appendChild(texto);
	defauult.setAttribute('value', -1);
				
	municipios.appendChild(defauult);

	
	if(seleccion > 0)
	{
		var ajax = nuevoAjax();
		var url = window.location.pathname;
		if(url == '/Control-Gastos/Codigo/View/expedienteCliente.html')
			ajax.open('GET','../Utils/GetMunicipios.php?idEstado='+seleccion,true);
		else
			ajax.open('GET','../Codigo/Utils/GetMunicipios.php?idEstado='+seleccion,true);
		
		ajax.onreadystatechange = function()
		{
			if(ajax.readyState == 4)
			{
				var response = eval(ajax.responseText);
				
				for (municipio in response){
					var option = document.createElement('option');
					var text = document.createTextNode(response[municipio].nombre_municipio);
					option.appendChild(text);
					option.setAttribute('value',response[municipio].id_municipio);
					
					municipios.appendChild(option);
				}
			}
		}
		
		ajax.send(null);
	}
}

function llenarEstadosAlta(){
	var ajax = nuevoAjax();
	var url = window.location.pathname.split('/');
	if(url[3] == 'View')
		ajax.open('GET','../Utils/GetEstados.php',true);
	else
		ajax.open('GET','../Codigo/Utils/GetEstados.php',true);
	
	
	
	ajax.onreadystatechange = function()
	{
		if(ajax.readyState == 4)
		{
			var estados = document.getElementById('selectEstados2');
			var response = eval(ajax.responseText);
			
			var defauult = document.createElement('option');
			var texto = document.createTextNode('Selecciona un estado...');
			defauult.appendChild(texto);
			defauult.setAttribute('value', -1);
			
			estados.appendChild(defauult);
			
			for (estado in response){
				var option = document.createElement('option');
				var text = document.createTextNode(response[estado].estado);
				option.appendChild(text);
				option.setAttribute('value',response[estado].id_estado);
				
				estados.appendChild(option);
			}
		}
	}
	
	ajax.send(null);
}

function obtenerMunicipiosAlta(select)
{
	var seleccion = select.selectedIndex;
	
	var municipios = document.getElementById('selectMunicipios2');
    municipios.options.length = 0;
    
    var defauult = document.createElement('option');
	var texto = document.createTextNode('Selecciona un municipio...');
	defauult.appendChild(texto);
	defauult.setAttribute('value', -1);
				
	municipios.appendChild(defauult);

	
	if(seleccion > 0)
	{
		var ajax = nuevoAjax();
		var url = window.location.pathname.split('/');
		if(url[3] == 'View')
			ajax.open('GET','../Utils/GetMunicipios.php?idEstado='+seleccion,true);
		else
			ajax.open('GET','../Codigo/Utils/GetMunicipios.php?idEstado='+seleccion,true);
		
		ajax.onreadystatechange = function()
		{
			if(ajax.readyState == 4)
			{
				var response = eval(ajax.responseText);
				
				for (municipio in response){
					var option = document.createElement('option');
					var text = document.createTextNode(response[municipio].nombre_municipio);
					option.appendChild(text);
					option.setAttribute('value',response[municipio].id_municipio);
					
					municipios.appendChild(option);
				}
			}
		}
		
		ajax.send(null);
	}
}

function clientes(){
	var ajax = nuevoAjax();
	var url = window.location.pathname.split('/');
	if(url[3] == 'View')
		ajax.open('GET','../Utils/GetInfoCliente.php',true);
	else
		ajax.open('GET','../Codigo/Utils/GetInfoCliente.php',true);

	ajax.onreadystatechange = function(){
		if(ajax.readyState == 4){
			var clientes = document.getElementById('selectClientes');
			var response = eval(ajax.responseText);

			var elemento = document.createElement('option');
			var texto = document.createTextNode('selecciona Cliente...');
			elemento.appendChild(texto);
			elemento.setAttribute('value', -1);
			clientes.appendChild(elemento);

			for(cliente in response){
				var option = document.createElement('option');
				var text = document.createTextNode(response[cliente].id_cliente);
				option.appendChild(text);
				option.setAttribute('value', response[cliente].id_cliente);
				clientes.appendChild(option);
			}

		}
	}

	ajax.send(null);
}

function obtenerDatos(select)
{
	var seleccion = select.selectedIndex;
	var valor = select.value;
	console.log(valor);
	
	if(seleccion > 0)
	{
		var ajax = nuevoAjax();
		var url = window.location.pathname.split('/');
		if(url[3] == 'View')
			ajax.open('GET','../Utils/GetInfoEntidad.php?idCliente='+valor,true);
		else
			ajax.open('GET','../Codigo/Utils/GetInfoEntidad.php?idCliente='+valor,true);
		
		ajax.onreadystatechange = function()
		{
			if(ajax.readyState == 4)
			{
				var response = eval(ajax.responseText);
				var form = document.getElementById('datosClientes');
				var nombreC = document.getElementById('nombreDatos');
				var apMatC = document.getElementById('apMatDatos');
				var apPatC = document.getElementById('apPatDatos');
				var rfcC = document.getElementById('rfcDatos');
				var tdC = document.getElementById('tableD');
				var tdT = document.getElementById('tableT');

				if(nombreC != null)
					var namae = tdC.parentNode;
					//var namae2 = namae.parentNode;
				if(nombreC && nombreC!=null){
					/*namae.removeChild(nombreC);
					namae.removeChild(apMatC);
					namae.removeChild(apPatC);
					namae.removeChild(rfcC);*/
					namae.removeChild(tdC);
					namae.removeChild(tdT);
				}

				var td = document.createElement('td');
				td.setAttribute('id','tableD');
				var tdTitulos = document.createElement('td');
				tdTitulos.setAttribute('id','tableT');
				tdTitulos.setAttribute('width','15%');

				var rfcHead = document.createElement('div');
				var rfcTitulo = document.createTextNode('RFC:');
				rfcHead.appendChild(rfcTitulo);

    			var rfc = document.createElement('div');
    			var rfcText = document.createTextNode(response[0].rfc);
    			rfc.appendChild(rfcText);
    			rfc.setAttribute('id','rfcDatos');
    			//rfc.setAttribute('class','span8');
    			$(rfc).insertAfter($('#datosTitulo'));

    			var apMatHead = document.createElement('div');
				var apMatTitulo = document.createTextNode('Apellido Materno:');
				apMatHead.appendChild(apMatTitulo);

				var apMat = document.createElement('div');
    			var lastM = document.createTextNode(response[0].apellidoM);
    			apMat.appendChild(lastM);
    			apMat.setAttribute('id','apMatDatos');
    			//apMat.setAttribute('class','span8');
    			$(apMat).insertAfter($('#datosTitulo'));

    			var apPatHead = document.createElement('div');
				var apPatTitulo = document.createTextNode('Apellido Paterno:');
				apPatHead.appendChild(apPatTitulo);

    			var apPat = document.createElement('div');
    			var lastP = document.createTextNode(response[0].apellidoP);
    			apPat.appendChild(lastP);
    			apPat.setAttribute('id','apPatDatos');
    			//apPat.setAttribute('class','span8');
    			$(apPat).insertAfter($('#datosTitulo'));

    			var nombreHead = document.createElement('div');
				var nombreTitulo = document.createTextNode('Nombre:');
				nombreHead.appendChild(nombreTitulo);

    			var nombre = document.createElement('div');
    			var name = document.createTextNode(response[0].nombre);
    			console.log(name);
    			nombre.appendChild(name);
    			nombre.setAttribute('id','nombreDatos');
    			//mbre.setAttribute('class','span8');
    			$(nombre).insertAfter($('#datosTitulo'));
    			td.appendChild(nombre);
    			td.appendChild(apMat);
    			td.appendChild(apPat);
    			td.appendChild(rfc);
    			//tr.appendChild(td);

    			tdTitulos.appendChild(nombreHead);
    			tdTitulos.appendChild(apPatHead);
    			tdTitulos.appendChild(apMatHead);
    			tdTitulos.appendChild(rfcHead);
    			
    			$(td).insertAfter($('#datosTitulo'));
    			$(tdTitulos).insertAfter($('#datosTitulo'));

			}
		}
		
		ajax.send(null);
	}
}

	function home(){
		var protocol = window.location.protocol;
		var host = window.location.host;
		var path = 'Control-Gastos/Codigo/Menu.php';

		//alert(protocol);

		//if(protocol!="")
			var newURL = "/" + path;
		/*else
			var newURL = "/" + path;*/

		window.location.replace(newURL);
	}