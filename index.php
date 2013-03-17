<html>
<head>
	<title> ola k mira </title>
</head>
<body>
	Van a Reprobar :v <br>
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
			die('No pusiste un modulo D:<');
			break;
	}

	$controlador->ejecutar();

	?>
</body>
</html>