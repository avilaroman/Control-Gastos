<?php

require('Model/cliente.php');

class ControladorCliente
{
	public $modelo;
	private $accionador;
	
	function ejecutar()
	{
		//si no hya parametros, nomas listar los usuarios
		if(!isset($_REQUEST['accion']) )
		{
			die('No se definio que accion tomar');	
		}
		else{
		    $_REQUEST = Cleaner::LimpiarTodo($_REQUEST);
             switch ($_REQUEST['accion']) 
		{
			case 'insertar':
				$nombre = $_REQUEST['nombre'];
				$apellidoPat = $_REQUEST['apellidoPat'];
				$apellidoMat = $_REQUEST['apellidoMat'];
				$RFC = $_REQUEST['RFC'];
				$esPersonaFisica = $_REQUEST['esPersonaFisica'];
				
				$this->modelo = new Cliente($nombre, $apellidoPat, $apellidoMat, $RFC, $esPersonaFisica);
				
				$usuario = $this->modelo;
				$idBase = $this->modelo->insertar();
				$this->modelo->crearCliente($idBase);
				
				break;

			default:
				echo 'DAFUQ AR U DOIN =_=';
				$usuario = 'groar*';
				break;
		}
        }

		include ('View/vista.php');

	}
}

?>