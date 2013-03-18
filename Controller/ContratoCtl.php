<?php


require_once('Model/ContratoClass.php');
class ControladorContrato{
	public $model;


	function __construct(){
		$fecha = $_REQUEST['fecha'];
		$periodo = $_REQUEST['periodo'];
		$presupuesto = $_REQUEST['presupuesto'];
		$plazos = $_REQUEST['plazos'];
		$renovacion = $_REQUEST['renovacion'];
		$saldado = $_REQUEST['saldado'];


		$this -> model = new ContratoClass($fecha,$periodo,
			$presupuesto,$plazos,$renovacion,$saldado);

	}

	function ejecutar(){
		if(!isset($_REQUEST['action'])){
			$usuarios = $this->model->error();
		}else switch ($_REQUEST['action']){
			case 'crear':
				$usuario = $this->model->crear();
				break;
			/*case 'pago':
				$this -> modelP = new PagoClass()
				$usuario = $this->model->realizarPago();
				break;
			case 'gasto':
				$usuario = $this->model->realizarGasto();*/
			default:
				echo 'Ola k ase?, ekivokandose o k ase? :v'
				break;
		}


	}
}

?>
