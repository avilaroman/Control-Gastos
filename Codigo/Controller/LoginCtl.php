<?php
require_once('Utils/Cleaner.php');
//require_once('Utils/DebugerPHP.php');

class LoginCtl{
        
    function ejecutar()
    {
        if((isset($_SESSION)))
		{
			session_start();
		}
        $modelo = new Cliente();
        $_REQUEST = Cleaner::LimpiarTodo($_REQUEST);
        $usuario = $modelo->recuperarCliente($_REQUEST['username'], $_REQUEST['password']);
        
        if($usuario==FALSE)
		{
            echo "Usuario y/o contraseña incorrectos ";
			//logConsole("ERROR inicio sesion", $usuario);
		}
        else
		{
			$_SESSION['USERNAME'] = $_REQUEST['username'];
			$_SESSION['PASSWORD'] = $_REQUEST['password'];
			$_SESSION['username']=$modelo->getName();
			$_SESSION['id'] = $modelo->getIdCliente();
			
			//var_dump($modelo);
			//logConsole("SESSION", $_SESSION, true);
		}
            
    }
    
           
}
?>
