<?php

	include ('Controller/controladorCliente.php');

	switch ($_REQUEST['uso']) 
	{
		case 'cliente':
			$controlador = new ControladorCliente();
			break;
		case 'Contrato':
			//$controlador = asdasdas;
		
		default:
			$invalido = TRUE;
			break;
	}

	if(isset($invalido))
	{
		echo 'Ejemplos de uso: '.PHP_EOL;
		
		//Llamadas al controlador que se encarga de manejar al cliente
		echo '?uso=cliente&accion=insertar&nombre=Miguel&apellidoPat=Seguame&apellidoMat=Reyes&RFC=1234567890123&telefonos=36436418&cuentasBancarias=012345678&emails=lol%40lol&domicilios=JesusUrueta&esPersonaFisica=TRUE'.PHP_EOL;
	}
	else 
	{
		$controlador->ejecutar();
	}

?>