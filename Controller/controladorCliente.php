<?php

require('Model/cliente.php');

class ControladorCliente
{
	public $modelo;
	private $accionador;

	function __construct()
	{
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
	}
	
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
				$usuario = $this->modelo;
				$idBase = $this->modelo->insertar("Entidad");
				$this->modelo->crearCliente($idBase);
				//$usuario = $this->modelo->insertarUsuario($_GET['nombre'], $_GET['mail'], $_GET['pass'], $_GET['privilegio']);
				break;
			
			case 'consultar':
				//$usuarios = $this->modelo->consultarId($_GET['id']);
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