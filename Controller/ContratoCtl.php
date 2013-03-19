<?php


require('Model/ContratoClass.php');
class ControladorContrato{
	public $model;

	function __construct(){
		$this -> model = new ContratoClass();
	}

	function ejecutar(){
		if(!isset($_REQUEST['action'])){
			$usuarios = $this->model->error();//
		}else switch ($_REQUEST['action']){

			case 'crear':
				$fecha = $_REQUEST['fecha'];
				$periodo = $_REQUEST['periodo'];
				$presupuesto = $_REQUEST['presupuesto'];
				$plazos = $_REQUEST['plazos'];
				$renovacion = $_REQUEST['renovacion'];
				$saldado = $_REQUEST['saldado'];
				
				$usuario = $this->model->crear($fecha,$periodo,$presupuesto,$plazos,$renovacion,$saldado);
				break;
			case 'pago':
				$monto = $_REQUEST['monto'];
				$fecha = $_REQUEST['fecha'];

				$usuario = $this->model->realizarPago($monto,$fecha);

				break;
			case 'gasto':
				$usuario = $this->model->realizarGasto($_REQUEST['costo'],$_REQUEST['precio'],$_REQUEST['comentario'],
					$_REQUEST['categoria'],$_REQUEST['cuenta_origen'],$_REQUEST['cuenta_destino'],$_REQUEST['comision']);
				break;
			
			default:
				echo 'Ola k ase?, ekivokandose o k ase? :v';
				break;
		}


	}
}

?>
