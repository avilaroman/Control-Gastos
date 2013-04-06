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
	
	function ConsultarPago(){
        
    $this->conecta();
        if(!$this->conecta())
        {
            die('SHIT HAPPENS: '.$this->conexion->errno.':'.$this->conexion->error);
        }
        $query = "SELECT 
                    *
                 FROM
                    Pago";
        $resultado = $this->conexion->query($query);
        
        if($this->conexion->errno)
        {
            echo 'Error consultando Pago '.$this->conexion->errno.' : '.$this->conexion->error;
            //Cerrar la conexion
            $this->cerrar_conexion();
            return FALSE;
        }
        else
        {
            //Cerrar la conexion
            $this->cerrar_conexion();

            while ($fila = $resultado -> fetch_assoc())
            printf ("[%s|%s|%s]\n", $fila["id_pago"], $fila["monto"], $fila["fecha_pago"]);    
        }
        
        
	}
	
	function ConsultarGasto(){
	    $this->conecta();
        if(!$this->conecta())
        {
            die('SHIT HAPPENS: '.$this->conexion->errno.':'.$this->conexion->error);
        }
        $query = "SELECT 
                    *
                 FROM
                    Gasto";
        $resultado = $this->conexion->query($query);
        
        if($this->conexion->errno)
        {
            echo 'Error consultando Gasto '.$this->conexion->errno.' : '.$this->conexion->error;
            //Cerrar la conexion
            $this->cerrar_conexion();
            return FALSE;
        }
        else
        {
            //Cerrar la conexion
            $this->cerrar_conexion();

            while ($fila = $resultado -> fetch_assoc())
            printf ("[%s|%s|%s|%s|%s|%s]\n", $fila["id_gasto"], $fila["costo"], $fila["precio"], $fila["comentario"], $fila["categoria"], $fila["comision"]);    
        }
        
        
	}
	
	function EliminarPago($id){
	    $this->conecta();
        if(!$this->conecta())
        {
            die('SHIT HAPPENS: '.$this->conexion->errno.':'.$this->conexion->error);
        }
        $query = "DELETE FROM
                    Pago
                    WHERE
                    id_pago LIKE '$id'";
        $resultado = $this->conexion->query($query);
        
        if($this->conexion->errno)
        {
            echo 'Error eliminando Pago '.$this->conexion->errno.' : '.$this->conexion->error;
            //Cerrar la conexion
            $this->cerrar_conexion();
            return FALSE;
        }
        else
        {
            //Cerrar la conexion
            $this->cerrar_conexion();
            printf ("Pago Eliminado \n");    
        }
        
        
	}
    
    function EliminarGasto($id){
         $this->conecta();
        if(!$this->conecta())
        {
            die('SHIT HAPPENS: '.$this->conexion->errno.':'.$this->conexion->error);
        }
        $query = "DELETE FROM
                    Gasto
                    WHERE
                    id_gasto LIKE '$id'";
        $resultado = $this->conexion->query($query);
        
        if($this->conexion->errno)
        {
            echo 'Error eliminando Gasto '.$this->conexion->errno.' : '.$this->conexion->error;
            //Cerrar la conexion
            $this->cerrar_conexion();
            return FALSE;
        }
        else
        {
            //Cerrar la conexion
            $this->cerrar_conexion();
            printf ("Gasto Eliminado \n");    
        }
    }
	
    function ModificarPago($campo, $valor, $id){
        $this->conecta();
        if(!$this->conecta())
        {
            die('SHIT HAPPENS: '.$this->conexion->errno.':'.$this->conexion->error);
        }
        $query = "UPDATE
                    Pago
                    SET
                    $campo = '$valor'
                    WHERE
                    id_pago = '$id'";
        $resultado = $this->conexion->query($query);
        
        if($this->conexion->errno)
        {
            echo 'Error modificando Pago '.$this->conexion->errno.' : '.$this->conexion->error;
            //Cerrar la conexion
            $this->cerrar_conexion();
            return FALSE;
        }
        else
        {
            //Cerrar la conexion
            $this->cerrar_conexion();
            printf ("Campo Modificado \n");    
        }
        
    }
    
    function ModificarGasto($campo, $valor, $id){
        $this->conecta();
        if(!$this->conecta())
        {
            die('SHIT HAPPENS: '.$this->conexion->errno.':'.$this->conexion->error);
        }
        $query = "UPDATE
                    Gasto
                    SET
                    $campo = '$valor'
                    WHERE
                    id_gasto = '$id'";
        $resultado = $this->conexion->query($query);
        
        if($this->conexion->errno)
        {
            echo 'Error modificando Gasto '.$this->conexion->errno.' : '.$this->conexion->error;
            //Cerrar la conexion
            $this->cerrar_conexion();
            return FALSE;
        }
        else
        {
            //Cerrar la conexion
            $this->cerrar_conexion();
            printf ("Campo Modificado \n");    
        }
    }
    
	public function insertar(){}
    public function eliminar(){}
    public function modificar(){}
	public function recuperar($id){}

}
?>
