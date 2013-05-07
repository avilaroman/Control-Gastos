<?php

require('Model/cliente.php');
require_once('View/html.html');

class ControladorCliente
{
	public $modelo;
	
	public function ejecutar()
	{
		//si no hya parametros, nomas listar los usuarios
		if(!isset($_POST['accion']) )
		{
			die('No se definio que accion tomar');	
		}
		else
		{
		    $_POST = Cleaner::LimpiarTodo($_POST);
			
            switch ($_POST['accion']) 
			{
				case 'insertar':
					//if($_SESSION['admin'])
					//{
						$usuario = $this->InsertarCliente();
					//}
					//else
					//{
					//	echo "No tienes poderes de super vaca";
					//}
					
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
		$nombre = $_POST['nombre'];
		$apellidoPat = $_POST['apellidoPat'];
		$apellidoMat = $_POST['apellidoMat'];
		$RFC = $_POST['RFC'];
		$esPersonaFisica = $_POST['esPersonaFisica'];
		
		if(strcmp($esPersonaFisica, "on") == 0)
		{
			$esPersonaFisica = TRUE;
		}
		else
		{
			$esPersonaFisica = FALSE;
		}
			
		$this->modelo = new Cliente($nombre, $apellidoPat, $apellidoMat, $RFC, $esPersonaFisica);
		$usuario = $this->modelo;
		if(!$usuario->insertar())
		{
			die('ERRORES CREANDO AL CLIENTE');
		}
		
		$usuario->crearCliente($usuario->getIdEntidad());
		
		if(isset($_POST['telefono']))
		{
			$telefono = new Telefono($usuario->getIdEntidad(), $_POST['telefono']);
			
			if($telefono->insertar())
			{
				$usuario->agregarTelefono($telefono);
			}
		}

		if(isset($_POST['email']))
		{
			$email = new Telefono($usuario->getIdEntidad(), $_POST['email']);
			
			if($email->insertar())
			{
				$usuario->agregarEmail($email);
			}
		}
		
		if(isset($_POST['direccion']))
		{
			$this->InsertarDireccion($usuario);
		}
		
		if(isset($_POST['cuentaBancaria']))
		{
			$this->InsertarCuentaBancaria($usuario);
		}
		
		return $usuario;		
	}

	private function InsertarDireccion($usuario)
	{
		//direccion es un arreglo
		$tmp = $_POST['direccion'];
			
			
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
		$tmp = $_POST['cuentaBancaria'];
			
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
