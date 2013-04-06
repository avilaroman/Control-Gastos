<?php

require_once('iTablaDB.php');
require_once('Model/DatosEntidades.php');

class Entidad extends BaseDatos
{
	public $nombre;
	public $apellidoPat;
	public $apellidoMat;
	public $RFC;
	public $telefonos;
	public $cuentasBancarias;
	public $emails;
	public $domicilios;
	public $idEntidad;

	public function __construct($nombre, $apellidoPat, $apellidoMat, $RFC)
	{
		$this->nombre 			= $nombre;
		$this->apellidoPat 		= $apellidoPat;
		$this->apellidoMat 		= $apellidoMat;
		$this->RFC 				= $RFC;
	}

	public function insertar()
	{
		if(!$this->conecta())
		{
			die('SHIT HAPPENS: '.$this->conexion->errno.':'.$this->conexion->error);
		}

		$this->nombre 			= $this->limpiarCadena($this->nombre);
		$this->apellidoPat 		= $this->limpiarCadena($this->apellidoPat);
		$this->apellidoMat 		= $this->limpiarCadena($this->apellidoMat);
		$this->RFC 				= $this->limpiarCadena($this->RFC);


		$query = "	INSERT INTO 
						Entidad (nombre, apellido_paterno, apellido_materno, RFC)
					VALUES 
						('$this->nombre',
						'$this->apellidoPat',
						'$this->apellidoMat',
						'$this->RFC')";

		$resultado = $this->conexion->query($query);

		if(!$resultado)
		{
			echo 'No se logro insertar la entidad: '.$this->conexion->errno.':'.$this->conexion->error;
			$retornable = FALSE;
		}
		else
		{
			$this->idEntidad = $this->conexion->insert_id;
			$retornable = $this -> idEntidad;
		}

		$this->cerrar_conexion();

		return $retornable;
	}

    public function eliminar(){}
    public function modificar(){}
	
	public function recuperar($id)
	{

		if(!$this->conecta())
		{
			die('SHIT HAPPENS: '.$this->conexion->errno.':'.$this->conexion->error);
		}


		$query = "SELECT
						*
				  FROM
						Entidad
				  WHERE
				  		$id = id_entidad";

		//Ejecutar el query
		$resultado = $this->conexion->query($query);

		if($this->conexion->errno)
		{
			echo 'FALLO '.$this->conexion->errno.' : '.$this->conexion->error;
			
			$this->conexion -> close();
			return FALSE;
		}
		else
		{
			$this->cerrar_conexion();

			while ($fila = $resultado -> fetch_assoc())
				$entidad[] = $fila;
			
			$this->nombre 			= $entidad[0]['nombre'];
			$this->apellidoPat 		= $entidad[0]['apellido_paterno'];
			$this->apellidoMat 		= $entidad[0]['apellido_materno'];
			$this->RFC 				= $entidad[0]['RFC'];
			$this->idEntidad		= $entidad[0]['id_entidad'];
			
			return $entidad;			
		}
	}
}
?>