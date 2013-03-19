<?php

require_once('iTablaDB.php');
require_once('Model/cuentaBancoClass.php');
require_once('Model/direccionClass.php');

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

	public function __construct($nombre, $apellidoPat, $apellidoMat, $RFC, $telefonos, $emails)
	{
		$this->nombre 			= $nombre;
		$this->apellidoPat 		= $apellidoPat;
		$this->apellidoMat 		= $apellidoMat;
		$this->RFC 				= $RFC;
		$this->telefonos 		= $telefonos;
		$this->emails 			= $emails;
		
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
		$this->telefonos 		= $BD->limpiarCadena($this->telefonos);
		$this->emails 			= $BD->limpiarCadena($this->emails);


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
			echo 'No se logro insertar la entidad: '.$BD->conexion->errno.':'.$BD->conexion->error;
			$retornable = FALSE;
		}
		else
		{
			$this->idEntidad = $BD->conexion->insert_id;
			$retornable = $this -> idEntidad;
			
			$query = " INSERT INTO
							Telefono(Entidad_id_entidad, telefono)
						VALUES
							($this->idEntidad,
							'$this->telefonos')";
							
			$resultado = $BD->conexion->query($query);
			
			if(!$resultado)
			{
				echo 'No se pudo insertar el Telefono: '.$BD->conexion->errno.':'.$BD->conexion->error;
				$retornable = FALSE;
			}
			
			$query = " INSERT INTO
							Email(Entidad_id_entidad, email)
						VALUES
							($this->idEntidad,
							'$this->emails')";
							
			$resultado = $BD->conexion->query($query);
			
			if(!$resultado)
			{
				echo 'No se pudo insertar el email: '.$BD->conexion->errno.':'.$BD->conexion->error;
				$retornable = FALSE;
			}
			
			
			//Banquini
			$nombre_banco = $_REQUEST['nombreBanco'];
			$numero_cuenta = $_REQUEST['numeroCuenta'];
			
			$this->cuentasBancarias = new CuentaBanco($nombre_banco, $numero_cuenta, $this->idEntidad);
			
			
			$this->cuentasBancarias->insertar("Cuenta_Bancaria");
			
			//Domicilini
			$this->domicilios = new Direccion($_REQUEST['calle'],$_REQUEST['numInterior'],$_REQUEST['numExterior'], $_REQUEST['colonia'], $_REQUEST['cp'], $_REQUEST['estado'], $_REQUEST['municipio'], $this->idEntidad);
			
			$this->domicilios->insertar("Domicilio");
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
			$this->idEntidad		= $entidad[0]['id_entidad'];
			/*$this->telefonos 		= $entidad[0]['nombre'];
			$this->cuentasBancarias = $entidad[0]['nombre'];
			$this->emails 			= $entidad[0]['nombre'];
			$this->domicilios 		= $entidad[0]['nombre'];*/
			
			return $entidad;			
		}
	}
}

?>