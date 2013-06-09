<?php

require_once ('Model/iTablaDB.php');
class GastoClass extends iTablaDB{

	private $costo;
	private $precio;
	private $comentario;
	private $categoria;
	private $cuenta_origen;
	private $cuenta_destino;
	private $comision;
	private $id_contrato;

	function __construct($id_contrato, $costoG,$precioG,$comentarioG,
			$categoriaG,$cuenta_origenG,$cuenta_destinoG,$comisionG){
		$this->costo=$costoG;
		$this->precio=$precioG;
		$this->comentario=$comentarioG;
		$this->categoria=$categoriaG;
		$this->cuenta_origen=$cuenta_origenG;
		$this->cuenta_destino=$cuenta_destinoG;
		$this->comision=$comisionG;
		
		$this->id_contrato = $id_contrato;
	}

	function gasto(){
		require('bd_info.inc');

		$BD = new BaseDatos($hostdb, $userdb, $passdb, $db);

		if(!$BD->conecta())
		{
			die('SHIT HAPPENS: '.$BD->conexion->errno.':'.$BD->conexion->error);
		}

		$query = "INSERT INTO
			Gasto(costo,precio,comentario,categoria,cuenta_origen,
				cuenta_destino,comision)
			VALUES 
			('$this->costo',
			'$this->precio',
			'$this->comentario',
			'$this->categoria',
			'$this->cuenta_origen',
			'$this->cuenta_destino'.
			'$this->comision')
					";

		$resultado = $BD->conexion->query($query);
		if(!$resultado)
		{
			echo 'SHIT HAPPENS: '.$BD->conexion->errno.':'.$BD->conexion->error;
			$retornable = FALSE;
		}

		$BD->cerrar_conexion();
	}
    
    function modificar($campo, $valor){
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
                    id_gasto = '$this->id'";
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
    
    function eliminar(){
         $this->conecta();
        if(!$this->conecta())
        {
            die('SHIT HAPPENS: '.$this->conexion->errno.':'.$this->conexion->error);
        }
        $query = "DELETE FROM
                    Gasto
                    WHERE
                    id_gasto LIKE '$this->id'";
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
    
	//Ponerles los THIS y así
    function insertar(){
        $model = new GastoClass($costoG,$precioG,$comentarioG,
            $categoriaG,$cuenta_origenG,$cuenta_destinoG,$comisionG);
    }
	
	public  function recuperar($id){}
    
}
?>