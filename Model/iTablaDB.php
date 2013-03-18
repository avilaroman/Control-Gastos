<?php

interface iTablaDB
{
    public function insertar($tabla);
    public function eliminar($tabla);
    public function modificar($tabla);
	public function recuperar($tabla, $id);
}


?>