<?php
    $status = session_status();
    if($status == PHP_SESSION_NONE){
        session_start();
    }else
    if($status == PHP_SESSION_DISABLED){
        ?><script language="javascript" type="text/javascript">
                
                /*php por si mismo no puede redireccionarse a otra pagina
                *asi que esta sentencia en js nos hace ese trabajo
                */
                document.location.href="index.php";
                //Este formulario estará disponible cuando se comience a trabajar con la BD + HTML
     </script>
     <?php
    }
?>