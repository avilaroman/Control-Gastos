<?php
	
    //#1
    
    /*
     * Antes de cualquier cosa, incluso del html debemos de iniciar el objeto de sesion y este
     * tiene que estar presente en todo el sitio
     */
    
    //verificamos que exista la sesion llama usuario y que no este vacia
    if(isset($_SESSION['username'])){
	header("Location: View/Menu.php");
	}else{
		if(!isset($_SESSION))
		{
			session_start();
		}
	    include ('View/login.html');
	}
?>