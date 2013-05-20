<?php
require_once('../Model/EstadosMunicipio.php');

$Getter = new Localidades();

$estados = $Getter->obtenEstados();

echo json_encode($estados);

?>