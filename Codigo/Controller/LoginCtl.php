<?php
require('Utils/Cleaner.php');

    session_start();
            $modelo = new Cliente();
            $_POST = Cleaner.LimpiarTodo($_POST);
                $usuario = $modelo->recuperarCliente($_POST['username'], $_POST['password']);
                if($usuario==FALSE)
                    echo "Usuario y/o contraseña incorrectos ";
                else
                    $_SESSION['user']=$usuario;
?>
