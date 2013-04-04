<?php

require_once('iTablaDB.php');
require_once('Model/cuentaBancoClass.php');
require_once('Model/direccionClass.php');

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

	public function __construct($nombre, $apellidoPat, $apellidoMat, $RFC, $telefonos, $emails)
	{
		$this->nombre 			= $nombre;
		$this->apellidoPat 		= $apellidoPat;
		$this->apellidoMat 		= $apellidoMat;
		$this->RFC 				= $RFC;
		$this->telefonos 		= $telefonos;
		$this->emails 			= $emails;
		
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
		$this->telefonos 		= $this->limpiarCadena($this->telefonos);
		$this->emails 			= $this->limpiarCadena($this->emails);


		$query = "	INSERT INTO 
						Entidad (nombre, apellido_paterno, apellido_materno, RFC)
					VALUES 
						('$this->nombre',
						'$this->apellidoPat',
						'$this->apellidoMat',
						'$this->RFC')";

		//$resultado = $this->consulta($query);
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
			
			$query = " INSERT INTO
							Telefono(Entidad_id_entidad, telefono)
						VALUES
							($this->idEntidad,
							'$this->telefonos')";
							
			$resultado = $this->conexion->query($query);
			
			if(!$resultado)
			{
				echo 'No se pudo insertar el Telefono: '.$this->conexion->errno.':'.$this->conexion->error;
				$retornable = FALSE;
			}
			
			$query = " INSERT INTO
							Email(Entidad_id_entidad, email)
						VALUES
							($this->idEntidad,
							'$this->emails')";
							
			$resultado = $this->conexion->query($query);
			
			if(!$resultado)
			{
				echo 'No se pudo insertar el email: '.$this->conexion->errno.':'.$this->conexion->error;
				$retornable = FALSE;
			}
			
			
			//Banquini
			$nombre_banco = $_REQUEST['nombreBanco'];
			$numero_cuenta = $_REQUEST['numeroCuenta'];
			
			$this->cuentasBancarias = new CuentaBanco($nombre_banco, $numero_cuenta, $this->idEntidad);
			
			
			$this->cuentasBancarias->insertar();
			
			//Domicilini
			$this->domicilios = new Direccion($_REQUEST['calle'],$_REQUEST['numInterior'],$_REQUEST['numExterior'], $_REQUEST['colonia'], $_REQUEST['cp'], $_REQUEST['estado'], $_REQUEST['municipio'], $this->idEntidad);
			
			$this->domicilios->insertar();
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
			//Cerrar la conexion
			$this->conexion -> close();
			return FALSE;
		}
		else
		{
			//Cerrar la conexion
			$this->cerrar_conexion();

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