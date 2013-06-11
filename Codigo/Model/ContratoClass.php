<?php

require_once 'Model/iTablaDB.php';
require_once 'Model/baseDatos.php';
require_once 'Model/entidad.php';

class Contrato extends iTablaDB{
	private $idCuenta;
	private $idEnt;
	private $fecha;
	private $periodo;
	private $plazos;
	private $renovacion;
	private $saldado;
	private $asunto;

	function __construct($idC="",$idEn="",$fechaC="",$periodoC="",$presupuestoC="",$plazosC="",$renovacionC="",$saldadoC="", $asunto = ""){
		$this->idCuenta=$idC;
		$this->idEnt=$idEn;
		$this->fecha=$fechaC;
		$this->periodo=$periodoC;
		$this->presupuesto=$presupuestoC;
		$this->plazos=$plazosC;
		$this->renovacion=$renovacionC;
		$this->saldado=$saldadoC;
		$this->asunto = $asunto;
	}

	public function insertar(){	

		if(!$this->conecta())
		{
			die('Contrato::insertar: '.$this->conexion->errno.':'.$this->conexion->error);
		}

		$query = "INSERT INTO
			Contrato(Cuenta_id_cuenta, Entidad_id_contacto,fecha_contrato,periodo_fiscal,presupuesto,plazos,renovacion,saldado, asunto)
			VALUES 
			($this->idCuenta,
			 $this->idEnt,
			'$this->fecha',
			'$this->periodo',
			'$this->presupuesto',
			'$this->plazos',
			'$this->renovacion',
			'$this->saldado',
			'$this->asunto)
					";
		$resultado = $this->conexion->query($query);
		
		if(!$resultado)
		{
			echo 'Contrato::insertar::No se logró insertar el contrato: '.$this->conexion->errno.':'.$this->conexion->error;
			$insertado = FALSE;
		}
		else{
			$this->id = $this->conexion->insert_id;
			$insertado = TRUE;
		}

		$this->cerrar_conexion();

		return $insertado;
	}	    

    function RealizarPago(){
        
    }
    public function eliminar(){}
    public function modificar($campo, $valor)
    {
    	if(!$this->conecta())
		{
			die('SHIT HAPPENS: '.$this->conexion->errno.':'.$this->conexion->error);
		}

		$query = "	UPDATE  
						Contrato
					SET
						$campo = '$valor'
					WHERE
						id_contrato = $this->id";

		$resultado = $this->conexion->query($query);

		if(!$resultado)
		{
			echo "No se logro modificar el $campo del Contrato: ".$this->conexion->errno.':'.$this->conexion->error;
			$exito = FALSE;
		}
		else
		{
			$exito = TRUE;
		}

		$this->cerrar_conexion();

		return $exito;
    }
	
	public function recuperar($id)
	{
		if(!$this->conecta())
		{
			die('SHIT HAPPENS: '.$this->conexion->errno.':'.$this->conexion->error);
		}


		$query = "SELECT
						*
				  FROM
						Contrato
				  WHERE
				  		id_contrato = $id";

		//Ejecutar el query
		$resultado = $this->conexion->query($query);

		if($this->conexion->errno)
		{
			echo 'FALLO '.$this->conexion->errno.' : '.$this->conexion->error;
			
			$this->conexion -> close();
			return FALSE;
		}
		else
		{
			$this->cerrar_conexion();

			while ($fila = $resultado -> fetch_assoc())
				$contrato[] = $fila;
			
			if(isset($contrato))
			{
				$this->id 			= $contrato[0]['id_contrato'];
				$this->idCuenta		= $contrato[0]['Cuenta_id_cuenta'];
				$this->idEnt		= $contrato[0]['Entidad_id_contacto'];
				$this->fecha		= $contrato[0]['fecha_contrato'];
				$this->periodo		= $contrato[0]['periodo_fiscal'];
				$this->presupuesto	= $contrato[0]['presupuesto'];
				$this->plazos		= $contrato[0]['plazos'];
				$this->renovacion	= $contrato[0]['renovacion'];
				$this->saldado		= $contrato[0]['saldado'];
				$this->asunto		= $contrato[0]['asunto'];
				return TRUE;	
			}
			
			return FALSE;
					
		}
	}

}
?>
