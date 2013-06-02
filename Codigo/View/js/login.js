function llenarEstados(){
	var ajax = nuevoAjax();
	ajax.open('GET','Utils/GetEstados.php',true);
	
	
	
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

function clientes(){
	var ajax = nuevoAjax();
	ajax.open('GET','Utils/GetInfoCliente.php',true);

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
				var text = document.createTextNode(response[cliente].nombre);
				option.appendChild(text);
				option.setAttribute('value', response[cliente].id_entidad);
				clientes.appendChild(option);
			}

		}
	}


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
		ajax.open('GET','Utils/GetMunicipios.php?idEstado='+seleccion,true);
		
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
