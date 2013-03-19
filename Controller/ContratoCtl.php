<?php


require('Model/ContratoClass.php');
require('Model/PagoClass.php');
require('Model/GastoClass.php');
class ControladorContrato{
	public $model;

	function __construct(){
		$this -> model = new ContratoClass();
	}

	function ejecutar(){
		if(!isset($_REQUEST['accion'])){
			$usuarios = $this->model->error();//
		}else switch ($_REQUEST['accion']){

			case 'crear':
				$nombre = $_REQUEST['nombre'];
				$apellidoPat = $_REQUEST['apellidoPat'];
				$apellidoMat = $_REQUEST['apellidoMat'];
				$rfc = $_REQUEST['RFC'];
				$entidad = new Entidad($nombre,$apellidoPat,$apellidoMat,$rfc,"","","","");
				$entidad->insertar("Entidad");
				$idEnt_Cont = $entidad -> idEntidad;
				$idCuenta = $_REQUEST['idCuenta'];
				$fecha = $_REQUEST['fecha'];
				$periodo = $_REQUEST['periodo'];
				$presupuesto = $_REQUEST['presupuesto'];
				$plazos = $_REQUEST['plazos'];
				$renovacion = $_REQUEST['renovacion'];
				$saldado = $_REQUEST['saldado'];
				
				$this->model->crear($idCuenta,$idEnt_Cont,$fecha,$periodo,$presupuesto,$plazos,$renovacion,$saldado);
				
				$usuario = $this->model;
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

		include ('View/vista.php');
	}
}

?>
