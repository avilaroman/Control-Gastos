/**
 * @author Miguel Seguame Reyes
 */

function rellenaFormulario()
{
	var ajax = nuevoAjax();
	ajax.open('GET','Utils/GetInfoUsuario.php',true);
	
	ajax.onreadystatechange = function()
	{
		if(ajax.readyState == 4)
		{
			//var nombre = document.getElementById('nombre');
			
			var response = ajax.responseText;
			
			//console.log(nombre);
			//console.log(response);
			//for(valores in response)
			//{
				//nombre.setAttribute('value', response[valores].nombre);
			//}
			
			//var defauult = document.createElement('option');
			//var texto = document.createTextNode('Selecciona un estado...');
			//defauult.appendChild(texto);
			//defauult.setAttribute('value', -1);
			
			//estados.appendChild(defauult);
			
			//for (estado in response){
			//	var option = document.createElement('option');
			//	var text = document.createTextNode(response[estado].estado);
			//	option.appendChild(text);
			//	option.setAttribute('value',response[estado].id_estado);
			//	
			//	estados.appendChild(option);
			//}
		}
	}
	
	ajax.send(null);
}
