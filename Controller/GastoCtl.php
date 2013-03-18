<?php

require_once('Model/GastoClass.php');

/**
* 
*/
class ControladorGasto
{
	public $model;

	function __construct()
	{
		$costo = $_REQUEST['costo'];
		$precio = $_REQUEST['precio'];
		$comentario = $_REQUEST['comentario'];
		$categoria = $_REQUEST['categoria'];
		$cuenta_origen = $_REQUEST['origen'];
		$cuenta_destino = $_REQUEST['destino'];
		$comision = $_REQUEST['comision'];

		$this -> model = new GastoClass($costo,$precio,$comentario,
			$categoria,$cuenta_origen,$cuenta_destino,$comision);
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
				echo 'Ola k ase?, ekivokandose o k ase? :v';
				break;
		}

	}
}
?>