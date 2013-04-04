<?php

require_once('entidad.php');


/**
 * Los clientes son divididos en persona fisicas y personas morales, y la diferencia entre 
 * estas dos radica en son los datos personales, ya que una persona física tiene nombre y apellidos, 
 * y una persona moral tiene nombre de empresa. 
 * De todos los clientes se obtiene el RFC, el domicilio (calle, no ext, no int, entre que calles, 
 * referencias extras, estado, municipio, colonia y cp), además de uno o varios teléfonos, 
 * uno o varios correos y una o varias cuentas bancarias.
 * Los únicos datos obligatorios de un cliente son los datos personales y el RFC, lo demás puede s
 * er capturados conforme se vayan obteniendo.
 */
class Cliente extends Entidad
{
	public $idCliente;
	public $esPersonaFisica;
	
	/**
	 * @param string $nombre: nombre del cliente
	 * @param string $apellidoPat: apellido paterno del cliente
	 * @param string $apellidoMat: apellido materno del cliente
	 * @param string $RFC: cadena de 13 caracteres con clave única de registro
	 * @param array<string> $telefonos: multiples telefonos del cliente
	 * @param array<object> $cuentasBancarias: múltiples cuentas bancarias
	 * @param array<string> $emails: múltiples correos electronicos
	 * @param array>object> $domicilios: sus direcciones de contacto
	 * @param boolean $esPersonaFisica: FALSE para que sea persona moral 
	 */
	public function __construct($nombre = "", $apellidoPat= "", $apellidoMat= "", $RFC= "", $telefonos= "", $emails= "", $esPersonaFisica = TRUE)
	{
		parent::__construct($nombre, $apellidoPat, $apellidoMat, $RFC, $telefonos, $emails);
		$this->esPersonaFisica = $esPersonaFisica;
	}
	
	/**
	 * Fase final de la creacion del usuario, despues de tener su informacion
	 * personal relacionada con una entidad, se genera el relacion final. Debe 
	 * hacerse DESPUES de crear la entidad en la que se basa. 
	 *
	 * @param int $idBase
	 * @return mixed id del objeto creado en la BD y en caso de falla un FALSE
	 */
	public function crearCliente($idBase)
	{
		if(!$this->conecta())
		{
			die('No se logro conectar la base de datos: '.$conexion->errno.':'.$conexion->error);
		}


		$query = "	INSERT INTO 
						Cliente (Entidad_id_entidad, persona_fisica)
					VALUES 
						($this->idEntidad,
						 $this->esPersonaFisica)";

		//$resultado = $BD->consulta($query);
		$resultado = $this->conexion->query($query);

		if(!$resultado)
		{
			echo 'No se pudo insertar el cliente: '.$this->conexion->errno.':'.$this->conexion->error;
			$retornable = FALSE;
		}
		else
		{
			$this->idCliente = $this->conexion->insert_id;
			$retornable = $this->idCliente;
		}
		
		//$username = $BD->limpiarCadena($_REQUEST['username']);
		//$password = $BD->limpiarCadena($_REQUEST['password']);
		
		
		
		$query = " INSERT INTO 
						Cuenta(Cliente_id_cliente, nombre_usuario, clave_acceso)
					VALUES
						($this->idCliente,'$username', '$password')";
		
		//$resultado = $BD->consulta($query);
		$resultado = $this->conexion->query($query);

		if(!$resultado)
		{
			echo 'No se pudo crear la cuenta '.$this->conexion->errno.':'.$this->conexion->error;
			$retornable = FALSE;
		}

		$this->cerrar_conexion();

		return $retornable;
	}

	public function recuperarCliente($username, $password)
	{
		if(!$this->conecta())
		{
			die('No se pudo conectar la BD para recuperar informacion del cliente: '.$this->conexion->errno.':'.$this->conexion->error);
		}

		
		$query = "SELECT
						*
				  FROM
						Cuenta
				  WHERE
				  		nombre_usuario LIKE '$username'
				  AND
				  		clave_acceso LIKE '$password'";
				  		
		

		//Ejecutar el query
		$resultado = $this->conexion->query($query);
		if($this->conexion->errno)
		{
			echo 'FALLO la recuperacion de la cuenta con esas credenciales '.$this->conexion->errno.' : '.$this->conexion->error;
			//Cerrar la conexion
			
			$this->cerrar_conexion();
			return FALSE;
		}
		else
		{
			$this->cerrar_conexion();

			while ($fila = $resultado -> fetch_assoc())
				$cliente[] = $fila;
			
			if(isset($cliente))
			{
				$idCliente		= $cliente[0]['Cliente_id_cliente'];
				return $this->reconstruirCliente($idCliente);
			}
			
			return FALSE;
			
		}
	}

	private function reconstruirCliente($idCliente)
	{

		if(!$this->conecta())
		{
			die('No se pudo conectar a la BD para reconstruir al cliente: '.$this->conexion->errno.':'.$this->conexion->error);
		}


		$query = "SELECT
						*
				  FROM
						Cliente
				  WHERE
				  		id_cliente = $idCliente";

		//Ejecutar el query
		$resultado = $this->conexion->query($query);

		if($this->conexion->errno)
		{
			echo 'Error obteiendo a el cliente '.$this->conexion->errno.' : '.$this->conexion->error;
			//Cerrar la conexion
			$this->cerrar_conexion();
			return FALSE;
		}
		else
		{
			//Cerrar la conexion
			$this->cerrar_conexion();

			while ($fila = $resultado -> fetch_assoc())
				$cliente[] = $fila;
			
			$esPersonaFisica		= $cliente[0]['persona_fisica'];
			
			parent::recuperar($cliente[0]['Entidad_id_entidad']);
			
			return $this;			
		}
	}
}

?>