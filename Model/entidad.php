<?php

require_once('iTablaDB.php');

class Entidad implements iTablaDB
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

	public function __construct($nombre, $apellidoPat, $apellidoMat, $RFC, $telefonos, $cuentasBancarias, $emails, $domicilios)
	{
		$this->nombre 			= $nombre;
		$this->apellidoPat 		= $apellidoPat;
		$this->apellidoMat 		= $apellidoMat;
		$this->RFC 				= $RFC;
		$this->telefonos 		= $telefonos;
		$this->cuentasBancarias = $cuentasBancarias;
		$this->emails 			= $emails;
		$this->domicilios 		= $domicilios;
	}

	public function insertar($tabla)
	{
		require('bd_info.inc');
		require_once('baseDatos.php');

		$BD = new BaseDatos($hostdb, $userdb, $passdb, $db);

		if(!$BD->conecta())
		{
			die('SHIT HAPPENS: '.$BD->conexion->errno.':'.$BD->conexion->error);
		}

		$this->nombre 			= $BD->limpiarCadena($this->nombre);
		$this->apellidoPat 		= $BD->limpiarCadena($this->apellidoPat);
		$this->apellidoMat 		= $BD->limpiarCadena($this->apellidoMat);
		$this->RFC 				= $BD->limpiarCadena($this->RFC);


		$query = "	INSERT INTO 
						$tabla (nombre, apellido_paterno, apellido_materno, RFC)
					VALUES 
						('$this->nombre',
						'$this->apellidoPat',
						'$this->apellidoMat',
						'$this->RFC')";

		//$resultado = $BD->consulta($query);
		$resultado = $BD->conexion->query($query);

		if(!$resultado)
		{
			echo 'SHIT HAPPENS: '.$BD->conexion->errno.':'.$BD->conexion->error;
			$retornable = FALSE;
		}
		else
		{
			$this->idEntidad = $BD->conexion->insert_id;
			$retornable = $this -> idEntidad;
		}

		$BD->cerrar_conexion();

		return $retornable;
	}

    public function eliminar($tabla){}
    public function modificar($tabla){}
}

?>