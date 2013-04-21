<?php

require_once ('Model/iTablaDB.php');


class Telefono extends iTablaDB
{
  	private $numero;
	private $id_propietario;
	
	public function __construct($id_propietario, $numero)
	{
		$this->id_propietario = $id_propietario;
		$this->numero = $numero;
	}
		
   	public function insertar()
   	{
   		
   		if(!$this->conecta())
		{
			die('DatosEntidades::Telefono: '.$this->conexion->errno.':'.$this->conexion->error);
		}
		
		$query = " INSERT INTO
						Telefono(Entidad_id_entidad, telefono)
					VALUES
						($this->id_propietario,
						'$this->numero')";
						
		$resultado = $this->conexion->query($query);
		
		if(!$resultado)
		{
			echo 'DatosEntidades::Telefono -> No se pudo insertar el Telefono: '.$this->conexion->errno.':'.$this->conexion->error;
			$retornable = FALSE;
		}
		else
		{
			$this->id = $this->conexion->insert_id;
			$retornable = TRUE;
		}
		
		$this->cerrar_conexion();
		
		return $retornable;
   	}
	
    public function eliminar()
    {
    	if(!$this->conecta())
		{
			die('DatosEntidades::Telefono: '.$this->conexion->errno.':'.$this->conexion->error);
		}
		
		$query = " DELETE FROM
						Telefono
					WHERE
						id_telefono = $this->id
					LIMIT
						1";
						
		$resultado = $this->conexion->query($query);
		
		if(!$resultado)
		{
			echo 'DatosEntidades::Telefono -> No se pudo eliminar el Telefono: '.$this->conexion->errno.':'.$this->conexion->error;
			$retornable = FALSE;
		}
		else
		{
			$retornable = TRUE;
		}
		
		$this->cerrar_conexion();
		
		return $retornable;
    }
    public function modificar(){}
	public function recuperar($id){}
}

class CuentaBanco extends iTablaDB
{
	private $nombreBanco;
	private $numeroCuenta;
	private $idDuenio;
	
	public function __construct($idDuenio, $nombreBanco, $numeroCuenta)
	{
		$this->nombreBanco = $nombreBanco;
		$this->numeroCuenta = $numeroCuenta;
		$this->idDuenio = $idDuenio;
	}
	
	public function insertar()
	{
		if(!$this->conecta())
		{
			die('DatosEntidades::CuentaBanco: '.$this->conexion->errno.':'.$this->conexion->error);
		}

		//$this->nombreBanco = $this->limpiarCadena($this->nombreBanco);


		$query = "	INSERT INTO 
						Cuenta_Bancaria (Entidad_id_entidad,num_cuenta)
					VALUES 
						($this->idDuenio,
						'$this->numeroCuenta')";
		//$resultado = $this->consulta($query);
		$resultado = $this->conexion->query($query);

		if(!$resultado)
		{
			echo 'DatosEntidades::CuentaBanco -> No se pudo insertar la cuenta bancaria: '.$this->conexion->errno.':'.$this->conexion->error;
			$retornable = FALSE;
		}
		else
		{
			
			$this->id = $this->conexion->insert_id;
			
			$query = "  SELECT 
							id_banco
						FROM
							Banco
						WHERE
							nombre LIKE '$this->nombreBanco'";
							
			$resultado = $this->conexion->query($query);
							
			while ($fila = $resultado -> fetch_assoc())
				$banco[] = $fila;
			
			if(isset($banco))
			{
				$idBanco = $banco[0]['id_banco'];
				
				$query = "	INSERT INTO 
								Cuenta_Bancaria_has_Banco (Cuenta_Bancaria_id_cuenta_Bancaria, Banco_id_banco)
							VALUES 
								($this->id, $idBanco)";
				
				$resultado = $this->conexion->query($query);

				if(!$resultado)
				{
					echo 'DatosEntidades::CuentaBanco -> No se pudo relacionar la cuenta del banco: '.$this->conexion->errno.':'.$this->conexion->error;
					$retornable = FALSE;
				}
						
				$retornable = TRUE;
			}
			else
			{
				 $retornable = FALSE;
			}
			
		}

		$this->cerrar_conexion();

		return $retornable;
	}
    public function eliminar()
    {
    	if(!$this->conecta())
		{
			die('DatosEntidades::CuentaBanco: '.$this->conexion->errno.':'.$this->conexion->error);
		}
		
		$query = " DELETE FROM
						Cuenta_Bancaria
					WHERE
						id_cuenta_Bancaria = $this->id
					LIMIT
						1";
						
		$resultado = $this->conexion->query($query);
		
		if(!$resultado)
		{
			echo 'DatosEntidades::CuentaBanco -> No se pudo eliminar la Cuenta Bancaria: '.$this->conexion->errno.':'.$this->conexion->error;
			$retornable = FALSE;
		}
		else
		{
			$retornable = TRUE;
		}
		
		$this->cerrar_conexion();
		
		return $retornable;
    }
    public function modificar(){}
	public function recuperar($id){}
}

class Email extends iTablaDB
{
	private $email;
	private $id_propietario;
	
	public function __construct($id_propietario, $email)
	{
		$this->id_propietario = $id_propietario;
		$this->$email = $email;
	}
		
   	public function insertar()
   	{	
   		if(!$this->conecta())
		{
			die('DatosEntidades::Email: '.$this->conexion->errno.':'.$this->conexion->error);
		}
		
		$query = " INSERT INTO
							Email(Entidad_id_entidad, email)
						VALUES
							($this->idEntidad,
							'$this->email')";
							
		$resultado = $this->conexion->query($query);
			
		if(!$resultado)
		{
			echo 'DatosEntidades::Email -> No se pudo insertar el email: '.$this->conexion->errno.':'.$this->conexion->error;
			$retornable = FALSE;
		}
		else
		{
			$this->id = $this->conexion->insert_id();
			$retornable = TRUE;
		}
		
		$this->cerrar_conexion();
		
		return $retornable;
   	}
	
    public function eliminar()
    {
    	if(!$this->conecta())
		{
			die('DatosEntidades::Email: '.$this->conexion->errno.':'.$this->conexion->error);
		}
		
		$query = " DELETE FROM
						Email
					WHERE
						id_email = $this->id
					LIMIT
						1";
						
		$resultado = $this->conexion->query($query);
		
		if(!$resultado)
		{
			echo 'DatosEntidades::Email -> No se pudo eliminar el Email: '.$this->conexion->errno.':'.$this->conexion->error;
			$retornable = FALSE;
		}
		else
		{
			$retornable = TRUE;
		}
		
		$this->cerrar_conexion();
		
		return $retornable;
    }
    public function modificar(){}
	public function recuperar($id){}
}

class Direccion extends iTablaDB
{
	public $calle;
	public $numInterior;
	public $numExterior;
	public $colonia;
	public $codigoPostal;
	public $estado;
	public $municipio;
	public $idDuenio;
	
	public function __construct($idDuenio, $calle, $numInterior, $numExterior, $colonia, $codigoPostal, $estado, $municipio)
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
	
	public function insertar()
	{
		if(!$this->conecta())
		{
			die('DatosEntidades::Direccion: '.$this->conexion->errno.':'.$this->conexion->error);
		}

		$this->calle 		= $this->limpiarCadena($this->calle);
		$this->colonia 		= $this->limpiarCadena($this->colonia);
		$this->estado 		= $this->limpiarCadena($this->estado);
		$this->municipio 	= $this->limpiarCadena($this->municipio);


		$query = "	INSERT INTO 
						Domicilio (calle, num_interior, num_exterior, colonia, codigo_postal, stado, municipio)
					VALUES 
						('$this->calle',
						$this->numInterior,
						$this->numExterior,
						'$this->colonia',
						$this->codigoPostal,
						'$this->estado',
						'$this->municipio')";
		
		//$resultado = $this->consulta($query);
		$resultado = $this->conexion->query($query);

		if(!$resultado)
		{
			echo 'DatosEntidades::Direccion -> Error al insertar la direccion: '.$this->conexion->errno.':'.$this->conexion->error;
			$retornable = FALSE;
		}
		else
		{
			$this->id = $this->conexion->insert_id;
			
			$query = " INSERT INTO
							Entidad_has_Domicilio(Entidad_id_entidad, Domicilio_id_domicilio)
						VALUES
							($this->idDuenio, $this->id)";
			$resultado = $this->conexion->query($query);
			
			if(!$resultado)
			{
				echo 'DatosEntidades::Direccion -> Error al relacionar una direccion con una entidad: '.$this->conexion->errno.':'.$this->conexion->error;
				$retornable = FALSE;
			}
			else
			{
				$retornable = TRUE;
			}
			
		}

		$this->cerrar_conexion();

		return $retornable;
	}
	
    public function eliminar()
    {
    	if(!$this->conecta())
		{
			die('DatosEntidades::Direccion: '.$this->conexion->errno.':'.$this->conexion->error);
		}
		
		$query = " DELETE FROM
						Domicilio
					WHERE
						id_domicilio = $this->id
					LIMIT
						1";
						
		$resultado = $this->conexion->query($query);
		
		if(!$resultado)
		{
			echo 'DatosEntidades::Direccion -> No se pudo eliminar la Direccion: '.$this->conexion->errno.':'.$this->conexion->error;
			$retornable = FALSE;
		}
		else
		{
			$retornable = TRUE;
		}
		
		$this->cerrar_conexion();
		
		return $retornable;
    }
    public function modificar(){}
	public function recuperar($id){}
}
?>