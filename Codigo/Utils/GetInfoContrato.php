<?php
require('../Model/ContratoClass.php');
//require_once('DebugerPHP.php');

$Getter = new Contrato();

$contrato = $Getter->recuperar($_POST['id_contrato']);

if($contrato==null)
{
	logConsole('NO SACA LA INFO CORRECTAMENTE', $Getter, true);
}

echo json_encode($contrato);

?>