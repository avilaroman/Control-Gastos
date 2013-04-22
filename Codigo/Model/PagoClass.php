<?php
class PagoClass{


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
    
    function modificar($campo, $valor, $id){
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
    
    function eliminar($id){
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
    
    function insertar($montoP,$fechaP){
        $model = new PagoClass($montoP,$fechaP);
    }
    
}
?>