<?php
require('../Model/cliente.php');
//require_once('DebugerPHP.php');

$usuario = new Cliente();
$entidad = $usuario->obtenerCliente($_GET['idCliente']);

if($entidad==FALSE)
{
	logConsole('NO SACA LA INFO CORRECTAMENTE', $usuario, true);
}
else 
{
	$arreglo = array(array('nombre' => $usuario->getName(),
					 'apellidoP' => $usuario->getApellidoPaterno(),
					 'apellidoM' => $usuario->getApellidoMaterno(),
					 'rfc' => $usuario->getRFC(),
					 'telefono' => $usuario->getTelefono()->getNumero(),
					 'personaFisica' => $usuario->getPersonaFisica(),
					 'email' => $usuario->getEmail()->getEmail(),
					 'cuentaBanco' => $usuario->getCuentaBancaria()
	));
	echo json_encode($arreglo);
}

?>