<?php

require_once('baseDatos.php');

abstract class iTablaDB extends BaseDatos
{
    public abstract function insertar();
    public abstract function eliminar();
    public abstract function modificar();
	public abstract static function recuperar($id);
}


?>