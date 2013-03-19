<?php
require_once 'iTablaDB.php';

class Direccion implements iTablaDB
{
	public $calle;
	public $numInterior;
	public $numExterior;
	public $colonia;
	public $codigoPostal;
	public $estado;
	public $municipio;
	public $idDuenio;
	
	public function __construct($calle, $numInterior, $numExterior, $colonia, $codigoPostal, $estado, $municipio, $idDuenio)
	{
		$this->calle 		= $calle;
		$this->numInterior 	= $numInterior;
		$this->numExterior 	= $numExterior;
		$this->colonia 		= $colonia;
		$this->codigoPostal = $codigoPostal;
		$this->estado 		= $estado;
		$this->municipio 	= $municipio;
		$this->idDuenio		= $idDuenio;
	}
	
	public function insertar($tabla)
	{
		require('bd_info.inc');
		require_once('baseDatos.php');

		$BD = new BaseDatos($hostdb, $userdb, $passdb, $db);

		if(!$BD->conecta())
		{
			die('No se logro conectar la BD para insertar Direccion: '.$BD->conexion->errno.':'.$BD->conexion->error);
		}

		$this->calle 		= $BD->limpiarCadena($this->calle);
		$this->colonia 		= $BD->limpiarCadena($this->colonia);
		$this->estado 		= $BD->limpiarCadena($this->estado);
		$this->municipio 	= $BD->limpiarCadena($this->municipio);


		$query = "	INSERT INTO 
						$tabla (calle, num_interior, num_exterior, colonia, codigo_postal, stado, municipio)
					VALUES 
						('$this->calle',
						$this->numInterior,
						$this->numExterior,
						'$this->colonia',
						$this->codigoPostal,
						'$this->estado',
						'$this->municipio')";

		//$resultado = $BD->consulta($query);
		$resultado = $BD->conexion->query($query);

		if(!$resultado)
		{
			echo 'Error al insertar una direccion: '.$BD->conexion->errno.':'.$BD->conexion->error;
			$retornable = FALSE;
		}
		else
		{
			$idDireccion = $BD->conexion->insert_id;
			
			$query = " INSERT INTO
							Entidad_has_Domicilio(Entidad_id_entidad, Domicilio_id_domicilio)
						VALUES
							($this->idDuenio, $idDireccion)";
			
			$resultado = $BD->conexion->query($query);
			
			if(!$resultado)
			{
				echo 'Error al relacionar una direccion con una entidad: '.$BD->conexion->errno.':'.$BD->conexion->error;
				$retornable = FALSE;
			}
			else
			{
				$retornable = TRUE;
			}
			
		}

		$BD->cerrar_conexion();

		return $retornable;
	}
	
    public function eliminar($tabla){}
    public function modificar($tabla){}
	public function recuperar($tabla, $id){}
}
?>