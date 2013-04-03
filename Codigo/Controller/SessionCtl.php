<?php

require_once('Model/cliente.php');

class SessionCtl{
    public $model;
    public $valido;
    
    function __construct(){
        $this->model = new Cliente();
        
    }
    
function ejecutar(){
    switch ($_REQUEST['accion']) {
        case 'consultar':
            $usuario = $this->model->recuperarCliente($_POST['username'], $_POST['password']);
              if($usuario==FALSE){
                echo "Usuario y/o contraseña incorrectos ";
                $valido = FALSE;
              }else
                  $valido = TRUE;
              
            break;
        
        default:
            
            break;
    }
}
}

?>