<?php

require_once ('Model/iTablaDB.php');

class CuentaBanco implements iTablaDB
{
	public $nombreBanco;
	public $numerosCuenta;
	public $idDuenio;
	
	public function __construct($nombreBanco, $numerosCuenta, $idDuenio)
	{
		$this->nombreBanco = $nombreBanco;
		$this->numerosCuenta = $numerosCuenta;
		$this->idDuenio = $idDuenio;
	}
	
	public function insertar($tabla)
	{
		require('bd_info.inc');
		require_once('baseDatos.php');

		$BD = new BaseDatos($hostdb, $userdb, $passdb, $db);

		if(!$BD->conecta())
		{
			die('Error conexion con la inserccion de la BD: '.$BD->conexion->errno.':'.$BD->conexion->error);
		}

		$this->nombreBanco = $BD->limpiarCadena($this->nombreBanco);


		$query = "	INSERT INTO 
						$tabla (Entidad_id_entidad,num_cuenta)
					VALUES 
						($this->idDuenio,
						'$this->numerosCuenta')";
		//$resultado = $BD->consulta($query);
		$resultado = $BD->conexion->query($query);

		if(!$resultado)
		{
			echo 'No se pudo insertar la cuenta del banco: '.$BD->conexion->errno.':'.$BD->conexion->error;
			$retornable = FALSE;
		}
		else
		{
			
			$idCuenta = $BD->conexion->insert_id;
			
			$query = "  SELECT 
							id_banco
						FROM
							Banco
						WHERE
							nombre LIKE '$this->nombreBanco'";
							
			$resultado = $BD->conexion->query($query);
							
			while ($fila = $resultado -> fetch_assoc())
				$banco[] = $fila;
			
			if(isset($banco))
			{
				$idBanco = $banco[0]['id_banco'];
				
				$query = "	INSERT INTO 
								Cuenta_Bancaria_has_Banco (Cuenta_Bancaria_id_cuenta_Bancaria, Banco_id_banco)
							VALUES 
								($idCuenta, $idBanco)";
				
				$resultado = $BD->conexion->query($query);

				if(!$resultado)
				{
					echo 'No se pudo relacionar la cuenta del banco: '.$BD->conexion->errno.':'.$BD->conexion->error;
					$retornable = FALSE;
				}
						
				$retornable = TRUE;
			}
			else
			{
				 $retornable = FALSE;
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