<?php
require_once('Utils/Cleaner.php');

class LoginCtl{
        
    function ejecutar(){
        session_start();
        $modelo = new Cliente();
        $_POST = Cleaner::LimpiarTodo($_POST);
        $usuario = $modelo->recuperarCliente($_POST['username'], $_POST['password']);
        if($usuario==FALSE)
            echo "Usuario y/o contraseña incorrectos ";
        else
            $_SESSION['usuario']=$usuario;
    }
    
           
}
?>
