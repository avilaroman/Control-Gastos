<?php

interface iTablaDB
{
    public function insertar();
    public function eliminar();
    public function modificar();
	public function recuperar($id);
}


?>