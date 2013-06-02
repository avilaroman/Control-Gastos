<?php

require('Model/cliente.php');
//require_once('View/html.html');

class ControladorCliente
{
	public $modelo;
	
	public function ejecutar()
	{
		if(!isset($_SESSION))
		{
			session_start();
		}
		
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
					//if(isset($_SESSION['admin']) && $_SESSION['admin'] == 1)
					//{
						$usuario = $this->InsertarCliente();
						$this->enviarEmail();
						$_REQUEST['uso'] = '';
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

		if(isset($usuario))
			include ('View/vista.php');

	}
	
	private function InsertarCliente()
	{
		$nombre = $_REQUEST['nombre'];
		$apellidoPat = $_REQUEST['apellidoPat'];
		$apellidoMat = $_REQUEST['apellidoMat'];
		$RFC = $_REQUEST['RFC'];
		$esPersonaFisica = $_REQUEST['esPersonaFisica'];
		
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
		
		if(isset($_REQUEST['telefono']))
		{
			$telefono = new Telefono($usuario->getIdEntidad(), $_REQUEST['telefono']);
			
			if($telefono->insertar())
			{
				$usuario->agregarTelefono($telefono);
			}
		}

		if(isset($_REQUEST['email']))
		{
			$email = new Email($usuario->getIdEntidad(), $_REQUEST['email']);
			
			if($email->insertar())
			{
				$usuario->agregarEmail($email);
			}
		}
		
		if(isset($_REQUEST['direccion']))
		{
			$this->InsertarDireccion($usuario);
		}
		
		if(isset($_REQUEST['cuentaBancaria']))
		{
			$this->InsertarCuentaBancaria($usuario);
		}
		
		return $usuario;		
	}

	private function InsertarDireccion($usuario)
	{
		//direccion es un arreglo
		$tmp = $_REQUEST['direccion'];
			
			
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
		$tmp = $_REQUEST['cuentaBancaria'];
			
		$nombreBanco 	= $tmp['nombreBanco'];
		$numeroCuenta 	= $tmp['numeroCuenta'];
		
		$cuenta = new CuentaBanco($usuario->getIdEntidad(), $nombreBanco, $numeroCuenta);
		
		if($cuenta->insertar())
		{
			$usuario->agregarCuentaBancaria($cuenta);
		}
	} 
	
	private function enviarEmail()
	{
		//require('Utils/phpmailer/class.phpmailer.php');
		
		$para = $_REQUEST['email'];
		$asunto = 'probando mail';
		$mensaje = 'Esta es una prueba desde un servidor local';
		$headers = 'From: seguame@gastos.com';
		
		if ( mail($para,$asunto,$mensaje,$headers) )
		{
			echo 'Se mando el correo';
		}
		else {
			echo 'Hubo algun error al enviar el correo';
		}
	}
}

?>
