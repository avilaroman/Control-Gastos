<?php

require_once 'Model/iTablaDB.php';
require_once 'Model/baseDatos.php';
require_once 'Model/entidad.php';

class ContratoClass implements iTablaDB{
	private $idCuenta;
	private $idEnt;
	private $fecha;
	private $periodo;
	private $plazos;
	private $renovacion;
	private $saldado;

	function crear($idC,$idEn,$fechaC,$periodoC,$presupuestoC,$plazosC,$renovacionC,$saldadoC){
		$this->idCuenta=$idC;
		$this->idEnt=$idEn;
		$this->fecha=$fechaC;
		$this->periodo=$periodoC;
		$this->presupuesto=$presupuestoC;
		$this->plazos=$plazosC;
		$this->renovacion=$renovacionC;
		$this->saldado=$saldadoC;

		
		require('bd_info.inc');

		$BD = new BaseDatos($hostdb, $userdb, $passdb, $db);

		if(!$BD->conecta())
		{
			die('SHIT HAPPENS: '.$BD->conexion->errno.':'.$BD->conexion->error);
		}

		$query = "INSERT INTO
			Contrato(Cuenta_id_cuenta,Entidad_id_contacto,fecha_contrato,periodo_fiscal,presupuesto,plazos,renovacion,saldado)
			VALUES 
			($this->idCuenta,
			$this->idEnt,
			'$this->fecha',
			'$this->periodo',
			'$this->presupuesto',
			'$this->plazos',
			'$this->renovacion',
			'$this->saldado')
					";
		echo "$query";
		$resultado = $BD->conexion->query($query);
		if(!$resultado)
		{
			echo 'SHIT HAPPENS: '.$BD->conexion->errno.':'.$BD->conexion->error;
			$retornable = FALSE;
		}
		else{
			$this->id = $BD->conexion->insert_id;
			$retornable = $this->id;
		}

		$query = "INSERT INTO
			Contrato_has_Asunto(Contrato_id_contrato)
			VALUES
			('this->id')";

		$resultado = $BD->conexion->query($query);


		$BD->cerrar_conexion();

		return $retornable;

	}

	function RealizarPago($montoP,$fechaP){
		$model = new PagoClass($montoP,$fechaP);
	}

	function RealizarGasto($costoG,$precioG,$comentarioG,
			$categoriaG,$cuenta_origenG,$cuenta_destinoG,$comisionG){
		$model = new GastoClass($costoG,$precioG,$comentarioG,
			$categoriaG,$cuenta_origenG,$cuenta_destinoG,$comisionG);
	}
	
	
	public function insertar($tabla){}
    public function eliminar($tabla){}
    public function modificar($tabla){}
	public function recuperar($tabla, $id){}

}
?>
