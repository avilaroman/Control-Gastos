<?php

class BaseDatos
{
	private $host;
	private $user;
	private $pass;
	private $db;

	public $conexion;

	function __construct($dbhost, $dbuser, $dbpass, $db)
	{
		$this->host = $dbhost;
		$this->user = $dbuser;
		$this->pass = $dbpass;
		$this->db 	= $db;
	}

	function conecta()
	{
		$this->conexion = new mysqli($this->host, $this->user, $this->pass, $this->db);

		if($this->conexion->errno)
		{
			return FALSE;
		}

		return TRUE;
	}

	function consulta($query)
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

	function cerrar_conexion()
	{
		return $this->conexion->close();
	}

	function limpiarCadena($cadena)
	{
		return $this->conexion->real_escape_string($cadena);
	}
}

?>