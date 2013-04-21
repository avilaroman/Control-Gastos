<!DOCTYPE html>
<html lang="es">
    <head>
        <meta charset="UTF-8"/>
        <title>Menu</title>
        <script type="text/javascript"></script>
        <noscript>Tu explorador no soporta javascript</noscript>
    </head>
    <body>
        <a href="Utils/Logout.php">Cerrar sesion</a>
    </body>
    
</html>


<?php

include_once ('Controller/ClienteCtl.php');
include_once ('Controller/ContratoCtl.php');
include_once ('Controller/LoginCtl.php');
//include_once ('Utils/Logout.php');

        
    if(isset($_REQUEST['uso']))
    {
        switch ($_REQUEST['uso']) 
        {
            case 'cliente':
				include ('Utils/StatusSession.php');
                $controlador = new ControladorCliente();
                break;
            case 'contrato':
				include ('Utils/StatusSession.php');
                $controlador = new ControladorContrato();
                break;
            case 'login':
                $controlador = new LoginCtl();
                break;
            default:
                die("'uso' invalido");
        }
        
        $controlador->ejecutar();
    }
    else
    {
        echo 'Ejemplos de uso: '.PHP_EOL;
        
        echo 'Para clientes'.PHP_EOL.PHP_EOL;
        //Llamadas al controlador que se encarga de manejar al cliente
        echo 'http://www.seguame.com/?uso=cliente&accion=insertar&nombre=Foo&apellidoPat=Bar&apellidoMat=Baz&RFC=1234567890123&esPersonaFisica=TRUE&username=test&password=test&telefono=36436418&email=lol%40lol&direccion[calle]=ASDF&direccion[numInterior]=345&direccion[numExterior]=123&direccion[colonia]=Mirador&direccion[cp]=4444&direccion[estado]=Jalisco&direccion[municipio]=gdl$&cuentaBancaria[nombreBanco]=Santander&cuentaBancaria[numeroCuenta]=124a'.PHP_EOL;
        
        echo 'Para contrato'.PHP_EOL.PHP_EOL;
        //Controlador de Contrato
        echo '?uso=contrato&accion=crear&nombre=Miguel&apellidoPat=Seguame&apellidoMat=Reyes&RFC=1234567890123&telefonos=36436418&nombreBanco=Santander&numeroCuenta=124a&emails=lol%40lol&calle=JesusUrueta&numInterior=1600&numExterior=1&colonia=Mirador&cp=4444&estado=Jalisco&municipio=gdl&idCuenta=1&fecha=hoy&periodo=masd&presupuesto=1212&plazos=TRUE&renovacion=2432&saldado=FALSE';
    }

?>