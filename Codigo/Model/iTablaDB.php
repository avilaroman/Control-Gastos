<?php

require_once('baseDatos.php');

abstract class iTablaDB extends BaseDatos
{
	protected $id;
	
	
    public abstract function insertar();
    public abstract function eliminar();
    public abstract function modificar();
	public abstract function recuperar($id);
}


?>