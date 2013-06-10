<?php
require_once('baseDatos.php');
require_once ("cliente.php");

class Cuentas extends iTablaDB
{
	
	public function recuperar($id)
	{
		if(!$this->conecta())
		{
			die('Cuentas::obtenCuentas: '.$this->conexion->errno.':'.$this->conexion->error);
		}
		
		$query = "SELECT
					*
				  FROM
				  	Cuenta
				  WHERE
				  	Cliente_id_cliente = $id";
					
		$resultado = $this->conexion->query($query);
		
		while ($fila = $resultado -> fetch_assoc())
				$cuenta[] = $fila;	

		if(isset($cuenta))
		{
			$usuario = new Cliente();
			$usuario->reconstruirCliente($cuenta[0]['Cliente_id_cliente']);
			$cuentaObtenida['nombre_usuario'] 	=  $cuenta[0]['nombre_usuario'];
			$cuentaObtenida['clave_acceso']	 	=  $cuenta[0]['clave_acceso'];
			$cuentaObtenida['idCliente']		=  $usuario->getIdCliente();
			$cuentaObtenida['esPersonaFisica'] 	=  $usuario->getPersonaFisica();
			$cuentaObtenida['nombre'] 			=  $usuario->getName();
			$cuentaObtenida['apellidoPat'] 		=  $usuario->getApellidoPaterno();
			$cuentaObtenida['apellidoMat']		=  $usuario->getApellidoMaterno();
			$cuentaObtenida['RFC'] 				=  $usuario->getRFC();
			$cuentaObtenida['telefonos'] 		=  $usuario->getTelefono();
			$cuentaObtenida['cuentasBancarias'] =  $usuario->getCuentaBancaria();
			$cuentaObtenida['emails']			=  $usuario->getEmail();
			$cuentaObtenida['domicilios'] 		=  $usuario->getDomicilio();
			$cuentaObtenida['idEntidad'] 		=  $usuario->getIdEntidad();
			
			$this->id 							= $cuenta[0]['id_cuenta'];
		}
		
		$this->cerrar_conexion();
		
		return $cuentaObtenida;
	}		

	public  function insertar(){}
    public  function eliminar(){}
    public  function modificar($campo, $valor)
    {
    	if(!$this->conecta())
		{
			die('SHIT HAPPENS: '.$this->conexion->errno.':'.$this->conexion->error);
		}

		$query = "	UPDATE  
						Cuenta
					SET
						$campo = '$valor'
					WHERE
						id_cuenta = $this->id";

		$resultado = $this->conexion->query($query);

		if(!$resultado)
		{
			echo "No se logro modificar el $campo de la cuenta: ".$this->conexion->errno.':'.$this->conexion->error;
			$exito = FALSE;
		}
		else
		{
			$exito = TRUE;
		}

		$this->cerrar_conexion();

		return $exito;
    }
}
?>
	