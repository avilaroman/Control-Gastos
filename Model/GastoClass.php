<?php
class GastoClass implements iTablaDB{


	private $costo;
	private $precio;
	private $comentario;
	private $categoria;
	private $cuenta_origen;
	private $cuenta_destino;
	private $comision;

	function __construct($costoG,$precioG,$comentarioG,
			$categoriaG,$cuenta_origenG,$cuenta_destinoG,$comisionG){
		$this->costo=$costoG;
		$this->precio=$precioG;
		$this->comentario=$comentarioG;
		$this->categoria=$categoriaG;
		$this->cuenta_origen=$cuenta_origenG;
		$this->cuenta_destino=$cuenta_destinoG;
		$this->comision=$comisionG;
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
}
?>