<?php


require('Model/ContratoClass.php');
require('Model/PagoClass.php');
require('Model/GastoClass.php');
require('Utils/Cleaner.php');
require_once('View/html.html');
class ControladorContrato{
	public $model;

	function __construct(){
		$this -> model = new ContratoClass();
	}

	function ejecutar(){
		if(!isset($_REQUEST['accion'])){
			$usuarios = $this->model->error();
		}else{
		      $_REQUEST = Cleaner::LimpiarTodo($_REQUEST);
		     switch ($_REQUEST['accion']){

			case 'crear':
                
				$nombre = $_REQUEST['nombre'];
				$apellidoPat = $_REQUEST['apellidoPat'];
				$apellidoMat = $_REQUEST['apellidoMat'];
				$rfc = $_REQUEST['RFC'];
				
				$entidad = new Entidad($nombre,$apellidoPat,$apellidoMat,$rfc,"","","","");
				$entidad->insertar();
				
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

				$usuario = $this->model->RealizarPago($monto,$fecha);

				break;
			case 'gasto':
				$usuario = $this->model->RealizarGasto($_REQUEST['costo'],$_REQUEST['precio'],$_REQUEST['comentario'],
					$_REQUEST['categoria'],$_REQUEST['cuenta_origen'],$_REQUEST['cuenta_destino'],$_REQUEST['comision']);
				break;
                
            case 'consultar':
                //posible if que indique si es pago o gasto
                $usuario = $this->model->ConsultarPago();
                $usuario = $this->model->ConsultarGasto();
                break;
            case 'modificar':
                //if gasto o pago
                $usuario = $this->model->ModificarPago($_REQUEST['campo'], $_REQUEST['valor'], $_REQUEST['id']);
                //$usuario = $this->model->ModificarGasto($_REQUEST['campo'], $_REQUEST['valor'], $_REQUEST['id']);
                break;
            case 'eliminar':
                //if
                $usuario = $this->model->EliminarPago($_REQUEST['del']);
                $usuario = $this->model->EliminarGasto($_REQUEST['del']);
                break;
			
			default:
				echo 'Ola k ase?, ekivokandose o k ase? :v';
				break;
		}
		}
		include ('View/vista.php');
	}
}

?>
