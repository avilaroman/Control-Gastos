function validaLogin(){
	form = document.getElementById('well');
	var input_User = document.getElementById('user');
	var input_Pass = document.getElementById('pass');

	if(!/^\w$/test(input_User.value) && !/^{graph}$/test(input_Pass.value)){
		var div = document.createElement('div');
		div.setAttribute('class','error');
		div.setAttribute('id','user_error');
		var msg = document.createTextNode('Usuario o Contraseña Incorrecto');
		div.appenChild(msg);
		form.insertBefore(div,input_User.nextSibling);
	}
	else{
		var dir_error = document.getElementById('user_error');
		if(typeof(div_error) == 'object')
			form.removeChild(div_error);
	}
}

function validaForm(){
	form = document.getElementById('formulario');
	var input_User = document.getElementById('user');
	var input_Pass = document.getElementById('pass');
	var input_Email = document.getElementById('email');
	var input_Nombre = document.getElementById('nombre');
	var input_ApellidoP = document.getElementById('apellidoP');
	var input_ApellidoM = document.getElementById('input_ApellidoM');
	var input_Rfc = document.getElementById('rfc');
	var input_Tel = document.getElementById('tel');
	var input_Calle = document.getElementById('calle');
	var input_NumInt = document.getElementById('numint');
	var input_NumExt = document.getElementById('numext');
	var input_Colonia = document.getElementById('col');
	var input_CP = document.getElementById('cp');
	var input_Estado = document.getElementById('selectEstados');
	var input_Municipio = document.getElementById('municipio');

	if(!/^\w$/test(input_User.value) && !/^{graph}$/test(input_Pass.value)){
		var div = document.createElement('div');
		div.setAttribute('class','error');
		div.setAttribute('id','user_error');
		var msg = document.createTextNode('Usuario o Contraseña Incorrecto');
		div.appenChild(msg);
		form.insertBefore(div,input_User.nextSibling);
	}
	else{
		var dir_error = document.getElementById('user_error');
		if(typeof(div_error) == 'object')
			form.removeChild(div_error);
	}

	if(!/^\w[@]$/test(input_Email.value)){
		var div = document.createElement('div');
		div.setAttribute('class','error');
		div.setAttribute('id','email_error');
		var msg = document.createTextNode('Email Incorrecto');
		div.appenChild(msg);
		form.insertBefore(div,input_User.nextSibling);
	}
	else{
		var dir_error = document.getElementById('email_error');
		if(typeof(div_error) == 'object')
			form.removeChild(div_error);
	}

	if(!/^{alpha}$/test(input_Nombre.value)){
		var div = document.createElement('div');
		div.setAttribute('class','error');
		div.setAttribute('id','nombre_error');
		var msg = document.createTextNode('Incorrecto');
		div.appenChild(msg);
		form.insertBefore(div,input_Nombre.nextSibling);
	}
	else{
		var dir_error = document.getElementById('nombre_error');
		if(typeof(div_error) == 'object')
			form.removeChild(div_error);
	}

	if(!/^{alpha}$/test(input_ApellidoM.value)){
		var div = document.createElement('div');
		div.setAttribute('class','error');
		div.setAttribute('id','apellidoM_error');
		var msg = document.createTextNode('Incorrecto');
		div.appenChild(msg);
		form.insertBefore(div,input_ApellidoM.nextSibling);
	}
	else{
		var dir_error = document.getElementById('apellidoM_error');
		if(typeof(div_error) == 'object')
			form.removeChild(div_error);
	}

	if(!/^{alpha}$/test(input_ApellidoP.value)){
		var div = document.createElement('div');
		div.setAttribute('class','error');
		div.setAttribute('id','apellidoP_error');
		var msg = document.createTextNode('Incorrecto');
		div.appenChild(msg);
		form.insertBefore(div,input_ApellidoP.nextSibling);
	}
	else{
		var dir_error = document.getElementById('apellidoM_error');
		if(typeof(div_error) == 'object')
			form.removeChild(div_error);
	}

	if(!/^{alpha}{4}\d{6}{alnum}{3}$/test(input_Rfc.value)){
		var div = document.createElement('div');
		div.setAttribute('class','error');
		div.setAttribute('id','rfc_error');
		var msg = document.createTextNode('Incorrecto');
		div.appenChild(msg);
		form.insertBefore(div,input_Rfc.nextSibling);
	}
	else{
		var dir_error = document.getElementById('rfc_error');
		if(typeof(div_error) == 'object')
			form.removeChild(div_error);
	}

	if(!/^\d{10}$/test(input_Tel.value)){
		var div = document.createElement('div');
		div.setAttribute('class','error');
		div.setAttribute('id','tel_error');
		var msg = document.createTextNode('Incorrecto');
		div.appenChild(msg);
		form.insertBefore(div,input_Tel.nextSibling);
	}
	else{
		var dir_error = document.getElementById('tel_error');
		if(typeof(div_error) == 'object')
			form.removeChild(div_error);
	}

	if(!/^{alpha}\s$/test(input_Calle.value)){
		var div = document.createElement('div');
		div.setAttribute('class','error');
		div.setAttribute('id','calle_error');
		var msg = document.createTextNode('Incorrecto');
		div.appenChild(msg);
		form.insertBefore(div,input_Calle.nextSibling);
	}
	else{
		var dir_error = document.getElementById('calle_error');
		if(typeof(div_error) == 'object')
			form.removeChild(div_error);
	}

	if(!/^\d$/test(input_NumInt.value)){
		var div = document.createElement('div');
		div.setAttribute('class','error');
		div.setAttribute('id','numint_error');
		var msg = document.createTextNode('Incorrecto');
		div.appenChild(msg);
		form.insertBefore(div,input_NumInt.nextSibling);
	}
	else{
		var dir_error = document.getElementById('numint_error');
		if(typeof(div_error) == 'object')
			form.removeChild(div_error);
	}

	if(!/^\d$/test(input_NumExt.value)){
		var div = document.createElement('div');
		div.setAttribute('class','error');
		div.setAttribute('id','numext_error');
		var msg = document.createTextNode('Incorrecto');
		div.appenChild(msg);
		form.insertBefore(div,input_NumExt.nextSibling);
	}
	else{
		var dir_error = document.getElementById('numext_error');
		if(typeof(div_error) == 'object')
			form.removeChild(div_error);
	}

	if(!/^{alpha}\s$/test(input_Colonia.value)){
		var div = document.createElement('div');
		div.setAttribute('class','error');
		div.setAttribute('id','colonia_error');
		var msg = document.createTextNode('Incorrecto');
		div.appenChild(msg);
		form.insertBefore(div,input_Colonia.nextSibling);
	}
	else{
		var dir_error = document.getElementById('colonia_error');
		if(typeof(div_error) == 'object')
			form.removeChild(div_error);
	}

	if(document.formulario.estado.selectedIndex == 0);
		alert('Debe seleccionar un estado');
	}

	if(document.formulario.municipio.selectedIndex == 0);
		alert('Debe seleccionar un municipio');
	}

}