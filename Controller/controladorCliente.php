<?php

require('Model/cliente.php');

class ControladorCliente
{
	public $modelo;
	private $accionador;
	
	function ejecutar()
	{
		//si no hya parametros, nomas listar los usuarios
		if( !isset($_REQUEST['accion']) )
		{
			$usuarios = $this->modelo->listar();		
		}
		else switch ($_REQUEST['accion']) 
		{
			case 'insertar':
				$nombre = $_REQUEST['nombre'];
				$apellidoPat = $_REQUEST['apellidoPat'];
				$apellidoMat = $_REQUEST['apellidoMat'];
				$RFC = $_REQUEST['RFC'];
				$telefonos = $_REQUEST['telefonos'];
				$cuentasBancarias = $_REQUEST['cuentasBancarias'];
				$emails = $_REQUEST['emails'];
				$domicilios = $_REQUEST['domicilios'];
				$esPersonaFisica = $_REQUEST['esPersonaFisica'];
				
				$this->modelo = new Cliente($nombre, $apellidoPat, $apellidoMat, $RFC, $telefonos, $cuentasBancarias, $emails, $domicilios, $esPersonaFisica);
				
				$usuario = $this->modelo;
				$idBase = $this->modelo->insertar("Entidad");
				$this->modelo->crearCliente($idBase);
				break;
				//http://www.seguame.com/?uso=cliente&accion=insertar&nombre=12445&apellidoPat=adw&apellidoMat=asdasd&RFC=aasd&telefonos=234234&cuentasBancarias=23423423&emails=lolatlol&domicilios=1234&esPersonaFisica=FALSE&username=lol&password=lol
			case 'consultar':
				
				$this->modelo = new Cliente();
				
				$usuario = $this->modelo->recuperarCliente($_REQUEST['username'], $_REQUEST['password']);
				break;

			default:
				echo 'DAFUQ AR U DOIN =_=';
				$usuario = 'groar*';
				break;
		}

		include ('View/vista.php');

	}
}

?>