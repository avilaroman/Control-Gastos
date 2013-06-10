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
	$domicilio = $usuario->getDomicilio();
	$arreglo = array(array('nombre' => $usuario->getName(),
					 'apellidoP' => $usuario->getApellidoPaterno(),
					 'apellidoM' => $usuario->getApellidoMaterno(),
					 'rfc' => $usuario->getRFC(),
					 'telefono' => $usuario->getTelefono()->getNumero(),
					 'personaFisica' => $usuario->getPersonaFisica(),
					 'email' => $usuario->getEmail()->getEmail(),
					 'cuentaBanco' => $usuario->getCuentaBancaria(),
					 'calle' => $domicilio->getCalle(),
					 'numInt' => $domicilio->getNumInterior(),
					 'numExt' => $domicilio->getNumExterior(),
					 'colonia' => $domicilio->getColonia(),
					 'cp' => $domicilio->getCodigoPostal(),
					 'estado' => $domicilio->getEstado(),
					 'municipio' => $domicilio->getMunicipio()

	));
	echo json_encode($arreglo);
}

?>