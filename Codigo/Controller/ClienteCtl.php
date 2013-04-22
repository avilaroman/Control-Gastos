<?php

require('Model/cliente.php');
require_once('View/html.html');

class ControladorCliente
{
	public $modelo;
	
	public function ejecutar()
	{
		//si no hya parametros, nomas listar los usuarios
		if(!isset($_GET['accion']) )
		{
			die('No se definio que accion tomar');	
		}
		else
		{
		    $_GET = Cleaner::LimpiarTodo($_GET);
			
            switch ($_GET['accion']) 
			{
				case 'insertar':
					if($_SESSION['admin'])
					{
						$usuario = $this->InsertarCliente();
					}
					else
					{
						echo "No tienes poderes de super vaca";
					}
					
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
		$nombre = $_GET['nombre'];
		$apellidoPat = $_GET['apellidoPat'];
		$apellidoMat = $_GET['apellidoMat'];
		$RFC = $_GET['RFC'];
		$esPersonaFisica = $_GET['esPersonaFisica'];
			
		$this->modelo = new Cliente($nombre, $apellidoPat, $apellidoMat, $RFC, $esPersonaFisica);
		$usuario = $this->modelo;
		if(!$usuario->insertar())
		{
			die('ERRORES CREANDO AL CLIENTE');
		}
		
		$usuario->crearCliente($usuario->getIdEntidad());
		
		if(isset($_GET['telefono']))
		{
			$telefono = new Telefono($usuario->getIdEntidad(), $_GET['telefono']);
			
			if($telefono->insertar())
			{
				$usuario->agregarTelefono($telefono);
			}
		}

		if(isset($_GET['email']))
		{
			$email = new Telefono($usuario->getIdEntidad(), $_GET['email']);
			
			if($email->insertar())
			{
				$usuario->agregarEmail($email);
			}
		}
		
		if(isset($_GET['direccion']))
		{
			$this->InsertarDireccion($usuario);
		}
		
		if(isset($_GET['cuentaBancaria']))
		{
			$this->InsertarCuentaBancaria($usuario);
		}
		
		return $usuario;		
	}

	private function InsertarDireccion($usuario)
	{
		//direccion es un arreglo
		$tmp = $_GET['direccion'];
			
			
		$calle 			= $tmp['calle'];
		$numInterior 	= $tmp['numInterior'];
		$numExterior 	= $tmp['numExterior'];
		$colonia 		= $tmp['colonia'];
		$codigoPostal 	= $tmp['cp'];
		$estado 		= $tmp['estado'];
		$municipio 		= $tmp['municipio'];
		
		$direccion = new Direccion($usuario->getIdEntidad(), $calle, $numInterior, $numExterior, $colonia, $codigoPostal, $estado, $municipio);
		
		if($direccion->insertar())
		{
			$usuario->agregarDomicilio($direccion);
		}
	} 

	private function InsertarCuentaBancaria($usuario)
	{
		//cuentaBancaria es un arreglo
		$tmp = $_GET['cuentaBancaria'];
			
		$nombreBanco 	= $tmp['nombreBanco'];
		$numeroCuenta 	= $tmp['numeroCuenta'];
		
		$cuenta = new CuentaBanco($usuario->getIdEntidad(), $nombreBanco, $numeroCuenta);
		
		if($cuenta->insertar())
		{
			$usuario->agregarCuentaBancaria($cuenta);
		}
	} 
}

?>
