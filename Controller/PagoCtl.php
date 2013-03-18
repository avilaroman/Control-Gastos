<?php

require_once('Model/PagoClass.php');

/**
* 
*/
class ControladorPago
{
	public $model;

	function __construct()
	{
		$monto = $_REQUEST['monto'];
		$fecha = $_REQUEST['fecha'];

		$this -> model = new PagoClass($monto,$fecha);
	}

	function ejecutar(){
		if(!isset($_REQUEST['action'])){
			$usuarios = $this->model->error();
		}else switch( $_REQUEST['action']){
			case 'gasto':
				$usuario=$this->model->gasto();
				break;
			case 'lista':
				$usuario=$this->model->lista();
				break;
			default:
				echo 'Ola k ase?, ekivokandose o k ase? :v'
				break;
		}

	}
}
?>