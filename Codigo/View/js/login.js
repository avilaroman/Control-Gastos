function llenarEstados(){
	var ajax = nuevoAjax();
	ajax.open('post','GetEstados.php',true);
	var response = eval(ajax.responseText);
	console.log(response);
	console.log(response[0].id);
	var estado = document.getElementById('selectEstados');
	for (estado in response){
		var option = document.createElement('option');
		var text = document.createTextNode(response[estado].estado);
		option.appenChild(text);
		option.setAttribute('value',response[estado].id_estado);
		estado.appendChild(option);
	}
	ajax.send(null);
}