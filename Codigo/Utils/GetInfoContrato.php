<?php
require('../Model/CuentasClass.php');
require_once('DebugerPHP.php');

$Getter = new Cuentas();

$Getter->recuperar($_GET['idCliente']);
$contrato = $Getter->obtenerContratos();

if($contrato==null)
{
	logConsole('NO SACA LA INFO CORRECTAMENTE', $Getter, true);
}

echo json_encode($contrato);

?>