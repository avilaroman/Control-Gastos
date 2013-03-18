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
	
	public function recuperar($tabla, $id)
	{
		require('bd_info.inc');
		require_once('baseDatos.php');

		$BD = new BaseDatos($hostdb, $userdb, $passdb, $db);

		if(!$BD->conecta())
		{
			die('SHIT HAPPENS: '.$BD->conexion->errno.':'.$BD->conexion->error);
		}


		$query = "SELECT
						*
				  FROM
						$tabla
				  WHERE
				  		$id = id_entidad";

		//Ejecutar el query
		$resultado = $BD->conexion->query($query);

		if($BD->conexion->errno)
		{
			echo 'FALLO '.$BD->conexion->errno.' : '.$BD->conexion->error;
			//Cerrar la conexion
			$BD->conexion -> close();
			return FALSE;
		}
		else
		{
			//Cerrar la conexion
			$BD->cerrar_conexion();

			while ($fila = $resultado -> fetch_assoc())
				$entidad[] = $fila;
			
			$this->nombre 			= $entidad[0]['nombre'];
			$this->apellidoPat 		= $entidad[0]['apellido_paterno'];
			$this->apellidoMat 		= $entidad[0]['apellido_materno'];
			$this->RFC 				= $entidad[0]['RFC'];
			/*$this->telefonos 		= $entidad[0]['nombre'];
			$this->cuentasBancarias = $entidad[0]['nombre'];
			$this->emails 			= $entidad[0]['nombre'];
			$this->domicilios 		= $entidad[0]['nombre'];*/
			
			return $entidad;			
		}
	}
}

?>