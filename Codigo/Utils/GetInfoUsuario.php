<?php
require('../Model/cliente.php');
require_once('DebugerPHP.php');

if(!isset($_SESSION))
{
	session_start();
}
//logConsole("SESSION", $_SESSION, true);
//logConsole("MIRA MIRA", $_SESSION, true);
var_dump($_SESSION);
$usuario = new Cliente();
$exito = $usuario->recuperarCliente($_SESSION['USERNAME'], $_SESSION['PASSWORD']);

if($exito==FALSE)
{
	logConsole('NO SACA LA INFO CORRECTAMENTE', $usuario, true);
}
else 
{
	$arreglo = array('username' => $_SESSION['USERNAME'],
					 'password' => $_SESSION['PASSWORD'],
					 'nombre' => $usuario->getName(),
					 'apellidoP' => $usuario->getApellidoPaterno(),
					 'apellidoM' => $usuario->getApellidoMaterno(),
					 'rfc' => $usuario->getRFC(),
					 'telefono' => $usuario->getTelefono(),
					 'personaFisica' => $usuario->getPersonaFisica(),
					 'email' => $usuario->getEmail()
	);	
	logConsole('EXISTO', $arreglo, true);
	echo json_encode($arreglo);
}

?>