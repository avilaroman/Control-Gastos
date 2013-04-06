<?php

require('Model/cliente.php');

class ControladorCliente
{
	public $modelo;
	
	public function ejecutar()
	{
		//si no hya parametros, nomas listar los usuarios
		if(!isset($_REQUEST['accion']) )
		{
			die('No se definio que accion tomar');	
		}
		else
		{
		    $_REQUEST = Cleaner::LimpiarTodo($_REQUEST);
			
            switch ($_REQUEST['accion']) 
			{
				case 'insertar':
					$this->InsertarCliente();
					break;
	
				default:
					echo 'DAFUQ AR U DOIN =_=';
					$usuario = 'groar*';
					break;
			}
        }

		include ('View/vista.php');

	}
	
	private function InsertarCliente()
	{
		$nombre = $_REQUEST['nombre'];
		$apellidoPat = $_REQUEST['apellidoPat'];
		$apellidoMat = $_REQUEST['apellidoMat'];
		$RFC = $_REQUEST['RFC'];
		$esPersonaFisica = $_REQUEST['esPersonaFisica'];
			
		$this->modelo = new Cliente($nombre, $apellidoPat, $apellidoMat, $RFC, $esPersonaFisica);
					
		$usuario = $this->modelo;
		if(!$this->modelo->insertar())
		{
			die('ERRORES CREANDO AL CLIENTE');
		}
		
		$this->modelo->crearCliente($idCliente);
		
		if(isset($_REQUEST['telefono']))
		{
			$telefono = new Telefono($this->modelo->getIdEntidad(), $_REQUEST['telefono']);
			$telefono->insertar();
		}

		if(isset($_REQUEST['email']))
		{
			$email = new Telefono($this->modelo->getIdEntidad(), $_REQUEST['email']);
			$email->insertar();
		}
		
		if(isset($_REQUEST['direccion']))
		{
			$this->InsertarDireccion();
		}
		
	}

	private function InsertarDireccion()
	{
		//direccion es un arreglo
		$tmp = $_REQUEST['direccion'];
		Cleaner::LimpiarTodo($tmp);
			
			
		$calle 			= $tmp['calle'];
		$numInterior 	= $tmp['numInterior'];
		$numExterior 	= $tmp['numExterior'];
		$colonia 		= $tmp['colonia'];
		$codigoPostal 	= $tmp['cp'];
		$estado 		= $tmp['estado'];
		$municipio 		= $tmp['municipio'];
		
		$direccion = new Direccion($this->modelo->getIdEntidad(), $calle, $numInterior, $numExterior, $colonia, $codigoPostal, $estado, $municipio);
		$direccion->insertar();
	} 
}

?>