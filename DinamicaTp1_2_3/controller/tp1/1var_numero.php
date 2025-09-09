<?php
define('ROOT_PATH', dirname(__DIR__, 2));
include_once ROOT_PATH . '/controller/encapsulamiento/encapsulado.php';


    /*
    Obtiene un número enviado por el usuario (ya sea por método POST o GET)
    usando la función encapsuladorDeMetodos().
    
    Evalua ese número de la siguiente manera:
    * Si es mayor que 0 → devuelve "Positivo".
    * Si es igual a 0 → devuelve "Cero".
    * Si es menor que 0 → devuelve "Negativo".
    * Si no se recibió ningún número → devuelve "No se encontró número".*/
    
    class varNumero{
        public function ejercicio1(){
            $metodo = encapsuladorDeMetodos();
            $respuesta = "No se encontró número";
            
            if (isset($metodo['num'])) {
                $numero = $metodo['num'];
    
                if ($numero > 0) {
                    $respuesta = "Positivo";
                } else if ($numero == 0) {
                    $respuesta = "Cero";
                } else {
                    $respuesta = "Negativo";
                }
            }
            return $respuesta;
        }
    }
?>