<?php
# Funcion para limpiar caracte-
# res que pudieran comprometer
# al servidor y/o al usuario
class Cleaner{
    public static function limpia($var){
        $var = strip_tags($var);
        $malo = array("\\",";","\'","'"); // Aqui poner caracteres no permitidos
    
        foreach($malo as $quitable){
            $var = str_replace($quitable,"",$var);
        }

        return $var;
    }
 
# Funcion que aplica la funcion anterior
# para no tener que preocuparnos por
# ataques de XSS o SQLi
    public static function LimpiarTodo($datos){
        if(is_array($datos)){
            $datos = array_map('limpia',$datos);
        
        return $datos;  
        } 
    
    }
}
?>