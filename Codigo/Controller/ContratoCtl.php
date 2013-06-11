<?php

require_once('Model/CuentasClass.php');
require_once('Model/ContratoClass.php');
require_once('Model/PagoClass.php');
require_once('Model/GastoClass.php');
require_once('Utils/Cleaner.php');
//require_once('View/html.html');
class ControladorContrato{
	public $model;

	function ejecutar(){
		if(isset($_POST['accion'])){
		      $_REQUEST = Cleaner::LimpiarTodo($_POST);
		     switch ($_POST['accion']){

			case 'crear':
                if(isset($_SESSION['admin']) && $_SESSION['admin'] == 1)
                $this->crearContrato();
                else{
                    echo "Shit happened or u t not Admin";
                }
				break;
			case 'pago':
				$usuario = $this->realizarPago();

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
	}

    private function crearContrato()
    {
        $cuenta = new Cuentas();
		
        $usuario = $cuenta->recuperarCliente($_POST['idCliente']);
        $idEnt_Cont = $_POST['idEntidad'];
        $idCuenta = $cuenta->getIdCuenta();
        $fecha = $_POST['fecha'];
        $periodo = $_POST['periodo'];
        $presupuesto = $_POST['presupuesto'];
		
		if(isset($_POST['plazos']))
		{
			$plazos = TRUE;
		}
		else
		{
			$plazos = FALSE;
		}
		
        $renovacion = $_POST['renovacion'];
		
		if(isset($_POST['saldado']))
		{
			$saldado = TRUE;
		}
		else
		{
			$saldado = FALSE;
		}
		
		$asunto = $_POST['asunto'];
        
		$contrato = new Contrato($idCuenta, $idEnt_Cont, $fecha, $periodo, $presupuesto, $plazos, $renovacion, $saldado, $asunto);
		
		$contrato->insertar();
                
    }

    private function realizarPago(){
                $monto = $_POST['monto'];
                $fecha = $_POST['fecha'];
                $usuario = $this->model->RealizarPago($monto,$fecha);
    }
}

?>
