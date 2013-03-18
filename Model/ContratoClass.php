<?php
class Contrato{
	private $id;
	private $fecha;
	private $periodo;
	private $plazos;
	private $renovacion;
	private $saldado;

	function __construct($fechaC,$periodoC,$presupuestoC,$plazosC,$renovacionC,$saldadoC){
		this->fecha=$fechaC;
		this->periodo=$periodoC;
		this->presupuesto=$presupuestoC;
		this->plazos=$plazosC;
		this->renovacion=$renovacionC;
		this->saldado=$saldadoC;

	}

	function crear(){
		require('bd_info.inc');

		$BD = new BaseDatos($hostdb, $userdb, $passdb, $db);

		if(!$BD->conecta())
		{
			die('SHIT HAPPENS: '.$BD->conexion->errno.':'.$BD->conexion->error);
		}

		$query = "INSERT INTO
			Contrato(fecha_contrato,periodo_fiscal,presupuesto,plazos,renovacion,saldado)
			VALUES 
			('$this->fecha',
			'$this->periodo',
			'$this->presupuesto',
			'$this->plazos',
			'$this->renovacion',
			'$this->saldado')
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
