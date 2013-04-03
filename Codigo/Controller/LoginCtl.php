<?php
    //#1
    
    /*
     * Antes de cualquier cosa, incluso del html debemos de iniciar el objeto de sesion y este
     * tiene que estar presente en todo el sitio
     */
    session_start();
    
    //verificamos que exista la sesion llama usuario y que no este vacia
    if(isset($_SESSION['usuario']) && $_SESSION['usuario']!=""){
        
        /*php se puede partir en modulos a su antojo como en este caso se parte
        *para hacer una llamada en JS, pero no importa en cuantos modulos se parta de esta manera
        *siempre php lo tomara como uno solo, en este caso el script esta dentro de la
        *selectiva simple if
         */
        ?>
            <script language="javascript" type="text/javascript">
                
                /*php por si mismo no puede redireccionarse a otra pagina
                *asi que esta sentencia en js nos hace ese trabajo
                */
                document.location.href="Menu.php";
                //Este formulario estará disponible cuando se comience a trabajar con la BD + HTML
            </script>
        <?php
    }
?>
<html>
    <head>
        <title>Login Control de Gastos</title>
    </head>
    
    <body>
        <form action="index.php" method="post" name="login">
            <table width="300" align="center">
                <tr>
                    <input type="hidden" name="uso" value="login">
                    <input type="hidden" name="accion" value="consultar">
                    <td width="100"><label>Usuario: </label></td>
                    <td width="200"><input type="text" width="200" name="username"/></td>
                </tr>
                <tr>
                    <td width="100"><label>Contrase&ntilde;a</label></td>
                    <td width="200"><input type="password" width="200" name="password" /></td>
                </tr>
                <tr>
                    
                    <td colspan="2" align="center"><input type="submit" name="enviar" value="Enviar"/></td>
                </tr>
            </table>
         </form>
    </body>
</html>