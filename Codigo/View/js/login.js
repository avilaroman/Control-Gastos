function llenarEstados(){
	var ajax = nuevoAjax();
	ajax.open('GET','../Utils/GetEstados.php',true);
	
	
	
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
		ajax.open('GET','../Utils/GetMunicipios.php?idEstado='+seleccion,true);
		
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
	ajax.open('GET','../Utils/GetInfoCliente.php',true);

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
		ajax.open('GET','../Utils/GetInfoEntidad.php?idCliente='+valor,true);
		
		ajax.onreadystatechange = function()
		{
			if(ajax.readyState == 4)
			{
				var response = eval(ajax.responseText);
				var form = document.getElementById('datosClientes');
				/*var namae = document.getElementById('nombreDatos');
				if(typeof(namae) == 'object' && namae!=null)
					form.removeChild(namae);*/
    			var rfc = document.createElement('div');
    			var rfcText = document.createTextNode(response[0].rfc);
    			rfc.appendChild(rfcText);
    			rfc.setAttribute('id','rfc');
    			rfc.setAttribute('class','span8');
    			$(rfc).insertAfter($('#datosTitulo'));
				var apMat = document.createElement('div');
    			var lastM = document.createTextNode(response[0].apellidoM);
    			apMat.appendChild(lastM);
    			apMat.setAttribute('id','apMat');
    			apMat.setAttribute('class','span8');
    			$(apMat).insertAfter($('#datosTitulo'));
    			var apPat = document.createElement('div');
    			var lastP = document.createTextNode(response[0].apellidoP);
    			apPat.appendChild(lastP);
    			apPat.setAttribute('id','apPat');
    			apPat.setAttribute('class','span8');
    			$(apPat).insertAfter($('#datosTitulo'));
    			var nombre = document.createElement('div');
    			var name = document.createTextNode(response[0].nombre);
    			console.log(name);
    			nombre.appendChild(name);
    			nombre.setAttribute('id','nombreDatos');
    			nombre.setAttribute('class','span8');
    			$(nombre).insertAfter($('#datosTitulo'));

			}
		}
		
		ajax.send(null);
	}
}