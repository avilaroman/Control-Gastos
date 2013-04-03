<?php

abstract class BaseDatos
{
	protected $conexion;
	
	protected function conecta()
	{
		require_once('bd_info.php');
		
		$this->conexion = new mysqli($host, $user, $pass, $db);

		if($this->conexion->errno)
		{
			return FALSE;
		}

		return TRUE;
	}

	protected function consulta($query)
	{
		$resultado = $this->conexion->query($query);

		if($this->conexion->errno)
		{
			return FALSE;
		}

		//Si esperabamos un resultado de vuelta
		if(is_object($resultado))
		{
			if($resultado->num_rows > 0)
			{
				while($fila = $resultado->fetch_assoc())
				{
					$resultado_array[] = $fila;
				}

				return $resultado_array;
			}

			return FALSE;
		}

		//si fue un insert
		//if($this->conexion->insert_id)
		if(strpos($query, "INSERT") == 0)
		{
			return $this->conexion->insert_id;
		}

		//Regresar cantidad de filas afectadas
		return $resultado->affected_rows;
	}

	protected function cerrar_conexion()
	{
		return $this->conexion->close();
	}

	protected function limpiarCadena($cadena)
	{
		return $this->conexion->real_escape_string($cadena);
	}
}

?>