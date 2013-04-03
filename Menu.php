<?php

include ('Controller/ClienteCtl.php');
include ('Controller/ContratoCtl.php');
include ('Controller/SessionCtl.php');
    
    if(isset($_REQUEST['uso']))
    {
        switch ($_REQUEST['uso']) 
        {
            case 'cliente':
                $controlador = new ControladorCliente();
                break;
            case 'contrato':
                $controlador = new ControladorContrato();
                break;
            case 'login':
                $controlador = new LoginCtl();
                break;
            default:
                die("'uso' invalido");
        }
        
        $controlador->ejecutar();
        if($controlador->valido==TRUE)
            $_SESSION['usuario']=$controlador->model->nombre;
    }
    else
    {
        echo 'Ejemplos de uso: '.PHP_EOL;
        
        echo 'Para clientes'.PHP_EOL.PHP_EOL;
        //Llamadas al controlador que se encarga de manejar al cliente
        echo 'http://www.seguame.com/?uso=cliente&accion=insertar&nombre=Miguel&apellidoPat=Seguame&apellidoMat=Reyes&RFC=1234567890123&telefonos=36436418&nombreBanco=Santander&numeroCuenta=124a&emails=lol%40lol&calle=JesusUrueta&numInterior=1600&numExterior=1&colonia=Mirador&cp=4444&estado=Jalisco&municipio=gdl&esPersonaFisica=TRUE&username=lal&password=lal'.PHP_EOL;
        
        echo 'Para contrato'.PHP_EOL.PHP_EOL;
        //Controlador de Contrato
        echo '?uso=contrato&accion=crear&nombre=Miguel&apellidoPat=Seguame&apellidoMat=Reyes&RFC=1234567890123&telefonos=36436418&nombreBanco=Santander&numeroCuenta=124a&emails=lol%40lol&calle=JesusUrueta&numInterior=1600&numExterior=1&colonia=Mirador&cp=4444&estado=Jalisco&municipio=gdl&idCuenta=1&fecha=hoy&periodo=masd&presupuesto=1212&plazos=TRUE&renovacion=2432&saldado=FALSE';
    }

?>