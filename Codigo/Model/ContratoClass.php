<?php

require_once 'Model/iTablaDB.php';
require_once 'Model/baseDatos.php';
require_once 'Model/entidad.php';

class ContratoClass extends iTablaDB{
	private $idCuenta;
	private $idEnt;
	private $fecha;
	private $periodo;
	private $plazos;
	private $renovacion;
	private $saldado;

	function __construct(/*$idC,*/$idEn,$fechaC,$periodoC,$presupuestoC,$plazosC,$renovacionC,$saldadoC){
		//$this->idCuenta=$idC;
		$this->idEnt=$idEn;
		$this->fecha=$fechaC;
		$this->periodo=$periodoC;
		$this->presupuesto=$presupuestoC;
		$this->plazos=$plazosC;
		$this->renovacion=$renovacionC;
		$this->saldado=$saldadoC;
	}

	public function insertar(){	

		if(!$this->conecta())
		{
			die('Contrato::insertar: '.$this->conexion->errno.':'.$this->conexion->error);
		}

		$query = "INSERT INTO
			Contrato(Entidad_id_contacto,fecha_contrato,periodo_fiscal,presupuesto,plazos,renovacion,saldado)
			VALUES 
			($this->idEnt,
			'$this->fecha',
			'$this->periodo',
			'$this->presupuesto',
			'$this->plazos',
			'$this->renovacion',
			'$this->saldado')
					";
		$resultado = $this->conexion->query($query);
		
		if(!$resultado)
		{
			echo 'Contrato::insertar::No se logró insertar el contrato: '.$BD->conexion->errno.':'.$BD->conexion->error;
			$insertado = FALSE;
		}
		else{
			$this->idCuenta = $this->conexion->insert_id;
			$insertado = TRUE;
		}

		
		$BD->cerrar_conexion();

		return $insertado;
	}	    

    function RealizarPago(){
        
    }
    public function eliminar(){}
    public function modificar($campo, $valor){}
	public function recuperar($id){}

}
?>
