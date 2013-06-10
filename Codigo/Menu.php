<?php

include_once ('Controller/ClienteCtl.php');
include_once ('Controller/ContratoCtl.php');
include_once ('Controller/LoginCtl.php');

//include_once ('Utils/Logout.php');
if((!isset($_SESSION)))
{
	session_start();
}

        
    if(isset($_REQUEST['uso']))
    {
        switch ($_REQUEST['uso']) 
        {
            case 'cliente':
                $controlador = new ControladorCliente();
                break;
            case 'contrato':
				include ('Utils/StatusSession.php');
                $controlador = new ControladorContrato();
                break;
            case 'login':
                $controlador = new LoginCtl();
                break;
            case 'registrar':
                $controlador = new RegisterCtl();
                break;
                
        }
        
        $controlador->ejecutar();
		
    }
    else
    {
    	if(isset($_SESSION['username']))
		{
			include ('Utils/StatusSession.php');
			require_once ('View/menu.html');
		}
    }
 		

?>

