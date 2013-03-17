<?php

require_once('entidad.php');

class Cliente extends Entidad
{
	public $idCliente;
	public $esPersonaFisica;

	public function __construct($nombre, $apellidoPat, $apellidoMat, $RFC, $telefonos, $cuentasBancarias, $emails, $domicilios, $esPersonaFisica)
	{
		parent::__construct($nombre, $apellidoPat, $apellidoMat, $RFC, $telefonos, $cuentasBancarias, $emails, $domicilios);
		$this->esPersonaFisica = $esPersonaFisica;
	}

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