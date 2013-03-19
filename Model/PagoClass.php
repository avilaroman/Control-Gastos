<?php
class PagoClass implements iTablaDB{


	private $monto;
	private $fecha;

	function __construct($montoP,$fechaP){
		$this->monto=$montoP;
		$this->fecha=$fechaP;
	}

	function pago(){
		require('bd_info.inc');

		$BD = new BaseDatos($hostdb, $userdb, $passdb, $db);

		if(!$BD->conecta())
		{
			die('SHIT HAPPENS: '.$BD->conexion->errno.':'.$BD->conexion->error);
		}

		$query = "INSERT INTO
			Pago(monto,fecha_pago)
			VALUES 
			('$this->monto',
			'$this->fecha_pago')
					";

		$resultado = $BD->conexion->query($query);
		if(!$resultado)
		{
			echo 'SHIT HAPPENS: '.$BD->conexion->errno.':'.$BD->conexion->error;
			$retornable = FALSE;
		}

		$BD->cerrar_conexion();
	}
}
?>