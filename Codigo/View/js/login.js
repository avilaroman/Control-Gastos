function llenarEstados(){
	var ajax = nuevoAjax();
	ajax.open('POST','Utils/GetEstados.php',true);
	
	ajax.onreadystatechange = function()
	{
		if(ajax.readyState == 4)
		{
			var response = eval(ajax.responseText);
			for (estado in response){
				var option = document.createElement('option');
				var text = document.createTextNode(response[estado].estado);
				option.appendChild(text);
				option.setAttribute('value',response[estado].id_estado);
				var estados = document.getElementById('selectEstados');
				estados.appendChild(option);
			}
		}
	}
	
	ajax.send(null);
}