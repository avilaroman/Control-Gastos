<?php
require('../Model/cliente.php');
require_once('DebugerPHP.php');

$Getter = new Cliente();

$clientes = $Getter->obtenerClientes();

if($clientes==FALSE)
{
	logConsole('NO SACA LA INFO CORRECTAMENTE', $Getter, true);
}

echo json_encode($clientes);

?>