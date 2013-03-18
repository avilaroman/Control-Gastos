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
	public function __construct($nombre, $apellidoPat, $apellidoMat, $RFC, $telefonos, $cuentasBancarias, $emails, $domicilios, $esPersonaFisica = TRUE)
	{
		parent::__construct($nombre, $apellidoPat, $apellidoMat, $RFC, $telefonos, $cuentasBancarias, $emails, $domicilios);
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
		require('bd_info.inc');
		require_once('baseDatos.php');

		$BD = new BaseDatos($hostdb, $userdb, $passdb, $db);

		if(!$BD->conecta())
		{
			die('SHIT HAPPENS: '.$BD->conexion->errno.':'.$BD->conexion->error);
		}


		$query = "	INSERT INTO 
						Cliente (Entidad_id_entidad, persona_fisica)
					VALUES 
						($this->idEntidad,
						 $this->esPersonaFisica)";

		//$resultado = $BD->consulta($query);
		$resultado = $BD->conexion->query($query);

		if(!$resultado)
		{
			echo 'SHIT HAPPENS: '.$BD->conexion->errno.':'.$BD->conexion->error;
			$retornable = FALSE;
		}
		else
		{
			$this->idCliente = $BD->conexion->insert_id;
			$retornable = $this->idCliente;
		}

		$BD->cerrar_conexion();

		return $retornable;
	}
}

?>