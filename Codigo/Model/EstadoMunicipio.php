<?php
require_once('baseDatos.php');

class Localidades extends BaseDatos
{
	public function obtenEstados()
	{
		if(!$this->conecta())
		{
			die('EstadosMunicipios::obtenEstados: '.$this->conexion->errno.':'.$this->conexion->error);
		}
		
		$query = "SELECT
					*
				  FROM
				  	estados";
					
		$resultado = $this->conexion->query($query);
		
		while ($fila = $resultado -> fetch_assoc())
				$estados[] = $fila;	
		
		$this->cerrar_conexion();
		
		return $estados;
	}
}
?>