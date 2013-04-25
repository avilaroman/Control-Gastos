<?php
	
    //#1
    
    /*
     * Antes de cualquier cosa, incluso del html debemos de iniciar el objeto de sesion y este
     * tiene que estar presente en todo el sitio
     */
    session_start();
    
    //verificamos que exista la sesion llama usuario y que no este vacia
    if(isset($_SESSION['username'])){
	header("Location: Menu.php");
    
	}else{
	    ?>
	    <html>
    <head>
        <title>Login Control de Gastos</title>
    </head>
    
    <body>
        <form action="Menu.php" method="get" name="login">
            <table width="300" align="center">
                <tr>
                    <td width="100"><label>Usuario: </label></td>
                    <td width="200"><input type="text" width="200" name="username" required="required"/></td>
                </tr>
                <tr>
                    <td width="100"><label>Contrase&ntilde;a</label></td>
                    <td width="200"><input type="password" width="200" name="password" required="required" /></td>
                </tr>
                <tr>
                    
                    <td colspan="5" align="middle"><input type="submit" name="uso" value="login"/></td>
                    <td colspan="5" align="middle"><input type="submit" name="registrar" value="Registrar"/></td>
                </tr>
            </table>
         </form>
    </body>
</html>
        <?php
	}
?>